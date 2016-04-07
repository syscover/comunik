@extends('pulsar::layouts.modal')

@section('head')
    @include('pulsar::includes.js.header_list')
    <script>
        $(document).ready(function() {
            parent.$.cssLoader.hide()
        })
    </script>
@stop

@section('mainContent')
    <div class="row">
        <div class="col-md-12">
            <div class="widget box">
                <div class="widget-header">
                    <h4><i class="fa fa-reorder"></i> {{ trans_choice('pulsar::pulsar.import', 1) }}</h4> - {{ count($arrayDataFail) }} {{ trans('pulsar::comunik.import_error_title') }}
                </div>
                <div class="widget-content">
                    <table class="table table-striped table-bordered table-hover table-checkable table-responsive datatable">
                        <thead>
                            <tr>
                                <th>{{ trans_choice('pulsar::pulsar.row', 1) }}</th>
                                @if(count($arrayDataFail) > 1)
                                    @foreach($columns as $key => $value)
                                        <th>{{ $value }}</th>
                                    @endforeach
                                @endif
                                <th class="align-center">{{ trans_choice('pulsar::pulsar.error', 2) }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($j=0; $j < count($arrayDataFail); $j++)
                                <tr id="tr{{ $j }}">
                                    <td>{{ $j +1 }}</td>
                                        @foreach($columns as $key => $value)
                                            <td>{{ $arrayDataFail[$j]['row'][$key] }}</td>
                                        @endforeach
                                    <td class="align-center">
                                        @foreach($arrayDataFail[$j]['errors'] as $error)
                                            {{ $error }}
                                        @endforeach
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                    @if(count($arrayDataFail) == 0)
                        <h4>{{ trans('comunik::pulsar.all_import_successful') }}</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop