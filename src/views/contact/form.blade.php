@extends('pulsar::layouts.form')

@section('head')
    @parent
    <!-- comunik::contact.create -->
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">

    <script src="{{ asset('packages/syscover/pulsar/vendor/datetimepicker/js/moment.min.js') }}"></script>
    <script src="{{ asset('packages/syscover/pulsar/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('packages/syscover/pulsar/plugins/bootstrap-inputmask/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('packages/syscover/pulsar/vendor/getaddress/js/jquery.getaddress.js') }}"></script>
    <script>
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

                countryValue:               '{{ old('country', isset($object->country_id_041)? $object->country_id_041 : null) }}'
            })
        })
    </script>
    <!-- /.comunik::contact.create -->
@stop

@section('rows')
    <!-- comunik::contact.create -->
    @include('pulsar::includes.html.form_text_group', [
        'label' => 'ID',
        'name' => 'id',
        'value' => isset($object->id_041)? $object->id_041 : null,
        'readOnly' => true,
        'fieldSize' => 2
    ])
    @include('pulsar::includes.html.form_select_group', [
        'label' => trans_choice('pulsar::pulsar.group', 2),
        'name' => 'groups[]',
        'value' => old('groups', isset($object)? $object->getGroups : null),
        'objects' => $groups,
        'idSelect' => 'id_040',
        'nameSelect' => 'name_040',
        'multiple' => true,
        'required' => true,
        'class' => 'col-md-12 select2',
        'data' => [
            'placeholder' => 'Seleccione las categorías correspondientes'
        ]
    ])
    @include('pulsar::includes.html.form_text_group', [
        'label' => trans_choice('pulsar::pulsar.company', 1),
        'name' => 'company',
        'value' => old('company', isset($object->company_041)? $object->company_041 : null),
        'maxLength' => '100',
        'rangeLength' => '2,100'
    ])
    @include('pulsar::includes.html.form_text_group', [
        'label' => trans('pulsar::pulsar.name'),
        'name' => 'name',
        'value' => old('name', isset($object->name_041)? $object->name_041 : null),
        'maxLength' => '50',
        'rangeLength' => '2,50',
        'required' => true
    ])
    @include('pulsar::includes.html.form_text_group', [
        'label' => trans('pulsar::pulsar.surname'),
        'name' => 'surname',
        'value' => old('surname', isset($object->name_041)? $object->name_041 : null),
        'maxLength' => '50',
        'rangeLength' => '2,50'
    ])
    @include('pulsar::includes.html.form_datetimepicker_group', [
        'fieldSize' => 4,
        'label' => trans('pulsar::pulsar.birth_date'),
        'name' => 'birthDate',
        'data' => [
            'format' => Miscellaneous::convertFormatDate(config('pulsar.datePattern')),
            'locale' => config('app.locale'),
            'default-date' => old('birthDate', isset($object->birth_date_041)? date('Y-m-d', $object->birth_date_041) : null)
        ]
    ])
    @include('pulsar::includes.html.form_select_group', [
        'label' => trans_choice('pulsar::pulsar.country', 1),
        'name' => 'country',
        'idSelect' => 'id_002',
        'nameSelect' => 'name_002',
        'class' => 'select2',
        'fieldSize' => 4,
        'required' => true,
        'data' => [
            'width' => '100%'
        ]
    ])
    @include('pulsar::includes.html.form_text_group', [
        'label' => trans('pulsar::pulsar.email'),
        'name' => 'email',
        'value' => old('email', isset($object->email_041)? $object->email_041 : null),
        'maxLength' => '255',
        'rangeLength' => '2,255',
        'type' => 'email',
        'required' => true
    ])
    @include('pulsar::includes.html.form_text_group', [
        'label' => trans('pulsar::pulsar.mobile'),
        'name' => 'prefix',
        'value' => old('prefix', isset($object->prefix_041)? $object->prefix_041 : null),
        'maxLength' => '5',
        'rangeLength' => '0,5',
        'fieldSize' => 2,
        'placeholder' => trans('comunik::pulsar.international_prefix'),
        'inputs' => [
            [
                'name' => 'mobile',
                'value' => old('mobile', isset($object->mobile_041)? $object->mobile_041 : null),
                'maxLength' => '50',
                'rangeLength' => '2,50',
                'fieldSize' => 8
            ]
        ]
    ])
    @include('pulsar::includes.html.form_checkbox_group', [
        'label' => trans('comunik::pulsar.unsubscribe') . ' ' . trans('pulsar::pulsar.email'),
        'fieldSize' => 3, 'name' => 'unsubscribeEmail',
        'value' => 1,
        'checked' => old('unsubscribeEmail', isset($object->unsubscribe_email_041)? $object->unsubscribe_email_041 : null),
        'inputs' => [
            [
                'label' => trans('comunik::pulsar.unsubscribe') . ' ' .trans('pulsar::pulsar.mobile'),
                'fieldSize' => 3,
                'name' => 'unsubscribeMobile',
                'value' => 1,
                'checked' => old('unsubscribeMobile', isset($object->unsubscribe_mobile_041)? $object->unsubscribe_mobile_041 : null)
            ]
        ]
    ])
    <!-- /.comunik::contact.create -->
@stop