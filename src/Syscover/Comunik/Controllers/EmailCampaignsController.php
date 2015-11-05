<?php namespace Syscover\Comunik\Controllers;

use Illuminate\Support\Facades\Crypt;
use Syscover\Pulsar\Controllers\Controller;
use Syscover\Pulsar\Libraries\EmailServices;
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
        $htmlLinks = MiscellaneousComunik::setMailingLinks($request, $parameters);

        $emailCampaign = EmailCampaign::create([
            'name_044'              => $request->input('name'),
            'email_account_044'     => $request->input('emailAccount'),
            'template_044'          => empty($request->input('template'))? null : $request->input('template'),
            'subject_044'           => $request->input('subject'),
            'theme_044'             => $request->input('theme'),
            'header_044'            => $htmlLinks['header'],
            'body_044'              => $htmlLinks['body'],
            'footer_044'            => $htmlLinks['footer'],
            'text_044'              => $htmlLinks['text'],
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
        $htmlLinks = MiscellaneousComunik::setMailingLinks($request, $parameters);

        EmailCampaign::where('id_044', $parameters['id'])->update([
            'name_044'              => $request->input('name'),
            'email_account_044'     => $request->input('emailAccount'),
            'template_044'          => empty($request->input('template'))? null : $request->input('template'),
            'subject_044'           => $request->input('subject'),
            'theme_044'             => $request->input('theme'),
            'header_044'            => $htmlLinks['header'],
            'body_044'              => $htmlLinks['body'],
            'footer_044'            => $htmlLinks['footer'],
            'text_044'              => $htmlLinks['text'],
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


    public function showCampaign($emailCampaign, $contactKey)
    {
        // function to view online the campaign
        $emailCampaign  = EmailCampaign::find(Crypt::decrypt($emailCampaign));
        $contact        = Contact::find(Crypt::decrypt($contactKey));
        $data           = [
            'email'         => $contact->email_041,
            'html'          => $emailCampaign->header_044 . $emailCampaign->body_044 . $emailCampaign->footer_044,
            'subject'       => $emailCampaign->subject_044,
            'campaign'      => Crypt::encrypt($emailCampaign->id_044),
            'contactKey'    => Crypt::encrypt($contact->id_041),
            'company'       => isset($contact->company_041)? $contact->company_041 : null,
            'name'          => isset($contact->name_041)? $contact->name_041 : null,
            'surname'       => isset($contact->surname_041)? $contact->surname_041 : null,
            'birthDay'      => isset($contact->birth_date_041)?  date(config('pulsar.datePattern'), $contact->birth_date_041) : null,
        ];

        $data = EmailServices::setTemplate($data);

        return view('pulsar::common.views.html_display', $data);
    }
}