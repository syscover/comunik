@extends('pulsar::layouts.index', ['newTrans' => 'new2'])

@section('head')
    @parent
    <!-- comunik::email_template.index -->
    <script>
        $(document).ready(function() {
            if ($.fn.dataTable)
            {
                $('.datatable-pulsar').dataTable({
                    'displayStart' : {{ $offset }},
                    'columnDefs': [
                        { 'sortable': false, 'targets': [2,3]},
                        { 'class': 'checkbox-column', 'targets': [2]},
                        { 'class': 'align-center', 'targets': [3]}
                    ],
                    "processing": true,
                    "serverSide": true,
                    "ajax": "{{ route('jsonData' . ucfirst($routeSuffix)) }}"
                }).fnSetFilteringDelay();
            }
        });
    </script>
    <!-- /.comunik::email_template.index -->
@stop

@section('tHead')
    <!-- comunik::email_template.index -->
    <tr>
        <th data-hide="phone,tablet">ID.</th>
        <th>{{ trans('pulsar::pulsar.name') }}</th>
        <th class="checkbox-column"><input type="checkbox" class="uniform"></th>
        <th>{{ trans_choice('pulsar::pulsar.action', 2) }}</th>
    </tr>
    <!-- /.comunik::email_template.index -->
@stop