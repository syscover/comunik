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

use Syscover\Pulsar\Models\Preference;
use Syscover\Comunik\Models\EmailCampaign;

class Cron
{
    /**
     * Function to get contacts from campaign to record in send queue table
     *
     * @access	public
     * @param   arrray $data
     * @return	void
     */
    public static function checkEmailsToQueue($data)
    {
        $sendingEmailsToQueue = Preference::getValue('sendingEmailsToQueue', 3, 0);

        // Comprobación para casos de errores o caídas del servidor, y no dejen bloquedo el envío de emails a la cola de proceso
        // si en 5 minutos no se ha liberado la variable, damos por hecho que se ha bloqueado y la liberamos
        $update = \DateTime::createFromFormat('Y-m-d H:i:s', $sendingEmailsToQueue->updated_at);
        if($sendingEmailsToQueue->value_018 == 1 && date('U') - $update->getTimestamp() > 300)
        {
            Preference::setValue('sendingEmailsToQueue', 3, 0);
        }

        // en el caso que el estado de envio esté activo, eso siginifica que hay una petición trabajando y enviando
        // a la tabla de cola de envíos los contactos, cuando termine de hacerlo cambiaremos el estado de envío de emails
        // para poder aceptar más peticiones, de esa manera nos aseguramos que no hayan
        // varias peticiones concurrentes insertando mails.
        if($sendingEmailsToQueue->value_018)
        {
            exit;
        }
        else
        {
            ConfigPulsar::setValue('sendingEmailsToQueue', 1);
        }

        // START INCLUDES EMAILS IN SEND QUEUE TABLE

        $campaign = EmailCampaign::find($data['id'])

        // antes de realizar la ejecución comprobamos que la capaña aún existe, no vaya a ser que la hayan borrado en el intervalo de tiempo,
        // entre que se mando la petición a cola y se ejecute la petición
        if($campana == null)
        {
            $job->delete();
            exit(0);
        }

        $grupos     = $campana->grupos;
        $paises     = $campana->paises;
        $idGrupos   = array();
        $idPaises   = array();

        foreach ($grupos as $grupo)
        {
            array_push($idGrupos, $grupo->id_029);
        }

        foreach ($paises as $pais)
        {
            array_push($idPaises, $pais->id_002);
        }

        $contactos = Contacto::getContactosEmailToInsert($campana->id_048, $idGrupos, $idPaises, (int)ConfigPulsar::find('emailIntervaloProceso')->value_018, 0);

        if(count($contactos) > 0)
        {
            $enviosEmails = array();
            foreach ($contactos as $contacto)
            {
                $envioEmail = array(
                    'campana_056'   => $campana->id_048,
                    'contacto_056'  => $contacto->id_030,
                    'creado_056'    => date('U'),
                    'orden_056'     => $campana->orden_048
                );
                array_push($enviosEmails, $envioEmail);
            }
            ColaEnviosEmails::insert($enviosEmails);

            ConfigPulsar::setValue('sendingEmailsToQueue', 0);

            $job->release();
        }
        else
        {
            //marcamos la campaña como creada, ya que puede que esté creada de antemano o si no lo estuviera por ser un envío con fecha posterior
            //a la de su creación
            CampanaEmail::where('id_048','=',$campana->id_048)->update(array(
                'creada_048'        => true
            ));

            Preference::setValue('sendingEmailsToQueue', 3, 0);
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
     *  Función que recupera las llamadas a realizar que serán enviadas a nuestra cola de procesos, tanto de emails de campañas persistentes que no se hayan enviado,
     *  como correos de campañas con fecha de envio anterior a la actual y que no se haya enviado.
     *  Tanto de emails como de SMS
     *
     * @access	public
     * @return	void
     */
    public static function checkCallsToQueue()
    {
        //listamos todas las campañas persistentes activas, que su fecha de envío sea anterior a la actual y ya hayan sido enviadas
        $campanas = CampanaEmail::getCampanasWithPersistencia();

        //enviamos a cola de proceso la comprobacion que no hay correos nuevos de los que hacer envío
        foreach ($campanas as $campana)
        {
            $dataQueue = array(
                'id'    => $campana->id_048
            );
            Queue::push('\Pulsar\Comunik\Libraries\Cron@checkEmailsToQueue', $dataQueue);
        }

        //listamos todas las campañas sin enviar que su fecha de envío sea anterior a la actual
        $campanas = CampanaEmail::getCampanasWithoutSend();

        //enviamos a cola de proceso la comprobacion que no hay correos nuevos de los que hacer envío
        foreach ($campanas as $campana)
        {
            $dataQueue = array(
                'id'    => $campana->id_048
            );
            Queue::push('\Pulsar\Comunik\Libraries\Cron@checkEmailsToQueue', $dataQueue);

            if($campana->enviada_048 != true)
            {
                CampanaEmail::where('id_048', '=', $campana->id_048)->update(array(
                    'enviada_048' => true
                ));
            }
        }


        //listamos todas las campañas persistentes activas, que su fecha de envío sea anterior a la actual y ya hayan sido enviadas
        $campanas = CampanaSms::getCampanasWithPersistencia();

        //enviamos a cola de proceso la comprobacion que no hay correos nuevos de los que hacer envío
        foreach ($campanas as $campana)
        {
            $dataQueue = array(
                'id'    => $campana->id_049
            );
            Queue::push('\Pulsar\Comunik\Libraries\Cron@checkSmsToQueue', $dataQueue);
        }

        //listamos todas las campañas sin enviar que su fecha de envío sea anterior a la actual
        $campanas = CampanaSms::getCampanasWithoutSend();

        //enviamos a cola de proceso la comprobacion que no hay correos nuevos de los que hacer envío
        foreach ($campanas as $campana)
        {
            $dataQueue = array(
                'id'    => $campana->id_049
            );
            Queue::push('\Pulsar\Comunik\Libraries\Cron@checkSmsToQueue', $dataQueue);

            if($campana->enviada_049 != true)
            {
                CampanaSms::where('id_049', '=', $campana->id_048)->update(array(
                    'enviada_049' => true
                ));
            }
        }
    }



    /**
     *  Función que chequea si hay hay que lanzar una queue para que haga un envío de emails
     *  esta queue ejecutaría la función sendMails
     *
     * @access	public
     * @return	array
     */
    public static function checkCallQueueSendEmails()
    {

        $nEnvios = ColaEnviosEmails::getNEnvios();

        if($nEnvios > 0)
        {
            Queue::push('\Pulsar\Comunik\Libraries\Cron@sendEmails', array());
        }
    }

    /**
     *  Función llamada por la cola que lanza los emails
     *
     * @access	public
     * @return	array
     */
    public static function sendEmails($job, $data)
    {
        $emailStateSendEmails = ConfigPulsar::getValue('emailStateSendEmails', 0);

        // Comprobación para casos de errores o caídas del servidor, y no dejen bloqueda la entrada a peticiones
        $update = \DateTime::createFromFormat('Y-m-d H:i:s', $emailStateSendEmails->updated_at);
        if($emailStateSendEmails->value_018 == 1 && date('U') - $update->getTimestamp() > 300)
        {
            ConfigPulsar::setValue('emailStateSendEmails', 0);
        }

        //en el caso que el estado de envio esté activo, eso siginifica que hay una petición en curso y está haciendo la petición 
        //a la base de datos y esta sustrayendo los ids, para posteriormente cambiar el estado de envíos, solo en ese momento 
        //cambiaremos el estado de envío de emails para poder aceptar más peticiones, de esa manera nos aseguramos que no hayan
        //varias peticiones concurrentes del gestor de colas.
        if($emailStateSendEmails->value_018)
        {
            $job->delete();
            exit(0);
        }
        else
        {
            ConfigPulsar::setValue('emailStateSendEmails', 1);
        }

        // consultamos la cola de envíos que estén por enviar, solicitamos los primero N envíos según el itervalo configurado
        // solo de aquellos envíos que estén en estado 0
        $envios = ColaEnviosEmails::getEnvios((int)ConfigPulsar::find('emailIntervaloProceso')->value_018, 0);

        //Al cambiar la consulta a raw nos devuelve un array con objetos en vez de un objeto Collection
        //$idsEnvios  = Miscellaneous::getIdsCollection($envios, 'id_056');
        $idsEnvios = array();
        foreach ($envios as $envio)
        {
            array_push($idsEnvios, $envio->id_056);
        }

        if(count($envios)>0)
        {
            //cambiamos el estado de send mail para que se puedan hacer peticiones
            ColaEnviosEmails::whereIn('id_056',$idsEnvios)->update(array(
                'estado_056' => 1
            ));

            //bloqueo de proceso a realizar con iron cache? o config?
            ConfigPulsar::setValue('emailStateSendEmails', 0);

            $idsEnviosEnviados = array();

            foreach ($envios as $envio)
            {
                // Creamos el historico de envío con antelación para obtener el ID del histórico de envío y contabilizarlo
                $historicoEnvioEmail = HistoricoEnviosEmails::create(array(
                    'cola_envio_060'    => $envio->id_056,
                    'campana_060'       => $envio->campana_056,
                    'contacto_060'      => $envio->contacto_056,
                    'enviado_060'       => date('U'),
                    'visto_060'         => 0
                ));

                $dataEmail = array(
                    'replyTo'   => $envio->reply_to_047 == null || $envio->reply_to_047 == "" ? null : $envio->reply_to_047,
                    'email'     => $envio->email_030,
                    'html'      => $envio->header_048 . $envio->body_048 . $envio->footer_048,
                    'text'      => $envio->text_048,
                    'asunto'    => $envio->asunto_048,
                    'message'   => Crypt::encrypt($envio->id_048),
                    'contact'   => Crypt::encrypt($envio->id_030),
                    'company'   => isset($envio->empresa_030)? $envio->empresa_030 : '',
                    'name'      => isset($envio->nombre_030)? $envio->nombre_030 : '',
                    'surname'   => isset($envio->apellidos_030)? $envio->apellidos_030 : '',
                    'birthday'  => isset($envio->nacimiento_030)?  date('d-m-Y', $envio->nacimiento_030) : '',
                    'campana'   => Crypt::encrypt($envio->campana_056),
                    'envio'     => Crypt::encrypt($historicoEnvioEmail->id_060) //dato para contabilizar en las estadísticas
                );

                //configuración servidor SMTP
                Config::set('mail.host',        $envio->host_smtp_047);
                Config::set('mail.port',        $envio->port_smtp_047);
                Config::set('mail.from',        array('address' => $envio->email_047, 'name' => $envio->nombre_047));
                Config::set('mail.encryption',  $envio->secure_smtp_047 == 'null'? null : $envio->secure_smtp_047);
                Config::set('mail.username',    $envio->user_smtp_047);
                Config::set('mail.password',    Crypt::decrypt($envio->pass_smtp_047));

                $response = EmailServices::SendEmail($dataEmail);

                if($response)
                {
                    //Agregamos el id del envío al array para actulizar su estado posteriormente
                    array_push($idsEnviosEnviados, $envio->id_056);
                }
                else
                {
                    //Error de envío
                    //Eliminamos en histórico antes creado
                    HistoricoEnviosEmails::destroy($historicoEnvioEmail->id_060);

                    ///Marcamos en error
                    //***** AQUÍ MARCAMOS EL ERROR ******
                }
            }

            //actualizamos el estado de los envíos a enviado
            ColaEnviosEmails::whereIn('id_056',$idsEnviosEnviados)->update(array(
                'estado_056' => 2
            ));

            $job->release(5);
        }
        else
        {
            //cambiamos el estado de send mail para que se puedan hacer peticiones
            ConfigPulsar::setValue('emailStateSendEmails', 0);

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