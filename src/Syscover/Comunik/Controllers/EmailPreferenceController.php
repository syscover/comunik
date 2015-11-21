<?php namespace Syscover\Comunik\Controllers;

/**
 * @package	    Forms
 * @author	    Jose Carlos Rodríguez Palacín
 * @copyright   Copyright (c) 2015, SYSCOVER, SL
 * @license
 * @link		http://www.syscover.com
 * @since		Version 2.0
 * @filesource
 */

use Illuminate\Support\Facades\Request;
use Syscover\Comunik\Models\Group;
use Syscover\Pulsar\Controllers\Controller;
use Syscover\Pulsar\Models\Preference;
use Syscover\Pulsar\Traits\TraitController;

class EmailPreferenceController extends Controller {

    use TraitController;

    protected $routeSuffix  = 'emailPreference';
    protected $folder       = 'preference';
    protected $package      = 'comunik';
    protected $aColumns     = [];
    protected $nameM        = null;
    protected $model        = '\Syscover\Pulsar\Models\Preference';
    protected $icon         = 'fa fa-cog';
    protected $objectTrans  = 'preference';

    public function indexCustom($parameters)
    {
        $parameters['intervalsShipping']    = [];
        for($i=0; $i<121; $i++)
            $parameters['intervalsShipping'][] = (object)['id' => $i, 'name' => str_pad($i, 2, '0', STR_PAD_LEFT)];
        $parameters['intervalShipping']     = Preference::getValue('emailServiceIntervalShipping', 3);

        $parameters['groups']               = Group::all();
        $parameters['testGroup']            = Preference::getValue('emailServiceTestGroup', 3);

        $parameters['intervalsProcess']     = [
            (object)['id' => 100, 'name' => 100],
            (object)['id' => 500, 'name' => 500],
            (object)['id' => 1000, 'name' => 1000],
            (object)['id' => 5000, 'name' => 5000],
            (object)['id' => 10000, 'name' => 10000],
            (object)['id' => 20000, 'name' => 20000],
            (object)['id' => 30000, 'name' => 30000],
            (object)['id' => 40000, 'name' => 40000],
            (object)['id' => 50000, 'name' => 50000]];

        $parameters['intervalProcess']      = Preference::getValue('emailServiceIntervalProcess', 3);

        return $parameters;
    }
    
    public function updateCustomRecord()
    {
        Preference::setValue('emailServiceIntervalShipping', 3, Request::input('intervalShipping'));
        Preference::setValue('emailServiceTestGroup', 3, Request::input('testGroup'));
        Preference::setValue('emailServiceIntervalProcess', 3, Request::input('intervalProcess'));
    }
}