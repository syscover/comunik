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
    protected $aColumns     = ['id_041', 'name_041', 'surname_041', 'name_002', 'mobile_041', ['data' => 'email_041', 'type' => 'email'], ['data' => 'unsubscribe_mobile_041', 'type' => 'invertActive'], ['data' => 'unsubscribe_email_041', 'type' => 'invertActive'], 'name_041'];
    protected $nameM        = 'name_041';
    protected $model        = '\Syscover\Comunik\Models\Contact';
    protected $icon         = 'fa fa-user';
    protected $objectTrans  = 'contact';

    public function createCustomRecord($parameters)
    {
        $parameters['groups'] = Group::all();

        return $parameters;
    }

    public function storeCustomRecord()
    {
        $contact = Contact::create([
            'company_041'       => Request::input('company'),
            'name_041'          => Request::input('name'),
            'surname_041'       => Request::input('surname'),
            'birthdate_041'     => Request::has('birthdate')? \DateTime::createFromFormat('d-m-Y',Request::input('birthdate'))->getTimestamp() : null,
            'country_041'       => Request::input('country'),
            'prefix_041'        => Request::input('prefix'),
            'mobile_041'        => Request::has('mobile')? str_replace('-', '', Request::input('mobile')) : null,
            'email_041'         => strtolower(Request::input('email')),
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
            'birthdate_041'     => Request::has('birthdate')? \DateTime::createFromFormat('d-m-Y',Request::input('birthdate'))->getTimestamp() : null,
            'country_041'       => Request::input('country'),
            'prefix_041'        => Request::input('prefix'),
            'mobile_041'        => Request::has('mobile')? str_replace('-', '', Request::input('mobile')) : null,
            'email_041'         => strtolower(Request::input('email')),
        ]);
    }
}