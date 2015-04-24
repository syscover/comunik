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

Route::group(['middleware' => ['auth.pulsar','permission.pulsar']], function() {

    /*
    |--------------------------------------------------------------------------
    | MOD. GROUPS
    |--------------------------------------------------------------------------
    */
    Route::any(config('pulsar.appName') . '/comunik/groups/{page?}',                                                                    ['as'=>'ComunikGroup',                          'uses'=>'Syscover\Comunik\Controllers\Groups@index']);
    Route::any(config('pulsar.appName') . '/comunik/groups/json/data',                                                                  ['as'=>'jsonDataComunikGroup',                  'uses'=>'Syscover\Comunik\Controllers\Groups@jsonData']);
    Route::get(config('pulsar.appName') . '/comunik/groups/create/{page}',                                                              ['as'=>'createComunikGroup',                    'uses'=>'Syscover\Comunik\Controllers\Groups@create']);
    Route::post(config('pulsar.appName') . '/comunik/groups/store/{page}',                                                              ['as'=>'storeComunikGroup',                     'uses'=>'Syscover\Comunik\Controllers\Groups@store']);
    Route::get(config('pulsar.appName') . '/comunik/groups/{id}/edit/{page}',                                                           ['as'=>'editComunikGroup',                      'uses'=>'Syscover\Comunik\Controllers\Groups@edit']);
    Route::post(config('pulsar.appName') . '/comunik/groups/update/{page}',                                                             ['as'=>'updateComunikGroup',                    'uses'=>'Syscover\Comunik\Controllers\Groups@update']);
    Route::get(config('pulsar.appName') . '/comunik/groups/destroy/{id}',                                                               ['as'=>'destroyComunikGroup',                   'uses'=>'Syscover\Comunik\Controllers\Groups@destroy']);
    Route::post(config('pulsar.appName') . '/comunik/groups/destroy/select/elements',                                                   ['as'=>'destroySelectComunikGroup',             'uses'=>'Syscover\Comunik\Controllers\Groups@destroySelect']);
    
    /*
    |--------------------------------------------------------------------------
    | MOD. CONTACTS
    |--------------------------------------------------------------------------
    */
    Route::any(config('pulsar.appName') . '/comunik/contacts/{page?}',                                                                  ['as'=>'ComunikContact',                        'uses'=>'Syscover\Comunik\Controllers\Contacts@index']);
    Route::any(config('pulsar.appName') . '/comunik/contacts/json/data',                                                                ['as'=>'jsonDataComunikContact',                'uses'=>'Syscover\Comunik\Controllers\Contacts@jsonData']);
    Route::get(config('pulsar.appName') . '/comunik/contacts/create/{page}',                                                            ['as'=>'createComunikContact',                  'uses'=>'Syscover\Comunik\Controllers\Contacts@create']);
    Route::post(config('pulsar.appName') . '/comunik/contacts/store/{page}',                                                            ['as'=>'storeComunikContact',                   'uses'=>'Syscover\Comunik\Controllers\Contacts@store']);
    Route::get(config('pulsar.appName') . '/comunik/contacts/{id}/edit/{page}',                                                         ['as'=>'editComunikContact',                    'uses'=>'Syscover\Comunik\Controllers\Contacts@edit']);
    Route::post(config('pulsar.appName') . '/comunik/contacts/update/{page}',                                                           ['as'=>'updateComunikContact',                  'uses'=>'Syscover\Comunik\Controllers\Contacts@update']);
    Route::get(config('pulsar.appName') . '/comunik/contacts/destroy/{id}',                                                             ['as'=>'destroyComunikContact',                 'uses'=>'Syscover\Comunik\Controllers\Contacts@destroy']);
    Route::post(config('pulsar.appName') . '/comunik/contacts/destroy/select/elements',                                                 ['as'=>'destroySelectComunikContact',           'uses'=>'Syscover\Comunik\Controllers\Contacts@destroySelect']);



    Route::get(config('pulsar.appName') . '/comunik/contacts/import/excel/preview/{file}',                                              ['as'=>'importExcelPreviewComunikContact',     'uses'=>'Syscover\Comunik\Controllers\Contacts@ImportExcelPreview']);
    Route::post(config('pulsar.appName') . '/comunik/contacts/import/excel/{file}',                                                     ['as'=>'importExcelComunikContact',            'uses'=>'Syscover\Comunik\Controllers\Contacts@ImportExcel']);
     
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    /*
    |--------------------------------------------------------------------------
    | EMAIL SERVICES ENVÍOS
    |--------------------------------------------------------------------------
    */
    Route::any(config('pulsar.appName').'/comunik/email/services/envios/{campana}/{page?}',        array('as'=>'emailServicesEnvios', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesEnvios@index'));
    Route::any(config('pulsar.appName').'/comunik/email/services/envios/json/data/{campana}',      array('as'=>'jsonDataEmailServicesEnvios', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesEnvios@jsonData'));
    Route::get(config('pulsar.appName').'/comunik/email/services/envios/forward/{envio}/{page?}',  array('as'=>'forwardEmailServicesEnvios', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesEnvios@forward'));

    /*
    |--------------------------------------------------------------------------
    | EMAIL SERVICES CAMPAÑA
    |--------------------------------------------------------------------------
    */
    Route::any(config('pulsar.appName').'/comunik/email/services/campanas/{page?}',                        array('as'=>'emailServicesCampanas', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesCampanas@index'));
    Route::get(config('pulsar.appName').'/comunik/email/services/campanas/send/test/{campana}/{page?}',    array('as'=>'sendTestEmailServicesCampanas', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesCampanas@sendTest'));
    Route::any(config('pulsar.appName').'/comunik/email/services/campanas/json/data',                      array('as'=>'jsonDataEmailServicesCampanas', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesCampanas@jsonData'));
    Route::get(config('pulsar.appName').'/comunik/email/services/campanas/create/{page}/{id?}',            array('as'=>'createEmailServicesCampanas', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesCampanas@create'));
    Route::get(config('pulsar.appName').'/comunik/email/services/campanas/preview/{id}',                   array('as'=>'previewEmailServicesCampanas', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesCampanas@preview'));
    Route::post(config('pulsar.appName').'/comunik/email/services/campanas/store/{page}',                  array('as'=>'storeEmailServicesCampanas', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesCampanas@store'));
    Route::get(config('pulsar.appName').'/comunik/email/services/campanas/{id}/edit/{page}',               array('as'=>'editEmailServicesCampanas', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesCampanas@edit'));
    Route::post(config('pulsar.appName').'/comunik/email/services/campanas/update/{page}',                 array('as'=>'updateEmailServicesCampanas', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesCampanas@update'));
    Route::get(config('pulsar.appName').'/comunik/email/services/campanas/destroy/{id}',                   array('as'=>'destroyEmailServicesCampanas', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesCampanas@destroy'));
    Route::post(config('pulsar.appName').'/comunik/email/services/campanas/destroy/select/elements',       array('as'=>'destroyEmailServicesCampanas', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesCampanas@destroySelect'));
    
    /*
    |--------------------------------------------------------------------------
    | EMAIL SERVICES PLANTILLAS
    |--------------------------------------------------------------------------
    */
    Route::any(config('pulsar.appName').'/comunik/email/services/plantillas/{page?}',                      array('as'=>'emailServicesPlantillas', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesPlantillas@index'));
    Route::any(config('pulsar.appName').'/comunik/email/services/plantillas/json/data',                    array('as'=>'jsonDataEmailServicesPlantillas', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesPlantillas@jsonData'));
    Route::get(config('pulsar.appName').'/comunik/email/services/plantillas/preview/{id}',                 array('as'=>'previewEmailServicesPlantillas', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesPlantillas@preview'));
    Route::get(config('pulsar.appName').'/comunik/email/services/plantillas/create/{page}',                array('as'=>'createEmailServicesPlantillas', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesPlantillas@create'));
    Route::post(config('pulsar.appName').'/comunik/email/services/plantillas/store/{page}',                array('as'=>'storeEmailServicesPlantillas', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesPlantillas@store'));
    Route::get(config('pulsar.appName').'/comunik/email/services/plantillas/{id}/edit/{page}',             array('as'=>'editEmailServicesPlantillas', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesPlantillas@edit'));
    Route::post(config('pulsar.appName').'/comunik/email/services/plantillas/update/{page}',               array('as'=>'updateEmailServicesPlantillas', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesPlantillas@update'));
    Route::get(config('pulsar.appName').'/comunik/email/services/plantillas/destroy/{id}',                 array('as'=>'destroyEmailServicesPlantillas', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesPlantillas@destroy'));
    Route::post(config('pulsar.appName').'/comunik/email/services/plantillas/destroy/select/elements',     array('as'=>'destroyEmailServicesPlantillas', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesPlantillas@destroySelect'));
    Route::post(config('pulsar.appName').'/comunik/email/services/plantillas/json/get_plantilla/{id}',     array('as'=>'jsonGetPlantilla', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesPlantillas@jsonGetPlantilla'));
    Route::get(config('pulsar.appName').'/comunik/email/services/plantillas/show/{plantilla}/{contact}',   array('as'=>'showEmailServicesPlantillas', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesPlantillas@show'));

    /*
    |--------------------------------------------------------------------------
    | EMAIL SERVICES MENSAJES
    |--------------------------------------------------------------------------
    */
    Route::get(config('pulsar.appName').'/comunik/email/services/accounts/{account}/{pageAccounts}/messages/{page?}',                      array('as'=>'emailServicesMessages', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesMessages@index'));
    Route::any(config('pulsar.appName').'/comunik/email/services/accounts/{account}/{pageAccounts}/messages/json/data',                    array('as'=>'jsonDataEmailServicesMessages', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesMessages@jsonData'));
    Route::post(config('pulsar.appName').'/comunik/email/services/accounts/{account}/{pageAccounts}/messages/{page?}',                     array('as'=>'emailServicesMessages', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesMessages@processMessage'));
    Route::get(config('pulsar.appName').'/comunik/email/services/accounts/{account}/{pageAccounts}/messages/{message}/{page?}',            array('as'=>'emailServicesShowMessage', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesMessages@showMessage'));
    Route::get(config('pulsar.appName').'/comunik/email/services/accounts/{account}/{pageAccounts}/messages/destroy/message/{message}',    array('as'=>'destroyEmailServicesMessages', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesMessages@destroy'));
    Route::post(config('pulsar.appName').'/comunik/email/services/accounts/{account}/{pageAccounts}/messages/destroy/select/elements',     array('as'=>'destroyEmailServicesMessages', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesMessages@destroySelect'));


    /*
    |--------------------------------------------------------------------------
    | EMAIL SERVICES CUENTAS
    |--------------------------------------------------------------------------
    */
    Route::any(config('pulsar.appName').'/comunik/email/services/accounts/{page?}',                    array('as'=>'emailServicesAccounts', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesCuentas@index'));
    Route::any(config('pulsar.appName').'/comunik/email/services/accounts/json/data',                  array('as'=>'jsonDataEmailServicesAccounts', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesCuentas@jsonData'));
    Route::get(config('pulsar.appName').'/comunik/email/services/accounts/create/{page}',              array('as'=>'createEmailServicesAccounts', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesCuentas@create'));
    Route::post(config('pulsar.appName').'/comunik/email/services/accounts/store/{page}',              array('as'=>'storeEmailServicesAccounts', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesCuentas@store'));
    Route::get(config('pulsar.appName').'/comunik/email/services/accounts/{id}/edit/{page}',           array('as'=>'editEmailServicesAccounts', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesCuentas@edit'));
    Route::get(config('pulsar.appName').'/comunik/email/services/accounts/{id}/review/{page}',         array('as'=>'reviewEmailServicesAccounts', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesCuentas@review'));
    Route::post(config('pulsar.appName').'/comunik/email/services/accounts/update/{page}',             array('as'=>'updateEmailServicesAccounts', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesCuentas@update'));
    Route::get(config('pulsar.appName').'/comunik/email/services/accounts/destroy/{id}',               array('as'=>'destroyEmailServicesAccounts', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesCuentas@destroy'));
    Route::post(config('pulsar.appName').'/comunik/email/services/accounts/destroy/select/elements',   array('as'=>'destroyEmailServicesAccounts', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesCuentas@destroySelect'));

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
    Route::get(config('pulsar.appName').'/comunik/email/services/patterns/destroy/{id}',               array('as'=>'destroyEmailServicesPatterns', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesPatterns@destroy'));
    Route::post(config('pulsar.appName').'/comunik/email/services/patterns/destroy/select/elements',   array('as'=>'destroyEmailServicesPatterns', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesPatterns@destroySelect'));


    /*
    |--------------------------------------------------------------------------
    | EMAIL SERVICES PREFERENCIAS
    |--------------------------------------------------------------------------
    */
    Route::any(config('pulsar.appName').'/comunik/email/services/preferencias',                    array('as'=>'emailServicesPreferencias', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesPreferencias@index'));
    Route::any(config('pulsar.appName').'/comunik/email/services/preferencias/json/{json}',        array('as'=>'emailServicesPreferenciasJson', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesPreferencias@index'));
    Route::post(config('pulsar.appName').'/comunik/email/services/preferencias/update',            array('as'=>'updateEmailServicesPreferencias', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesPreferencias@update'));

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
    Route::get(config('pulsar.appName').'/comunik/sms/services/campanas/destroy/{id}',                     array('as'=>'destroySmsServicesCampanas', 'uses'=>'Syscover\Comunik\Controllers\SmsServicesCampanas@destroy'));
    Route::post(config('pulsar.appName').'/comunik/sms/services/campanas/destroy/select/elements',         array('as'=>'destroySmsServicesCampanas', 'uses'=>'Syscover\Comunik\Controllers\SmsServicesCampanas@destroySelect'));
    
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
    Route::get(config('pulsar.appName').'/comunik/sms/services/remitentes/destroy/{id}',               array('as'=>'destroySmsServicesRemitentes', 'uses'=>'Syscover\Comunik\Controllers\SmsServicesRemitentes@destroy'));
    Route::post(config('pulsar.appName').'/comunik/sms/services/remitentes/destroy/select/elements',   array('as'=>'destroySmsServicesRemitentes', 'uses'=>'Syscover\Comunik\Controllers\SmsServicesRemitentes@destroySelect'));
    
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
    Route::get(config('pulsar.appName').'/comunik/sms/services/plantillas/destroy/{id}',               array('as'=>'destroySmsServicesPlantillas', 'uses'=>'Syscover\Comunik\Controllers\SmsServicesPlantillas@destroy'));
    Route::post(config('pulsar.appName').'/comunik/sms/services/plantillas/json/get_plantilla/{id}',   array('as'=>'jsonGetPlantilla', 'uses'=>'Syscover\Comunik\Controllers\SmsServicesPlantillas@jsonGetPlantilla'));
    Route::post(config('pulsar.appName').'/comunik/sms/services/plantillas/destroy/select/elements',   array('as'=>'destroySmsServicesPlantillas', 'uses'=>'Syscover\Comunik\Controllers\SmsServicesPlantillas@destroySelect'));
    
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
| EMAIL SERVICES CAMPANAS
|--------------------------------------------------------------------------
*/
Route::get(config('pulsar.appName').'/comunik/email/services/campanas/show/{campana}/{contact}', array('as'=>'showEmailServicesCampanas', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesCampanas@show'));

/*
|--------------------------------------------------------------------------
| MOD. CONTACTOS
|--------------------------------------------------------------------------
*/
Route::post(config('pulsar.appName').'/comunik/contacts/unsubscribe/email', array('before' => 'csrf', 'as'=>'unsubscribeComunikContact', 'uses'=>'Syscover\Comunik\Controllers\Contacts@unsubscribeEmail'));
Route::get(config('pulsar.appName').'/comunik/contacts/unsubscribe/email/{contact}', function($id){
    return View::make('comunik::pulsar.comunik.contacts.email_unsubscribe',array('id' => $id));
});

/*
|--------------------------------------------------------------------------
| EMAIL ESTADÍSTICAS DE CAMPAÑAS
|--------------------------------------------------------------------------
*/
Route::get(config('pulsar.appName').'/comunik/email/services/campanas/analytics/{campana}/{envio}', array('as'=>'emailServicesCampanasAnalytics', 'uses'=>'Syscover\Comunik\Controllers\EmailServicesCampanas@analytics'));