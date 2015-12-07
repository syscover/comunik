<?php namespace Syscover\Comunik\Models;

use Syscover\Pulsar\Models\Model;
use Illuminate\Support\Facades\Validator;
use Syscover\Pulsar\Traits\TraitModel;
use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;

/**
 * Class EmailSendHistorical
 *
 * Model with properties
 * <br><b>[id, send_queue, campaign, contact, create, sent, viewed]</b>
 *
 * @package     Syscover\Comunik\Models
 */

class EmailSendHistorical extends Model {

    use TraitModel;
    use Eloquence, Mappable;

	protected $table        = '005_048_email_send_historical';
    protected $primaryKey   = 'id_048';
    public $timestamps      = false;
    protected $fillable     = ['id_048', 'send_queue_048', 'campaign_048', 'contact_048', 'create_048', 'sent_048', 'viewed_048'];
    protected $maps         = [];
    protected $relationMaps = [
        'contact' => \Syscover\Comunik\Models\Contact::class,
    ];
    private static $rules   = [];

    public static function validate($data)
    {
        return Validator::make($data, static::$rules);
	}

    public function scopeBuilder($query)
    {
        return $query->join('005_041_contact', '005_048_email_send_historical.contact_048', '=', '005_041_contact.id_041');
    }

    /**
     * @deprecated
     * @param $parameters
     * @return mixed
     */
    public static function getRecords($parameters)
    {
        $query = EmailSendHistorical::builder();

        if(isset($parameters['id_048'])) $query->where('id_048', $parameters['id_048']);
        if(isset($parameters['campaign_048'])) $query->where('campaign_048', $parameters['campaign_048']);
        if(isset($parameters['contact_048'])) $query->where('contact_048', $parameters['contact_048']);

        return $query->get();
    }
}