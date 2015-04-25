<?php namespace Syscover\Comunik\Controllers;

use Illuminate\Support\Facades\Request;
use Syscover\Pulsar\Controllers\Controller;
use Syscover\Pulsar\Traits\ControllerTrait;
use Syscover\Comunik\Models\Group;

class Groups extends Controller {

    use ControllerTrait;

    protected $routeSuffix  = 'ComunikGroup';
    protected $folder       = 'groups';
    protected $package      = 'comunik';
    protected $aColumns     = ['id_029', 'name_029'];
    protected $nameM        = 'name_029';
    protected $model        = '\Syscover\Comunik\Models\Group';
    protected $icon         = 'icomoon-icon-users-2';
    protected $objectTrans  = 'group';

    public function storeCustomRecord()
    {
        Group::create([
            'id_029'    => Request::input('id'),
            'name_029'  => Request::input('name')
        ]);
    }
    
    public function updateCustomRecord($parameters)
    {
        Group::where('id_029', $parameters['id'])->update([
            'id_029'    => Request::input('id'),
            'name_029'  => Request::input('name')
        ]);
    }
}