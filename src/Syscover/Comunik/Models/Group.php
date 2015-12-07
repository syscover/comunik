<?php namespace Syscover\Comunik\Models;

use Syscover\Pulsar\Models\Model;
use Illuminate\Support\Facades\Validator;
use Syscover\Pulsar\Traits\TraitModel;
use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;

/**
 * Class Group
 *
 * Model with properties
 * <br><b>[id, name]</b>
 *
 * @package     Syscover\Comunik\Models
 */

class Group extends Model {

    use TraitModel;
    use Eloquence, Mappable;

	protected $table        = '005_040_group';
    protected $primaryKey   = 'id_040';
    public $timestamps      = false;
    protected $fillable     = ['id_040', 'name_040'];
    protected $maps         = [];
    protected $relationMaps = [];
    private static $rules   = [
        'name'  => 'required|between:2,50'
    ];

    public static function validate($data)
    {
        return Validator::make($data, static::$rules);
	}
}