<?php namespace Syscover\Comunik\Controllers;

use Illuminate\Support\Facades\Request;
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

    public function createCustomRecord($parameters)
    {
        $parameters['emlHeaders']   = MiscellaneousComunik::getEmlHeaders();
        $parameters['themes']       = MiscellaneousComunik::getThemes();

        return $parameters;
    }

    public function storeCustomRecord($parameters, $request)
    {
        // check if header is include inside body field
        if(Input::has('header') == "" && strpos(Input::get('body'), "<!DOCTYPE html") === false)
        {
            $header =   MiscellaneousComunik::getHeader();
        }
        else
        {
            $header = Input::get('header');
        }

        if(Input::has('isHtmlLink'))
        {
            $body = MiscellaneousComunik::setHtmlLink(Input::get('body'));
        }
        else
        {
            $body = Input::get('body');
        }

        if(Input::has('isUnsubscribe'))
        {
            $body = MiscellaneousComunik::setUnsubscribe($body);
        }

        if(Input::has('isPixel'))
        {
            $body = MiscellaneousComunik::setTracingPixel($body);
        }

        if(Input::has('footer') == "" && strpos(Input::get('body'), "</html>") === false)
        {
            $footer =   MiscellaneousComunik::getFooter();
        }
        else
        {
            $footer = Input::get('footer');
        }

        $text = MiscellaneousComunik::htmlToText($header . $body . $footer);

        EmailTemplate::create([
            'name_043'      => Input::get('name'),
            'subject_043'   => Input::get('subject'),
            'theme_043'     => Input::get('theme'),
            'header_043'    => $header,
            'body_043'      => $body,
            'footer_043'    => $footer,
            'text_043'      => $text,
            'data_043'      => Input::get('data')
        ]);


        $contact = Contact::create([
            'company_041'       => Request::input('company'),
            'name_041'          => Request::input('name'),
            'surname_041'       => Request::input('surname'),
            'birthdate_041'     => Request::has('birthdate')? \DateTime::createFromFormat(config('pulsar.datePattern'), Request::input('birthdate'))->getTimestamp() : null,
            'country_041'       => Request::input('country'),
            'prefix_041'        => Request::input('prefix'),
            'mobile_041'        => Request::has('mobile')? str_replace('-', '', Request::input('mobile')) : null,
            'email_041'         => strtolower(Request::input('email')),
        ]);

        $contact->groups()->attach(Request::input('groups'));
    }

    public function editCustomRecord($parameters)
    {
        $parameters['emlHeaders']   = MiscellaneousComunik::getEmlHeaders();
        $parameters['themes']       = MiscellaneousComunik::getThemes();

        return $parameters;
    }

    public function checkSpecialRulesToUpdate($parameters)
    {
        $contact = Contact::find($parameters['id']);

        $parameters['specialRules']['emailRule'] = Request::input('email') == $contact->email_041? true : false;
        $parameters['specialRules']['mobileRule'] = Request::input('mobile') == $contact->mobile_041? true : false;

        return $parameters;
    }
    
    public function updateCustomRecord($parameters)
    {
        Contact::where('id_041', $parameters['id'])->update([
            'company_041'       => Request::input('company'),
            'name_041'          => Request::input('name'),
            'surname_041'       => Request::input('surname'),
            'birthdate_041'     => Request::has('birthdate')? \DateTime::createFromFormat(config('pulsar.datePattern'), Request::input('birthdate'))->getTimestamp() : null,
            'country_041'       => Request::input('country'),
            'prefix_041'        => Request::input('prefix'),
            'mobile_041'        => Request::has('mobile')? str_replace('-', '', Request::input('mobile')) : null,
            'email_041'         => strtolower(Request::input('email')),
        ]);
    }
}