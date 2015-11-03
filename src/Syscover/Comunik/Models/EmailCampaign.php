<?php namespace Syscover\Comunik\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Syscover\Pulsar\Traits\TraitModel;

class EmailCampaign extends Model {

    use TraitModel;

	protected $table        = '005_044_email_campaign';
    protected $primaryKey   = 'id_044';
    public $timestamps      = false;
    protected $fillable     = ['id_044', 'name_044', 'email_account_044', 'template_044', 'subject_044', 'theme_044', 'header_044', 'body_044', 'footer_044', 'text_044', 'data_044', 'shipping_date_044', 'persistence_date_044', 'sorting_044', 'created_044', 'sent_044', 'viewed_044'];
    private static $rules   = [
        'name'      => 'required|between:2,100',
        'subject'   => 'required|between:2,255',
        'body'      => 'required'
    ];

    public static function validate($data)
    {
        return Validator::make($data, static::$rules);
	}

    public static function getCustomRecordsLimit()
    {
        $query =  EmailCampaign::join('001_013_email_account', '005_044_email_campaign.email_account_044', '=', '001_013_email_account.id_013')
            ->newQuery();

        return $query;
    }

    public function countries()
    {
        return EmailCampaign::belongsToMany('Syscover\Pulsar\Models\Country', '005_045_email_campaigns_countries', 'campaign_045', 'country_045');
    }

    public function groups()
    {
        return EmailCampaign::belongsToMany('Syscover\Comunik\Models\Group', '005_046_email_campaigns_groups', 'campaign_046','group_046');
    }
}