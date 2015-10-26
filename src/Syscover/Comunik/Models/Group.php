<?php namespace Syscover\Comunik\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Syscover\Pulsar\Traits\TraitModel;

class Group extends Model {

    use TraitModel;

	protected $table        = '005_040_group';
    protected $primaryKey   = 'id_040';
    public $timestamps      = false;
    protected $fillable     = ['id_040', 'name_040'];
    private static $rules   = [
        'name'  => 'required|between:2,50'
    ];

    public static function validate($data)
    {
        return Validator::make($data, static::$rules);
	}
}