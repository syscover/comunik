<?php namespace Syscover\Comunik\Models;

use Syscover\Pulsar\Core\Model;
use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;
use Illuminate\Support\Facades\Validator;

/**
 * Class EmailPattern
 *
 * Model with properties
 * <br><b>[id, name, subject, operator, message, action]</b>
 *
 * @package     Syscover\Comunik\Models
 */

class EmailPattern extends Model
{
    use Eloquence, Mappable;

	protected $table        = '005_049_email_pattern';
    protected $primaryKey   = 'id_049';
    public $timestamps      = false;
    protected $fillable     = ['id_049', 'name_049', 'subject_049', 'operator_049', 'message_049', 'action_049'];
    protected $maps         = [];
    protected $relationMaps = [];
    private static $rules   = [
        'name'      => 'required|between:2,255',
        'subject'   => 'between:2,255',
        'message'   => 'between:2,255',
        'action'    => 'not_in:null',
    ];

    public static function validate($data)
    {
        return Validator::make($data, static::$rules);
	}
}