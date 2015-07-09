<?php namespace Syscover\Comunik\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Syscover\Pulsar\Traits\TraitModel;
use Illuminate\Support\Facades\DB;

class Contact extends Model {

    use TraitModel;

	protected $table        = '005_030_contact';
    protected $primaryKey   = 'id_030';
    public $timestamps      = false;
    protected $fillable     = ['id_030','company_030','name_030','surname_030','birthdate_030','country_030','prefix_030','mobile_030','email_030'];
    private static $rules   = [

        'groups'        => 'required',
        'company'       => 'between:2,100',
        'name'          => 'required|between:2,50',
        'surname'       => 'between:0,50',
        'birthdate'     => 'date_format:d-m-Y',
        'country'       => 'not_in:null',
        'email'         => 'between:2,50|email|unique:005_030_contact,email_030',
        'prefix'        => 'between:0,5',
        'mobile'        => 'between:2,50|unique:005_030_contact,mobile_030'
    ];

    public static function validate($data, $specialRules = [])
    {
        if(isset($specialRules['emailRule']) && $specialRules['emailRule'])     static::$rules['email'] = 'between:2,50|email';
        if(isset($specialRules['mobileRule']) && $specialRules['mobileRule'])   static::$rules['mobile'] = 'between:0,50';

        return Validator::make($data, static::$rules);
	}

    public function groups()
    {
        return Contact::belongsToMany('Syscover\Comunik\Models\Group','005_044_contacts_groups', 'contact_044', 'group_044');
    }

    public static function getCustomRecordsLimit()
    {
        $query =  Contact::join('001_002_country', '005_030_contact.country_030', '=', '001_002_country.id_002')
            ->where('lang_002', config('app.locale'))
            ->leftJoin('005_044_contacts_groups', '005_030_contact.id_030', '=', '005_044_contacts_groups.contact_044')
            ->leftJoin('005_029_group', '005_044_contacts_groups.group_044', '=', '005_029_group.id_029')
            ->newQuery();

        return $query;
    }

    public static function getCustomReturnRecordsLimit($query)
    {
        return $query->groupBy('id_030')
            ->get(array('*', DB::raw('GROUP_CONCAT(name_029 SEPARATOR \', \') AS name_029')));
    }
}