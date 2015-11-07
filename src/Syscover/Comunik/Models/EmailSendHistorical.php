<?php namespace Syscover\Comunik\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Syscover\Pulsar\Traits\TraitModel;

class EmailSendHistorical extends Model {

    use TraitModel;

	protected $table        = '005_048_email_send_historical';
    protected $primaryKey   = 'id_048';
    public $timestamps      = false;
    protected $fillable     = ['id_048', 'send_queue_048', 'campaign_048', 'contact_048', 'sent_048', 'viewed_048'];
    private static $rules   = [];

    public static function validate($data)
    {
        return Validator::make($data, static::$rules);
	}

    public static function getRecords($parameters)
    {
        $query = EmailSendHistorical::join('005_041_contact', '005_048_email_send_historical.contact_048', '=', '005_041_contact.id_041')
            ->newQuery();

        if(isset($parameters['id_048'])) $query->where('id_048', $parameters['id_048']);
        if(isset($parameters['campaign_048'])) $query->where('campaign_048', $parameters['campaign_048']);
        if(isset($parameters['contact_048'])) $query->where('contact_048', $parameters['contact_048']);

        return $query->get();
    }
}