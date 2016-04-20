<?php namespace Syscover\Comunik\Controllers;

use Syscover\Pulsar\Core\Controller;
use Syscover\Comunik\Models\Group;

/**
 * Class GroupsController
 * @package Syscover\Comunik\Controllers
 */

class GroupsController extends Controller
{
    protected $routeSuffix  = 'comunikGroup';
    protected $folder       = 'group';
    protected $package      = 'comunik';
    protected $aColumns     = ['id_040', 'name_040'];
    protected $nameM        = 'name_040';
    protected $model        = Group::class;
    protected $icon         = 'fa fa-users';
    protected $objectTrans  = 'group';

    public function storeCustomRecord($parameters)
    {
        Group::create([
            'name_040'  => $this->request->input('name')
        ]);
    }
    
    public function updateCustomRecord($parameters)
    {
        Group::where('id_040', $parameters['id'])->update([
            'name_040'  => $this->request->input('name')
        ]);
    }
}