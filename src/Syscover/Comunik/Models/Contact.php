<?php namespace Syscover\Comunik\Models;

use Syscover\Pulsar\Core\Model;
use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;
use Illuminate\Support\Facades\Validator;
use Syscover\Pulsar\Models\Country;
use Illuminate\Support\Facades\DB;

/**
 * Class Contact
 *
 * Model with properties
 * <br><b>[id, company, name, surname, birth_date, birth_date_text, country_id, prefix, mobile, email, unsubscribe_mobile, unsubscribe_email]</b>
 *
 * @package     Syscover\Comunik\Models
 */

class Contact extends Model
{
    use Eloquence, Mappable;

	protected $table        = '005_041_contact';
    protected $primaryKey   = 'id_041';
    public $timestamps      = false;
    protected $fillable     = ['id_041','company_041','name_041','surname_041','birth_date_041','birth_date_text_041','country_id_041','prefix_041','mobile_041','email_041','unsubscribe_mobile_041','unsubscribe_email_041'];
    protected $maps         = [];
    protected $relationMaps = [
        'country'      => \Syscover\Pulsar\Models\Country::class,
    ];
    private static $rules   = [
        'groups'        => 'required',
        'company'       => 'between:2,255',
        'name'          => 'required|between:2,255',
        'surname'       => 'between:0,255',
        'country'       => 'required',
        'email'         => 'required|between:2,255|email|unique:005_041_contact,email_041',
        'prefix'        => 'numeric|digits_between:0,5',
        'mobile'        => 'numeric|digits_between:2,255|unique:005_041_contact,mobile_041'
    ];

    public static function validate($data, $specialRules = [])
    {
        // instance birthDate to set value pattern from config
        static::$rules['birthDate'] = 'date_format:' . config('pulsar.datePattern');
        if(isset($specialRules['emailRule']) && $specialRules['emailRule'])     static::$rules['email']     = 'required|between:2,255|email';
        if(isset($specialRules['mobileRule']) && $specialRules['mobileRule'])   static::$rules['mobile']    = 'between:0,255';

        return Validator::make($data, static::$rules);
	}

    public function scopeBuilder($query)
    {
        return $query->join('001_002_country', '005_041_contact.country_id_041', '=', '001_002_country.id_002')
            ->where('lang_id_002', config('app.locale'));
    }

    public function getGroups()
    {
        return Contact::belongsToMany('Syscover\Comunik\Models\Group','005_042_contacts_groups', 'contact_id_042', 'group_id_042');
    }

    public static function getCustomReturnIndexRecords($query, $parameters)
    {
        // old query, let comment to show alternative to select columns in get() sentence
        // return $query
        //    ->leftJoin('005_042_contacts_groups', '005_041_contact.id_041', '=', '005_042_contacts_groups.contact_id_042')
        //    ->leftJoin('005_040_group', '005_042_contacts_groups.group_id_042', '=', '005_040_group.id_040')
        //    ->groupBy('id_041')
        //    ->get(['*', DB::raw('GROUP_CONCAT(name_040 SEPARATOR \', \') AS name_040')]);

        // In laravel 5.3 in MySql drive has parameter strict = true,
        // this parameter check mode ONLY_FULL_GROUP_BY,
        // than force to define in group by all column than you want view
        return $query
            ->select(DB::raw('id_041, name_041, surname_041, name_002, mobile_041, email_041, unsubscribe_email_041, GROUP_CONCAT(name_040 SEPARATOR \', \') AS name_040'))
            ->leftJoin('005_042_contacts_groups', '005_041_contact.id_041', '=', '005_042_contacts_groups.contact_id_042')
            ->leftJoin('005_040_group', '005_042_contacts_groups.group_id_042', '=', '005_040_group.id_040')
            ->groupBy('id_041', 'name_041', 'surname_041', 'name_002', 'mobile_041', 'email_041', 'unsubscribe_email_041')
            ->get();
    }

    public static function customCountIndexRecords($query, $parameters)
    {
        return $query->select(DB::raw('id_041, GROUP_CONCAT(name_040 SEPARATOR \', \') AS name_040'))
            ->leftJoin('005_042_contacts_groups', '005_041_contact.id_041', '=', '005_042_contacts_groups.contact_id_042')
            ->leftJoin('005_040_group', '005_042_contacts_groups.group_id_042', '=', '005_040_group.id_040')
            ->groupBy('id_041')
            ->get()     // without get, don't count correctly, count group number
            ->count();
    }

    // Attention! function called from \Syscover\Comunik\Libraries\Cron::sendEmailTest
    public static function getRecords($parameters)
    {
        $query = Contact::builder();

        if(isset($parameters['group_id_042']))
        {
            $query->whereIn('id_041', function($query) use ($parameters) {
                // select contacts from this groups
                $query->select('contact_id_042')
                    ->from('005_042_contacts_groups')
                    ->whereIn('group_id_042', [$parameters['group_id_042']])
                    ->groupBy('contact_id_042')
                    ->get();
            });
        }

        if(isset($args['groupBy']))
            $query->groupBy($args['groupBy']);

        return $query->get();
    }

    public static function getCountriesContacts($args)
    {
        return Country::join('001_001_lang', '001_002_country.lang_id_002', '=', '001_001_lang.id_001')
            ->where('lang_id_002', $args['lang'])
            ->whereIn('id_002', function($query) {
                $query->select('country_id_041')
                    ->from('005_041_contact')
                    ->groupBy('country_id_041')
                    ->get();
            })
            ->orderBy('name_002')->get();
    }

    // Attention! function called from \Syscover\Comunik\Libraries\Cron
    public static function getContactsEmailToInsert($campaign, $groups, $countries, $take, $skip)
    {
        return Contact::whereIn('id_041', function($query) use ($groups) {
                // select contacts from this groups
                $query->select('contact_id_042')
                    ->from('005_042_contacts_groups')
                    ->whereIn('group_id_042', $groups)
                    ->groupBy('contact_id_042')
                    ->get();
            })
            // and they are from this countries
            ->whereIn('country_id_041', $countries)
            // the contact isn't in queue queue in the same campaign
            ->whereNotIn('id_041', function($query) use ($campaign) {
                $query->select('contact_id_047')
                    ->from('005_047_email_send_queue')
                    ->where('campaign_id_047', $campaign)->get();
            })
            // the contact isn't in historical queue in the same campaign
            ->whereNotIn('id_041', function($query) use ($campaign) {
                $query->select('contact_id_048')
                    ->from('005_048_email_send_history')
                    ->where('campaign_id_048', $campaign)->get();
            })
            ->where('unsubscribe_email_041', false)
            ->whereNotNull('email_041')
            ->where('email_041', '<>', '')
            ->take($take)->skip($skip)
            ->get();
    }
}