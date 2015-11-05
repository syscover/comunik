<?php namespace Syscover\Comunik\Controllers;

use Syscover\Pulsar\Controllers\Controller;
use Syscover\Pulsar\Traits\TraitController;
use Syscover\Pulsar\Models\EmailAccount;
use Syscover\Comunik\Libraries\Miscellaneous as MiscellaneousComunik;
use Syscover\Comunik\Models\EmailCampaign;
use Syscover\Comunik\Models\EmailSendQueue;
use Syscover\Comunik\Models\Group;
use Syscover\Comunik\Models\Contact;
use Syscover\Comunik\Models\EmailTemplate;

class EmailCampaignsController extends Controller {

    use TraitController;

    protected $routeSuffix  = 'ComunikEmailCampaign';
    protected $folder       = 'email_campaigns';
    protected $package      = 'comunik';
    protected $aColumns     = ['id_044', 'name_044', 'name_013', 'shipping_date_044', 'persistence_date_044', 'sorting_044', ['data' => 'processing_044', 'type' => 'active']];
    protected $nameM        = 'name_044';
    protected $model        = '\Syscover\Comunik\Models\EmailCampaign';
    protected $icon         = 'fa fa-user';
    protected $objectTrans  = 'campaign';

    public function createCustomRecord($request, $parameters)
    {
        $parameters['emailAccounts']    = EmailAccount::all();
        $parameters['templates']        = EmailTemplate::all();
        $parameters['themes']           = MiscellaneousComunik::getThemes();
        $parameters['emlHeaders']       = MiscellaneousComunik::getEmlHeaders();
        $parameters['groups']           = Group::all();
        $parameters['countries']        = Contact::getCountriesContacts(['lang' => $request->user()->lang_010]);

        return $parameters;
    }

    public function storeCustomRecord($request, $parameters)
    {
        // check if header is include inside body field
        if($request->has('theme') && $request->input('header') == "" && strpos($request->input('body'), "<!DOCTYPE html") === false)
        {
            $header =   MiscellaneousComunik::getHeader(public_path() . config('comunik.themesFolder') . $request->input('theme') . '/header.html');
        }
        else
        {
            $header = $request->input('header');
        }

        // check if include html link
        if($request->has('isHtmlLink'))
        {
            $body = MiscellaneousComunik::setHtmlLink($parameters, $request->input('body'));
        }
        else
        {
            $body = $request->input('body');
        }

        // check if include unsubscribe link
        if($request->has('isUnsubscribe'))
        {
            $body = MiscellaneousComunik::setUnsubscribe($parameters, $body);
        }

        // check if include track pixel
        if($request->has('isPixel'))
        {
            $body = MiscellaneousComunik::setTrackingPixel($request, $body);
        }

        // check if footer is include inside body field
        if($request->has('theme') && $request->input('footer') == "" && strpos($request->input('body'), "</html>") === false)
        {
            $footer = MiscellaneousComunik::getFooter(public_path() . config('comunik.themesFolder') . $request->input('theme') . '/footer.html');
        }
        else
        {
            $footer = $request->input('footer');
        }

        // convert html to text, to send text version email
        $text = MiscellaneousComunik::htmlToText($header . $body . $footer);

        $emailCampaign = EmailCampaign::create([
            'name_044'              => $request->input('name'),
            'email_account_044'     => $request->input('emailAccount'),
            'template_044'          => empty($request->input('template'))? null : $request->input('template'),
            'subject_044'           => $request->input('subject'),
            'theme_044'             => $request->input('theme'),
            'header_044'            => $header,
            'body_044'              => $body,
            'footer_044'            => $footer,
            'text_044'              => $text,
            'data_044'              => $request->input('data', 'NULL'),
            'shipping_date_044'     => $request->has('shippingDate')? \DateTime::createFromFormat(config('pulsar.datePattern') . ' H:i', $request->input('shippingDate'))->getTimestamp() : (integer)date('U'),
            'persistence_date_044'  => $request->has('persistenceDate')? \DateTime::createFromFormat(config('pulsar.datePattern') . ' H:i', $request->input('persistenceDate'))->getTimestamp() : null,
            'sorting_044'           => $request->input('sorting')
        ]);

        $emailCampaign->countries()->attach($request->input('countries'));
        $emailCampaign->groups()->attach($request->input('groups'));
    }

    public function editCustomRecord($request, $parameters)
    {
        $parameters['emailAccounts']    = EmailAccount::all();
        $parameters['templates']        = EmailTemplate::all();
        $parameters['themes']           = MiscellaneousComunik::getThemes();
        $parameters['emlHeaders']       = MiscellaneousComunik::getEmlHeaders();
        $parameters['groups']           = Group::all();
        $parameters['countries']        = Contact::getCountriesContacts(['lang' => $request->user()->lang_010]);

        return $parameters;
    }
    
    public function updateCustomRecord($request, $parameters)
    {
        // check if header is include inside body field
        if($request->has('theme') && $request->input('header') == "" && strpos($request->input('body'), "<!DOCTYPE html") === false)
        {
            $header =   MiscellaneousComunik::getHeader(public_path() . config('comunik.themesFolder') . $request->input('theme') . '/header.html');
        }
        else
        {
            $header = $request->input('header');
        }

        // check if include html link
        if($request->has('isHtmlLink'))
        {
            $body = MiscellaneousComunik::setHtmlLink($parameters, $request->input('body'));
        }
        else
        {
            $body = $request->input('body');
        }

        // check if include unsubscribe link
        if($request->has('isUnsubscribe'))
        {
            $body = MiscellaneousComunik::setUnsubscribe($parameters, $body);
        }

        // check if include track pixel
        if($request->has('isPixel'))
        {
            $body = MiscellaneousComunik::setTrackingPixel($request, $body);
        }

        // check if footer is include inside body field
        if($request->has('theme') && $request->input('footer') == "" && strpos($request->input('body'), "</html>") === false)
        {
            $footer = MiscellaneousComunik::getFooter(public_path() . config('comunik.themesFolder') . $request->input('theme') . '/footer.html');
        }
        else
        {
            $footer = $request->input('footer');
        }

        // convert html to text, to send text version email
        $text = MiscellaneousComunik::htmlToText($header . $body . $footer);

        EmailCampaign::where('id_044', $parameters['id'])->update([
            'name_044'              => $request->input('name'),
            'email_account_044'     => $request->input('emailAccount'),
            'template_044'          => empty($request->input('template'))? null : $request->input('template'),
            'subject_044'           => $request->input('subject'),
            'theme_044'             => $request->input('theme'),
            'header_044'            => $header,
            'body_044'              => $body,
            'footer_044'            => $footer,
            'text_044'              => $text,
            'data_044'              => $request->input('data', 'NULL'),
            'shipping_date_044'     => $request->has('shippingDate')? \DateTime::createFromFormat(config('pulsar.datePattern') . ' H:i', $request->input('shippingDate'))->getTimestamp() : (integer)date('U'),
            'persistence_date_044'  => $request->has('persistenceDate')? \DateTime::createFromFormat(config('pulsar.datePattern') . ' H:i', $request->input('persistenceDate'))->getTimestamp() : null,
            'sorting_044'           => $request->input('sorting')
        ]);

        $emailCampaign = EmailCampaign::find($parameters['id']);

        $emailCampaign->countries()->sync($request->input('countries'));
        $emailCampaign->groups()->sync($request->input('groups'));

        // borramos los envíos de cola, de aquellos correos en estado, status_047 = 0 waiting
        // que no correspondan con los nuevos grupos, caso muy dificil de ocurrir,
        // ya que solo se pasan a cola cuando van a ser enviados
        EmailSendQueue::deleteMailingWithoutGroupSendQueue($request->input('groups'), $emailCampaign->id_044);
    }
}