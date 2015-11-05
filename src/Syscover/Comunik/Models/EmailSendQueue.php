<?php namespace Syscover\Comunik\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Syscover\Pulsar\Models\Preference;
use Syscover\Pulsar\Traits\TraitModel;

class EmailSendQueue extends Model {

    use TraitModel;

	protected $table        = '005_047_email_send_queue';
    protected $primaryKey   = 'id_047';
    public $timestamps      = false;
    protected $fillable     = ['id_047', 'campaign_047', 'contact_047', 'sorting_047', 'status_047', 'create_047'];
    private static $rules   = [];

    public static function validate($data)
    {
        return Validator::make($data, static::$rules);
	}

    // Attention! function called from \Syscover\Comunik\Libraries\Cron
    public static function getNMailings()
    {
        $emailServiceIntervalShipping   = Preference::find('emailServiceIntervalShipping');
        $now                            = date('U');
        // fecha que hasta pasada la misma no se podría enviar emails
        $limitDate                      = $now - ((int)$emailServiceIntervalShipping->value_018 * 24 * 60 * 60);

        // se podría quitar de la consulta ->where('created_044', true) para mandar mails,
        // sin terminar de crear la campaña campaña para agilizar el proceso de envío
        return EmailSendQueue::join('005_044_email_campaign', '005_047_email_send_queue.campaign_047', '=', '005_044_email_campaign.id_044')
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
        $emailServiceIntervalShipping   = Preference::find('emailServiceIntervalShipping');
        $now                            = date('U');
        // fecha que hasta pasada la misma no se podría enviar emails
        $limitDate                      = $now - ($emailServiceIntervalShipping->value_018 * 24 * 60 * 60);
/*
        return collect(DB::select('select * from (select * from 005_047_email_send_queue order by sorting_047) as tmp_email_send_queue
            inner join 005_041_contact on tmp_email_send_queue.contact_047 = 005_041_contact.id_041
            inner join 005_044_email_campaign on tmp_email_send_queue.campaign_047 = 005_044_email_campaign.id_044
            inner join 001_013_email_account on 005_044_email_campaign.email_account_044 = 001_013_email_account.id_013
            where status_047 = 0
            and contact_047 not in (select contact_048 from 005_048_email_send_historical where sent_048 > ?)
            group by 005_041_contact.id_041
            limit ? offset ?', [$limitDate, $take, $skip]));
*/


        return EmailSendQueue::join('005_041_contact', '005_047_email_send_queue.contact_047', '=', '005_041_contact.id_041')
                ->join('005_044_email_campaign', '005_047_email_send_queue.campaign_047', '=', '005_044_email_campaign.id_044')
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