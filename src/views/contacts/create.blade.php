@extends('pulsar::layouts.form', ['action' => 'store'])

@section('script')
    @parent
    <!-- comunik::contacts.create -->
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/jquery.select2/css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/jquery.select2.custom/css/select2.css') }}">

    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/plugins/bootstrap-inputmask/jquery.inputmask.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/jquery.select2.custom/js/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/jquery.select2/js/i18n/' . config('app.locale') . '.js') }}"></script>
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

                countryValue:               '{{ Input::old('country') }}'
            });
        });
    </script>
    <!-- comunik::contacts.create -->
@stop

@section('rows')
    <!-- comunik::contacts.create -->
    @include('pulsar::includes.html.form_text_group', ['label' => 'ID', 'name' => 'id', 'readOnly' => true, 'fieldSize' => 2])
    @include('pulsar::includes.html.form_select_group', ['label' => trans_choice('pulsar::pulsar.group', 2), 'name' => 'groups[]', 'value' => Input::old('groups'), 'objects' => $groups, 'idSelect' => 'id_029', 'nameSelect' => 'name_029', 'multiple' => true, 'class' => 'col-md-12 select2', 'data' => ['placeholder' => 'Seleccione las categorías correspondientes']])
    @include('pulsar::includes.html.form_text_group', ['label' => trans('pulsar::pulsar.company'), 'name' => 'company', 'value' => Input::old('company'), 'maxLength' => '100', 'rangeLength' => '2,100'])
    @include('pulsar::includes.html.form_text_group', ['label' => trans('pulsar::pulsar.name'), 'name' => 'name', 'value' => Input::old('name'), 'maxLength' => '50', 'rangeLength' => '2,50'])
    @include('pulsar::includes.html.form_text_group', ['label' => trans('pulsar::pulsar.surname'), 'name' => 'surname', 'value' => Input::old('surname'), 'maxLength' => '50', 'rangeLength' => '2,50'])
    @include('pulsar::includes.html.form_text_group', ['label' => trans('pulsar::pulsar.birthdate'), 'name' => 'birthdate', 'value' => Input::old('birthdate'), 'fieldSize' => 2, 'data' => ['mask' => '99-99-9999']])
    @include('pulsar::includes.html.form_select_group', ['label' => trans_choice('pulsar::pulsar.country', 1), 'name' => 'country', 'idSelect' => 'id_002', 'nameSelect' => 'name_002', 'class' => 'select2', 'fieldSize' => 4])
    @include('pulsar::includes.html.form_text_group', ['label' => trans('pulsar::pulsar.email'), 'name' => 'email', 'value' => Input::old('email'), 'maxLength' => '50', 'rangeLength' => '2,50', 'type' => 'email'])
    @include('pulsar::includes.html.form_text_group', ['label' => trans('pulsar::pulsar.mobile'), 'name' => 'prefix', 'value' => Input::old('prefix'), 'maxLength' => '5', 'rangeLength' => '0,5', 'fieldSize' => 2, 'placeholder' => trans('comunik::pulsar.international_prefix'), 'inputs' => [['name' => 'mobile', 'value' => Input::old('mobile'), 'maxLength' => '50', 'rangeLength' => '2,50', 'fieldSize' => 8]]])
    <!-- /comunik::contacts.create -->
@stop