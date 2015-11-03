<?php namespace Syscover\Comunik\Controllers;

use Syscover\Comunik\Models\EmailCampaign;
use Syscover\Comunik\Models\Group;
use Syscover\Pulsar\Controllers\Controller;
use Syscover\Pulsar\Traits\TraitController;
use Syscover\Comunik\Libraries\Miscellaneous as MiscellaneousComunik;
use Syscover\Comunik\Models\Contact;
use Syscover\Pulsar\Models\EmailAccount;
use Syscover\Comunik\Models\EmailTemplate;

class EmailCampaignsController extends Controller {

    use TraitController;

    protected $routeSuffix  = 'ComunikEmailCampaign';
    protected $folder       = 'campaigns';
    protected $package      = 'comunik';
    protected $aColumns     = ['id_044', 'name_044', 'name_013', 'shipping_date_044', 'persistence_date_044', 'sorting_044', 'sent_044'];
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

    public function storeCustomRecord($request)
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
            'template_044'          => $request->input('template'),
            'subject_044'           => $request->input('subject'),
            'theme_044'             => $request->input('theme'),
            'header_044'            => $header,
            'body_044'              => $body,
            'footer_044'            => $footer,
            'text_044'              => $text,
            'data_044'              => $request->input('data', 'NULL'),
            'shipping_date_044'     => $request->input('shippingDate'),
            'shipping_date_044'     => $request->input('shippingDate'),
            'sorting_044'           => $request->input('sorting')
        ]);

        $emailCampaign->countries()->attach($request->input('countries'));
        $emailCampaign->groups()->attach($request->input('groups'));
    }

    public function editCustomRecord($request, $parameters)
    {
        $parameters['groups'] = Group::all();

        return $parameters;
    }

    public function checkSpecialRulesToUpdate($request, $parameters)
    {
        $contact = Contact::find($parameters['id']);

        $parameters['specialRules']['emailRule']    = $request->input('email') == $contact->email_041? true : false;
        $parameters['specialRules']['mobileRule']   = $request->input('mobile') == $contact->mobile_041? true : false;

        return $parameters;
    }
    
    public function updateCustomRecord($request, $parameters)
    {
        Contact::where('id_041', $parameters['id'])->update([
            'company_041'       => $request->input('company'),
            'name_041'          => $request->input('name'),
            'surname_041'       => $request->input('surname'),
            'birthdate_041'     => $request->has('birthdate')? \DateTime::createFromFormat(config('pulsar.datePattern'), $request->input('birthdate'))->getTimestamp() : null,
            'country_041'       => $request->input('country'),
            'prefix_041'        => $request->input('prefix'),
            'mobile_041'        => $request->has('mobile')? str_replace('-', '', $request->input('mobile')) : null,
            'email_041'         => strtolower($request->input('email')),
        ]);
    }
}