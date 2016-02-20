<?php namespace Syscover\Comunik\Controllers;

use Syscover\Comunik\Libraries\Miscellaneous as MiscellaneousComunik;
use Syscover\Comunik\Models\EmailTemplate;
use Syscover\Pulsar\Controllers\Controller;
use Syscover\Pulsar\Traits\TraitController;

/**
 * Class EmailTemplatesController
 * @package Syscover\Comunik\Controllers
 */

class EmailTemplatesController extends Controller {

    use TraitController;

    protected $routeSuffix  = 'comunikEmailTemplate';
    protected $folder       = 'email_templates';
    protected $package      = 'comunik';
    protected $aColumns     = ['id_043', 'name_043'];
    protected $nameM        = 'name_043';
    protected $model        = EmailTemplate::class;
    protected $icon         = 'fa fa-pencil-square-o';
    protected $objectTrans  = 'template';

    public function createCustomRecord($request, $parameters)
    {
        $parameters['themes']       = MiscellaneousComunik::getThemes();

        return $parameters;
    }

    public function storeCustomRecord($request, $parameters)
    {
        $htmlLinks = MiscellaneousComunik::setMailingLinks($request, $parameters);

        EmailTemplate::create([
            'name_043'      => $request->input('name'),
            'subject_043'   => $request->input('subject'),
            'theme_043'     => $request->input('theme'),
            'header_043'    => $htmlLinks['header'],
            'body_043'      => $htmlLinks['body'],
            'footer_043'    => $htmlLinks['footer'],
            'text_043'      => $htmlLinks['text'],
            'data_043'      => $request->input('data')
        ]);
    }

    public function editCustomRecord($request, $parameters)
    {
        $parameters['themes']       = MiscellaneousComunik::getThemes();

        return $parameters;
    }
    
    public function updateCustomRecord($request, $parameters)
    {
        $htmlLinks = MiscellaneousComunik::setMailingLinks($request, $parameters);

        EmailTemplate::where('id_043', $parameters['id'])->update([
            'name_043'      => $request->input('name'),
            'subject_043'   => $request->input('subject'),
            'theme_043'     => $request->input('theme'),
            'header_043'    => $htmlLinks['header'],
            'body_043'      => $htmlLinks['body'],
            'footer_043'    => $htmlLinks['footer'],
            'text_043'      => $htmlLinks['text'],
            'data_043'      => $request->input('data')
        ]);
    }
}