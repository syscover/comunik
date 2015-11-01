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
                        { 'bSortable': false, 'aTargets': [9,10]},
                        { 'sClass': 'checkbox-column', 'aTargets': [9]},
                        { 'sClass': 'align-center', 'aTargets': [6,7,10]}
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
        <th>{{ trans('pulsar::pulsar.name') }}</th>
        <th data-hide="phone,tablet">{{ trans('pulsar::pulsar.surname') }}</th>
        <th data-hide="phone,tablet">{{ trans_choice('pulsar::pulsar.country', 1) }}</th>
        <th data-hide="phone,tablet">{{ trans('pulsar::pulsar.mobile') }}</th>
        <th data-hide="expand">{{ trans('pulsar::pulsar.email') }}</th>
        <th data-hide="phone,tablet">{{ trans('comunik::pulsar.sms') }}</th>
        <th data-hide="phone,tablet">{{ trans('pulsar::pulsar.email') }}</th>
        <th data-hide="phone,tablet">{{ trans_choice('pulsar::pulsar.group', 2) }}</th>
        <th class="checkbox-column"><input type="checkbox" class="uniform"></th>
        <th>{{ trans_choice('pulsar::pulsar.action', 2) }}</th>
    </tr>
    <!-- /comunik::campaigns.index -->
@stop