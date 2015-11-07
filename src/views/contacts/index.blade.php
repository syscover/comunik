@extends('pulsar::layouts.index', ['newTrans' => 'new'])

@section('script')
    @parent
    <!-- comunik::contacts.index -->
    <script type="text/javascript">
        $(document).ready(function() {
            if ($.fn.dataTable)
            {
                $('.datatable-pulsar').dataTable({
                    'iDisplayStart' : {{ $offset }},
                    'aoColumnDefs': [
                        { 'bSortable': false, 'aTargets': [8,9]},
                        { 'sClass': 'checkbox-column', 'aTargets': [8]},
                        { 'sClass': 'align-center', 'aTargets': [6,9]}
                    ],
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": "{{ route('jsonData' . $routeSuffix) }}"
                }).fnSetFilteringDelay();
            }
        });
    </script>
    <!-- comunik::contacts.index -->
@stop

@section('headButtons')
    <div class="btn-group marginB10 marginL10">
        <button class="btn dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-download"></i> Importación
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            <li><a id="csv" href="#" style="overflow: hidden"><i class="fa fa-file-excel-o"></i> CSV</a></li>
        </ul>
    </div>
@stop

@section('tHead')
    <!-- comunik::contacts.index -->
    <tr>
        <th data-hide="phone,tablet">ID.</th>
        <th data-class="expand">{{ trans('pulsar::pulsar.name') }}</th>
        <th data-hide="phone,tablet">{{ trans('pulsar::pulsar.surname') }}</th>
        <th data-hide="phone,tablet">{{ trans_choice('pulsar::pulsar.country', 1) }}</th>
        <th data-hide="phone,tablet">{{ trans('pulsar::pulsar.mobile') }}</th>
        <th data-hide="phone,tablet">{{ trans('pulsar::pulsar.email') }}</th>
        <th data-hide="phone,tablet">{{ trans('pulsar::pulsar.email') }}</th>
        <th data-hide="phone,tablet">{{ trans_choice('pulsar::pulsar.group', 2) }}</th>
        <th class="checkbox-column"><input type="checkbox" class="uniform"></th>
        <th>{{ trans_choice('pulsar::pulsar.action', 2) }}</th>
    </tr>
    <!-- /comunik::contacts.index -->
@stop