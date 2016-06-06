@extends('pulsar::layouts.index', ['newTrans' => 'new'])

@section('head')
    @parent
    <!-- comunik::email_campaign.index -->
    <script>
        $(document).ready(function() {
            if ($.fn.dataTable)
            {
                $('.datatable-pulsar').dataTable({
                    'displayStart' : {{ $offset }},
                    'sorting': [[0, 'desc']],
                    'columnDefs': [
                        { 'visible': false, searchable': false, 'targets': [3,5]}, // hidden column 1 and prevents search on column 1
                        { 'dataSort': 3, 'targets': [4] }, // sort column 2 according hidden column 1 data
                        { 'dataSort': 5, 'targets': [6] }, // sort column 2 according hidden column 1 data
                        { 'sortable': false, 'targets': [9,10]},
                        { 'class': 'checkbox-column', 'targets': [9]},
                        { 'class': 'align-center', 'targets': [8,10]}
                    ],
                    "processing": true,
                    "serverSide": true,
                    "ajax": "{{ route('jsonData' . ucfirst($routeSuffix)) }}"
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