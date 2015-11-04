@extends('pulsar::layouts.form', ['action' => 'update', 'cancelButton' => false])

@section('script')
    @parent
    <!-- comunik::preferences.index -->
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/plugins/pnotify/jquery.pnotify.default.css') }}">

    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/plugins/pnotify/jquery.pnotify.min.js') }}"></script>
    @include('pulsar::includes.js.success_message')

    <script type="text/javascript">
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
    @include('pulsar::includes.html.form_select_group', ['label' => trans('comunik::pulsar.interval_shipping'), 'name' => 'intervalShipping', 'value' => (int)$intervalShipping->value_018, 'objects' => $intervalsShipping, 'idSelect' => 'id', 'nameSelect' => 'name', 'class' => 'form-control', 'fieldSize' => 5, 'required' => true])
    @include('pulsar::includes.html.form_select_group', ['label' => trans('comunik::pulsar.test_group'), 'name' => 'testGroup', 'value' => (int)$testGroup->value_018, 'objects' => $groups, 'idSelect' => 'id_040', 'nameSelect' => 'name_040', 'class' => 'form-control', 'fieldSize' => 5, 'required' => true])
    @include('pulsar::includes.html.form_select_group', ['label' => trans('comunik::pulsar.interval_process'), 'name' => 'intervalProcess', 'value' => (int)$intervalProcess->value_018, 'objects' => $intervalsProcess, 'idSelect' => 'id', 'nameSelect' => 'name', 'class' => 'form-control', 'fieldSize' => 5, 'required' => true])
    <!-- /comunik::preferences.index -->
@stop