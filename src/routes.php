<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can any all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(['middleware' => ['auth.pulsar','permission.pulsar','locale.pulsar']], function() {

    /*
    |--------------------------------------------------------------------------
    | MOD. GROUPS
    |--------------------------------------------------------------------------
    */
    Route::any(config('pulsar.appName') . '/comunik/groups/{offset?}',                                  ['as'=>'ComunikGroup',                  'uses'=>'Syscover\Comunik\Controllers\GroupsController@index',                'resource' => 'comunik-group',        'action' => 'access']);
    Route::any(config('pulsar.appName') . '/comunik/groups/json/data',                                  ['as'=>'jsonDataComunikGroup',          'uses'=>'Syscover\Comunik\Controllers\GroupsController@jsonData',             'resource' => 'comunik-group',        'action' => 'access']);
    Route::get(config('pulsar.appName') . '/comunik/groups/create/{offset}',                            ['as'=>'createComunikGroup',            'uses'=>'Syscover\Comunik\Controllers\GroupsController@createRecord',         'resource' => 'comunik-group',        'action' => 'create']);
    Route::post(config('pulsar.appName') . '/comunik/groups/store/{offset}',                            ['as'=>'storeComunikGroup',             'uses'=>'Syscover\Comunik\Controllers\GroupsController@storeRecord',          'resource' => 'comunik-group',        'action' => 'create']);
    Route::get(config('pulsar.appName') . '/comunik/groups/{id}/edit/{offset}',                         ['as'=>'editComunikGroup',              'uses'=>'Syscover\Comunik\Controllers\GroupsController@editRecord',           'resource' => 'comunik-group',        'action' => 'access']);
    Route::put(config('pulsar.appName') . '/comunik/groups/update/{id}/{offset}',                       ['as'=>'updateComunikGroup',            'uses'=>'Syscover\Comunik\Controllers\GroupsController@updateRecord',         'resource' => 'comunik-group',        'action' => 'edit']);
    Route::get(config('pulsar.appName') . '/comunik/groups/delete/{id}/{offset}',                       ['as'=>'deleteComunikGroup',            'uses'=>'Syscover\Comunik\Controllers\GroupsController@deleteRecord',         'resource' => 'comunik-group',        'action' => 'delete']);
    Route::delete(config('pulsar.appName') . '/comunik/groups/delete/select/records',                   ['as'=>'deleteSelectComunikGroup',      'uses'=>'Syscover\Comunik\Controllers\GroupsController@deleteRecordsSelect',  'resource' => 'comunik-group',        'action' => 'delete']);


    /*
    |--------------------------------------------------------------------------
    | MOD. CONTACTS
    |--------------------------------------------------------------------------
    */
    Route::any(config('pulsar.appName') . '/comunik/contacts/{offset?}',                                ['as'=>'ComunikContact',                  'uses'=>'Syscover\Comunik\Controllers\ContactsController@index',                'resource' => 'comunik-contact',        'action' => 'access']);
    Route::any(config('pulsar.appName') . '/comunik/contacts/json/data',                                ['as'=>'jsonDataComunikContact',          'uses'=>'Syscover\Comunik\Controllers\ContactsController@jsonData',             'resource' => 'comunik-contact',        'action' => 'access']);
    Route::get(config('pulsar.appName') . '/comunik/contacts/create/{offset}',                          ['as'=>'createComunikContact',            'uses'=>'Syscover\Comunik\Controllers\ContactsController@createRecord',         'resource' => 'comunik-contact',        'action' => 'create']);
    Route::post(config('pulsar.appName') . '/comunik/contacts/store/{offset}',                          ['as'=>'storeComunikContact',             'uses'=>'Syscover\Comunik\Controllers\ContactsController@storeRecord',          'resource' => 'comunik-contact',        'action' => 'create']);
    Route::get(config('pulsar.appName') . '/comunik/contacts/{id}/edit/{offset}',                       ['as'=>'editComunikContact',              'uses'=>'Syscover\Comunik\Controllers\ContactsController@editRecord',           'resource' => 'comunik-contact',        'action' => 'access']);
    Route::put(config('pulsar.appName') . '/comunik/contacts/update/{id}/{offset}',                     ['as'=>'updateComunikContact',            'uses'=>'Syscover\Comunik\Controllers\ContactsController@updateRecord',         'resource' => 'comunik-contact',        'action' => 'edit']);
    Route::get(config('pulsar.appName') . '/comunik/contacts/delete/{id}/{offset}',                     ['as'=>'deleteComunikContact',            'uses'=>'Syscover\Comunik\Controllers\ContactsController@deleteRecord',         'resource' => 'comunik-contact',        'action' => 'delete']);
    Route::delete(config('pulsar.appName') . '/comunik/contacts/delete/select/records',                 ['as'=>'deleteSelectComunikContact',      'uses'=>'Syscover\Comunik\Controllers\ContactsController@deleteRecordsSelect',  'resource' => 'comunik-contact',        'action' => 'delete']);


    /*
    |--------------------------------------------------------------------------
    | MOD. EMAIL SERVICES TEMPLATES
    |--------------------------------------------------------------------------
    */
    Route::any(config('pulsar.appName') . '/comunik/email/services/templates/{offset?}',                  ['as'=>'ComunikEmailTemplate',              'uses'=>'Syscover\Comunik\Controllers\EmailTemplatesController@index',                  'resource' => 'comunik-email-template',        'action' => 'access']);
    Route::any(config('pulsar.appName') . '/comunik/email/services/templates/json/data',                  ['as'=>'jsonDataComunikEmailTemplate',      'uses'=>'Syscover\Comunik\Controllers\EmailTemplatesController@jsonData',               'resource' => 'comunik-email-template',        'action' => 'access']);
    Route::get(config('pulsar.appName') . '/comunik/email/services/templates/create/{offset}',            ['as'=>'createComunikEmailTemplate',        'uses'=>'Syscover\Comunik\Controllers\EmailTemplatesController@createRecord',           'resource' => 'comunik-email-template',        'action' => 'create']);
    Route::post(config('pulsar.appName') . '/comunik/email/services/templates/store/{offset}',            ['as'=>'storeComunikEmailTemplate',         'uses'=>'Syscover\Comunik\Controllers\EmailTemplatesController@storeRecord',            'resource' => 'comunik-email-template',        'action' => 'create']);
    Route::get(config('pulsar.appName') . '/comunik/email/services/templates/{id}/edit/{offset}',         ['as'=>'editComunikEmailTemplate',          'uses'=>'Syscover\Comunik\Controllers\EmailTemplatesController@editRecord',             'resource' => 'comunik-email-template',        'action' => 'access']);
    Route::put(config('pulsar.appName') . '/comunik/email/services/templates/update/{id}/{offset}',       ['as'=>'updateComunikEmailTemplate',        'uses'=>'Syscover\Comunik\Controllers\EmailTemplatesController@updateRecord',           'resource' => 'comunik-email-template',        'action' => 'edit']);
    Route::get(config('pulsar.appName') . '/comunik/email/services/templates/delete/{id}',                ['as'=>'deleteComunikEmailTemplate',        'uses'=>'Syscover\Comunik\Controllers\EmailTemplatesController@deleteRecord',           'resource' => 'comunik-email-template',        'action' => 'delete']);
    Route::delete(config('pulsar.appName') . '/comunik/email/services/templates/delete/select/elements',  ['as'=>'deleteSelectComunikEmailTemplate',  'uses'=>'Syscover\Comunik\Controllers\EmailTemplatesController@deleteRecordsSelect',    'resource' => 'comunik-email-template',        'action' => 'delete']);

    Route::get(config('pulsar.appName').'/comunik/email/services/templates/preview/{id}',               ['as'=>'previewComunikEmailTemplate',       'uses'=>'Syscover\Comunik\Controllers\EmailTemplatesController@preview',                'resource' => 'comunik-email-template',        'action' => 'access']);
    Route::post(config('pulsar.appName').'/comunik/email/services/templates/json/get_plantilla/{id}',   ['as'=>'jsonGetComunikEmailTemplate',       'uses'=>'Syscover\Comunik\Controllers\TemplatesController@jsonGetTemplate',             'resource' => 'comunik-email-template',        'action' => 'access']);
    Route::get(config('pulsar.appName').'/comunik/email/services/templates/show/{template}/{contact}',  ['as'=>'showComunikEmailTemplate',          'uses'=>'Syscover\Comunik\Controllers\TemplatesController@showRecord',                  'resource' => 'comunik-email-template',        'action' => 'access']);


    /*
    |--------------------------------------------------------------------------
    | MOD. EMAIL SERVICES CAMPAIGNS
    |--------------------------------------------------------------------------
    */
    Route::any(config('pulsar.appName') . '/comunik/email/services/campaigns/{offset?}',                    ['as'=>'ComunikEmailCampaign',                  'uses'=>'Syscover\Comunik\Controllers\EmailCampaignsController@index',                  'resource' => 'comunik-email-campaign',     'action' => 'access']);
    Route::any(config('pulsar.appName') . '/comunik/email/services/campaigns/json/data',                    ['as'=>'jsonDataComunikEmailCampaign',          'uses'=>'Syscover\Comunik\Controllers\EmailCampaignsController@jsonData',               'resource' => 'comunik-email-campaign',     'action' => 'access']);
    Route::get(config('pulsar.appName') . '/comunik/email/services/campaigns/create/{offset}/{id?}',        ['as'=>'createComunikEmailCampaign',            'uses'=>'Syscover\Comunik\Controllers\EmailCampaignsController@createRecord',           'resource' => 'comunik-email-campaign',     'action' => 'create']);
    Route::post(config('pulsar.appName') . '/comunik/email/services/campaigns/store/{offset}',              ['as'=>'storeComunikEmailCampaign',             'uses'=>'Syscover\Comunik\Controllers\EmailCampaignsController@storeRecord',            'resource' => 'comunik-email-campaign',     'action' => 'create']);
    Route::get(config('pulsar.appName') . '/comunik/email/services/campaigns/{id}/edit/{offset}',           ['as'=>'editComunikEmailCampaign',              'uses'=>'Syscover\Comunik\Controllers\EmailCampaignsController@editRecord',             'resource' => 'comunik-email-campaign',     'action' => 'access']);
    Route::put(config('pulsar.appName') . '/comunik/email/services/campaigns/update/{id}/{offset}',         ['as'=>'updateComunikEmailCampaign',            'uses'=>'Syscover\Comunik\Controllers\EmailCampaignsController@updateRecord',           'resource' => 'comunik-email-campaign',     'action' => 'edit']);
    Route::get(config('pulsar.appName') . '/comunik/email/services/campaigns/delete/{id}',                  ['as'=>'deleteComunikEmailCampaign',            'uses'=>'Syscover\Comunik\Controllers\EmailCampaignsController@deleteRecord',           'resource' => 'comunik-email-campaign',     'action' => 'delete']);
    Route::delete(config('pulsar.appName') . '/comunik/email/services/campaigns/delete/select/elements',    ['as'=>'deleteSelectComunikEmailCampaign',      'uses'=>'Syscover\Comunik\Controllers\EmailCampaignsController@deleteRecordsSelect',    'resource' => 'comunik-email-campaign',     'action' => 'delete']);


    Route::get(config('pulsar.appName').'/comunik/email/services/campaigns/send/test/{campana}/{offset?}',      ['as'=>'sendTestComunikEmailCampaign',          'uses'=>'Syscover\Comunik\Controllers\EmailCampaignsController@sendTest']);
    Route::get(config('pulsar.appName').'/comunik/email/services/campaigns/preview/{id}',                       ['as'=>'previewComunikEmailCampaign',           'uses'=>'Syscover\Comunik\Controllers\EmailCampaignsController@preview']);



    /*
    |--------------------------------------------------------------------------
    | MOD. EMAIL SERVICES PREFERENCES
    |--------------------------------------------------------------------------
    */
    Route::any(config('pulsar.appName') . '/comunik/email/services/preferences',                        ['as'=>'EmailServicesPreference',          'uses'=>'Syscover\Comunik\Controllers\PreferenceController@index',               'resource' => 'comunik-email-preference',        'action' => 'access']);
    Route::put(config('pulsar.appName') . '/comunik/email/services/preferences/update',                 ['as'=>'updateEmailServicesPreference',    'uses'=>'Syscover\Comunik\Controllers\PreferenceController@updateRecord',        'resource' => 'comunik-email-preference',        'action' => 'edit']);












    Route::any(config('pulsar.appName') . '/comunik/email/services/preferences/json/{json}',            ['as'=>'EmailServicesPreferenceJson',      'uses'=>'Syscover\Comunik\Controllers\PreferenceController@index',       'resource' => 'comunik-email-preference',        'action' => 'access']);



    Route::get(config('pulsar.appName') . '/comunik/contacts/import/excel/preview/{file}',                                              ['as'=>'importExcelPreviewComunikContact',     'uses'=>'Syscover\Comunik\Controllers\Contacts@ImportExcelPreview']);
    Route::post(config('pulsar.appName') . '/comunik/contacts/import/excel/{file}',                                                     ['as'=>'importExcelComunikContact',            'uses'=>'Syscover\Comunik\Controllers\Contacts@ImportExcel']);
     

    
    
    /*
    |--------------------------------------------------------------------------
    | EMAIL SERVICES ENVÍOS
    |--------------------------------------------------------------------------
    */
    Route::any(config('pulsar.appName').'/comunik/email/services/envios/{campana}/{offset?}',        array('as'=>'emailServicesEnvios', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesEnvios@index'));
    Route::any(config('pulsar.appName').'/comunik/email/services/envios/json/data/{campana}',      array('as'=>'jsonDataEmailServicesEnvios', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesEnvios@jsonData'));
    Route::get(config('pulsar.appName').'/comunik/email/services/envios/forward/{envio}/{offset?}',  array('as'=>'forwardEmailServicesEnvios', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesEnvios@forward'));


    /*
    |--------------------------------------------------------------------------
    | EMAIL SERVICES MENSAJES
    |--------------------------------------------------------------------------
    */
    Route::get(config('pulsar.appName').'/comunik/email/services/accounts/{account}/{pageAccounts}/messages/{page?}',                      array('as'=>'emailServicesMessages', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesMessages@index'));
    Route::any(config('pulsar.appName').'/comunik/email/services/accounts/{account}/{pageAccounts}/messages/json/data',                    array('as'=>'jsonDataEmailServicesMessages', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesMessages@jsonData'));
    Route::post(config('pulsar.appName').'/comunik/email/services/accounts/{account}/{pageAccounts}/messages/{page?}',                     array('as'=>'emailServicesMessages', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesMessages@processMessage'));
    Route::get(config('pulsar.appName').'/comunik/email/services/accounts/{account}/{pageAccounts}/messages/{message}/{page?}',            array('as'=>'emailServicesShowMessage', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesMessages@showMessage'));
    Route::get(config('pulsar.appName').'/comunik/email/services/accounts/{account}/{pageAccounts}/messages/delete/message/{message}',    array('as'=>'deleteEmailServicesMessages', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesMessages@delete'));
    Route::post(config('pulsar.appName').'/comunik/email/services/accounts/{account}/{pageAccounts}/messages/delete/select/elements',     array('as'=>'deleteEmailServicesMessages', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesMessages@deleteSelect'));


    /*
    |--------------------------------------------------------------------------
    | EMAIL SERVICES PATRONES
    |--------------------------------------------------------------------------
    */
    Route::any(config('pulsar.appName').'/comunik/email/services/patterns/{page?}',                    array('as'=>'emailServicesPatterns', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesPatterns@index'));
    Route::any(config('pulsar.appName').'/comunik/email/services/patterns/json/data',                  array('as'=>'jsonDataEmailServicesPatterns', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesPatterns@jsonData'));
    Route::get(config('pulsar.appName').'/comunik/email/services/patterns/create/{page}',              array('as'=>'createEmailServicesPatterns', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesPatterns@create'));
    Route::post(config('pulsar.appName').'/comunik/email/services/patterns/store/{page}',              array('as'=>'storeEmailServicesPatterns', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesPatterns@store'));
    Route::get(config('pulsar.appName').'/comunik/email/services/patterns/{id}/edit/{page}',           array('as'=>'editEmailServicesPatterns', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesPatterns@edit'));
    Route::post(config('pulsar.appName').'/comunik/email/services/patterns/update/{page}',             array('as'=>'updateEmailServicesPatterns', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesPatterns@update'));
    Route::get(config('pulsar.appName').'/comunik/email/services/patterns/delete/{id}',               array('as'=>'deleteEmailServicesPatterns', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesPatterns@delete'));
    Route::post(config('pulsar.appName').'/comunik/email/services/patterns/delete/select/elements',   array('as'=>'deleteEmailServicesPatterns', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesPatterns@deleteSelect'));
    
});

/*
|--------------------------------------------------------------------------
| EMAIL SERVICES CAMPAIGNS
|--------------------------------------------------------------------------
*/
Route::get(config('pulsar.appName') . '/comunik/email/services/campaigns/show/{campaign}/{contact}',    ['as'=>'showComunikEmailCampaign', 'uses'=>'Syscover\Comunik\Controllers\EmailCampaignsController@show']);

/*
|--------------------------------------------------------------------------
| MOD. CONTACTS
|--------------------------------------------------------------------------
*/
Route::get(config('pulsar.appName') . '/comunik/contacts/unsubscribe/email/{key}', ['as'=>'getUnsubscribeComunikContact', 'uses'=>'Syscover\Comunik\Controllers\ContactsController@getEmailToUnsubscribe']);
Route::post(config('pulsar.appName') . '/comunik/contacts/unsubscribe/email', ['before' => 'csrf', 'as'=>'unsubscribeComunikContact', 'uses'=>'Syscover\Comunik\Controllers\ContactsController@unsubscribeEmail']);






/*
|--------------------------------------------------------------------------
| SPAM MANAGER
|--------------------------------------------------------------------------
*/
Route::post(config('pulsar.appName').'/comunik/email/services/spam/score', array('as'=>'emailServicesSpamScore', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesSpam@check'));

/*
|--------------------------------------------------------------------------
| METODOS AJAX PARA TOMA DE DATOS
|--------------------------------------------------------------------------
*/
Route::post(config('pulsar.appName').'/comunik/contacts/json/get_contacto_movil/{movil}', array('as'=>'jsonGetContactoMovil', 'uses'=>'Syscover\Comunik\Controllers\Contacts@jsonGetContactoMovil'));
Route::post(config('pulsar.appName').'/comunik/contacts/json/get_contacto_email/{email}', array('as'=>'jsonGetContactoEmail', 'uses'=>'Syscover\Comunik\Controllers\Contacts@jsonGetContactoEmail'));




/*
|--------------------------------------------------------------------------
| EMAIL ESTADÍSTICAS DE CAMPAÑAS
|--------------------------------------------------------------------------
*/
Route::get(config('pulsar.appName').'/comunik/email/services/campanas/analytics/{campana}/{envio}', array('as'=>'emailServicesCampanasAnalytics', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesCampanas@analytics'));