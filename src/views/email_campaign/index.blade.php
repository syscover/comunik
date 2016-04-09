@extends('pulsar::layouts.index', ['newTrans' => 'new'])

@section('head')
    @parent
    <!-- comunik::email_campaign.index -->
    <script>
        $(document).ready(function() {
            if ($.fn.dataTable)
            {
                $('.datatable-pulsar').dataTable({
                    'iDisplayStart' : {{ $offset }},
                    'aaSorting': [[ 0, "desc" ]],
                    'aoColumnDefs': [
                        { 'visible': false, "bSearchable": false, 'aTargets': [3,5]}, // hidden column 1 and prevents search on column 1
                        { 'iDataSort': 3, 'aTargets': [4] }, // sort column 2 according hidden column 1 data
                        { 'iDataSort': 5, 'aTargets': [6] }, // sort column 2 according hidden column 1 data
                        { 'bSortable': false, 'aTargets': [9,10]},
                        { 'sClass': 'checkbox-column', 'aTargets': [9]},
                        { 'sClass': 'align-center', 'aTargets': [8,10]}
                    ],
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": "{{ route('jsonData' . ucfirst($routeSuffix)) }}"
                }).fnSetFilteringDelay();
            }
        });
    </script>
    <!-- /.comunik::email_campaign.index -->
@stop

@section('tHead')
    <!-- comunik::email_campaign.index -->
    <tr>
        <th data-hide="phone,tablet">ID.</th>
        <th data-class="expand">{{ trans('pulsar::pulsar.name') }}</th>
        <th data-hide="phone,tablet">{{ trans_choice('pulsar::pulsar.account', 1) }}</th>
        <th>{{ trans('comunik::pulsar.shipping_date') }}</th>
        <th data-hide="phone,tablet">{{ trans('comunik::pulsar.shipping_date') }}</th>
        <th>{{ trans('comunik::pulsar.persistence_date') }}</th>
        <th data-hide="phone,tablet">{{ trans('comunik::pulsar.persistence_date') }}</th>
        <th data-hide="phone,tablet">{{ trans('pulsar::pulsar.sorting') }}</th>
        <th data-hide="phone,tablet">{{ trans('comunik::pulsar.sent_queue') }}</th>
        <th class="checkbox-column"><input type="checkbox" class="uniform"></th>
        <th>{{ trans_choice('pulsar::pulsar.action', 2) }}</th>
    </tr>
    <!-- /.comunik::email_campaign.index -->
@stop