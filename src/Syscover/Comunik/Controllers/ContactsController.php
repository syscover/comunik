<?php namespace Syscover\Comunik\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Syscover\Comunik\Models\Group;
use Syscover\Pulsar\Controllers\Controller;
use Syscover\Pulsar\Models\Country;
use Syscover\Pulsar\Traits\TraitController;
use Syscover\Comunik\Models\Contact;

class ContactsController extends Controller {

    use TraitController;

    protected $routeSuffix  = 'ComunikContact';
    protected $folder       = 'contacts';
    protected $package      = 'comunik';
    protected $aColumns     = ['id_041', 'name_041', 'surname_041', 'name_002', 'mobile_041', ['data' => 'email_041', 'type' => 'email'], ['data' => 'unsubscribe_email_041', 'type' => 'invertActive'], 'name_040'];
    protected $nameM        = 'name_041';
    protected $model        = '\Syscover\Comunik\Models\Contact';
    protected $icon         = 'fa fa-user';
    protected $objectTrans  = 'contact';

    public function createCustomRecord($request, $parameters)
    {
        $parameters['groups'] = Group::all();

        return $parameters;
    }

    public function storeCustomRecord($request)
    {
        $contact = Contact::create([
            'company_041'               => $request->input('company'),
            'name_041'                  => $request->input('name'),
            'surname_041'               => $request->input('surname'),
            'birth_date_041'            => $request->has('birthDate')? \DateTime::createFromFormat(config('pulsar.datePattern'), $request->input('birthDate'))->getTimestamp() : null,
            'country_041'               => $request->input('country'),
            'prefix_041'                => $request->input('prefix'),
            'mobile_041'                => $request->has('mobile')? str_replace('-', '', $request->input('mobile')) : null,
            'email_041'                 => strtolower($request->input('email')),
            'unsubscribe_mobile_041'    => $request->has('unsubscribeMobile'),
            'unsubscribe_email_041'     => $request->has('unsubscribeEmail'),
        ]);

        $contact->groups()->attach($request->input('groups'));
    }

    public function editCustomRecord($request, $parameters)
    {
        $parameters['groups'] = Group::all();

        return $parameters;
    }

    public function checkSpecialRulesToUpdate($request, $parameters)
    {
        $contact = Contact::find($parameters['id']);

        $parameters['specialRules']['emailRule']    = $request->input('email') == $contact->email_041? true : false;
        $parameters['specialRules']['mobileRule']   = $request->input('mobile') == $contact->mobile_041? true : false;

        return $parameters;
    }
    
    public function updateCustomRecord($request, $parameters)
    {
        Contact::where('id_041', $parameters['id'])->update([
            'company_041'               => $request->input('company'),
            'name_041'                  => $request->input('name'),
            'surname_041'               => $request->input('surname'),
            'birth_date_041'            => $request->has('birthDate')? \DateTime::createFromFormat(config('pulsar.datePattern'), $request->input('birthDate'))->getTimestamp() : null,
            'country_041'               => $request->input('country'),
            'prefix_041'                => $request->input('prefix'),
            'mobile_041'                => $request->has('mobile')? str_replace('-', '', $request->input('mobile')) : null,
            'email_041'                 => strtolower($request->input('email')),
            'unsubscribe_mobile_041'    => $request->has('unsubscribeMobile'),
            'unsubscribe_email_041'     => $request->has('unsubscribeEmail'),

        ]);
    }

    public function getEmailToUnsubscribe(Request $request)
    {
        // get parameters from url route
        $parameters = $request->route()->parameters();

        $contact = Contact::find(Crypt::decrypt($parameters['key']));

        return view('comunik::contacts.unsubscribe', ['key' => $parameters['key'], 'contact' => $contact]);
    }

    public function unsubscribeEmail(Request $request)
    {
        $contact = Contact::find(Crypt::decrypt($request->input('key')));
        Contact::where('id_041', $contact->id_041)->update([
            'unsubscribe_email_041' => true
        ]);

        return view('comunik::contacts.unsubscribe', ['contact' => $contact, 'unsubscribe' => true]);
    }

    public function importRecordsPreview(Request $request)
    {
        // get parameters from url route
        $parameters = $request->route()->parameters();

        $data['countries']  = Country::getTranslationsRecords($request->user()->lang_010);
        $data['groups']     = Group::all();
        $inputFileName      = public_path() . '/packages/syscover/pulsar/storage/tmp/' . $parameters['file'];

        $objReader      = new \PHPExcel_Reader_CSV();       // Creamos un objeto CSV Reader

        $objReader->setReadDataOnly(true);                  // Configura el reader para ignorar estilos, solo leerá los datos
        $objReader->setDelimiter(";");                      // Configura el reader para tener en cuenta el ; como elmento separador
        $objPHPExcel    = $objReader->load($inputFileName); // Cargamos el fichero y obtenemos el objeto PHPExcel

        //$totalSheets = $objPHPExcel->getSheetCount();       // Función para obtener el número de libros de la hoja de cálculo
        //$allSheetName = $objPHPExcel->getSheetNames();      // Función para obtener los nombres de los libros de las hojas de cálculo

        $objWorksheet       = $objPHPExcel->setActiveSheetIndex(0);     // Por defecto recuperamos el primer libro de la hoja de excel
        $highestRow         = $objWorksheet->getHighestRow();           // Recuperamos el número de fila más alto (dato numérico, empezando por 1)
        $highestColumn      = $objWorksheet->getHighestColumn();        // Recuperamos la columma mas alta (data string)
        $highestColumnIndex = \PHPExcel_Cell::columnIndexFromString($highestColumn); // Pasamos del dato string de columna a un dato numérico

        //limitamos las filas para ralizar un preview
        if($highestRow > 51) $highestRow = 51;  // obtenemos las 50 primeras filas

        for ($row = 1; $row <= $highestRow; ++$row)
        {
            for ($col = 0; $col < $highestColumnIndex; ++$col)
            {
                $value = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
                $arrayData[$row-1][$col] = $value;
            }
        }

        $data['data']       = $arrayData;
        $data['file']       = $parameters['file'];
        $data['nColumns']   = $highestColumnIndex;
        $data['nRows']      = $highestRow - 1;

        $data['javascriptView'] = 'comunik::pulsar.comunik.contactos.js.preview_import';

        return view('comunik::contacts.preview_import', $data);
    }

    public function importRecords(Request $request){
        $data           = [];
        $jsonData       = json_decode($request->input('data'), true);
        $grupos         = Grupo::all();
        $paises         = Pais::all();
        $gruposSelect   = Input::get('grupos');
        $paisSelect     = Input::get('pais');
        $fields         = array();
        $inputFileName  = public_path().'/packages/pulsar/pulsar/storage/tmp/'.$file;
        $paisObj        = null;

        if($paisSelect != 'null')
        {
            $paisObj = Pais::getPais($paisSelect, Session::get('idiomaBase')->id_001);
        }

        $objReader      = new \PHPExcel_Reader_CSV();       // Creamos un objeto CSV Reader

        $objReader->setReadDataOnly(true);                  // Configura el reader para ignorar estilos, solo leerá los datos
        $objReader->setDelimiter(";");                      // Configura el reader para tener en cuenta el ; como elmento separador
        $objPHPExcel    = $objReader->load($inputFileName); // Cargamos el fichero y obtenemos el objeto PHPExcel

        //$totalSheets = $objPHPExcel->getSheetCount();       // Función para obtener el número de libros de la hoja de cálculo
        //$allSheetName = $objPHPExcel->getSheetNames();      // Función para obtener los nombres de los libros de las hojas de cálculo

        $objWorksheet       = $objPHPExcel->setActiveSheetIndex(0); // Por defecto recuperamos el primer libro de la hoja de excel
        $highestRow         = $objWorksheet->getHighestRow();       // Recuperamos el número de fila más alto (dato numérico, empezando por 1)
        $highestColumn      = $objWorksheet->getHighestColumn();    // Recuperamos la columma mas alta (data string)
        $highestColumnIndex = \PHPExcel_Cell::columnIndexFromString($highestColumn);    // Pasamos del dato string de columna a un dato numérico

        $arrayDataFail = array();

        for ($row = 1; $row <= $highestRow; ++$row)
        {
            // comprobamos si esta fila no debe de ser insertada
            if(!in_array($row - 1, $jsonData['rowsDel']))
            {
                $dbRow = array();

                for ($col = 0; $col < $highestColumnIndex; ++$col)
                {
                    // validamos los datos comunes (grupo)
                    if($gruposSelect != null)
                    {
                        $grupo = $gruposSelect;
                        $dbRow['id_029'] = $grupo;
                    }

                    // validamos los datos comunes (pais)
                    if($paisSelect != 'null')
                    {
                        $dbRow['pais_030']  = $paisSelect;
                    }

                    // Damos formato a los datos a insertar
                    if (Input::get('column' . $col) == "nombre_030" || Input::get('column' . $col) == "apellidos_030")
                    {
                        // nombre y apellidos en minúsculas con la primera en mayúscula
                        $dbRow[Input::get('column' . $col)] = ucwords(strtolower($objWorksheet->getCellByColumnAndRow($col, $row)->getValue()));

                        // en la primera vuelta del bucle, obtenemos el campo que se graba para usarlo posteriormente para los datos erroneos
                        if($row == 1) $field = $this->searchField(Input::get('column' . $col), $jsonData['fields']);
                        if($row == 1 && Input::get('column' . $col) == "nombre_030")    array_push($fields, $field);
                        if($row == 1 && Input::get('column' . $col) == "apellidos_030") array_push($fields, $field);
                    }
                    elseif (Input::get('column' . $col) == "email_030")
                    {
                        // eliminamos espacios en blanco
                        // ponemos el mail en minúsculas
                        $dbRow[Input::get('column' . $col)] = trim(strtolower($objWorksheet->getCellByColumnAndRow($col, $row)->getValue()));

                        if($row == 1)   $field = $this->searchField(Input::get('column' . $col), $jsonData['fields']);
                        if($row == 1)   array_push($fields, $field);
                    }
                    elseif (Input::get('column' . $col) == "prefijo_030" && $paisObj == null)
                    {
                        // eliminamos espacios en blanco en el contenido
                        // ponemos el mail en minúsculas
                        $dbRow[Input::get('column' . $col)] = str_replace(' ', '', str_replace('-', '', $objWorksheet->getCellByColumnAndRow($col, $row)->getValue()));

                        if($row == 1)   $field = $this->searchField(Input::get('column' . $col), $jsonData['fields']);
                        if($row == 1)   array_push($fields, $field);
                    }
                    elseif (Input::get('column' . $col) == "movil_030")
                    {
                        // eliminamos espacios en blanco en el contenido
                        // ponemos el mail en minúsculas
                        $dbRow[Input::get('column' . $col)] = str_replace(' ', '', str_replace('-', '', $objWorksheet->getCellByColumnAndRow($col, $row)->getValue()));

                        if($row == 1)   $field = $this->searchField(Input::get('column' . $col), $jsonData['fields']);
                        if($row == 1)   array_push($fields, $field);
                    }
                    elseif ($gruposSelect == null && Input::get('column' . $col) == "id_029")
                    {
                        $grupo = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
                        $dbRow[Input::get('column' . $col)] = $grupo;

                        if($row == 1)   $field = $this->searchField(Input::get('column' . $col), $jsonData['fields']);
                        if($row == 1)   array_push($fields, $field);
                    }
                    elseif ($paisSelect == 'null' && Input::get('column' . $col) == "pais_030")
                    {
                        $dbRow[Input::get('column' . $col)] = trim(strtoupper($objWorksheet->getCellByColumnAndRow($col, $row)->getValue()));

                        if($row == 1)   $field = $this->searchField(Input::get('column' . $col), $jsonData['fields']);
                        if($row == 1)   array_push($fields, $field);
                    }
                }

                // asignación de prefijo si hay pais selecionado para todos los datos
                if($paisObj != null)
                {
                    $dbRow['prefijo_030'] = $paisObj->prefijo_002;
                }

                $rules = array(
                    'email_030'     => 'email',
                    'prefijo_030'   => 'numeric',
                    'movil_030'     => 'numeric|digits_between:6,15'
                );

                if(!array_key_exists('email_030', $dbRow) && array_key_exists('movil_030', $dbRow))
                {
                    $rules['movil_030'] = 'required|numeric|digits_between:6,15';
                }

                if(!array_key_exists('movil_030', $dbRow) && array_key_exists('email_030', $dbRow))
                {
                    $rules['email_030'] = 'required|email';
                }

                if(array_key_exists('movil_030', $dbRow) && array_key_exists('email_030', $dbRow) && $dbRow['movil_030'] == "" && $dbRow['email_030'] == "")
                {
                    $rules['movil_030'] = 'required|numeric|digits_between:6,15';
                    $rules['email_030'] = 'required|email';
                }

                if(!array_key_exists('movil_030', $dbRow) && !array_key_exists('email_030', $dbRow))
                {
                    $rules['movil_030'] = 'required|numeric|digits_between:6,15';
                    $rules['email_030'] = 'required|email';
                }

                // Realizamos una primara validación de los datos
                $validator = Validator::make($dbRow, $rules);

                if($validator->fails())
                {
                    $messages = $validator->messages();

                    $txtError = null;
                    foreach($messages->all() as $message)
                    {
                        if($txtError == null)
                        {
                            $txtError .= '* '.$message;
                        }
                        else
                        {
                            $txtError .= ' * '.$message;
                        }
                    }

                    array_push($arrayDataFail, array(
                        'row'       => $dbRow,
                        'message'   => $txtError
                    ));
                }
                elseif($paisSelect == 'null' && !isset($dbRow['pais_030']))
                {
                    array_push($arrayDataFail, array(
                        'row'       => $dbRow,
                        'message'   => 'No hay país asignado'
                    ));
                }
                elseif($paisSelect == 'null' && $paises->find($dbRow['pais_030']) == null)
                {
                    array_push($arrayDataFail, array(
                        'row'       => $dbRow,
                        'message'   => 'El país asignado no existe'
                    ));
                }
                elseif($gruposSelect == null && $grupos->find($grupo) == null)
                {
                    array_push($arrayDataFail, array(
                        'row'       => $dbRow,
                        'message'   => 'El grupo asignado no existe'
                    ));
                }
                else
                {
                    //realizamos la insercción en la base de datos
                    try
                    {
                        $contacto = Contacto::create($dbRow);
                        $contacto->grupos()->attach($grupo);
                    }
                    catch (\Exception $e)
                    {
                        array_push($arrayDataFail, array(
                            'row'       => $dbRow,
                            'message'   => $e->getMessage()
                        ));
                    }
                }
            }
        }

        $data['arrayDataFail']  = $arrayDataFail;
        $data['fields']         = $fields;

        return View::make('comunik::pulsar.comunik.contactos.error_import',$data);
    }
}