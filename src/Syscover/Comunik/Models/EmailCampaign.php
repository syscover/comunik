<?php namespace Syscover\Comunik\Models;

use Syscover\Pulsar\Models\Model;
use Illuminate\Support\Facades\Validator;
use Syscover\Pulsar\Traits\TraitModel;
use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;
use Syscover\Pulsar\Models\Lang;

/**
 * Class EmailCampaign
 *
 * Model with properties
 * <br><b>[id, name, email_account, template, subject, theme, header, body, footer, text, data, shipping_date, persistence_date, sorting, processing, created, viewed]</b>
 *
 * @package     Syscover\Comunik\Models
 */

class EmailCampaign extends Model {

    use TraitModel;
    use Eloquence, Mappable;

	protected $table        = '005_044_email_campaign';
    protected $primaryKey   = 'id_044';
    public $timestamps      = false;
    protected $fillable     = ['id_044', 'name_044', 'email_account_044', 'template_044', 'subject_044', 'theme_044', 'header_044', 'body_044', 'footer_044', 'text_044', 'data_044', 'shipping_date_044', 'persistence_date_044', 'sorting_044', 'processing_044', 'created_044', 'viewed_044'];
    protected $maps         = [];
    protected $relationMaps = [
        'email_account' => \Syscover\Pulsar\Models\EmailAccount::class,
    ];
    private static $rules   = [
        'name'      => 'required|between:2,100',
        'subject'   => 'required|between:2,255',
        'body'      => 'required'
    ];

    public static function validate($data)
    {
        return Validator::make($data, static::$rules);
	}

    public function scopeBuilder($query)
    {
        return $query->join('001_013_email_account', '005_044_email_campaign.email_account_044', '=', '001_013_email_account.id_013');
    }

    public function getCountries()
    {
        // get base lang from database because this function is call from cron, without create session variable baseLang
        $baseLang = Lang::getBaseLang()->id_001;
        return EmailCampaign::belongsToMany('Syscover\Pulsar\Models\Country', '005_045_email_campaigns_countries', 'campaign_045', 'country_045')
            ->where('001_002_country.lang_002', $baseLang);
    }

    public function getGroups()
    {
        return EmailCampaign::belongsToMany('Syscover\Comunik\Models\Group', '005_046_email_campaigns_groups', 'campaign_046','group_046');
    }

    public static function addToGetRecordsLimit()
    {
        $query =  EmailCampaign::builder()
            ->orderBy('id_044', 'desc');

        return $query;
    }

    // Attention! function called from \Syscover\Comunik\Libraries\Cron::sendEmailTest
    /**
     * @deprecated
     * @param $parameters
     * @return mixed
     */
    public static function getRecords($parameters)
    {
        $query = EmailCampaign::builder();

        if(isset($parameters['id_044'])) $query->where('id_044', $parameters['id_044']);

        return $query->get();
    }

    // Attention! function called from \Syscover\Comunik\Libraries\Cron
    public static function getCampaignsWithPersistence()
    {
        return EmailCampaign::where('persistence_date_044', '>', date('U'))
            ->where('shipping_date_044', '<', date('U'))
            ->where('processing_044', true) // solo aquellas campañas que se han enviado para que pasen a cola de envíos
            ->where('created_044', true)    // solo aquellas campañas que todos su destinatarios ya esten metidos en la cola de envíos
            ->get();
    }

    // listamos todas las campañas que su fecha de envío sea antrior a la actual y no hayan sido enviadas
    public static function getCampaignsNotCreated()
    {
        return EmailCampaign::where('shipping_date_044', '<', date('U'))
            ->where('created_044', false) // solo aquellas campañas sin enviar a cola de procesos o enviadas pero aún no terminadas de crear
            ->get();
    }
}