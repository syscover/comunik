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
        $data['fields']     = [
            (object)['id' => 'id_040',      'name' => trans('comunik::pulsar.group_id')],
            (object)['id' => 'company_041', 'name' => trans('pulsar::pulsar.company')],
            (object)['id' => 'name_041',    'name' => trans('pulsar::pulsar.name')],
            (object)['id' => 'surname_041', 'name' => trans('pulsar::pulsar.surname')],
            (object)['id' => 'country_041', 'name' => trans('comunik::pulsar.country_id')],
            (object)['id' => 'prefix_041',  'name' => trans('pulsar::pulsar.prefix')],
            (object)['id' => 'mobile_041',  'name' => trans('pulsar::pulsar.mobile')],
            (object)['id' => 'email_041',   'name' => trans('pulsar::pulsar.email')]
        ];

        $objReader =  \PHPExcel_IOFactory::createReader('CSV')
            ->setDelimiter(";")                                         // configura el reader para tener en los ';' como elemento separador
            ->setReadDataOnly(true);                                    // configura el reader para ignorar estilos, solo leerá los datos

        $objPHPExcel    = $objReader->load($inputFileName);             // cargamos el fichero y obtenemos el objeto PHPExcel

        //$totalSheets = $objPHPExcel->getSheetCount();       // función para obtener el número de libros de la hoja de cálculo
        //$allSheetName = $objPHPExcel->getSheetNames();      // función para obtener los nombres de los libros de las hojas de cálculo

        $objWorksheet       = $objPHPExcel->setActiveSheetIndex(0);     // Por defecto recuperamos el primer libro de la hoja de excel
        $highestRow         = $objWorksheet->getHighestRow();           // Recuperamos el número de fila más alto (dato numérico, empezando por 1)
        $highestColumn      = $objWorksheet->getHighestColumn();        // Recuperamos la columma mas alta (data string)
        $highestColumnIndex = \PHPExcel_Cell::columnIndexFromString($highestColumn); // Pasamos del dato string de columna a un dato numérico

        // limitamos las filas para ralizar un preview
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

        return view('comunik::contacts.preview_import', $data);
    }

    public function importRecords(Request $request){
        $data           = [];
        $jsonData       = json_decode($request->input('data'));
        $groups         = $request->input('groups');
        $country        = $request->input('country');

        $fields         = [];
        $inputFileName  = public_path() . '/packages/pulsar/pulsar/storage/tmp/' . $file;

        if(!empty($country))
            $country = Country::getTranslationRecord($country, $request->user()->lang_010);


        $objReader =  \PHPExcel_IOFactory::createReader('CSV')
            ->setDelimiter(";")                                     // configura el reader para tener en los ';' como elemento separador
            ->setReadDataOnly(true);                                // configura el reader para ignorar estilos, solo leerá los datos

        $objPHPExcel    = $objReader->load($inputFileName);         // Cargamos el fichero y obtenemos el objeto PHPExcel

        //$totalSheets = $objPHPExcel->getSheetCount();       // Función para obtener el número de libros de la hoja de cálculo
        //$allSheetName = $objPHPExcel->getSheetNames();      // Función para obtener los nombres de los libros de las hojas de cálculo

        $objWorksheet       = $objPHPExcel->setActiveSheetIndex(0); // Por defecto recuperamos el primer libro de la hoja de excel
        $highestRow         = $objWorksheet->getHighestRow();       // Recuperamos el número de fila más alto (dato numérico, empezando por 1)
        $highestColumn      = $objWorksheet->getHighestColumn();    // Recuperamos la columma mas alta (data string)
        $highestColumnIndex = \PHPExcel_Cell::columnIndexFromString($highestColumn);    // Pasamos del dato string de columna a un dato numérico

        $arrayDataFail = [];

        for ($row = 1; $row <= $highestRow; ++$row)
        {
            // comprobamos si esta fila no debe de ser insertada
            if(!in_array($row - 1, $jsonData['rowsDel']))
            {
                $dbRow = [];

                for ($col = 0; $col < $highestColumnIndex; ++$col)
                {
                    // validamos los datos comunes (group)
                    if(!empty($groups))
                    {
                        $dbRow['id_040'] = $groups;
                    }

                    // validamos los datos comunes (country)
                    if(!empty($selectCountry))
                    {
                        $dbRow['country_041']  = $country->id_002;
                    }

                    // damos formato a los datos a insertar
                    if ($request->input('column' . $col) == "name_041" || $request->input('column' . $col) == "surname_041")
                    {
                        // nombre y apellidos en minúsculas con la primera en mayúscula
                        $dbRow[$request->input('column' . $col)] = ucwords(strtolower($objWorksheet->getCellByColumnAndRow($col, $row)->getValue()));

                        // en la primera vuelta del bucle, obtenemos el campo que se graba para usarlo posteriormente para los datos erroneos
                        if($row == 1) $field = $this->searchField($request->input('column' . $col), $jsonData['fields']);
                        if($row == 1 && $request->input('column' . $col) == "name_041")    array_push($fields, $field);
                        if($row == 1 && $request->input('column' . $col) == "surname_041") array_push($fields, $field);
                    }
                    elseif ($request->input('column' . $col) == "email_041")
                    {
                        // eliminamos espacios en blanco y ponemos el mail en minúsculas
                        $dbRow[$request->input('column' . $col)] = trim(strtolower($objWorksheet->getCellByColumnAndRow($col, $row)->getValue()));

                        if($row == 1)   $field = $this->searchField($request->input('column' . $col), $jsonData['fields']);
                        if($row == 1)   $fields[] = $field;
                    }
                    elseif ($request->input('column' . $col) == "prefix_041" && $paisObj == null)
                    {
                        // eliminamos espacios en blanco en el contenido
                        // ponemos el mail en minúsculas
                        $dbRow[$request->input('column' . $col)] = str_replace(' ', '', str_replace('-', '', $objWorksheet->getCellByColumnAndRow($col, $row)->getValue()));

                        if($row == 1)   $field = $this->searchField($request->input('column' . $col), $jsonData['fields']);
                        if($row == 1)   array_push($fields, $field);
                    }
                    elseif ($request->input('column' . $col) == "movil_030")
                    {
                        // eliminamos espacios en blanco en el contenido
                        // ponemos el mail en minúsculas
                        $dbRow[$request->input('column' . $col)] = str_replace(' ', '', str_replace('-', '', $objWorksheet->getCellByColumnAndRow($col, $row)->getValue()));

                        if($row == 1)   $field = $this->searchField($request->input('column' . $col), $jsonData['fields']);
                        if($row == 1)   array_push($fields, $field);
                    }
                    elseif ($gruposSelect == null && $request->input('column' . $col) == "id_029")
                    {
                        $grupo = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
                        $dbRow[$request->input('column' . $col)] = $grupo;

                        if($row == 1)   $field = $this->searchField($request->input('column' . $col), $jsonData['fields']);
                        if($row == 1)   array_push($fields, $field);
                    }
                    elseif ($paisSelect == 'null' && $request->input('column' . $col) == "pais_030")
                    {
                        $dbRow[$request->input('column' . $col)] = trim(strtoupper($objWorksheet->getCellByColumnAndRow($col, $row)->getValue()));

                        if($row == 1)   $field = $this->searchField($request->input('column' . $col), $jsonData['fields']);
                        if($row == 1)   array_push($fields, $field);
                    }
                }

                // asignación de prefijo si hay pais selecionado para todos los datos
                if($paisObj != null)
                    $dbRow['prefix_041'] = $country->prefix_002;

                $rules = [
                    'email_041'     => 'email',
                    'prefix_041'    => 'numeric',
                    'mobile_041'    => 'numeric|digits_between:6,15'
                ];

                if(!array_key_exists('email_041', $dbRow) && array_key_exists('mobile_041', $dbRow))
                {
                    $rules['mobile_041']    = 'required|numeric|digits_between:6,15';
                }

                if(!array_key_exists('mobile_041', $dbRow) && array_key_exists('email_041', $dbRow))
                {
                    $rules['email_041']     = 'required|email';
                }

                if(array_key_exists('mobile_041', $dbRow) && array_key_exists('email_041', $dbRow) && $dbRow['mobile_041'] == "" && $dbRow['email_041'] == "")
                {
                    $rules['mobile_041']    = 'required|numeric|digits_between:6,15';
                    $rules['email_041']     = 'required|email';
                }

                if(!array_key_exists('mobile_041', $dbRow) && !array_key_exists('email_041', $dbRow))
                {
                    $rules['mobile_041']    = 'required|numeric|digits_between:6,15';
                    $rules['email_041']     = 'required|email';
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

                    $arrayDataFail[] = [
                        'row'       => $dbRow,
                        'message'   => $txtError
                    ];
                }
                elseif($paisSelect == 'null' && !isset($dbRow['pais_030']))
                {
                    $arrayDataFail[] = [
                        'row'       => $dbRow,
                        'message'   => 'No hay país asignado'
                    ];
                }
                elseif($paisSelect == 'null' && $paises->find($dbRow['pais_030']) == null)
                {
                    $arrayDataFail[] = [
                        'row'       => $dbRow,
                        'message'   => 'El país asignado no existe'
                    ];
                }
                elseif($gruposSelect == null && $grupos->find($grupo) == null)
                {
                    $arrayDataFail[] = [
                        'row'       => $dbRow,
                        'message'   => 'El grupo asignado no existe'
                    ];
                }
                else
                {
                    dd($dbRow);

                    //realizamos la insercción en la base de datos
                    try
                    {
                        $contact = Contact::create($dbRow);
                        $contact->groups()->attach($groups);
                    }
                    catch (\Exception $e)
                    {
                        $arrayDataFail[] = [
                            'row'       => $dbRow,
                            'message'   => $e->getMessage()
                        ];
                    }
                }
            }
        }

        $data['arrayDataFail']  = $arrayDataFail;
        $data['fields']         = $fields;

        return view('comunik::pulsar.comunik.contactos.error_import', $data);
    }

    private function readCSV($file){

    }
}