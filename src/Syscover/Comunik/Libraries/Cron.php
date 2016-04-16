<?php namespace Syscover\Comunik\Libraries;

use Illuminate\Support\Facades\Crypt;
use Syscover\Comunik\Models\EmailPattern;
use Syscover\Comunik\Models\EmailSendHistorical;
use Syscover\Comunik\Models\EmailSendQueue;
use Syscover\Comunik\Libraries\Miscellaneous as MiscellaneousComunik;
use Syscover\Pulsar\Libraries\EmailServices;
use Syscover\Pulsar\Libraries\ImapServices;
use Syscover\Pulsar\Models\EmailAccount;
use Syscover\Pulsar\Models\Preference;
use Syscover\Comunik\Models\EmailCampaign;
use Syscover\Comunik\Models\Contact;

class Cron
{
    /**
     *  Función que recupera las llamadas a realizar que serán enviadas a nuestra cola de procesos, tanto de emails de campañas persistentes que no se hayan enviado,
     *  como correos de campañas con fecha de envio anterior a la actual y que no se haya enviado.
     *  Tanto de emails como de SMS
     *
     * @access	public
     * @return	void
     */
    public static function checkCampaignsToCreate()
    {
        // listamos todas las campañas persistentes activas,
        // que su fecha de envío sea anterior a la actual y ya hayan sido enviadas
        $campaigns = EmailCampaign::getCampaignsWithPersistence();

        // enviamos a cola de proceso la comprobación que no hay correos nuevos a los que hacer envío
        foreach ($campaigns as $campaign)
        {
            Cron::checkEmailsToQueue(['id' => $campaign->id_044]);
        }


        // listamos todas las campañas sin crear, que su fecha de envío sea anterior a la actual,
        // enviará las campañas hasta que se envíen todos sus emails a cola de proceso y quede marcada como creada
        $campaigns = EmailCampaign::getCampaignsNotCreated();

        // enviamos a cola de proceso la comprobacion que no hay correos nuevos de los que hacer envío
        foreach ($campaigns as $campaign)
        {
            Cron::checkEmailsToQueue(['id' => $campaign->id_044]);

            if($campaign->enviada_048 != true)
            {
                EmailCampaign::where('id_044', $campaign->id_044)->update([
                    'processing_044' => true
                ]);
            }
        }
    }


    /**
     * Function to get contacts from campaign to record in send queue table
     *
     * @access	private
     * @param   arrray $data
     * @return	void
     */
    private static function checkEmailsToQueue($data)
    {
        $emailServiceSendingEmailsToQueue = Preference::getValue('emailServiceSendingEmailsToQueue', 5, '0');

        // Comprobación para casos de errores o caídas del servidor, y no dejen bloquedo el envío de emails a la cola de proceso
        // si en 5 minutos no se ha liberado la variable, damos por hecho que se ha bloqueado y la liberamos
        $update = \DateTime::createFromFormat('Y-m-d H:i:s', $emailServiceSendingEmailsToQueue->updated_at);
        if($emailServiceSendingEmailsToQueue->value_018 == '1' && date('U') - $update->getTimestamp() > 300)
            Preference::setValue('emailServiceSendingEmailsToQueue', 5, '0');


        // en el caso que el estado de envio esté activo, eso siginifica que hay una petición trabajando y enviando
        // a la tabla de cola de envíos los contactos, cuando termine de hacerlo cambiaremos el estado de envío de emails
        // para poder aceptar más peticiones, de esa manera nos aseguramos que no hayan
        // varias peticiones concurrentes insertando mails.
        if($emailServiceSendingEmailsToQueue->value_018 == '1')
            exit;
        else
            Preference::setValue('emailServiceSendingEmailsToQueue', 5, '1');


        // START INCLUDES EMAILS IN SEND QUEUE TABLE
        $campaign = EmailCampaign::find($data['id']);

        // antes de realizar la ejecución comprobamos que la capaña aún existe, no vaya a ser que la hayan borrado en el intervalo de tiempo,
        // entre que se mando la petición a cola y se ejecute la petición
        if($campaign == null)   exit;

        $groups     = $campaign->getGroups;
        $countries  = $campaign->getCountries;
        $groupIds   = $groups->pluck('id_040')->toArray();
        $countryIds = $countries->pluck('id_002')->toArray();

        // obtenemos los contactos a insertar
        $contacts = Contact::getContactsEmailToInsert($campaign->id_044, $groupIds, $countryIds, (int)Preference::getValue('emailServiceIntervalProcess', 5)->value_018, 0);

        // insert emailing into email queue
        if(count($contacts) > 0)
        {
            $emailSendQueue = [];
            foreach ($contacts as $contact)
            {
                $emailing = [
                    'campaign_047'  => $campaign->id_044,
                    'contact_047'   => $contact->id_041,
                    'create_047'    => date('U'),
                    'sorting_047'   => $campaign->sorting_044
                ];
                array_push($emailSendQueue, $emailing);
            }

            EmailSendQueue::insert($emailSendQueue);

            Preference::setValue('emailServiceSendingEmailsToQueue', 5, '0');
        }
        else
        {
            // marcamos la campaña como creada, ya que puede que esté creada de antemano
            // o si no lo estuviera por ser un envío con fecha posterior a la de su creación
            EmailCampaign::where('id_044', $campaign->id_044)->update([
                'created_044' => true
            ]);

            Preference::setValue('emailServiceSendingEmailsToQueue', 5, '0');
        }
    }


    /**
     *  Function to check if there is to send any email
     *
     *  @access	public
     *  @return	void
     */
    public static function checkSendEmails()
    {
        $nMailings = EmailSendQueue::getNMailings();

        if($nMailings > 0)
            Cron::sendEmails();
    }


    /**
     *  Function that sends emails
     *
     * @access	private
     * @return	array
     */
    private static function sendEmails()
    {
        $emailServiceSendingEmails = Preference::getValue('emailServiceSendingEmails', 5, '0');

        // Comprobación para casos de errores o caídas del servidor, y no dejen bloquedo el envío de emails
        // si en 5 minutos no se ha liberado la variable, damos por hecho que se ha bloqueado y la liberamos
        $update = \DateTime::createFromFormat('Y-m-d H:i:s', $emailServiceSendingEmails->updated_at);
        if($emailServiceSendingEmails->value_018 == '1' && date('U') - $update->getTimestamp() > 300)
            Preference::setValue('emailServiceSendingEmails', 5, '0');


        //en el caso que el estado de envio esté activo, eso siginifica que hay una petición en curso y está haciendo la petición
        //a la base de datos y esta sustrayendo los ids, para posteriormente cambiar el estado de envíos, solo en ese momento
        //cambiaremos el estado de envío de emails para poder aceptar más peticiones, de esa manera nos aseguramos que no hayan
        //varias peticiones concurrentes del gestor de colas.
        if($emailServiceSendingEmails->value_018 == '1')
            exit;
        else
            Preference::setValue('emailServiceSendingEmails', 5, '1');


        // consultamos la cola de envíos que estén por enviar, solicitamos los primero N envíos según el itervalo configurado
        // solo de aquellos envíos que estén en estado: 0 = waiting to be sent
        $mailings   = EmailSendQueue::getMailings((int)Preference::getValue('emailServiceIntervalProcess', 5)->value_018, 0);

        $mailingIds = $mailings->pluck('id_047')->toArray();

        if(count($mailings) > 0)
        {
            // cambiamos el estado de EmailSendQueue para que se puedan hacer peticiones
            EmailSendQueue::whereIn('id_047', $mailingIds)->update([
                // status_047 = 1 in process
                'status_047' => 1
            ]);

            // desbloqueo de proceso de obtención de emails para ser enviados y se puedan hacer peticiones
            Preference::setValue('emailServiceSendingEmails', 5, '0');

            $successfulIds =[];

            foreach ($mailings as $mailing)
            {
                // Creamos el historico de envío con antelación para obtener el ID del histórico de envío y contabilizarlo
                $emailSendHistorical = EmailSendHistorical::create([
                    'send_queue_048'    => $mailing->id_047,
                    'campaign_048'      => $mailing->campaign_047,
                    'contact_048'       => $mailing->contact_047,
                    'create_048'        => $mailing->create_047,
                    'sent_048'          => date('U'),
                    'viewed_048'        => 0
                ]);

                $dataEmail = [
                    'replyTo'       => empty($mailing->reply_to_013)? null : $mailing->reply_to_013,
                    'email'         => $mailing->email_041,
                    'html'          => $mailing->header_044 . $mailing->body_044 . $mailing->footer_044,
                    'text'          => $mailing->text_044,
                    'subject'       => $mailing->subject_044,
                    'contactKey'    => Crypt::encrypt($mailing->id_041),
                    'company'       => isset($mailing->company_041)? $mailing->company_041 : '',
                    'name'          => isset($mailing->name_041)? $mailing->name_041 : '',
                    'surname'       => isset($mailing->surname_041)? $mailing->surname_041 : '',
                    'birthDate'     => isset($mailing->birth_date_041)?  date(config('pulsar.datePattern'), $mailing->birth_date_041) : '',
                    'campaign'      => Crypt::encrypt($mailing->id_044),
                    'historicalId'  => Crypt::encrypt($emailSendHistorical->id_048), // dato para contabilizar en las estadísticas
                ];

                // config SMTP account
                config(['mail.host'         => $mailing->outgoing_server_013]);
                config(['mail.port'         => $mailing->outgoing_port_013]);
                config(['mail.from'         => ['address' => $mailing->email_013, 'name' => $mailing->name_013]]);
                config(['mail.encryption'   => $mailing->outgoing_secure_013 == 'null'? null : $mailing->outgoing_secure_013]);
                config(['mail.username'     => $mailing->outgoing_user_013]);
                config(['mail.password'     => Crypt::decrypt($mailing->outgoing_pass_013)]);

                // exec mailing
                $response = EmailServices::SendEmail($dataEmail);

                if($response)
                {
                    // agregamos el id del envío al array para actulizar su estado posteriormente
                    $successfulIds[] = $mailing->id_047;
                }
                else
                {
                    // error de envío, eliminamos el histórico antes creado
                    EmailSendHistorical::destroy($emailSendHistorical->id_048);

                    /// marcamos en error
                    // TODO:AQUÍ MARCAMOS EL ERROR
                }
            }

            // borramos los mensajes de la cola de envíos una vez enviados
            // delete queue?
            EmailSendQueue::whereIn('id_047', $successfulIds)->delete();
        }
        else
        {
            // desbloqueo de proceso de obtención de emails para ser enviados y se puedan hacer peticiones
            Preference::setValue('emailServiceSendingEmails', 5, '0');
        }
    }

    /**
     *  Function which directly sends a test campaign group
     *
     * @access	public
     * @param   array $paramenters
     * @return	void
     */
    public static function sendEmailsTest($paramenters)
    {
        $campaign       = EmailCampaign::builder()->where('id_044', $paramenters['id'])->first();
        $testGroup      = Preference::getValue('emailServiceTestGroup', 5);
        $contacts       = Contact::getRecords(['group_042' => (int)$testGroup->value_018, 'groupBy' => 'id_041']);

        if(count($contacts) > 0)
        {
            foreach ($contacts as $contact)
            {
                if($contact->email_041 != null)
                {
                    $dataEmail = [
                        'replyTo'       => empty($campaign->reply_to_013)? null : $campaign->reply_to_013,
                        'email'         => $contact->email_041,
                        'html'          => $campaign->header_044 . $campaign->body_044 . $campaign->footer_044,
                        'text'          => $campaign->text_044,
                        'subject'       => $campaign->subject_044,
                        'contactKey'    => Crypt::encrypt($contact->id_041),
                        'company'       => isset($contact->company_041)? $contact->company_041 : '',
                        'name'          => isset($contact->name_041)? $contact->name_041 : '',
                        'surname'       => isset($contact->surname_041)? $contact->surname_041 : '',
                        'birthDate'     => isset($contact->birth_date_041)?  date(config('pulsar.datePattern'), $contact->birth_date_041) : '',
                        'campaign'      => Crypt::encrypt($campaign->id_044),
                    ];

                    // config SMTP account
                    config(['mail.host'         => $campaign->outgoing_server_013]);
                    config(['mail.port'         => $campaign->outgoing_port_013]);
                    config(['mail.from'         => ['address' => $campaign->email_013, 'name' => $campaign->name_013]]);
                    config(['mail.encryption'   => $campaign->outgoing_secure_013 == 'null'? null : $campaign->outgoing_secure_013]);
                    config(['mail.username'     => $campaign->outgoing_user_013]);
                    config(['mail.password'     => Crypt::decrypt($campaign->outgoing_pass_013)]);

                    EmailServices::sendEmail($dataEmail);
                }
            }
        }
    }

    /**
     *  Función que compruba si hay emails en las cuentas de correo que no hayan sido comprobados
     */
    public static function checkBouncedEmailsAccounts()
    {
        $emailStatusBouncedMessagesFromAccount = Preference::getValue('emailStatusBouncedMessagesFromAccount', 5, '0');

        // Comprobación para casos de errores o caídas del servidor, y no dejen bloquedo la comprobación de emails
        // si en 5 minutos no se ha liberado la variable, damos por hecho que se ha bloqueado y la liberamos
        $update = \DateTime::createFromFormat('Y-m-d H:i:s', $emailStatusBouncedMessagesFromAccount->updated_at);
        if($emailStatusBouncedMessagesFromAccount->value_018 == '1' && date('U') - $update->getTimestamp() > 300)
            Preference::setValue('emailStatusBouncedMessagesFromAccount', 5, '0');

        // en el caso que el estado de envio esté activo, eso siginifica que hay una petición trabajando
        // cuando termine de hacerlo cambiaremos el estado de de comprobación de correos
        // para poder aceptar más peticiones, de esa manera nos aseguramos que no hayan
        // varias peticiones concurrentes comprobando mails.
        if($emailStatusBouncedMessagesFromAccount->value_018 === '1')
            exit;
        else
            Preference::setValue('emailStatusBouncedMessagesFromAccount', 5, '1');
        // una vez comprobado que no hay mas procesos en ejecución, comenzamos a trabajar


        $accounts   = EmailAccount::all();
        $patterns   = EmailPattern::all();

        foreach($accounts as $account)
        {
            $imapService = new ImapServices([
                'host'      => $account->incoming_server_013,
                'port'      => $account->incoming_port_013,
                'user'      => $account->incoming_user_013,
                'password'  => Crypt::decrypt($account->incoming_pass_013),
                'ssl'       => $account->incoming_secure_013 == 'ssl'? true : false
            ]);

            // get total messages
            $nEmails = $imapService->getServer()->numMessages();

            // update n emails on account
            EmailAccount::builder()
                ->where('id_013')
                ->update([
                    'n_emails_013' => $nEmails
                ]);

            // Get the last UID from email account
            if($nEmails > 0)
            {
                $lastUidMessage = $imapService->getServer()->getUidByPositon($nEmails);

                // If the UID is grater than last UID manage, has to check account queue
                if ($lastUidMessage > $account->last_check_uid_013)
                {
                    //obtenemos la posición del siguiente mensaje sin chequear
                    $lastUidCheck   = $account->last_check_uid_013;
                    $position       = 0;
                    $i              = 0;

                    // cuando obtengamos la posición del mensaje, será mayor que 0 y saldrá del bucle
                    // y si hemos hecho tantas o mas comprobaciones como emails hay, salimos del bucle
                    // sentencia para asegurarnos que no entramos en bucle infinito
                    while($position < 1 && $i < $nEmails)
                    {
                        // intentamos averiguar la posición del siguiente mensaje al último comprobado
                        $lastUidCheck++;
                        // si este UID no existe devolverá posición 0
                        $position = $imapService->getServer()->getPositonByUid($lastUidCheck);
                        // sumamos una vuelta para no entrar en bucle infinito
                        $i++;
                    }

                    // llamamos a la funcion que compruebe los correos es esa cuenta
                    Cron::checkBouncedMessagesFromAccount($imapService, $account, $patterns, $position - 1);
                }
                // ?? break, en caso de tener muchas cuentas para no expirar el tiempo de ejecución?
            }

            // after check bounced messages or if there are not emails, close IMAP connection
            $imapService->getServer()->close();

            // if is the last email account, we freed the proccess
            if($accounts->last()->id_013 == $account->id_013)
                Preference::setValue('emailStatusBouncedMessagesFromAccount', 5, '0');
        }
    }

    /**
     * Recursive function
     *
     * @param \Syscover\Pulsar\Libraries\ImapServices   $imapService
     * @param \Syscover\Pulsar\Models\EmailAccount      $account
     * @param \Illuminate\Support\Collection            $patterns
     * @param integer                                   $position
     */
    public static function checkBouncedMessagesFromAccount($imapService, $account, $patterns, $position)
    {
        $nEmailsToChecck = 10;

        // Solicitamos los 10 anteriores mensajes a comprobar desde la última posición comnprobada
        $messages = $imapService->getServer()->getMessages($nEmailsToChecck, $position);

        $findLastCheckUid = false;
        foreach($messages as $key => $message)
        {
            // comprobamos si el mensaje coincide con algún patron
            $response = MiscellaneousComunik::checkEmailPattern($message, $patterns);

            if($response['success'])
            {
                if(count($response['contacts']) > 0)
                    // Obtenemos el primer contacto del email que ha coincidido con el patrón
                    $contact = $response['contacts']->first();
                else
                    $contact = false;

                // Acciones a realizar
                // 1 = nada
                // 2 = borrar contacto y mensaje
                // 3 = unsuscribe y borrar mensaje
                // 4 = borrar contacto
                // 5 = ususcribe contacto
                // 6 = borrar mensaje
                if($contact != false && ($response['pattern']->action_049 == 2 || $response['pattern']->action_049 == 4))
                {
                    // borrar contacto
                    Contact::where('id_041', $contact->id_041)->delete();
                }

                if($contact != false && ($response['pattern']->action_049 == 3 || $response['pattern']->action_049 == 5))
                {
                    // unsuscribe contacto
                    Contact::where('id_041', $contact->id_041)->update([
                        'unsubscribe_email_041' => true
                    ]);
                }

                if($response['pattern']->action_049 == 2 || $response['pattern']->action_049 == 3 || $response['pattern']->action_049 == 6)
                {
                    // borrar mensaje
                    $message->delete();
                    $imapService->getServer()->expunge();

                    // retrasamos medio segundo la ejecución para no saturar el servidor IMAP de peticiones
                    usleep(500000);
                }
            }

            // si es la última interacción
            if($key === count($messages) - 1)
            {
                // actualizamos el último UID comprobado
                EmailAccount::where('id_013', $account->id_013)->update([
                    'last_check_uid_013' => $message->getUid()
                ]);
            }
        }
    }
}