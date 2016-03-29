<?php namespace Syscover\Comunik\Controllers;

use Syscover\Comunik\Models\Group;
use Syscover\Pulsar\Controllers\Controller;
use Syscover\Pulsar\Models\Preference;
use Syscover\Pulsar\Traits\TraitController;

/**
 * Class EmailPreferenceController
 * @package Syscover\Comunik\Controllers
 */

class EmailPreferenceController extends Controller {

    use TraitController;

    protected $routeSuffix  = 'emailPreference';
    protected $folder       = 'preference';
    protected $package      = 'comunik';
    protected $aColumns     = [];
    protected $nameM        = null;
    protected $model        = Preference::class;
    protected $icon         = 'fa fa-cog';
    protected $objectTrans  = 'preference';

    public function customIndex($parameters)
    {
        $parameters['intervalsShipping']    = [];
        for($i=0; $i < 121; $i++)
            $parameters['intervalsShipping'][] = (object)['id' => $i, 'name' => str_pad($i, 2, '0', STR_PAD_LEFT)];
        $parameters['intervalShipping']     = Preference::getValue('emailServiceIntervalShipping', 5);

        $parameters['groups']               = Group::all();
        $parameters['testGroup']            = Preference::getValue('emailServiceTestGroup', 5);

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

        $parameters['intervalProcess']      = Preference::getValue('emailServiceIntervalProcess', 5);

        return $parameters;
    }
    
    public function updateCustomRecord($parameters)
    {
        Preference::setValue('emailServiceIntervalShipping', 5, $this->request->input('intervalShipping'));
        Preference::setValue('emailServiceTestGroup', 5, $this->request->input('testGroup'));
        Preference::setValue('emailServiceIntervalProcess', 5, $this->request->input('intervalProcess'));
    }
}