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

Route::group(['middleware' => ['web', 'pulsar']], function() {

    /*
    |--------------------------------------------------------------------------
    | MOD. GROUPS
    |--------------------------------------------------------------------------
    */
    Route::any(config('pulsar.name') . '/comunik/groups/{offset?}',                                  ['as' => 'comunikGroup',                  'uses' => 'Syscover\Comunik\Controllers\GroupsController@index',                'resource' => 'comunik-group',        'action' => 'access']);
    Route::any(config('pulsar.name') . '/comunik/groups/json/data',                                  ['as' => 'jsonDataComunikGroup',          'uses' => 'Syscover\Comunik\Controllers\GroupsController@jsonData',             'resource' => 'comunik-group',        'action' => 'access']);
    Route::get(config('pulsar.name') . '/comunik/groups/create/{offset}',                            ['as' => 'createComunikGroup',            'uses' => 'Syscover\Comunik\Controllers\GroupsController@createRecord',         'resource' => 'comunik-group',        'action' => 'create']);
    Route::post(config('pulsar.name') . '/comunik/groups/store/{offset}',                            ['as' => 'storeComunikGroup',             'uses' => 'Syscover\Comunik\Controllers\GroupsController@storeRecord',          'resource' => 'comunik-group',        'action' => 'create']);
    Route::get(config('pulsar.name') . '/comunik/groups/{id}/edit/{offset}',                         ['as' => 'editComunikGroup',              'uses' => 'Syscover\Comunik\Controllers\GroupsController@editRecord',           'resource' => 'comunik-group',        'action' => 'access']);
    Route::put(config('pulsar.name') . '/comunik/groups/update/{id}/{offset}',                       ['as' => 'updateComunikGroup',            'uses' => 'Syscover\Comunik\Controllers\GroupsController@updateRecord',         'resource' => 'comunik-group',        'action' => 'edit']);
    Route::get(config('pulsar.name') . '/comunik/groups/delete/{id}/{offset}',                       ['as' => 'deleteComunikGroup',            'uses' => 'Syscover\Comunik\Controllers\GroupsController@deleteRecord',         'resource' => 'comunik-group',        'action' => 'delete']);
    Route::delete(config('pulsar.name') . '/comunik/groups/delete/select/records',                   ['as' => 'deleteSelectComunikGroup',      'uses' => 'Syscover\Comunik\Controllers\GroupsController@deleteRecordsSelect',  'resource' => 'comunik-group',        'action' => 'delete']);


    /*
    |--------------------------------------------------------------------------
    | MOD. CONTACTS
    |--------------------------------------------------------------------------
    */
    Route::any(config('pulsar.name') . '/comunik/contacts/{offset?}',                                ['as' => 'comunikContact',                    'uses' => 'Syscover\Comunik\Controllers\ContactsController@index',                  'resource' => 'comunik-contact',        'action' => 'access']);
    Route::any(config('pulsar.name') . '/comunik/contacts/json/data',                                ['as' => 'jsonDataComunikContact',            'uses' => 'Syscover\Comunik\Controllers\ContactsController@jsonData',               'resource' => 'comunik-contact',        'action' => 'access']);
    Route::get(config('pulsar.name') . '/comunik/contacts/create/{offset}',                          ['as' => 'createComunikContact',              'uses' => 'Syscover\Comunik\Controllers\ContactsController@createRecord',           'resource' => 'comunik-contact',        'action' => 'create']);
    Route::post(config('pulsar.name') . '/comunik/contacts/store/{offset}',                          ['as' => 'storeComunikContact',               'uses' => 'Syscover\Comunik\Controllers\ContactsController@storeRecord',            'resource' => 'comunik-contact',        'action' => 'create']);
    Route::get(config('pulsar.name') . '/comunik/contacts/{id}/edit/{offset}',                       ['as' => 'editComunikContact',                'uses' => 'Syscover\Comunik\Controllers\ContactsController@editRecord',             'resource' => 'comunik-contact',        'action' => 'access']);
    Route::put(config('pulsar.name') . '/comunik/contacts/update/{id}/{offset}',                     ['as' => 'updateComunikContact',              'uses' => 'Syscover\Comunik\Controllers\ContactsController@updateRecord',           'resource' => 'comunik-contact',        'action' => 'edit']);
    Route::get(config('pulsar.name') . '/comunik/contacts/delete/{id}/{offset}',                     ['as' => 'deleteComunikContact',              'uses' => 'Syscover\Comunik\Controllers\ContactsController@deleteRecord',           'resource' => 'comunik-contact',        'action' => 'delete']);
    Route::delete(config('pulsar.name') . '/comunik/contacts/delete/select/records',                 ['as' => 'deleteSelectComunikContact',        'uses' => 'Syscover\Comunik\Controllers\ContactsController@deleteRecordsSelect',    'resource' => 'comunik-contact',        'action' => 'delete']);
    Route::get(config('pulsar.name') . '/comunik/contacts/create/import/contacts/preview/{file}',    ['as' => 'importPreviewComunikContact',       'uses' => 'Syscover\Comunik\Controllers\ContactsController@importRecordsPreview',   'resource' => 'comunik-contact',        'action' => 'create']);
    Route::post(config('pulsar.name') . '/comunik/contacts/create/import/contacts',                  ['as' => 'importComunikContact',              'uses' => 'Syscover\Comunik\Controllers\ContactsController@importRecords',          'resource' => 'comunik-contact',        'action' => 'create']);

    /*
    |--------------------------------------------------------------------------
    | MOD. EMAIL SERVICES TEMPLATES
    |--------------------------------------------------------------------------
    */
    Route::any(config('pulsar.name') . '/comunik/email/services/templates/{offset?}',                    ['as' => 'comunikEmailTemplate',              'uses' => 'Syscover\Comunik\Controllers\EmailTemplatesController@index',                        'resource' => 'comunik-email-template',        'action' => 'access']);
    Route::any(config('pulsar.name') . '/comunik/email/services/templates/json/data',                    ['as' => 'jsonDataComunikEmailTemplate',      'uses' => 'Syscover\Comunik\Controllers\EmailTemplatesController@jsonData',                     'resource' => 'comunik-email-template',        'action' => 'access']);
    Route::get(config('pulsar.name') . '/comunik/email/services/templates/create/{offset}',              ['as' => 'createComunikEmailTemplate',        'uses' => 'Syscover\Comunik\Controllers\EmailTemplatesController@createRecord',                 'resource' => 'comunik-email-template',        'action' => 'create']);
    Route::post(config('pulsar.name') . '/comunik/email/services/templates/store/{offset}',              ['as' => 'storeComunikEmailTemplate',         'uses' => 'Syscover\Comunik\Controllers\EmailTemplatesController@storeRecord',                  'resource' => 'comunik-email-template',        'action' => 'create']);
    Route::get(config('pulsar.name') . '/comunik/email/services/templates/{id}/edit/{offset}',           ['as' => 'editComunikEmailTemplate',          'uses' => 'Syscover\Comunik\Controllers\EmailTemplatesController@editRecord',                   'resource' => 'comunik-email-template',        'action' => 'access']);
    Route::put(config('pulsar.name') . '/comunik/email/services/templates/update/{id}/{offset}',         ['as' => 'updateComunikEmailTemplate',        'uses' => 'Syscover\Comunik\Controllers\EmailTemplatesController@updateRecord',                 'resource' => 'comunik-email-template',        'action' => 'edit']);
    Route::get(config('pulsar.name') . '/comunik/email/services/templates/delete/{id}',                  ['as' => 'deleteComunikEmailTemplate',        'uses' => 'Syscover\Comunik\Controllers\EmailTemplatesController@deleteRecord',                 'resource' => 'comunik-email-template',        'action' => 'delete']);
    Route::delete(config('pulsar.name') . '/comunik/email/services/templates/delete/select/elements',    ['as' => 'deleteSelectComunikEmailTemplate',  'uses' => 'Syscover\Comunik\Controllers\EmailTemplatesController@deleteRecordsSelect',          'resource' => 'comunik-email-template',        'action' => 'delete']);
    Route::any(config('pulsar.name') . '/comunik/email/services/templates/{id}/show/{api}',              ['as' => 'apiShowComunikEmailTemplate',       'uses' => 'Syscover\Comunik\Controllers\EmailTemplatesController@showRecord',                   'resource' => 'comunik-email-template',        'action' => 'access']);
    Route::get(config('pulsar.name') . '/comunik/email/services/templates/preview/{template}',           ['as' => 'previewComunikEmailTemplate',       'uses' => 'Syscover\Comunik\Controllers\EmailTemplatesController@previewTemplate',              'resource' => 'comunik-email-template',        'action' => 'access']);


    /*
    |--------------------------------------------------------------------------
    | MOD. EMAIL SERVICES CAMPAIGNS
    |--------------------------------------------------------------------------
    */
    Route::any(config('pulsar.name') . '/comunik/email/services/campaigns/{offset?}',                    ['as' => 'comunikEmailCampaign',                  'uses' => 'Syscover\Comunik\Controllers\EmailCampaignsController@index',                  'resource' => 'comunik-email-campaign',     'action' => 'access']);
    Route::any(config('pulsar.name') . '/comunik/email/services/campaigns/json/data',                    ['as' => 'jsonDataComunikEmailCampaign',          'uses' => 'Syscover\Comunik\Controllers\EmailCampaignsController@jsonData',               'resource' => 'comunik-email-campaign',     'action' => 'access']);
    Route::get(config('pulsar.name') . '/comunik/email/services/campaigns/create/{offset}/{id?}',        ['as' => 'createComunikEmailCampaign',            'uses' => 'Syscover\Comunik\Controllers\EmailCampaignsController@createRecord',           'resource' => 'comunik-email-campaign',     'action' => 'create']);
    Route::post(config('pulsar.name') . '/comunik/email/services/campaigns/store/{offset}',              ['as' => 'storeComunikEmailCampaign',             'uses' => 'Syscover\Comunik\Controllers\EmailCampaignsController@storeRecord',            'resource' => 'comunik-email-campaign',     'action' => 'create']);
    Route::get(config('pulsar.name') . '/comunik/email/services/campaigns/{id}/edit/{offset}',           ['as' => 'editComunikEmailCampaign',              'uses' => 'Syscover\Comunik\Controllers\EmailCampaignsController@editRecord',             'resource' => 'comunik-email-campaign',     'action' => 'access']);
    Route::put(config('pulsar.name') . '/comunik/email/services/campaigns/update/{id}/{offset}',         ['as' => 'updateComunikEmailCampaign',            'uses' => 'Syscover\Comunik\Controllers\EmailCampaignsController@updateRecord',           'resource' => 'comunik-email-campaign',     'action' => 'edit']);
    Route::get(config('pulsar.name') . '/comunik/email/services/campaigns/delete/{id}',                  ['as' => 'deleteComunikEmailCampaign',            'uses' => 'Syscover\Comunik\Controllers\EmailCampaignsController@deleteRecord',           'resource' => 'comunik-email-campaign',     'action' => 'delete']);
    Route::delete(config('pulsar.name') . '/comunik/email/services/campaigns/delete/select/elements',    ['as' => 'deleteSelectComunikEmailCampaign',      'uses' => 'Syscover\Comunik\Controllers\EmailCampaignsController@deleteRecordsSelect',    'resource' => 'comunik-email-campaign',     'action' => 'delete']);
    Route::get(config('pulsar.name') . '/comunik/email/services/campaigns/send/test/{id}/{offset?}',     ['as' => 'sendTestComunikEmailCampaign',          'uses' => 'Syscover\Comunik\Controllers\EmailCampaignsController@sendTest',               'resource' => 'comunik-email-campaign',     'action' => 'create']);

    /*
    |--------------------------------------------------------------------------
    | MOD. EMAIL SERVICES PATTERN
    |--------------------------------------------------------------------------
    */
    Route::any(config('pulsar.name') . '/comunik/email/services/patterns/{offset?}',                     ['as' => 'comunikEmailPattern',                   'uses' => 'Syscover\Comunik\Controllers\EmailPatternsController@index',                     'resource' => 'comunik-email-pattern',     'action' => 'access']);
    Route::any(config('pulsar.name') . '/comunik/email/services/patterns/json/data',                     ['as' => 'jsonDataComunikEmailPattern',           'uses' => 'Syscover\Comunik\Controllers\EmailPatternsController@jsonData',                  'resource' => 'comunik-email-pattern',     'action' => 'access']);
    Route::get(config('pulsar.name') . '/comunik/email/services/patterns/create/{offset}',               ['as' => 'createComunikEmailPattern',             'uses' => 'Syscover\Comunik\Controllers\EmailPatternsController@createRecord',              'resource' => 'comunik-email-pattern',     'action' => 'create']);
    Route::post(config('pulsar.name') . '/comunik/email/services/patterns/store/{offset}',               ['as' => 'storeComunikEmailPattern',              'uses' => 'Syscover\Comunik\Controllers\EmailPatternsController@storeRecord',               'resource' => 'comunik-email-pattern',     'action' => 'create']);
    Route::get(config('pulsar.name') . '/comunik/email/services/patterns/{id}/edit/{offset}',            ['as' => 'editComunikEmailPattern',               'uses' => 'Syscover\Comunik\Controllers\EmailPatternsController@editRecord',                'resource' => 'comunik-email-pattern',     'action' => 'access']);
    Route::put(config('pulsar.name') . '/comunik/email/services/patterns/update/{id}/{offset}',          ['as' => 'updateComunikEmailPattern',             'uses' => 'Syscover\Comunik\Controllers\EmailPatternsController@updateRecord',              'resource' => 'comunik-email-pattern',     'action' => 'edit']);
    Route::get(config('pulsar.name') . '/comunik/email/services/patterns/delete/{id}',                   ['as' => 'deleteComunikEmailPattern',             'uses' => 'Syscover\Comunik\Controllers\EmailPatternsController@deleteRecord',              'resource' => 'comunik-email-pattern',     'action' => 'delete']);
    Route::delete(config('pulsar.name') . '/comunik/email/services/patterns/delete/select/elements',     ['as' => 'deleteSelectComunikEmailPattern',       'uses' => 'Syscover\Comunik\Controllers\EmailPatternsController@deleteRecordsSelect',       'resource' => 'comunik-email-pattern',     'action' => 'delete']);

    /*
    |--------------------------------------------------------------------------
    | MOD. EMAIL SERVICES PREFERENCES
    |--------------------------------------------------------------------------
    */
    Route::any(config('pulsar.name') . '/comunik/email/services/preferences',                            ['as' => 'comunikEmailPreference',                'uses' => 'Syscover\Comunik\Controllers\EmailPreferenceController@index',               'resource' => 'comunik-email-preference',        'action' => 'access']);
    Route::put(config('pulsar.name') . '/comunik/email/services/preferences/update',                     ['as' => 'updateComunikEmailPreference',          'uses' => 'Syscover\Comunik\Controllers\EmailPreferenceController@updateRecord',        'resource' => 'comunik-email-preference',        'action' => 'edit']);



    //Route::any(config('pulsar.name') . '/comunik/email/services/preferences/json/{json}',            ['as'=>'EmailServicesPreferenceJson',      'uses'=>'Syscover\Comunik\Controllers\PreferenceController@index',       'resource' => 'comunik-email-preference',        'action' => 'access']);

    //Route::get(config('pulsar.name') . '/comunik/contacts/import/excel/preview/{file}',                                              ['as'=>'importExcelPreviewComunikContact',     'uses'=>'Syscover\Comunik\Controllers\Contacts@ImportExcelPreview']);
    //Route::post(config('pulsar.name') . '/comunik/contacts/import/excel/{file}',                                                     ['as'=>'importExcelComunikContact',            'uses'=>'Syscover\Comunik\Controllers\Contacts@ImportExcel']);


    /*
    |--------------------------------------------------------------------------
    | EMAIL SERVICES ENVÍOS
    |--------------------------------------------------------------------------
    */
    //Route::any(config('pulsar.name').'/comunik/email/services/envios/{campana}/{offset?}',        array('as'=>'emailServicesEnvios', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesEnvios@index'));
    //Route::any(config('pulsar.name').'/comunik/email/services/envios/json/data/{campana}',      array('as'=>'jsonDataEmailServicesEnvios', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesEnvios@jsonData'));
    //Route::get(config('pulsar.name').'/comunik/email/services/envios/forward/{envio}/{offset?}',  array('as'=>'forwardEmailServicesEnvios', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesEnvios@forward'));


    /*
    |--------------------------------------------------------------------------
    | EMAIL SERVICES MENSAJES
    |--------------------------------------------------------------------------
    */
    //Route::get(config('pulsar.name').'/comunik/email/services/accounts/{account}/{pageAccounts}/messages/{page?}',                      array('as'=>'emailServicesMessages', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesMessages@index'));
    //Route::any(config('pulsar.name').'/comunik/email/services/accounts/{account}/{pageAccounts}/messages/json/data',                    array('as'=>'jsonDataEmailServicesMessages', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesMessages@jsonData'));
    //Route::post(config('pulsar.name').'/comunik/email/services/accounts/{account}/{pageAccounts}/messages/{page?}',                     array('as'=>'emailServicesMessages', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesMessages@processMessage'));
    //Route::get(config('pulsar.name').'/comunik/email/services/accounts/{account}/{pageAccounts}/messages/{message}/{page?}',            array('as'=>'emailServicesShowMessage', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesMessages@showMessage'));
    //Route::get(config('pulsar.name').'/comunik/email/services/accounts/{account}/{pageAccounts}/messages/delete/message/{message}',    array('as'=>'deleteEmailServicesMessages', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesMessages@delete'));
    //Route::post(config('pulsar.name').'/comunik/email/services/accounts/{account}/{pageAccounts}/messages/delete/select/elements',     array('as'=>'deleteEmailServicesMessages', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesMessages@deleteSelect'));
});

Route::group(['middleware' => ['web']], function() {

    Route::post(config('pulsar.name') . '/comunik/contacts/unsubscribe/email',                                       ['as' => 'unsubscribeComunikContact',              'uses' => 'Syscover\Comunik\Controllers\ContactsController@unsubscribeEmail']);

});

Route::group(['middleware' => ['noCsrWeb']], function() {

    /*
    |--------------------------------------------------------------------------
    | MOD. EMAIL SERVICES CAMPAIGNS (show campaign and set statistic)
    |--------------------------------------------------------------------------
    */
    Route::get(config('pulsar.name') . '/comunik/email/services/campaigns/preview/{campaign}/{historyId?}',          ['as' => 'previewComunikEmailCampaign',            'uses' => 'Syscover\Comunik\Controllers\EmailCampaignsController@previewCampaign']);
    Route::get(config('pulsar.name') . '/comunik/email/services/campaigns/statistics/{campaign}/{historyId}',        ['as' => 'statisticsComunikEmailCampaign',         'uses' => 'Syscover\Comunik\Controllers\EmailCampaignsController@recordStatistic']);

    /*
    |--------------------------------------------------------------------------
    | MOD. CONTACTS (UNSUBSCRIBE)
    |--------------------------------------------------------------------------
    */
    Route::get(config('pulsar.name') . '/comunik/contacts/unsubscribe/email/{contactKey}',                           ['as' => 'getUnsubscribeComunikContact',           'uses' => 'Syscover\Comunik\Controllers\ContactsController@getEmailToUnsubscribe']);

});









/*
|--------------------------------------------------------------------------
| SPAM MANAGER
|--------------------------------------------------------------------------
*/
//Route::post(config('pulsar.name').'/comunik/email/services/spam/score', array('as'=>'emailServicesSpamScore', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesSpam@check'));

/*
|--------------------------------------------------------------------------
| METODOS AJAX PARA TOMA DE DATOS
|--------------------------------------------------------------------------
*/
//Route::post(config('pulsar.name').'/comunik/contacts/json/get_contacto_movil/{movil}', array('as'=>'jsonGetContactoMovil', 'uses'=>'Syscover\Comunik\Controllers\Contacts@jsonGetContactoMovil'));
//Route::post(config('pulsar.name').'/comunik/contacts/json/get_contacto_email/{email}', array('as'=>'jsonGetContactoEmail', 'uses'=>'Syscover\Comunik\Controllers\Contacts@jsonGetContactoEmail'));

