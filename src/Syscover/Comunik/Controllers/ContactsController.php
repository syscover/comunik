<?php namespace Syscover\Comunik\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Syscover\Comunik\Models\Group;
use Syscover\Pulsar\Controllers\Controller;
use Syscover\Pulsar\Traits\TraitController;
use Syscover\Comunik\Models\Contact;

class ContactsController extends Controller {

    use TraitController;

    protected $routeSuffix  = 'ComunikContact';
    protected $folder       = 'contacts';
    protected $package      = 'comunik';
    protected $aColumns     = ['id_041', 'name_041', 'surname_041', 'name_002', 'mobile_041', ['data' => 'email_041', 'type' => 'email'], ['data' => 'unsubscribe_email_041', 'type' => 'invertActive'], 'name_040'];
    protected $nameM        = 'name_041';
    protected $model        = '\Syscover\Comunik\Models\Contact';
    protected $icon         = 'fa fa-user';
    protected $objectTrans  = 'contact';

    public function createCustomRecord($request, $parameters)
    {
        $parameters['groups'] = Group::all();

        return $parameters;
    }

    public function storeCustomRecord($request)
    {
        $contact = Contact::create([
            'company_041'               => $request->input('company'),
            'name_041'                  => $request->input('name'),
            'surname_041'               => $request->input('surname'),
            'birth_date_041'            => $request->has('birthDate')? \DateTime::createFromFormat(config('pulsar.datePattern'), $request->input('birthDate'))->getTimestamp() : null,
            'country_041'               => $request->input('country'),
            'prefix_041'                => $request->input('prefix'),
            'mobile_041'                => $request->has('mobile')? str_replace('-', '', $request->input('mobile')) : null,
            'email_041'                 => strtolower($request->input('email')),
            'unsubscribe_mobile_041'    => $request->has('unsubscribeMobile'),
            'unsubscribe_email_041'     => $request->has('unsubscribeEmail'),
        ]);

        $contact->groups()->attach($request->input('groups'));
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
            'company_041'               => $request->input('company'),
            'name_041'                  => $request->input('name'),
            'surname_041'               => $request->input('surname'),
            'birth_date_041'            => $request->has('birthDate')? \DateTime::createFromFormat(config('pulsar.datePattern'), $request->input('birthDate'))->getTimestamp() : null,
            'country_041'               => $request->input('country'),
            'prefix_041'                => $request->input('prefix'),
            'mobile_041'                => $request->has('mobile')? str_replace('-', '', $request->input('mobile')) : null,
            'email_041'                 => strtolower($request->input('email')),
            'unsubscribe_mobile_041'    => $request->has('unsubscribeMobile'),
            'unsubscribe_email_041'     => $request->has('unsubscribeEmail'),

        ]);
    }

    public function getEmailToUnsubscribe(Request $request)
    {
        // get parameters from url route
        $parameters = $request->route()->parameters();

        $contact = Contact::find(Crypt::decrypt($parameters['key']));

        return view('comunik::contacts.unsubscribe', ['key' => $parameters['key'], 'contact' => $contact]);
    }

    public function unsubscribeEmail(Request $request)
    {
        $contact = Contact::find(Crypt::decrypt($request->input('key')));
        Contact::where('id_041', $contact->id_041)->update([
            'unsubscribe_email_041' => true
        ]);

        return view('comunik::contacts.unsubscribe', ['contact' => $contact, 'unsubscribe' => true]);
    }
}