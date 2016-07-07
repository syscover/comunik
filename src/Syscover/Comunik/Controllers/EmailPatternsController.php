<?php namespace Syscover\Comunik\Controllers;

use Syscover\Pulsar\Core\Controller;
use Syscover\Comunik\Models\EmailPattern;

/**
 * Class EmailPatternsController
 * @package Syscover\Comunik\Controllers
 */

class EmailPatternsController extends Controller
{
    protected $routeSuffix  = 'comunikEmailPattern';
    protected $folder       = 'email_pattern';
    protected $package      = 'comunik';
    protected $indexColumns     = ['id_049', 'name_049', ['type' => 'translated', 'data' => 'action_049']];
    protected $nameM        = 'name_049';
    protected $model        = EmailPattern::class;
    protected $icon         = 'fa fa-braille';
    protected $objectTrans  = 'pattern';

    public function customColumnType($row, $indexColumn, $aObject)
    {
        switch ($indexColumn['type'])
        {
            case 'translated':
                $row[] = trans(collect(config('comunik.patternActions'))->where('id', $aObject[$indexColumn['data']])->first()->name);
                break;
        }

        return $row;
    }

    public function createCustomRecord($parameters)
    {
        $parameters['operators'] = array_map(function($object) {
            $object->name = trans($object->name);
            return $object;
        }, config('comunik.patternsOperators'));

        $parameters['actions'] = array_map(function($object) {
            $object->name = trans($object->name);
            return $object;
        }, config('comunik.patternActions'));

        return $parameters;
    }

    public function storeCustomRecord($parameters)
    {
        EmailPattern::create([
            'name_049'          => $this->request->input('name'),
            'subject_049'       => $this->request->input('subject', null),
            'operator_049'      => $this->request->input('operator', null),
            'message_049'       => $this->request->input('message', null),
            'action_049'        => $this->request->input('actionPattern')
        ]);
    }

    public function editCustomRecord($parameters)
    {
        $parameters['operators'] = array_map(function($object) {
            $object->name = trans($object->name);
            return $object;
        },config('comunik.patternsOperators'));

        $parameters['actions'] = array_map(function($object) {
            $object->name = trans($object->name);
            return $object;
        },config('comunik.patternActions'));

        return $parameters;
    }
    
    public function updateCustomRecord($parameters)
    {
        EmailPattern::where('id_049', $parameters['id'])->update([
            'name_049'          => $this->request->input('name'),
            'subject_049'       => $this->request->input('subject', null),
            'operator_049'      => $this->request->input('operator', null),
            'message_049'       => $this->request->input('message', null),
            'action_049'        => $this->request->input('actionPattern')
        ]);
    }
}