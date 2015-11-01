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
    Route::put(config('pulsar.appName') . '/comunik/email/services/templates/update/{offset}',            ['as'=>'updateComunikEmailTemplate',        'uses'=>'Syscover\Comunik\Controllers\EmailTemplatesController@updateRecord',           'resource' => 'comunik-email-template',        'action' => 'edit']);
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
    Route::any(config('pulsar.appName').'/comunik/email/services/campaigns/{offset?}',                          ['as'=>'ComunikEmailCampaign',                  'uses'=>'Syscover\Comunik\Controllers\EmailCampaignsController@index',          'resource' => 'comunik-email-campaign',     'action' => 'access']);
    Route::any(config('pulsar.appName').'/comunik/email/services/campaigns/json/data',                          ['as'=>'jsonDataComunikEmailCampaign',          'uses'=>'Syscover\Comunik\Controllers\EmailCampaignsController@jsonData',       'resource' => 'comunik-email-campaign',     'action' => 'access']);
    Route::get(config('pulsar.appName').'/comunik/email/services/campaigns/create/{offset}/{id?}',              ['as'=>'createComunikEmailCampaign',            'uses'=>'Syscover\Comunik\Controllers\EmailCampaignsController@createRecord',   'resource' => 'comunik-email-campaign',     'action' => 'create']);


    Route::get(config('pulsar.appName').'/comunik/email/services/campaigns/send/test/{campana}/{offset?}',      ['as'=>'sendTestComunikEmailCampaign',          'uses'=>'Syscover\Comunik\Controllers\EmailCampaignsController@sendTest']);


    Route::get(config('pulsar.appName').'/comunik/email/services/campaigns/preview/{id}',                       ['as'=>'previewComunikEmailCampaign',           'uses'=>'Syscover\Comunik\Controllers\EmailCampaignsController@preview']);
    Route::post(config('pulsar.appName').'/comunik/email/services/campaigns/store/{offset}',                    ['as'=>'storeComunikEmailCampaign',             'uses'=>'Syscover\Comunik\Controllers\EmailCampaignsController@store']);
    Route::get(config('pulsar.appName').'/comunik/email/services/campaigns/{id}/edit/{offset}',                 ['as'=>'editComunikEmailCampaign',              'uses'=>'Syscover\Comunik\Controllers\EmailCampaignsController@edit']);
    Route::put(config('pulsar.appName').'/comunik/email/services/campaigns/update/{offset}',                    ['as'=>'updateComunikEmailCampaign',            'uses'=>'Syscover\Comunik\Controllers\EmailCampaignsController@update']);
    Route::get(config('pulsar.appName').'/comunik/email/services/campaigns/delete/{id}',                        ['as'=>'deleteComunikEmailCampaign',            'uses'=>'Syscover\Comunik\Controllers\EmailCampaignsController@delete']);
    Route::delete(config('pulsar.appName').'/comunik/email/services/campaigns/delete/select/elements',          ['as'=>'deleteSelectComunikEmailCampaign',      'uses'=>'Syscover\Comunik\Controllers\EmailCampaignsController@deleteSelect']);



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



    /*
    |--------------------------------------------------------------------------
    | SMS SERVICES CAMPAÑA
    |--------------------------------------------------------------------------
    */
    Route::any(config('pulsar.appName').'/comunik/sms/services/campanas/{page?}',                          array('as'=>'smsServicesCampanas', 'uses'=>'Syscover\Comunik\Controllers\SmsServicesCampanas@index'));
    Route::get(config('pulsar.appName').'/comunik/sms/services/campanas/send/test/{campaign}/{page?}',     array('as'=>'sendTestSmsServicesCampanas', 'uses'=>'Syscover\Comunik\Controllers\SmsServicesCampanas@sendTest'));
    Route::any(config('pulsar.appName').'/comunik/sms/services/campanas/json/data',                        array('as'=>'jsonDataSmsServicesCampanas', 'uses'=>'Syscover\Comunik\Controllers\SmsServicesCampanas@jsonData'));
    Route::get(config('pulsar.appName').'/comunik/sms/services/campanas/create/{page}/{id?}',              array('as'=>'createSmsServicesCampanas', 'uses'=>'Syscover\Comunik\Controllers\SmsServicesCampanas@create'));
    Route::post(config('pulsar.appName').'/comunik/sms/services/campanas/store/{page}',                    array('as'=>'storeSmsServicesCampanas', 'uses'=>'Syscover\Comunik\Controllers\SmsServicesCampanas@store'));
    Route::get(config('pulsar.appName').'/comunik/sms/services/campanas/{id}/edit/{page}',                 array('as'=>'editSmsServicesCampanas', 'uses'=>'Syscover\Comunik\Controllers\SmsServicesCampanas@edit'));
    Route::post(config('pulsar.appName').'/comunik/sms/services/campanas/update/{page}',                   array('as'=>'updateSmsServicesCampanas', 'uses'=>'Syscover\Comunik\Controllers\SmsServicesCampanas@update'));
    Route::get(config('pulsar.appName').'/comunik/sms/services/campanas/delete/{id}',                     array('as'=>'deleteSmsServicesCampanas', 'uses'=>'Syscover\Comunik\Controllers\SmsServicesCampanas@delete'));
    Route::post(config('pulsar.appName').'/comunik/sms/services/campanas/delete/select/elements',         array('as'=>'deleteSmsServicesCampanas', 'uses'=>'Syscover\Comunik\Controllers\SmsServicesCampanas@deleteSelect'));
    
    /*
    |--------------------------------------------------------------------------
    | SMS SERVICES REMITENTES
    |--------------------------------------------------------------------------
    */
    Route::any(config('pulsar.appName').'/comunik/sms/services/remitentes/{page?}',                    array('as'=>'smsServicesRemitentes', 'uses'=>'Syscover\Comunik\Controllers\SmsServicesRemitentes@index'));
    Route::any(config('pulsar.appName').'/comunik/sms/services/remitentes/json/data',                  array('as'=>'jsonDataSmsServicesRemitentes', 'uses'=>'Syscover\Comunik\Controllers\SmsServicesRemitentes@jsonData'));
    Route::get(config('pulsar.appName').'/comunik/sms/services/remitentes/create/{page}',              array('as'=>'createSmsServicesRemitentes', 'uses'=>'Syscover\Comunik\Controllers\SmsServicesRemitentes@create'));
    Route::post(config('pulsar.appName').'/comunik/sms/services/remitentes/store/{page}',              array('as'=>'storeSmsServicesRemitentes', 'uses'=>'Syscover\Comunik\Controllers\SmsServicesRemitentes@store'));
    Route::get(config('pulsar.appName').'/comunik/sms/services/remitentes/{id}/edit/{page}',           array('as'=>'editSmsServicesRemitentes', 'uses'=>'Syscover\Comunik\Controllers\SmsServicesRemitentes@edit'));
    Route::post(config('pulsar.appName').'/comunik/sms/services/remitentes/update/{page}',             array('as'=>'updateSmsServicesRemitentes', 'uses'=>'Syscover\Comunik\Controllers\SmsServicesRemitentes@update'));
    Route::get(config('pulsar.appName').'/comunik/sms/services/remitentes/delete/{id}',               array('as'=>'deleteSmsServicesRemitentes', 'uses'=>'Syscover\Comunik\Controllers\SmsServicesRemitentes@delete'));
    Route::post(config('pulsar.appName').'/comunik/sms/services/remitentes/delete/select/elements',   array('as'=>'deleteSmsServicesRemitentes', 'uses'=>'Syscover\Comunik\Controllers\SmsServicesRemitentes@deleteSelect'));
    
    /*
    |--------------------------------------------------------------------------
    | SMS SERVICES PLANTILLAS
    |--------------------------------------------------------------------------
    */
    Route::any(config('pulsar.appName').'/comunik/sms/services/plantillas/{page?}',                    array('as'=>'smsServicesPlantillas', 'uses'=>'Syscover\Comunik\Controllers\SmsServicesPlantillas@index'));
    Route::any(config('pulsar.appName').'/comunik/sms/services/plantillas/json/data',                  array('as'=>'jsonDataSmsServicesPlantillas', 'uses'=>'Syscover\Comunik\Controllers\SmsServicesPlantillas@jsonData'));
    Route::get(config('pulsar.appName').'/comunik/sms/services/plantillas/create/{page}',              array('as'=>'createSmsServicesPlantillas', 'uses'=>'Syscover\Comunik\Controllers\SmsServicesPlantillas@create'));
    Route::post(config('pulsar.appName').'/comunik/sms/services/plantillas/store/{page}',              array('as'=>'storeSmsServicesPlantillas', 'uses'=>'Syscover\Comunik\Controllers\SmsServicesPlantillas@store'));
    Route::get(config('pulsar.appName').'/comunik/sms/services/plantillas/{id}/edit/{page}',           array('as'=>'editSmsServicesPlantillas', 'uses'=>'Syscover\Comunik\Controllers\SmsServicesPlantillas@edit'));
    Route::post(config('pulsar.appName').'/comunik/sms/services/plantillas/update/{page}',             array('as'=>'updateSmsServicesPlantillas', 'uses'=>'Syscover\Comunik\Controllers\SmsServicesPlantillas@update'));
    Route::get(config('pulsar.appName').'/comunik/sms/services/plantillas/delete/{id}',               array('as'=>'deleteSmsServicesPlantillas', 'uses'=>'Syscover\Comunik\Controllers\SmsServicesPlantillas@delete'));
    Route::post(config('pulsar.appName').'/comunik/sms/services/plantillas/json/get_plantilla/{id}',   array('as'=>'jsonGetPlantilla', 'uses'=>'Syscover\Comunik\Controllers\SmsServicesPlantillas@jsonGetPlantilla'));
    Route::post(config('pulsar.appName').'/comunik/sms/services/plantillas/delete/select/elements',   array('as'=>'deleteSmsServicesPlantillas', 'uses'=>'Syscover\Comunik\Controllers\SmsServicesPlantillas@deleteSelect'));
    
    /*
    |--------------------------------------------------------------------------
    | SMS SERVICES PREFERENCIAS
    |--------------------------------------------------------------------------
    */
    Route::any(config('pulsar.appName').'/comunik/sms/services/preferencias', array('as'=>'smsServicesPreferencias', 'uses'=>'Syscover\Comunik\Controllers\SmsServicesPreferencias@index'));
    Route::post(config('pulsar.appName').'/comunik/sms/services/preferencias/update', array('as'=>'updateSmsServicesPreferencias', 'uses'=>'Syscover\Comunik\Controllers\SmsServicesPreferencias@update'));
    
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
Route::post(config('pulsar.appName') . '/comunik/contacts/unsubscribe/email', ['before' => 'csrf', 'as'=>'unsubscribeComunikContact', 'uses'=>'Syscover\Comunik\Controllers\Contacts@unsubscribeEmail']);
Route::get(config('pulsar.appName') . '/comunik/contacts/unsubscribe/email/{contact}', ['as' => 'showUnsubscribeComunikContact', function($id) {
    return view('comunik::pulsar.comunik.contacts.email_unsubscribe', ['id' => $id]);
}]);






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