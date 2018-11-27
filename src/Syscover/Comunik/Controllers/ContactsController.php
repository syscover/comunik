<?php namespace Syscover\Comunik\Controllers;

use Syscover\Pulsar\Core\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Syscover\Comunik\Models\Group;
use Syscover\Pulsar\Models\Country;
use Syscover\Comunik\Models\Contact;

/**
 * Class ContactsController
 * @package Syscover\Comunik\Controllers
 */

class ContactsController extends Controller
{
    protected $routeSuffix  = 'comunikContact';
    protected $folder       = 'contact';
    protected $package      = 'comunik';
    protected $indexColumns = ['id_041', 'name_041', 'surname_041', 'name_002', 'mobile_041', ['data' => 'email_041', 'type' => 'email'], ['data' => 'unsubscribe_email_041', 'type' => 'invertActive'], 'name_040'];
    protected $nameM        = 'name_041';
    protected $model        = Contact::class;
    protected $icon         = 'fa fa-user';
    protected $objectTrans  = 'contact';


    public function createCustomRecord($parameters)
    {
        $parameters['groups'] = Group::all();

        return $parameters;
    }

    public function storeCustomRecord($parameters)
    {
        $contact = Contact::create([
            'company_041'               => empty($this->request->input('company'))? null : $this->request->input('company'),
            'name_041'                  => $this->request->input('name'),
            'surname_041'               => $this->request->input('surname'),
            'birth_date_041'            => $this->request->input('birthDate')? \DateTime::createFromFormat(config('pulsar.datePattern'), $this->request->input('birthDate'))->getTimestamp() : null,
            'birth_date_text_041'       => $this->request->input('birthDate')? $this->request->input('birthDate') : null,
            'country_id_041'            => $this->request->input('country'),
            'prefix_041'                => $this->request->input('prefix'),
            'mobile_041'                => $this->request->has('mobile')? str_replace('-', '', $this->request->input('mobile')) : null,
            'email_041'                 => strtolower($this->request->input('email')),
            'unsubscribe_mobile_041'    => $this->request->has('unsubscribeMobile'),
            'unsubscribe_email_041'     => $this->request->has('unsubscribeEmail'),
        ]);

        $contact->getGroups()->attach($this->request->input('groups'));
    }

    public function editCustomRecord($parameters)
    {
        $parameters['groups'] = Group::all();

        return $parameters;
    }

    public function checkSpecialRulesToUpdate($parameters)
    {
        $contact = Contact::find($parameters['id']);

        $parameters['specialRules']['emailRule']    = $this->request->input('email') == $contact->email_041? true : false;
        $parameters['specialRules']['mobileRule']   = $this->request->input('mobile') == $contact->mobile_041? true : false;

        return $parameters;
    }
    
    public function updateCustomRecord($parameters)
    {
        Contact::where('id_041', $parameters['id'])->update([
            'company_041'               => empty($this->request->input('company'))? null : $this->request->input('company'),
            'name_041'                  => $this->request->input('name'),
            'surname_041'               => $this->request->input('surname'),
            'birth_date_041'            => $this->request->input('birthDate')? \DateTime::createFromFormat(config('pulsar.datePattern'), $this->request->input('birthDate'))->getTimestamp() : null,
            'birth_date_text_041'       => $this->request->input('birthDate')? $this->request->input('birthDate') : null,
            'country_id_041'            => $this->request->input('country'),
            'prefix_041'                => $this->request->input('prefix'),
            'mobile_041'                => $this->request->has('mobile')? str_replace('-', '', $this->request->input('mobile')) : null,
            'email_041'                 => strtolower($this->request->input('email')),
            'unsubscribe_mobile_041'    => $this->request->has('unsubscribeMobile'),
            'unsubscribe_email_041'     => $this->request->has('unsubscribeEmail')
        ]);

        $contact = Contact::find($parameters['id']);

        $contact->getGroups()->sync($this->request->input('groups'));
    }

    public function getEmailToUnsubscribe()
    {
        // get parameters from url route
        $parameters = $this->request->route()->parameters();

        // if it's a test email, we brake execution
        if($parameters['contactKey'] === '0') exit;

        $contact = Contact::find(Crypt::decrypt($parameters['contactKey']));

        // from contactKey, we get contact and key for unsubscribe the contact
        return view('comunik::contact.unsubscribe', ['key' => $parameters['contactKey'], 'contact' => $contact]);
    }

    public function unsubscribeEmail()
    {
        $contact = Contact::find(Crypt::decrypt($this->request->input('key')));
        
        Contact::where('id_041', $contact->id_041)->update([
            'unsubscribe_email_041' => true
        ]);

        return view('comunik::contact.unsubscribe', ['contact' => $contact, 'unsubscribe' => true]);
    }

    public function importRecordsPreview()
    {
        // get parameters from url route
        $parameters = $this->request->route()->parameters();

        $data['groups']     = Group::all();
        $inputFileName      = public_path() . '/packages/syscover/pulsar/storage/tmp/' . $parameters['file'];
        $fields             = [
            'id_040'            => trans('comunik::pulsar.group_id'),
            'company_041'       => trans_choice('pulsar::pulsar.company', 1),
            'name_041'          => trans('pulsar::pulsar.name'),
            'surname_041'       => trans('pulsar::pulsar.surname'),
            'country_id_041'    => trans('comunik::pulsar.country_id'),
            'mobile_041'        => trans('pulsar::pulsar.mobile'),
            'email_041'         => trans('pulsar::pulsar.email')
        ];

        $objReader =  \PHPExcel_IOFactory::createReader('CSV')
            ->setDelimiter(';')                                         // configura el reader para tener en los ';' como elemento separador
            ->setReadDataOnly(true);                                    // configura el reader para ignorar estilos, solo leerá los datos

        $objPHPExcel    = $objReader->load($inputFileName);             // cargamos el fichero y obtenemos el objeto PHPExcel

        //$totalSheets = $objPHPExcel->getSheetCount();                 // función para obtener el número de libros de la hoja de cálculo
        //$allSheetName = $objPHPExcel->getSheetNames();                // función para obtener los nombres de los libros de las hojas de cálculo

        $objWorksheet       = $objPHPExcel->setActiveSheetIndex(0);     // Por defecto recuperamos el primer libro de la hoja de excel
        $highestRow         = $objWorksheet->getHighestRow();           // Recuperamos el número de fila más alto (dato numérico, empezando por 1)
        $highestColumn      = $objWorksheet->getHighestColumn();        // Recuperamos la columma mas alta (data string)
        $highestColumnIndex = \PHPExcel_Cell::columnIndexFromString($highestColumn); // Pasamos del dato string de columna a un dato numérico

        // limitamos las filas para ralizar un preview
        if($highestRow > 20) $highestRow = 20;  // obtenemos las 20 primeras filas

        for ($row = 1; $row <= $highestRow; ++$row)
        {
            for ($col = 0; $col < $highestColumnIndex; ++$col)
            {
                $value = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
                $arrayData[$row-1][$col] = $value;
            }
        }

        $data['data']       = $arrayData;
        $data['fields']     = $fields;
        $data['file']       = $parameters['file'];
        $data['nColumns']   = $highestColumnIndex;
        $data['nRows']      = $highestRow;

        return view('comunik::contact.import_preview', $data);
    }

    public function importRecords(){
        $data           = [];
        $jsonData       = json_decode($this->request->input('data'));
        $countries      = Country::where('lang_id_002', auth()->guard('pulsar')->user()->lang_id_010)->get();
        $groups         = $this->request->input('groups');
        $country        = $this->request->input('country');

        $inputFileName  = public_path() . '/packages/syscover/pulsar/storage/tmp/' . $this->request->input('file');
        $fields     = [
            'id_040'            => trans('comunik::pulsar.group_id'),
            'company_041'       => trans_choice('pulsar::pulsar.company', 1),
            'name_041'          => trans('pulsar::pulsar.name'),
            'surname_041'       => trans('pulsar::pulsar.surname'),
            'country_id_041'    => trans('comunik::pulsar.country_id'),
            'mobile_041'        => trans('pulsar::pulsar.mobile'),
            'email_041'         => trans('pulsar::pulsar.email')
        ];
        $columns         = [];

        $objReader =  \PHPExcel_IOFactory::createReader('CSV')
            ->setDelimiter(';')                                     // configura el reader para tener en los ';' como elemento separador
            ->setReadDataOnly(true);                                // configura el reader para ignorar estilos, solo leerá los datos

        $objPHPExcel    = $objReader->load($inputFileName);         // Cargamos el fichero y obtenemos el objeto PHPExcel

        //$totalSheets = $objPHPExcel->getSheetCount();       // Función para obtener el número de libros de la hoja de cálculo
        //$allSheetName = $objPHPExcel->getSheetNames();      // Función para obtener los nombres de los libros de las hojas de cálculo

        $objWorksheet       = $objPHPExcel->setActiveSheetIndex(0); // Por defecto recuperamos el primer libro de la hoja de excel
        $highestRow         = $objWorksheet->getHighestRow();       // Recuperamos el número de fila más alto (dato numérico, empezando por 1)
        $highestColumn      = $objWorksheet->getHighestColumn();    // Recuperamos la columma mas alta (data string)
        $highestColumnIndex = \PHPExcel_Cell::columnIndexFromString($highestColumn);    // Pasamos del dato string de columna a un dato numérico

        $arrayDataFail = [];

        $firsRow = true;
        for ($row = 1; $row <= $highestRow; ++$row)
        {
            // comprobamos si esta fila no debe de ser insertada
            if(!in_array($row - 1, $jsonData->deleteRows))
            {
                $dbRow = [];

                // recorremos las columnas y según coincida el campo con una columna lo agregamos al array $dbRow
                // para insertar la fila en la base de datos, tratando previamente el dato
                $checkCommonField = false;
                for ($col = 0; $col < $highestColumnIndex; ++$col)
                {
                    if($firsRow && isset($fields[$this->request->input('column' . $col)]))
                        // get sorting columns
                        $columns[$this->request->input('column' . $col)] = $fields[$this->request->input('column' . $col)];

                    // damos formato a los datos a insertar
                    if ($this->request->input('column' . $col) == 'name_041' || $this->request->input('column' . $col) == 'surname_041' || $this->request->input('column' . $col) == 'company_041')
                    {
                        // nombre y apellidos en minúsculas con la primera en mayúscula
                        $dbRow[$this->request->input('column' . $col)] = ucwords(strtolower($objWorksheet->getCellByColumnAndRow($col, $row)->getValue()));

                    }
                    elseif ($this->request->input('column' . $col) == 'email_041')
                    {
                        // eliminamos espacios en blanco y ponemos el mail en minúsculas
                        $dbRow['email_041'] = trim(strtolower($objWorksheet->getCellByColumnAndRow($col, $row)->getValue()));
                    }
                    elseif ($this->request->input('column' . $col) == 'mobile_041')
                    {
                        // eliminamos espacios en blanco en el contenido y ponemos el email en minúsculas
                        $dbRow['mobile_041'] = str_replace(' ', '', str_replace('-', '', $objWorksheet->getCellByColumnAndRow($col, $row)->getValue()));
                    }
                    elseif (empty($groups) && $this->request->input('column' . $col) == 'id_040')
                    {
                        // instanciamos $group para después insertarlo en la tabla 005_042_contacts_groups
                        // siempre y cuando no se elia un grupo para todas las filas
                        $dbRow['id_040'] = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
                    }
                    elseif (empty($country) && $this->request->input('column' . $col) == 'country_id_041')
                    {
                        $dbRow['country_id_041']   = trim(strtoupper($objWorksheet->getCellByColumnAndRow($col, $row)->getValue()));
                        $countryObj             = $countries->find($dbRow['country_id_041']);
                        if($countryObj != null)
                            $dbRow['prefix_041']    = $countryObj->prefix_002;
                    }

                    // comprobamos si debemos instanciar los datos comunes una vez en cada fila
                    if(!$checkCommonField)
                    {
                        if(!empty($groups))
                        {
                            // instanciamos los datos comunes de groups
                            $dbRow['id_040'] = $groups;
                        }
                        if(!empty($country))
                        {
                            // instanciamos los datos comunes de country
                            $country                    = $countries->find($country);
                            $dbRow['country_id_041']    = $country->id_002;
                            $dbRow['prefix_041']        = $country->prefix_002;
                        }
                        $checkCommonField = true;
                    }
                }

                // check data from server side
                $rules = [
                    'email_041'         => 'email|between:2,50|unique:mysql2.005_041_contact,email_041',
                    'prefix_041'        => 'numeric|digits_between:0,5',
                    'mobile_041'        => 'numeric|digits_between:2,50|unique:mysql2.005_041_contact,mobile_041',
                    'country_id_041'    => 'required|exists:001_002_country,id_002',
                    'id_040'            => 'required'
                ];

                // si no tenemos instaciado un grupo para todas las filas, añadimos la comprobación
                // de lo contrari, $group contendría un array al ser selección múltiple,
                // y en la validación siempre daría error
                if(empty($groups))
                    $rules['id_040']    = 'required|exists:005_040_group,id_040';

                if(!array_key_exists('email_041', $dbRow) && array_key_exists('mobile_041', $dbRow))
                    $rules['mobile_041']    = 'required|numeric|digits_between:2,50|unique:mysql2.005_041_contact,mobile_041';

                if(!array_key_exists('mobile_041', $dbRow) && array_key_exists('email_041', $dbRow))
                    $rules['email_041']     = 'required|email|between:2,50|unique:mysql2.005_041_contact,email_041';

                //if(array_key_exists('mobile_041', $dbRow) && array_key_exists('email_041', $dbRow) && empty($dbRow['mobile_041']) && empty($dbRow['email_041']))
                if((array_key_exists('mobile_041', $dbRow) && array_key_exists('email_041', $dbRow)) || (!array_key_exists('mobile_041', $dbRow) && !array_key_exists('email_041', $dbRow)))
                {
                    $rules['mobile_041']    = 'required|numeric|digits_between:6,15|unique:mysql2.005_041_contact,mobile_041';
                    $rules['email_041']     = 'required|email|between:2,50|unique:mysql2.005_041_contact,email_041';
                }

                // cargamos la validación de los datos para la fila a insertar
                $validator = Validator::make($dbRow, $rules);
                $validator->setAttributeNames($fields);

                if($validator->fails())
                {
                    $messages = $validator->messages();

                    // recojemos todos los errores de la fila y los añadimos
                    $errors = [];
                    foreach($messages->all() as $message)
                    {
                        $errors[] = $message;
                    }

                    $arrayDataFail[] = [
                        'row'       => $dbRow,
                        'errors'    => $errors
                    ];
                }
                else
                {
                    //realizamos la insercción en la base de datos
                    try
                    {
                        $contact = Contact::create($dbRow);
                        $contact->getGroups()->attach($dbRow['id_040']);
                    }
                    catch (\Exception $e)
                    {
                        $arrayDataFail[] = [
                            'row'       => $dbRow,
                            'errors'    => [$e->getMessage()]
                        ];
                    }
                }

                // set firs row to false
                $firsRow = false;
            }
        }

        $data['arrayDataFail']  = $arrayDataFail;
        $data['columns']        = $columns;

        return view('comunik::contact.import_error', $data);
    }
}