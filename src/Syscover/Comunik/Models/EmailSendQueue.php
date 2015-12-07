<?php namespace Syscover\Comunik\Models;

use Syscover\Pulsar\Models\Model;
use Illuminate\Support\Facades\Validator;
use Syscover\Pulsar\Traits\TraitModel;
use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;
use Syscover\Pulsar\Models\Preference;

/**
 * Class EmailSendHistorical
 *
 * Model with properties
 * <br><b>[id, campaign, contact, sorting, status, create]</b>
 *
 * @package     Syscover\Comunik\Models
 */

class EmailSendQueue extends Model {

    use TraitModel;
    use Eloquence, Mappable;

	protected $table        = '005_047_email_send_queue';
    protected $primaryKey   = 'id_047';
    public $timestamps      = false;
    protected $fillable     = ['id_047', 'campaign_047', 'contact_047', 'sorting_047', 'status_047', 'create_047'];
    protected $maps         = [];
    protected $relationMaps = [
        'campaign'  => \Syscover\Comunik\Models\EmailCampaign::class,
        'contact'   => \Syscover\Comunik\Models\Contact::class,
    ];
    private static $rules   = [];

    public static function validate($data)
    {
        return Validator::make($data, static::$rules);
	}

    public function scopeBuilder($query)
    {
        return $query->join('005_044_email_campaign', '005_047_email_send_queue.campaign_047', '=', '005_044_email_campaign.id_044')
            ->join('005_041_contact', '005_047_email_send_queue.contact_047', '=', '005_041_contact.id_041');
    }

    // Attention! function called from \Syscover\Comunik\Libraries\Cron
    public static function getNMailings()
    {
        $now        = date('U');
        // fecha que hasta pasada la misma no se podría enviar emails
        $limitDate  = $now - ((int)Preference::getValue('emailServiceIntervalShipping', 5)->value_018 * 24 * 60 * 60);

        // se podría quitar de la consulta ->where('created_044', true) para mandar mails,
        // sin terminar de crear la campaña campaña para agilizar el proceso de envío
        return EmailSendQueue::builder()
            // 0 = waiting to be sent
            ->where('status_047', 0)
            // only campaign already created
            ->where('created_044', true)
            ->whereNotIn('contact_047', function($query) use ($limitDate){
                $query->select('contact_048')
                    ->from('005_048_email_send_historical')
                    ->where('sent_048', '>', $limitDate)
                    ->get();
            })
            ->count();
    }

    // Attention! function called from \Syscover\Comunik\Libraries\Cron
    public static function getMailings($take, $skip)
    {
        $now        = date('U');
        // fecha que hasta pasada la misma no se podría enviar emails
        $limitDate  = $now - (Preference::getValue('emailServiceIntervalShipping', 5)->value_018 * 24 * 60 * 60);

        return EmailSendQueue::builder()
                ->join('001_013_email_account', '005_044_email_campaign.email_account_044', '=', '001_013_email_account.id_013')
                ->where('status_047', '=', 0)
                ->whereNotIn('contact_047', function($query) use ($limitDate) {
                    $query->select('contact_048')
                                ->from('005_048_email_send_historical')
                                ->where('sent_048', '>', $limitDate)
                                ->get();
                })
                ->groupBy('005_041_contact.id_041')
                ->take($take)->skip($skip)
                ->orderBy('sorting_047', 'asc')
                ->get();
    }

    // Attention! function called from \Syscover\Comunik\Controller\EmailCampaignsController
    public static function deleteMailingWithoutGroupSendQueue($groups, $campaign)
    {
        EmailSendQueue::where('campaign_047', $campaign)
            ->where('status_047', 0)
            ->whereNotIn('contact_047', function($query) use ($groups) {
                $query->select('contact_042')
                    ->from('005_042_contacts_groups')
                    ->whereIn('group_042', $groups)
                    ->groupBy('contact_042')
                    ->get();
            })
            ->delete();
    }
}