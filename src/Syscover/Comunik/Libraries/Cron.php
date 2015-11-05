<?php namespace Syscover\Comunik\Libraries;

/**
 *
 * An open source application development framework for PHP 5.5 or newer
 *
 * @package		Pulsar
 * @author		Jose Carlos Rodríguez Palacín
 * @copyright   Copyright (c) 2014, SYSCOVER, SL.
 * @license
 * @link		http://www.syscover.com
 * @since		Version 1.0
 * @filesource  Librería para la ejecución de funciones cron
 *
 *  1.1 - Tenemos una tarea cron que comprueba si hay envíos ha realizar de Emails (checkCallQueueSendEmails)
 *  1.2 - Tenemos una tarea cron que comprueba si hay envíos ha realziar de SMS (checkCallQueueSendSms)
 *  2 - Encaso de cumplirse alguna condición manda una tarea queue para uqe enví todo lo que tiene en cola sin enviar
 *
 */
// ------------------------------------------------------------------------

use Illuminate\Support\Facades\Crypt;
use Syscover\Comunik\Models\EmailSendHistorical;
use Syscover\Comunik\Models\EmailSendQueue;
use Syscover\Pulsar\Libraries\EmailServices;
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
        $emailServiceSendingEmailsToQueue = Preference::getValue('emailServiceSendingEmailsToQueue', 3, '0');

        // Comprobación para casos de errores o caídas del servidor, y no dejen bloquedo el envío de emails a la cola de proceso
        // si en 5 minutos no se ha liberado la variable, damos por hecho que se ha bloqueado y la liberamos
        $update = \DateTime::createFromFormat('Y-m-d H:i:s', $emailServiceSendingEmailsToQueue->updated_at);
        if($emailServiceSendingEmailsToQueue->value_018 == '1' && date('U') - $update->getTimestamp() > 300)
            Preference::setValue('emailServiceSendingEmailsToQueue', 3, '0');


        // en el caso que el estado de envio esté activo, eso siginifica que hay una petición trabajando y enviando
        // a la tabla de cola de envíos los contactos, cuando termine de hacerlo cambiaremos el estado de envío de emails
        // para poder aceptar más peticiones, de esa manera nos aseguramos que no hayan
        // varias peticiones concurrentes insertando mails.
        if($emailServiceSendingEmailsToQueue->value_018 == '1')
        {
            exit;
        }
        else
        {
            Preference::setValue('emailServiceSendingEmailsToQueue', 3, '1');
        }

        // START INCLUDES EMAILS IN SEND QUEUE TABLE
        $campaign = EmailCampaign::find($data['id']);

        // antes de realizar la ejecución comprobamos que la capaña aún existe, no vaya a ser que la hayan borrado en el intervalo de tiempo,
        // entre que se mando la petición a cola y se ejecute la petición
        if($campaign == null)   exit;

        $groups     = $campaign->groups;
        $countries  = $campaign->countries;
        $groupIds   = $groups->pluck('id_040')->toArray();
        $countryIds = $countries->pluck('id_002')->toArray();

        // obtenemos los contactos a insertar
        $contacts = Contact::getContactsEmailToInsert($campaign->id_044, $groupIds, $countryIds, (int)Preference::find('emailServiceIntervalProcess')->value_018, 0);

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

            Preference::setValue('emailServiceSendingEmailsToQueue', 3, '0');
        }
        else
        {
            // marcamos la campaña como creada, ya que puede que esté creada de antemano
            // o si no lo estuviera por ser un envío con fecha posterior a la de su creación
            EmailCampaign::where('id_044', $campaign->id_044)->update([
                'created_044' => true
            ]);

            Preference::setValue('emailServiceSendingEmailsToQueue', 3, '0');
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
        {
            Cron::sendEmails();
        }
    }


    /**
     *  Function that sends emails
     *
     * @access	private
     * @return	array
     */
    private static function sendEmails()
    {
        $emailServiceSendingEmails = Preference::getValue('emailServiceSendingEmails', 3, '0');

        // Comprobación para casos de errores o caídas del servidor, y no dejen bloquedo el envío de emails
        // si en 5 minutos no se ha liberado la variable, damos por hecho que se ha bloqueado y la liberamos
        $update = \DateTime::createFromFormat('Y-m-d H:i:s', $emailServiceSendingEmails->updated_at);
        if($emailServiceSendingEmails->value_018 == '1' && date('U') - $update->getTimestamp() > 300)
            Preference::setValue('emailServiceSendingEmails', 3, '0');


        //en el caso que el estado de envio esté activo, eso siginifica que hay una petición en curso y está haciendo la petición
        //a la base de datos y esta sustrayendo los ids, para posteriormente cambiar el estado de envíos, solo en ese momento
        //cambiaremos el estado de envío de emails para poder aceptar más peticiones, de esa manera nos aseguramos que no hayan
        //varias peticiones concurrentes del gestor de colas.
        if($emailServiceSendingEmails->value_018 == '1')
        {
            exit;
        }
        else
        {
            Preference::setValue('emailServiceSendingEmails', 3, '1');
        }

        // consultamos la cola de envíos que estén por enviar, solicitamos los primero N envíos según el itervalo configurado
        // solo de aquellos envíos que estén en estado: 0 = waiting to be sent
        $mailings   = EmailSendQueue::getMailings((int)Preference::find('emailServiceIntervalProcess')->value_018, 0);

        $mailingIds = $mailings->pluck('id_047')->toArray();

        if(count($mailings) > 0)
        {
            // cambiamos el estado de EmailSendQueue para que se puedan hacer peticiones
            EmailSendQueue::whereIn('id_047', $mailingIds)->update([
                // status_047 = 1 in process
                'status_047' => 1
            ]);

            // desbloqueo de proceso de obtención de emails para ser enviados y se puedan hacer peticiones
            Preference::setValue('emailServiceSendingEmails', 3, '0');

            $successfulIds =[];

            foreach ($mailings as $mailing)
            {
                // Creamos el historico de envío con antelación para obtener el ID del histórico de envío y contabilizarlo
                $emailSendHistorical = EmailSendHistorical::create([
                    'send_queue_048'    => $mailing->id_047,
                    'campaign_048'      => $mailing->campaign_047,
                    'contact_048'       => $mailing->contact_047,
                    'sent_048'          => date('U'),
                    'viewed_048'        => 0
                ]);

                $dataEmail = [
                    'replyTo'   => empty($mailing->reply_to_013)? null : $mailing->reply_to_013,
                    'email'     => $mailing->email_041,
                    'html'      => $mailing->header_044 . $mailing->body_044 . $mailing->footer_044,
                    'text'      => $mailing->text_044,
                    'subject'   => $mailing->subject_044,
                    'message'   => Crypt::encrypt($mailing->id_044),
                    'contact'   => Crypt::encrypt($mailing->id_041),
                    'company'   => isset($mailing->company_041)? $mailing->company_041 : '',
                    'name'      => isset($mailing->name_041)? $mailing->name_041 : '',
                    'surname'   => isset($mailing->surname_041)? $mailing->surname_041 : '',
                    'birthday'  => isset($mailing->birth_date_041)?  date(config('pulsar.datePattern'), $mailing->birth_date_041) : '',
                    'campaign'  => Crypt::encrypt($mailing->id_044),
                    'sending'   => Crypt::encrypt($emailSendHistorical->id_048) // dato para contabilizar en las estadísticas
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

            // actualizamos el estado de los envíos a enviado
            EmailSendQueue::whereIn('id_047', $successfulIds)->update([
                // status_047 = 2 sent
                'status_047' => 2
            ]);
        }
        else
        {
            // desbloqueo de proceso de obtención de emails para ser enviados y se puedan hacer peticiones
            Preference::setValue('emailServiceSendingEmails', 3, '0');
        }
    }










    /**
     *  Función que comprueba los rebotes de los emails en cada cuenta y ejecuta una acción según la coincidencia del patron encontrado
     *
     * @access	public
     * @return	void
     */
    public static function checkBouncedEmailsAccountsToQueue()
    {
        $accounts = Cuenta::all();
        foreach($accounts as $account)
        {
            $imapServices = new ImapServices(array(
                'host'      => $account->host_inbox_047,
                'port'      => $account->port_inbox_047,
                'user'      => $account->user_inbox_047,
                'password'  => Crypt::decrypt($account->pass_inbox_047),
                'ssl'       => $account->secure_inbox_047 == 'ssl'? true : false
            ));

            // requerimos el número de mensajes total
            $nMessages = $imapServices->getServer()->numMessages();

            // configuramos el número de emails actuales en la cuenta
            Cuenta::where('id_047', '=', $account->id_047)->update(array(
                'n_emails_047' => $nMessages
            ));

            // averiguamos el UID del último email recibido si hay mas de uno
            if($nMessages > 0)
            {
                $UidLastMessage = $imapServices->getServer()->getUidByPositon($nMessages);

                // Si el UID es mayor que el último UID del email gestionado, es que hay nuevos emails por comprobar
                if ($UidLastMessage > $account->last_check_uid_047) {
                    $dataQueue = array(
                        'id' => $account->id_047
                    );
                    Queue::push('\Pulsar\Comunik\Libraries\Cron@checkBouncedMessagesToQueue', $dataQueue);
                }
            }
        }
    }

    /**
     *  Función que recupera los contactos de una campaña que tiene que enviar la newsletter y no esten en cola de envio
     *
     * @access	public
     * @return	void
     */
    public static function checkBouncedMessagesToQueue($job, $data)
    {
        $emailStateBouncedMessagesToQueue = ConfigPulsar::getValue('emailStateBouncedMessagesToQueue', 0);

        // Comprobación para casos de errores o caídas del servidor, y no dejen bloqueda la entrada a peticiones
        $update = \DateTime::createFromFormat('Y-m-d H:i:s', $emailStateBouncedMessagesToQueue->updated_at);
        if($emailStateBouncedMessagesToQueue->value_018 == 1 && date('U') - $update->getTimestamp() > 300)
        {
            ConfigPulsar::setValue('emailStateBouncedMessagesToQueue', 0);
        }

        //en el caso de estár activo, significa que ya hay una gestión de cola en proceso y eliminamos la actual
        if($emailStateBouncedMessagesToQueue->value_018)
        {
            $job->delete();
            exit(0);
        }
        else
        {
            ConfigPulsar::setValue('emailStateBouncedMessagesToQueue', 1);
        }

        $account    = Cuenta::find($data['id']);
        $patterns   = PatternEmail::all();

        $imapServices = new ImapServices(array(
            'host'      => $account->host_inbox_047,
            'port'      => $account->port_inbox_047,
            'user'      => $account->user_inbox_047,
            'password'  => Crypt::decrypt($account->pass_inbox_047),
            'ssl'       => $account->secure_inbox_047 == 'ssl'? true : false
        ));

        $lastUidCheck = $account->last_check_uid_047;

        //obtenemos la posición del siguiente mensaje sin chequear
        $position   = 0;
        $i          = 0;

        // cuando obtengamos la posición del mensaje, será mayor que 0 y saldrá del bucle
        while($position < 1)
        {
            if($i < $account->n_emails_047)
            {
                // intentamos averiguar la posición del siguiente mensaje al último comprobado
                $lastUidCheck++;
                // si este UID no existe devolverá posición 0
                $position = $imapServices->getServer()->getPositonByUid($lastUidCheck);
                // sumamos una vuelta para no entrar en bucle infinito
                $i++;
            }
            else
            {
                // si hemos hecho tantas o mas comprobaciones como emails hay, salimos del bucle
                // sentencia para asegurarnos que no entramos en bucle infinito
                break;
            }
        }

        // Solicitamos los mensajes a comprobar desde la posición del primer mensaje a comprobar
        $messages = $imapServices->getServer()->getMessages(10, $position);

        $i = 0; // contador del bucle
        foreach($messages as $message)
        {
            // si es el último mensaje a actualizar, actualizamos el campo last_check_uid_047
            if($i == count($messages) - 1)
            {
                Cuenta::where('id_047', '=', $account->id_047)->update(array(
                    'last_check_uid_047' => $message->getUid()
                ));
            }
            $i++;

            // comprobamos si el mensaje coincide con algún patron
            $response = MiscellaneousComunik::checkEmailPattern($message, $patterns);

            if($response['success'])
            {
                if(count($response['contactos']) > 0)
                {
                    // Obtenesmos el contacto del email que ha coincidido con el patrón
                    $contacto = $response['contactos'][0];
                }
                else
                {
                    $contacto = false;
                }

                // 0 = nada, 1 = borrar contacto y mensaje, 2 = unsuscribe y borrar mensaje, 3 = borrar contacto, 4 = ususcribe contacto, 5 = borrar mensaje
                if($contacto != false && ($response['pattern']->action_079 == 1 || $response['pattern']->action_079 == 3))
                {
                    // borrar contacto
                    Contacto::where('id_030', '=', $contacto->id_030)->delete();
                }

                if($contacto != false && ($response['pattern']->action_079 == 2 || $response['pattern']->action_079 == 4))
                {
                    // unsuscriber contacto
                    Contacto::where('id_030', '=', $contacto->id_030)->update(array(
                        'unsubscribe_email_030' => 1
                    ));
                }

                if($response['pattern']->action_079 == 1 || $response['pattern']->action_079 == 2 || $response['pattern']->action_079 == 5)
                {
                    // borrar mensaje
                    //$message                = $imapServices->getServer()->getMessageByUid($message->getUid());
                    $message->delete();
                    $imapServices->getServer()->expunge();

                    // retrasamos medio segundo la ejecución para no saturar el servidor IMAP de peticiones
                    usleep(500000);
                }
            }
        }

        ConfigPulsar::setValue('emailStateBouncedMessagesToQueue', 0);

        if(count($messages) > 0)
        {
            // liberamos la queue
            $job->release(5);
        }
        else
        {
            // borramos la queue
            $job->delete();
        }
    }









    /**
     *  Función que envía directamente una plantilla a los usuarios de test
     *
     * @access	public
     * @return	void
     */
    public static function sendEmailsTest($job, $data)
    {
        $campanaEmail   = CampanaEmail::find($data['id']);
        $grupo          = ConfigPulsar::find('emailGrupoTest')->value_018;
        $cuenta         = Cuenta::find($campanaEmail->cuenta_048);

        $contactos = Contacto::getContactoFromGrupo($grupo);

        if(count($contactos)>0)
        {
            foreach ($contactos as $contacto)
            {
                if($contacto->email_030 != null)
                {
                    $dataEmail = array(
                        'replyTo'   => $cuenta->reply_to_047 == null || $cuenta->reply_to_047 == "" ? null : $cuenta->reply_to_047,
                        'email'     => $contacto->email_030,
                        'html'      => $campanaEmail->header_048 . $campanaEmail->body_048 . $campanaEmail->footer_048,
                        'text'      => $campanaEmail->text_048,
                        'asunto'    => $campanaEmail->asunto_048,
                        'message'   => Crypt::encrypt($campanaEmail->id_048),   //encriptamos el id de la campaña para verlo online
                        'contact'   => Crypt::encrypt($contacto->id_030),       //encriptamos el id del contacto para hacer el unsubscribe
                        'company'   => isset($contacto->empresa_030)? $contacto->empresa_030 : '',
                        'name'      => isset($contacto->nombre_030)? $contacto->nombre_030 : '',
                        'surname'   => isset($contacto->apellidos_030)? $contacto->apellidos_030 : '',
                        'birthday'  => isset($contacto->nacimiento_030)?  date('d-m-Y', $contacto->nacimiento_030) : '',
                    );

                    //configuración servidor SMTP
                    Config::set('mail.host',        $cuenta->host_smtp_047);
                    Config::set('mail.port',        $cuenta->port_smtp_047);
                    Config::set('mail.from',        array('address' => $cuenta->email_047, 'name' => $cuenta->nombre_047));
                    Config::set('mail.encryption',  $cuenta->secure_smtp_047 == 'null'? null : $cuenta->secure_smtp_047);
                    Config::set('mail.username',    $cuenta->user_smtp_047);
                    Config::set('mail.password',    Crypt::decrypt($cuenta->pass_smtp_047));

                    EmailServices::SendEmail($dataEmail);
                }
            }
        }
        $job->delete();
    }

}