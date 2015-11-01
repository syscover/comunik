@extends('pulsar::layouts.index', ['newTrans' => 'new'])

@section('script')
    @parent
    <!-- comunik::campaigns.index -->
    <script type="text/javascript">
        $(document).ready(function() {
            if ($.fn.dataTable)
            {
                $('.datatable-pulsar').dataTable({
                    'iDisplayStart' : {{ $offset }},
                    'aoColumnDefs': [
                        { 'bSortable': false, 'aTargets': [7,8]},
                        { 'sClass': 'checkbox-column', 'aTargets': [7]},
                        { 'sClass': 'align-center', 'aTargets': [6,8]}
                    ],
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": "{{ route('jsonData' . $routeSuffix) }}"
                }).fnSetFilteringDelay();
            }
        });
    </script>
    <!-- comunik::campaigns.index -->
@stop

@section('headButtons')

@stop

@section('tHead')
    <!-- comunik::campaigns.index -->
    <tr>
        <th data-hide="phone,tablet">ID.</th>
        <th data-class="expand">{{ trans('pulsar::pulsar.name') }}</th>
        <th data-hide="phone,tablet">{{ trans_choice('pulsar::pulsar.account', 1) }}</th>
        <th data-hide="phone,tablet">{{ trans('comunik::pulsar.shipping_date') }}</th>
        <th data-hide="phone,tablet">{{ trans('comunik::pulsar.persistence_date') }}</th>
        <th data-hide="phone,tablet">{{ trans('pulsar::pulsar.sorting') }}</th>
        <th data-hide="phone,tablet">{{ trans('comunik::pulsar.sent_queue') }}</th>
        <th class="checkbox-column"><input type="checkbox" class="uniform"></th>
        <th>{{ trans_choice('pulsar::pulsar.action', 2) }}</th>
    </tr>
    <!-- /comunik::campaigns.index -->
@stop