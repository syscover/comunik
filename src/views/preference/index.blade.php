@extends('pulsar::layouts.form', ['action' => 'update'])

@section('head')
    @parent
    <!-- comunik::preferences.index -->
    @include('pulsar::includes.js.messages')

    <script>
        $(document).ready(function() {
            $(".custom-select2").select2({
                templateResult: formatState,
                templateSelection: formatState,
                minimumResultsForSearch: -1
            });
        });

        function formatState(option)
        {
            if (!option.id) { return option.text; }
            var $option = $(
                    '<span><i class="color" style="background-color:' + $(option.element).data('color') + '"></i>' + ' ' + option.text + '</span>'
            );
            return $option;
        };
    </script>
    <!-- /comunik::preferences.index -->
@stop

@section('rows')
    <!-- comunik::preferences.index -->
    @include('pulsar::includes.html.form_select_group', [
        'label' => trans('comunik::pulsar.interval_shipping'),
        'name' => 'intervalShipping',
        'value' => (int)$intervalShipping->value_018,
        'objects' => $intervalsShipping,
        'idSelect' => 'id',
        'nameSelect' => 'name',
        'fieldSize' => 5,
        'required' => true
    ])
    @include('pulsar::includes.html.form_select_group', [
        'label' => trans('comunik::pulsar.test_group'),
        'name' => 'testGroup',
        'value' => (int)$testGroup->value_018,
        'objects' => $groups,
        'idSelect' => 'id_040',
        'nameSelect' => 'name_040',
        'fieldSize' => 5,
        'required' => true
    ])
    @include('pulsar::includes.html.form_select_group', [
        'label' => trans('comunik::pulsar.interval_process'),
        'name' => 'intervalProcess',
        'value' => (int)$intervalProcess->value_018,
        'objects' => $intervalsProcess,
        'idSelect' => 'id',
        'nameSelect' => 'name',
        'fieldSize' => 5,
        'required' => true
    ])
    <!-- /comunik::preferences.index -->
@stop