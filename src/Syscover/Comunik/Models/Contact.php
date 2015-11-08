<?php namespace Syscover\Comunik\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Syscover\Pulsar\Models\Country;
use Syscover\Pulsar\Traits\TraitModel;
use Illuminate\Support\Facades\DB;

class Contact extends Model {

    use TraitModel;

	protected $table        = '005_041_contact';
    protected $primaryKey   = 'id_041';
    public $timestamps      = false;
    protected $fillable     = ['id_041','company_041','name_041','surname_041','birth_date_041','country_041','prefix_041','mobile_041','email_041','unsubscribe_mobile_041','unsubscribe_email_041'];
    private static $rules   = [
        'groups'        => 'required',
        'company'       => 'between:2,100',
        'name'          => 'required|between:2,50',
        'surname'       => 'between:0,50',
        'country'       => 'required',
        'email'         => 'between:2,50|email|unique:005_041_contact,email_041',
        'prefix'        => 'between:0,5',
        'mobile'        => 'between:2,50|unique:005_041_contact,mobile_041'
    ];

    public static function validate($data, $specialRules = [])
    {
        // instance birthDate to set value pattern from config
        static::$rules['birthDate'] = 'date_format:' . config('pulsar.datePattern');
        if(isset($specialRules['emailRule']) && $specialRules['emailRule'])     static::$rules['email']     = 'between:2,50|email';
        if(isset($specialRules['mobileRule']) && $specialRules['mobileRule'])   static::$rules['mobile']    = 'between:0,50';

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
        return $query->groupBy('id_041')
            ->get(array('*', DB::raw('GROUP_CONCAT(name_040 SEPARATOR \', \') AS name_040')));
    }

    public static function getCountriesContacts($args)
    {
        return Country::join('001_001_lang', '001_002_country.lang_002', '=', '001_001_lang.id_001')
            ->where('lang_002', $args['lang'])
            ->whereIn('id_002', function($query) {
                $query->select('country_041')
                    ->from('005_041_contact')
                    ->groupBy('country_041')
                    ->get();
            })
            ->orderBy('name_002')->get();
    }

    // Attention! function called from \Syscover\Comunik\Libraries\Cron
    public static function getContactsEmailToInsert($campaign, $groups, $countries, $take, $skip)
    {
        return Contact::whereIn('id_041', function($query) use ($groups) {
            // select contacts from this groups
            $query->select('contact_042')
                ->from('005_042_contacts_groups')
                ->whereIn('group_042', $groups)
                ->groupBy('contact_042')
                ->get();
        })
            // and they are from this countries
            ->whereIn('country_041', $countries)
            // the contact isn't in mail queue in the same campaign
            ->whereNotIn('id_041', function($query) use ($campaign) {
                $query->select('contact_047')
                ->from('005_047_email_send_queue')
                ->where('campaign_047', $campaign)->get();
        })
            ->where('unsubscribe_email_041', false)
            ->whereNotNull('email_041')
            ->where('email_041', '<>', '')
            ->take($take)->skip($skip)
            ->get();
    }
}