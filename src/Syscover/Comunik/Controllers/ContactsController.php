<?php namespace Syscover\Comunik\Controllers;

use Illuminate\Support\Facades\Request;
use Syscover\Comunik\Models\Group;
use Syscover\Pulsar\Controllers\Controller;
use Syscover\Pulsar\Traits\TraitController;
use Syscover\Comunik\Models\Contact;

class ContactsController extends Controller {

    use TraitController;

    protected $routeSuffix  = 'ComunikContact';
    protected $folder       = 'contacts';
    protected $package      = 'comunik';
    protected $aColumns     = ['id_030', 'name_030', 'surname_030', 'name_002', 'mobile_030', ['data' => 'email_030', 'type' => 'email'], ['data' => 'unsubscribe_mobile_030', 'type' => 'invertActive'], ['data' => 'unsubscribe_email_030', 'type' => 'invertActive'], 'name_029'];
    protected $nameM        = 'name_030';
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
            'company_030'       => Request::input('company'),
            'name_030'          => Request::input('name'),
            'surname_030'       => Request::input('surname'),
            'birthdate_030'     => Request::has('birthdate')? \DateTime::createFromFormat('d-m-Y',Request::input('birthdate'))->getTimestamp() : null,
            'country_030'       => Request::input('country'),
            'prefix_030'        => Request::input('prefix'),
            'mobile_030'        => Request::has('mobile')? str_replace('-', '', Request::input('mobile')) : null,
            'email_030'         => strtolower(Request::input('email')),
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

        $parameters['specialRules']['emailRule'] = Request::input('email') == $contact->email_030? true : false;
        $parameters['specialRules']['mobileRule'] = Request::input('mobile') == $contact->mobile_030? true : false;

        return $parameters;
    }
    
    public function updateCustomRecord($parameters)
    {
        Contact::where('id_030', $parameters['id'])->update([
            'company_030'       => Request::input('company'),
            'name_030'          => Request::input('name'),
            'surname_030'       => Request::input('surname'),
            'birthdate_030'     => Request::has('birthdate')? \DateTime::createFromFormat('d-m-Y',Request::input('birthdate'))->getTimestamp() : null,
            'country_030'       => Request::input('country'),
            'prefix_030'        => Request::input('prefix'),
            'mobile_030'        => Request::has('mobile')? str_replace('-', '', Request::input('mobile')) : null,
            'email_030'         => strtolower(Request::input('email')),
        ]);
    }
}