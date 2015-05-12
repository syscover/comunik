<?php namespace Syscover\Comunik\Controllers;

use Illuminate\Support\Facades\Request;
use Syscover\Comunik\Models\Group;
use Syscover\Pulsar\Controllers\Controller;
use Syscover\Pulsar\Traits\ControllerTrait;
use Syscover\Comunik\Models\Contact;

class EmailAccount extends Controller {

    use ControllerTrait;

    protected $routeSuffix  = 'ComunikContact';
    protected $folder       = 'contacts';
    protected $package      = 'comunik';
    protected $aColumns     = ['id_047', 'name_047', 'surname_047', 'name_002', 'mobile_047', ['data' => 'email_047', 'type' => 'email'], ['data' => 'unsubscribe_mobile_047', 'type' => 'invertActive'], ['data' => 'unsubscribe_email_047', 'type' => 'invertActive'], 'name_029'];
    protected $nameM        = 'name_047';
    protected $model        = '\Syscover\Comunik\Models\Contact';
    protected $icon         = 'icomoon-icon-address-book';
    protected $objectTrans  = 'contact';

    public function createCustomRecord($parameters)
    {
        $parameters['groups'] = Group::all();

        return $parameters;
    }

    public function storeCustomRecord()
    {
        $contact = Contact::create([
            'company_047'       => Request::input('company'),
            'name_047'          => Request::input('name'),
            'surname_047'       => Request::input('surname'),
            'birthdate_047'     => Request::has('birthdate')? \DateTime::createFromFormat('d-m-Y',Request::input('birthdate'))->getTimestamp() : null,
            'country_047'       => Request::input('country'),
            'prefix_047'        => Request::input('prefix'),
            'mobile_047'        => Request::has('mobile')? str_replace('-', '', Request::input('mobile')) : null,
            'email_047'         => strtolower(Request::input('email')),
        ]);

        $contact->groups()->attach(Request::input('groups'));
    }

    public function editCustomRecord($parameters)
    {
        $parameters['groups']       = Group::all();

        return $parameters;
    }

    public function checkSpecialRulesToUpdate($parameters)
    {
        $contact = Contact::find($parameters['id']);

        $parameters['specialRules']['emailRule'] = Request::input('email') == $contact->email_047? true : false;
        $parameters['specialRules']['mobileRule'] = Request::input('mobile') == $contact->mobile_047? true : false;

        return $parameters;
    }
    
    public function updateCustomRecord($parameters)
    {
        Contact::where('id_047', $parameters['id'])->update([
            'company_047'       => Request::input('company'),
            'name_047'          => Request::input('name'),
            'surname_047'       => Request::input('surname'),
            'birthdate_047'     => Request::has('birthdate')? \DateTime::createFromFormat('d-m-Y',Request::input('birthdate'))->getTimestamp() : null,
            'country_047'       => Request::input('country'),
            'prefix_047'        => Request::input('prefix'),
            'mobile_047'        => Request::has('mobile')? str_replace('-', '', Request::input('mobile')) : null,
            'email_047'         => strtolower(Request::input('email')),
        ]);
    }
}