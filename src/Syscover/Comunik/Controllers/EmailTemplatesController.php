<?php namespace Syscover\Comunik\Controllers;

use Syscover\Comunik\Libraries\Miscellaneous as MiscellaneousComunik;
use Syscover\Comunik\Models\EmailTemplate;
use Syscover\Pulsar\Controllers\Controller;
use Syscover\Pulsar\Traits\TraitController;
use Syscover\Comunik\Models\Contact;

class EmailTemplatesController extends Controller {

    use TraitController;

    protected $routeSuffix  = 'ComunikEmailTemplate';
    protected $folder       = 'email_templates';
    protected $package      = 'comunik';
    protected $aColumns     = ['id_043', 'name_043'];
    protected $nameM        = 'name_043';
    protected $model        = '\Syscover\Comunik\Models\EmailTemplate';
    protected $icon         = 'fa fa-pencil-square-o';
    protected $objectTrans  = 'template';

    public function createCustomRecord($request, $parameters)
    {
        $parameters['emlHeaders']   = MiscellaneousComunik::getEmlHeaders();
        $parameters['themes']       = MiscellaneousComunik::getThemes();

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

        EmailTemplate::create([
            'name_043'      => $request->input('name'),
            'subject_043'   => $request->input('subject'),
            'theme_043'     => $request->input('theme'),
            'header_043'    => $header,
            'body_043'      => $body,
            'footer_043'    => $footer,
            'text_043'      => $text,
            'data_043'      => $request->input('data')
        ]);
    }

    public function editCustomRecord($request, $parameters)
    {
        $parameters['emlHeaders']   = MiscellaneousComunik::getEmlHeaders();
        $parameters['themes']       = MiscellaneousComunik::getThemes();

        return $parameters;
    }

    public function checkSpecialRulesToUpdate($request, $parameters)
    {
        $contact = Contact::find($parameters['id']);

        $parameters['specialRules']['emailRule'] = $request->input('email') == $contact->email_041? true : false;
        $parameters['specialRules']['mobileRule'] = $request->input('mobile') == $contact->mobile_041? true : false;

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