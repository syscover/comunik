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
}