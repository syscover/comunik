<?php namespace Syscover\Comunik\Controllers;

use Syscover\Pulsar\Core\Controller;
use Illuminate\Support\Facades\Crypt;
use Syscover\Comunik\Libraries\Cron;
use Syscover\Comunik\Models\EmailSendHistory;
use Syscover\Pulsar\Libraries\EmailServices;
use Syscover\Pulsar\Models\EmailAccount;
use Syscover\Comunik\Libraries\Miscellaneous as MiscellaneousComunik;
use Syscover\Comunik\Models\EmailCampaign;
use Syscover\Comunik\Models\EmailSendQueue;
use Syscover\Comunik\Models\Group;
use Syscover\Comunik\Models\Contact;
use Syscover\Comunik\Models\EmailTemplate;

/**
 * Class EmailCampaignsController
 * @package Syscover\Comunik\Controllers
 */

class EmailCampaignsController extends Controller
{
    protected $routeSuffix  = 'comunikEmailCampaign';
    protected $folder       = 'email_campaign';
    protected $package      = 'comunik';
    protected $aColumns     = ['id_044', 'name_044', 'name_013', 'shipping_date_044', 'shipping_date_text_044', 'persistence_date_044', 'persistence_date_text_044', 'sorting_044', ['data' => 'processing_044', 'type' => 'active']];
    protected $nameM        = 'name_044';
    protected $model        = EmailCampaign::class;
    protected $icon         = 'fa fa-user';
    protected $objectTrans  = 'campaign';

    public function jsonCustomDataBeforeActions($aObject, $actionUrlParameters, $parameters)
    {
        $actions = '';

        $actions .= is_allowed($this->resource, 'create')? '<a class="btn btn-xs bs-tooltip" href="' . route('create' . ucfirst($this->routeSuffix), ['offset' => $this->request->input('start'), 'id' => $aObject['id_044']]) . '" data-original-title="' . trans('comunik::pulsar.duplicate_campaign') . '"><i class="fa fa-files-o"></i></a>' : null;
        $actions .= is_allowed($this->resource, 'access')? '<a class="btn btn-xs bs-tooltip" href="' . route('preview' . ucfirst($this->routeSuffix), [Crypt::encrypt($aObject['id_044'])]) . '" data-original-title="' . trans('comunik::pulsar.preview_campaign') . '" target="_blank"><i class="fa fa-eye"></i></a>' : null;
        $actions .= is_allowed($this->resource, 'access')? '<a class="btn btn-xs bs-tooltip" href="' . route('sendTest' . ucfirst($this->routeSuffix), [$aObject['id_044'], $this->request->input('start')]) . '" data-original-title="' . trans('comunik::pulsar.send_test_email') . '"><i class="fa fa-share"></i></a>' : null;

        return $actions;
    }

    public function createCustomRecord($parameters)
    {
        if(isset($parameters['id']))
        {
            $campaign = EmailCampaign::builder()->find($parameters['id']);
            $object = [
                'name_044'                  => $campaign->name_044,
                'email_account_id_044'      => $campaign->email_account_id_044,
                'template_id_044'           => $campaign->template_id_044,
                'subject_044'               => $campaign->subject_044,
                'theme_044'                 => $campaign->theme_044,
                'header_044'                => $campaign->header_044,
                'body_044'                  => $campaign->body_044,
                'footer_044'                => $campaign->footer_044,
                'text_044'                  => $campaign->text_044,
                'data_044'                  => $campaign->data_044,
                'shipping_date_044'         => $campaign->shipping_date_044,
                'persistence_date_044'      => $campaign->persistence_date_044,
                'sorting_044'               => $campaign->sorting_044
            ];

            $parameters['object']           = (object)$object;
            $parameters['selectGroups']     = $campaign->getGroups;
            $parameters['selectCountries']  = $campaign->getCountries;
        }

        $parameters['emailAccounts']    = EmailAccount::all();
        $parameters['templates']        = EmailTemplate::all();
        $parameters['themes']           = MiscellaneousComunik::getThemes();
        $parameters['emlHeaders']       = MiscellaneousComunik::getEmlHeaders();
        $parameters['groups']           = Group::all();
        $parameters['countries']        = Contact::getCountriesContacts(['lang' => auth('pulsar')->user()->lang_id_010]);

        return $parameters;
    }

    public function storeCustomRecord($parameters)
    {
        $htmlLinks = MiscellaneousComunik::setMailingLinks($this->request, $parameters);

        $emailCampaign = EmailCampaign::create([
            'name_044'                  => $this->request->input('name'),
            'email_account_id_044'      => $this->request->input('emailAccount'),
            'template_id_044'           => empty($this->request->input('template'))? null : $this->request->input('template'),
            'subject_044'               => $this->request->input('subject'),
            'theme_044'                 => $this->request->input('theme'),
            'header_044'                => $htmlLinks['header'],
            'body_044'                  => $htmlLinks['body'],
            'footer_044'                => $htmlLinks['footer'],
            'text_044'                  => $htmlLinks['text'],
            'data_044'                  => $this->request->input('data', 'NULL'),
            'shipping_date_044'         => $this->request->has('shippingDate')? \DateTime::createFromFormat(config('pulsar.datePattern') . ' H:i', $this->request->input('shippingDate'))->getTimestamp() : (integer)date('U'),
            'shipping_date_text_044'    => $this->request->has('shippingDate')? $this->request->input('shippingDate') : null,
            'persistence_date_044'      => $this->request->has('persistenceDate')? \DateTime::createFromFormat(config('pulsar.datePattern') . ' H:i', $this->request->input('persistenceDate'))->getTimestamp() : null,
            'persistence_date_text_044' => $this->request->has('persistenceDate')? $this->request->input('persistenceDate') : null,
            'sorting_044'               => $this->request->input('sorting')
        ]);

        $emailCampaign->getCountries()->attach($this->request->input('countries'));
        $emailCampaign->getGroups()->attach($this->request->input('groups'));
    }

    public function editCustomRecord($parameters)
    {
        $parameters['emailAccounts']        = EmailAccount::all();
        $parameters['templates']            = EmailTemplate::all();
        $parameters['themes']               = MiscellaneousComunik::getThemes();
        $parameters['emlHeaders']           = MiscellaneousComunik::getEmlHeaders();
        $parameters['groups']               = Group::all();
        $parameters['selectGroups']         = $parameters['object']->getGroups;
        $parameters['countries']            = Contact::getCountriesContacts(['lang' => auth('pulsar')->user()->lang_id_010]);
        $parameters['selectCountries']      = $parameters['object']->getCountries;

        // statistics
        $parameters['queueMailings']        = EmailSendQueue::where('campaign_id_047', $parameters['id'])->count();
        $parameters['sentMailings']         = EmailSendHistory::where('campaign_id_048', $parameters['id'])->count();
        $parameters['noSentMailings']       = EmailSendQueue::where('campaign_id_047', $parameters['id'])->where('status_id_047', 0)->count();
        $parameters['uniqueViewMailings']   = EmailSendHistory::where('campaign_id_048', $parameters['id'])->where('viewed_048', '>' ,0)->count();
        $parameters['effectiveness']        = $parameters['uniqueViewMailings'] > 0? round($parameters['uniqueViewMailings'] / $parameters['sentMailings'] * 100, 2) : 0;

        return $parameters;
    }
    
    public function updateCustomRecord($parameters)
    {
        $htmlLinks = MiscellaneousComunik::setMailingLinks($this->request, $parameters);

        EmailCampaign::where('id_044', $parameters['id'])->update([
            'name_044'                  => $this->request->input('name'),
            'email_account_id_044'      => $this->request->input('emailAccount'),
            'template_id_044'           => empty($this->request->input('template'))? null : $this->request->input('template'),
            'subject_044'               => $this->request->input('subject'),
            'theme_044'                 => $this->request->input('theme'),
            'header_044'                => $htmlLinks['header'],
            'body_044'                  => $htmlLinks['body'],
            'footer_044'                => $htmlLinks['footer'],
            'text_044'                  => $htmlLinks['text'],
            'data_044'                  => $this->request->input('data', 'NULL'),
            'shipping_date_044'         => $this->request->has('shippingDate')? \DateTime::createFromFormat(config('pulsar.datePattern') . ' H:i', $this->request->input('shippingDate'))->getTimestamp() : (integer)date('U'),
            'shipping_date_text_044'    => $this->request->has('shippingDate')? $this->request->input('shippingDate') : null,
            'persistence_date_044'      => $this->request->has('persistenceDate')? \DateTime::createFromFormat(config('pulsar.datePattern') . ' H:i', $this->request->input('persistenceDate'))->getTimestamp() : null,
            'persistence_date_text_044' => $this->request->has('persistenceDate')? $this->request->input('persistenceDate') : null,
            'sorting_044'               => $this->request->input('sorting')
        ]);

        $emailCampaign = EmailCampaign::find($parameters['id']);

        $emailCampaign->getCountries()->sync($this->request->input('countries'));
        $emailCampaign->getGroups()->sync($this->request->input('groups'));

        // borramos los envíos de cola, de aquellos correos en estado, status_id_047 = 0 waiting
        // que no correspondan con los nuevos grupos, caso muy dificil de ocurrir,
        // ya que solo se pasan a cola cuando van a ser enviados
        EmailSendQueue::deleteMailingWithoutGroupSendQueue($this->request->input('groups'), $emailCampaign->id_044);
    }

    public function previewCampaign()
    {
        // get parameters from url route
        $parameters = $this->request->route()->parameters();

        // function to view online the campaign
        $emailCampaign = EmailCampaign::find(Crypt::decrypt($parameters['campaign']));

        // We check that the historicoId exists and is equal to 0,
        // It is 0 when the request comes from a campaign preview
        if(isset($parameters['historyId']) && $parameters['historyId'] != 0)
            $emailSendHistorical = EmailSendHistory::getRecords(['id_048' => Crypt::decrypt($parameters['historyId'])])->first();

        // if is a test mailing, set contactKey and historyId to 0
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
            'historyId'     => isset($parameters['historyId'])? $parameters['historyId'] : 0,
        ];

        $data = EmailServices::setTemplate($data);

        return view('pulsar::common.views.html_display', $data);
    }

    public function recordStatistic()
    {
        // get parameters from url route
        $parameters = $this->request->route()->parameters();

        // if it's a test email, we brake execution
        if($parameters['historyId'] === "0") exit;

        $campaign   = Crypt::decrypt($parameters['campaign']);
        $historyId  = Crypt::decrypt($parameters['historyId']);


        // add a viewed to the campaign
        EmailCampaign::where('id_044', $campaign)->increment('viewed_044');

        // add a viewed to the historical
        EmailSendHistory::where('id_048', $historyId)->increment('viewed_048');
    }

    public function sendTest()
    {
        // get parameters from url route
        $parameters     = $this->request->route()->parameters();

        Cron::sendEmailsTest($parameters);

        return redirect()->route('comunikEmailCampaign', ['offset' => $parameters['offset']])->with([
            'msg'        => 1,
            'txtMsg'     => trans('comunik::pulsar.send_test_email_msg_ok')
        ]);
    }
}