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
}