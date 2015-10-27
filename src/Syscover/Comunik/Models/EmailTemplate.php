<?php namespace Syscover\Comunik\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Syscover\Pulsar\Traits\TraitModel;

class EmailTemplate extends Model {

    use TraitModel;

	protected $table        = '005_043_email_template';
    protected $primaryKey   = 'id_043';
    public $timestamps      = false;
    protected $fillable     = ['id_043', 'name_043', 'subject_043', 'theme_043', 'header_043', 'body_043', 'footer_043', 'text_043', 'data_043'];
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