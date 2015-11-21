<?php namespace Syscover\Comunik\Controllers;

use Illuminate\Support\Facades\Request;
use Syscover\Pulsar\Controllers\Controller;
use Syscover\Pulsar\Traits\TraitController;
use Syscover\Comunik\Models\Group;

class GroupsController extends Controller {

    use TraitController;

    protected $routeSuffix  = 'comunikGroup';
    protected $folder       = 'groups';
    protected $package      = 'comunik';
    protected $aColumns     = ['id_040', 'name_040'];
    protected $nameM        = 'name_040';
    protected $model        = '\Syscover\Comunik\Models\Group';
    protected $icon         = 'fa fa-users';
    protected $objectTrans  = 'group';

    public function storeCustomRecord($request, $parameters)
    {
        Group::create([
            'name_040'  => Request::input('name')
        ]);
    }
    
    public function updateCustomRecord($request, $parameters)
    {
        Group::where('id_040', $parameters['id'])->update([
            'name_040'  => Request::input('name')
        ]);
    }
}