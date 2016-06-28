<?php namespace Syscover\Comunik\Models;

use Syscover\Pulsar\Core\Model;
use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;
use Illuminate\Support\Facades\Validator;

/**
 * Class EmailSendHistory
 *
 * Model with properties
 * <br><b>[id, send_queue_id, campaign, contact_id, create, sent, viewed]</b>
 *
 * @package     Syscover\Comunik\Models
 */

class EmailSendHistory extends Model
{
    use Eloquence, Mappable;

	protected $table        = '005_048_email_send_history';
    protected $primaryKey   = 'id_048';
    public $timestamps      = false;
    protected $fillable     = ['id_048', 'send_queue_id_048', 'campaign_id_048', 'contact_id_048', 'create_048', 'sent_048', 'viewed_048'];
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
        return $query->join('005_041_contact', '005_048_email_send_history.contact_id_048', '=', '005_041_contact.id_041');
    }

    /**
     * @deprecated
     * @param $parameters
     * @return mixed
     */
    public static function getRecords($parameters)
    {
        $query = EmailSendHistory::builder();

        if(isset($parameters['id_048'])) $query->where('id_048', $parameters['id_048']);
        if(isset($parameters['campaign_id_048'])) $query->where('campaign_id_048', $parameters['campaign_id_048']);
        if(isset($parameters['contact_id_048'])) $query->where('contact_id_048', $parameters['contact_id_048']);

        return $query->get();
    }
}