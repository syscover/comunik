@extends('pulsar::layouts.index', ['newTrans' => 'new2'])

@section('head')
    @parent
    <!-- comunik::email_template.index -->
    <script>
        $(document).ready(function() {
            if ($.fn.dataTable)
            {
                $('.datatable-pulsar').dataTable({
                    "displayStart": {{ $offset }},
                    "columnDefs": [
                        { "sortable": false, "targets": [3,4]},
                        { "class": "checkbox-column", "targets": [3]},
                        { "class": "align-center", "targets": [4]}
                    ],
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        "url": "{{ route('jsonData' . ucfirst($routeSuffix)) }}",
                        "type": "POST",
                        "headers": {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        }
                    }
                }).fnSetFilteringDelay();
            }
        });
    </script>
    <!-- /comunik::email_template.index -->
@stop

@section('tHead')
    <!-- comunik::email_template.index -->
    <tr>
        <th data-hide="phone,tablet">ID.</th>
        <th>{{ trans('pulsar::pulsar.name') }}</th>
        <th>{{ trans_choice('pulsar::pulsar.action', 1) }}</th>
        <th class="checkbox-column"><input type="checkbox" class="uniform"></th>
        <th>{{ trans_choice('pulsar::pulsar.action', 2) }}</th>
    </tr>
    <!-- /comunik::email_template.index -->
@stop