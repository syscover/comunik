<?php namespace Syscover\Comunik\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Syscover\Pulsar\Traits\TraitModel;
use Illuminate\Support\Facades\DB;

class Contact extends Model {

    use TraitModel;

	protected $table        = '005_041_contact';
    protected $primaryKey   = 'id_041';
    public $timestamps      = false;
    protected $fillable     = ['id_041','company_041','name_041','surname_041','birthdate_041','country_041','prefix_041','mobile_041','email_041'];
    private static $rules   = [

        'groups'        => 'required',
        'company'       => 'between:2,100',
        'name'          => 'required|between:2,50',
        'surname'       => 'between:0,50',
        'birthdate'     => 'date_format:d-m-Y',
        'country'       => 'not_in:null',
        'email'         => 'between:2,50|email|unique:005_041_contact,email_041',
        'prefix'        => 'between:0,5',
        'mobile'        => 'between:2,50|unique:005_041_contact,mobile_041'
    ];

    public static function validate($data, $specialRules = [])
    {
        if(isset($specialRules['emailRule']) && $specialRules['emailRule'])     static::$rules['email'] = 'between:2,50|email';
        if(isset($specialRules['mobileRule']) && $specialRules['mobileRule'])   static::$rules['mobile'] = 'between:0,50';

        return Validator::make($data, static::$rules);
	}

    public function groups()
    {
        return Contact::belongsToMany('Syscover\Comunik\Models\Group','005_042_contacts_groups', 'contact_042', 'group_042');
    }

    public static function getCustomRecordsLimit()
    {
        $query =  Contact::join('001_002_country', '005_041_contact.country_041', '=', '001_002_country.id_002')
            ->where('lang_002', config('app.locale'))
            ->leftJoin('005_042_contacts_groups', '005_041_contact.id_041', '=', '005_042_contacts_groups.contact_042')
            ->leftJoin('005_040_group', '005_042_contacts_groups.group_042', '=', '005_040_group.id_040')
            ->newQuery();

        return $query;
    }

    public static function getCustomReturnRecordsLimit($query)
    {
        return $query->groupBy('id_040')
            ->get(array('*', DB::raw('GROUP_CONCAT(name_040 SEPARATOR \', \') AS name_040')));
    }
}