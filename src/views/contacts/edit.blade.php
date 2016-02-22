@extends('pulsar::layouts.form', ['action' => 'update'])

@section('head')
    @parent
    <!-- comunik::contacts.create -->
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/plugins/bootstrap-inputmask/jquery.inputmask.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/getaddress/js/jquery.getaddress.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $('[name="country"]').data('language', '{{ config('app.locale') }}')

            $.getAddress({
                id:                         '01',
                type:                       'laravel',
                appName:                    'pulsar',
                token:                      '{{ csrf_token() }}',
                lang:                       '{{ config('app.locale') }}',
                highlightCountrys:          ['ES','US'],

                useSeparatorHighlight:      true,
                textSeparatorHighlight:     '------------------',

                countryValue:               '{{ $object->country_041 }}'
            });
        });
    </script>
    <!-- comunik::contacts.create -->
@stop

@section('rows')
    <!-- comunik::contacts.create -->
    @include('pulsar::includes.html.form_text_group', ['label' => 'ID', 'value' => $object->id_041, 'name' => 'id', 'readOnly' => true, 'fieldSize' => 2])
    @include('pulsar::includes.html.form_select_group', ['label' => trans_choice('pulsar::pulsar.group', 2), 'value' => $object->getGroups, 'name' => 'groups[]', 'objects' => $groups, 'idSelect' => 'id_040', 'nameSelect' => 'name_040', 'multiple' => true, 'required' => true, 'class' => 'col-md-12 select2', 'data' => ['placeholder' => 'Seleccione las categorías correspondientes']])
    @include('pulsar::includes.html.form_text_group', ['label' => trans_choice('pulsar::pulsar.company', 1), 'name' => 'company', 'value' => $object->company_041, 'maxLength' => '100', 'rangeLength' => '2,100'])
    @include('pulsar::includes.html.form_text_group', ['label' => trans('pulsar::pulsar.name'), 'name' => 'name', 'value' => $object->name_041, 'maxLength' => '50', 'rangeLength' => '2,50', 'required' => true])
    @include('pulsar::includes.html.form_text_group', ['label' => trans('pulsar::pulsar.surname'), 'name' => 'surname', 'value' => $object->surname_041, 'maxLength' => '50', 'rangeLength' => '2,50'])
    @include('pulsar::includes.html.form_text_group', ['label' => trans('pulsar::pulsar.birth_date'), 'name' => 'birthdate', 'value' => $object->birth_date_041? date('d-m-Y', $object->birth_date_041) : null, 'fieldSize' => 2, 'data' => ['mask' => '99-99-9999']])
    @include('pulsar::includes.html.form_select_group', ['label' => trans_choice('pulsar::pulsar.country', 1), 'name' => 'country', 'idSelect' => 'id_002', 'nameSelect' => 'name_002', 'class' => 'select2', 'fieldSize' => 4, 'required' => true, 'data' => ['width' => '100%']])
    @include('pulsar::includes.html.form_text_group', ['label' => trans('pulsar::pulsar.email'), 'name' => 'email', 'value' => $object->email_041, 'maxLength' => '50', 'rangeLength' => '2,50', 'type' => 'email', 'required' => true])
    @include('pulsar::includes.html.form_text_group', ['label' => trans('pulsar::pulsar.mobile'), 'name' => 'prefix', 'value' => $object->prefix_041, 'maxLength' => '5', 'rangeLength' => '0,5', 'fieldSize' => 2, 'placeholder' => trans('comunik::pulsar.international_prefix'), 'inputs' => [['name' => 'mobile', 'value' => $object->mobile_041, 'maxLength' => '50', 'rangeLength' => '2,50', 'fieldSize' => 8]]])
    @include('pulsar::includes.html.form_checkbox_group', ['label' => trans('comunik::pulsar.unsubscribe') . ' ' . trans('pulsar::pulsar.email'), 'fieldSize' => 3, 'name' => 'unsubscribeEmail', 'value' => 1, 'checked' => $object->unsubscribe_email_041, 'inputs' => [
        ['label' => trans('comunik::pulsar.unsubscribe') . ' ' .trans('pulsar::pulsar.mobile'), 'fieldSize' => 3, 'name' => 'unsubscribeMobile', 'value' => 1, 'checked' => $object->unsubscribe_mobile_041]
    ]])
    <!-- /comunik::contacts.create -->
@stop