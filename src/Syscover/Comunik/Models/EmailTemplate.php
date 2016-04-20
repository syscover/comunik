<?php namespace Syscover\Comunik\Models;

use Syscover\Pulsar\Core\Model;
use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;
use Illuminate\Support\Facades\Validator;

/**
 * Class EmailTemplate
 *
 * Model with properties
 * <br><b>[id, name, subject, theme, header, body, footer, text, data]</b>
 *
 * @package     Syscover\Comunik\Models
 */

class EmailTemplate extends Model
{
    use Eloquence, Mappable;

	protected $table        = '005_043_email_template';
    protected $primaryKey   = 'id_043';
    public $timestamps      = false;
    protected $fillable     = ['id_043', 'name_043', 'subject_043', 'theme_043', 'header_043', 'body_043', 'footer_043', 'text_043', 'data_043'];
    protected $maps         = [];
    protected $relationMaps = [];
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