@extends('pulsar::layouts.index')

@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/getfile/libs/cropper/cropper.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/getfile/libs/filedrop/filedrop.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/getfile/css/getfile.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/jquery.magnific-popup/magnific-popup.css') }}">
@stop

@section('head')
    @parent
    <script src="{{ asset('packages/syscover/pulsar/vendor/getfile/libs/cropper/cropper.min.js') }}"></script>
    <script src="{{ asset('packages/syscover/pulsar/vendor/getfile/libs/cssloader/js/jquery.cssloader.min.js') }}"></script>
    <script src="{{ asset('packages/syscover/pulsar/vendor/getfile/libs/mobiledetect/mdetect.min.js') }}"></script>
    <script src="{{ asset('packages/syscover/pulsar/vendor/getfile/libs/filedrop/filedrop.min.js') }}"></script>
    <script src="{{ asset('packages/syscover/pulsar/vendor/getfile/js/jquery.getfile.js') }}"></script>
    <script src="{{ asset('packages/syscover/pulsar/vendor/jquery.magnific-popup/jquery.magnific-popup.min.js') }}"></script>

    <!-- comunik::contact.index -->
    <script>
        $(document).ready(function() {
            if ($.fn.dataTable)
            {
                $('.datatable-pulsar').dataTable({
                    "displayStart": {{ $offset }},
                    "columnDefs": [
                        { "sortable": false, "targets": [8,9]},
                        { "class": "checkbox-column", "targets": [8]},
                        { "class": "align-center", "targets": [6,9]}
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

            $('#csv').getFile({
                    urlPlugin:      '/packages/syscover/pulsar/vendor',
                    folder:         '/packages/syscover/pulsar/storage/tmp',
                    tmpFolder:      '/packages/syscover/pulsar/storage/tmp',
                    encryption:     true,
                    mimesAccept:    [
                        'text/plain',
                        'text/csv',
                        'application/csv'
                    ]
                },
                function(data)
                {
                    if(data.success == true && data.action == "upload")
                    {
                        var url = '{{ route('importPreviewComunikContact', ['file' => '%file%']) }}';
                        $.magnificPopup.open({
                            type: 'iframe',
                            iframe: {
                                markup: '<div class="mfp-iframe-scaler your-special-css-class">'+
                                '<div class="mfp-close"></div>'+
                                '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
                                '</div>'
                            },
                            items: {
                                src: url.replace('%file%', data.name)
                            },
                            callbacks: {
                                close: function()
                                {
                                    location.reload();
                                }
                            }
                        });
                    }
                }
            );
        });
    </script>
    <!-- /comunik::contact.index -->
@stop

@section('headButtons')
    @if($viewParameters['newButton'])
        <div class="btn-group margin-b10 margin-l10">
            <button class="btn dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-download"></i> {{ trans_choice('pulsar::pulsar.import', 1) }}
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a id="csv"><i class="fa fa-file-excel-o"></i> CSV</a></li>
            </ul>
        </div>
    @endif
@stop

@section('tHead')
    <!-- comunik::contact.index -->
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
    <!-- /comunik::contact.index -->
@stop