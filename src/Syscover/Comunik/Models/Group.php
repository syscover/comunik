<?php namespace Syscover\Comunik\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Syscover\Pulsar\Traits\ModelTrait;

class Group extends Model {

    use ModelTrait;

	protected $table        = '005_029_group';
    protected $primaryKey   = 'id_029';
    public $timestamps      = false;
    protected $fillable     = ['id_029', 'name_029'];
    private static $rules   = [
        'name'  => 'required|between:2,50'
    ];

    public static function validate($data)
    {
        return Validator::make($data, static::$rules);
	}
}