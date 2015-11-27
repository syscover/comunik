<?php namespace Syscover\Comunik\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Syscover\Comunik\Libraries\Cron;
use Syscover\Comunik\Models\EmailSendHistorical;
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

    protected $routeSuffix  = 'comunikEmailCampaign';
    protected $folder       = 'email_campaigns';
    protected $package      = 'comunik';
    protected $aColumns     = ['id_044', 'name_044', 'name_013', 'shipping_date_044', 'persistence_date_044', 'sorting_044', ['data' => 'processing_044', 'type' => 'active']];
    protected $nameM        = 'name_044';
    protected $model        = '\Syscover\Comunik\Models\EmailCampaign';
    protected $icon         = 'fa fa-user';
    protected $objectTrans  = 'campaign';

    public function jsonCustomDataBeforeActions($request, $aObject)
    {
        $actions = '';

        $actions .= session('userAcl')->isAllowed($request->user()->profile_010, $this->resource, 'access')? '<a class="btn btn-xs bs-tooltip" href="' . route('show' . ucfirst($this->routeSuffix), [Crypt::encrypt($aObject['id_044'])]) . '" data-original-title="' . trans('comunik::pulsar.preview_campaign') . '" target="_blank"><i class="fa fa-eye"></i></a>' : null;
        $actions .= session('userAcl')->isAllowed($request->user()->profile_010, $this->resource, 'access')? '<a class="btn btn-xs bs-tooltip" href="' . route('sendTest' . ucfirst($this->routeSuffix), [$aObject['id_044'], $request->input('iDisplayStart')]) . '" data-original-title="' . trans('comunik::pulsar.send_test_email') . '"><i class="fa fa-share"></i></a>' : null;

        return $actions;
    }

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
        $parameters['emailAccounts']        = EmailAccount::all();
        $parameters['templates']            = EmailTemplate::all();
        $parameters['themes']               = MiscellaneousComunik::getThemes();
        $parameters['emlHeaders']           = MiscellaneousComunik::getEmlHeaders();
        $parameters['groups']               = Group::all();
        $parameters['countries']            = Contact::getCountriesContacts(['lang' => $request->user()->lang_010]);

        // statistics
        $parameters['queueMailings']        = EmailSendQueue::where('campaign_047', $parameters['id'])->count();
        $parameters['sentMailings']         = EmailSendHistorical::where('campaign_048', $parameters['id'])->count();
        $parameters['noSentMailings']       = EmailSendQueue::where('campaign_047', $parameters['id'])->where('status_047', 0)->count();
        $parameters['uniqueViewMailings']   = EmailSendHistorical::where('campaign_048', $parameters['id'])->where('viewed_048', '>' ,0)->count();
        $parameters['effectiveness']        = $parameters['uniqueViewMailings'] > 0? round($parameters['uniqueViewMailings'] / $parameters['sentMailings'] * 100, 2) : 0;

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

    public function showCampaign(Request $request)
    {
        // get parameters from url route
        $parameters     = $request->route()->parameters();

        // function to view online the campaign
        $emailCampaign          = EmailCampaign::find(Crypt::decrypt($parameters['campaign']));

        // comprobamos que el historicoId existe y es diferente a 0,
        // es 0 cuando la petición viene de un preview de campaña
        if(isset($parameters['historicalId']) && $parameters['historicalId'] != 0)
            $emailSendHistorical    = EmailSendHistorical::getRecords(['id_048' => Crypt::decrypt($parameters['historicalId'])])->first();

        // if is a test mailing, set contactKey and historicalId to 0
        $data           = [
            'email'         => isset($emailSendHistorical->email_041)? $emailSendHistorical->email_041 : null,
            'html'          => $emailCampaign->header_044 . $emailCampaign->body_044 . $emailCampaign->footer_044,
            'subject'       => $emailCampaign->subject_044,
            'campaign'      => Crypt::encrypt($emailCampaign->id_044),
            'contactKey'    => isset($emailSendHistorical->id_041)? Crypt::encrypt($emailSendHistorical->id_041) : 0,
            'company'       => isset($emailSendHistorical->company_041)? $emailSendHistorical->company_041 : null,
            'name'          => isset($emailSendHistorical->name_041)? $emailSendHistorical->name_041 : null,
            'surname'       => isset($emailSendHistorical->surname_041)? $emailSendHistorical->surname_041 : null,
            'birthDay'      => isset($emailSendHistorical->birth_date_041)?  date(config('pulsar.datePattern'), $emailSendHistorical->birth_date_041) : null,
            'historicalId'  => isset($parameters['historicalId'])? $parameters['historicalId'] : 0,
        ];

        $data = EmailServices::setTemplate($data);

        return view('pulsar::common.views.html_display', $data);
    }

    public function recordStatistic(Request $request)
    {
        // get parameters from url route
        $parameters     = $request->route()->parameters();

        // if it's a test email, we brake execution
        if($parameters['historicalId'] === "0") exit;

        $campaign       = Crypt::decrypt($parameters['campaign']);
        $historicalId   = Crypt::decrypt($parameters['historicalId']);

        // add a viewed to the campaign
        EmailCampaign::where('id_044', $campaign)->increment('viewed_044');

        // add a viewed to the historical
        EmailSendHistorical::where('id_048', $historicalId)->increment('viewed_048');
    }

    public function sendTest(Request $request)
    {
        // get parameters from url route
        $parameters     = $request->route()->parameters();

        Cron::sendEmailsTest($parameters);

        return redirect()->route('comunikEmailCampaign', ['offset' => $parameters['offset']])->with([
            'msg'        => 1,
            'txtMsg'     => trans('comunik::pulsar.send_test_email_msg_ok')
        ]);
    }
}