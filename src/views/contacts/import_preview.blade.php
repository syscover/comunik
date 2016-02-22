@extends('pulsar::layouts.modal')

@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/jquery.select2/css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/jquery.select2.custom/css/select2.css') }}">

    @include('pulsar::includes.js.header_list')
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/jquery.select2.custom/js/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/jquery.select2/js/i18n/' . config('app.locale') . '.js') }}"></script>
    <script type="text/javascript">
        var deleteRow = function(row)
        {
            var data = JSON.parse($('[name=data]').val());
            data.deleteRows.push(row);
            $('[name=data]').val(JSON.stringify(data));
            $('#tr' + row).fadeOut();
        }

        var importData = function()
        {
            // validamos que haya elegido un campo
            var nNull = $(".fields").filter(function() {
                return this.value !== "";
            });

            if(nNull.length == 0) {
                new PNotify({
                    type:   'error',
                    title:  '{{ trans('comunik::pulsar.import_error') }}',
                    text:   '{{ trans('comunik::pulsar.error_01') }}',
                    opacity: .9,
                    styling: 'fontawesome'
                })
                return false;
            }

            // validamos que haya elegido al menos un campo movil o email
            var nEmails = $(".fields").filter(function() {
                return this.value == "email_041";
            });
            var nMobiles = $(".fields").filter(function() {
                return this.value == "mobile_041";
            });

            if(nEmails.length == 0 && nMobiles.length == 0)
            {
                new PNotify({
                    type:   'error',
                    title:  '{{ trans('comunik::pulsar.import_error') }}',
                    text:   '{{ trans('comunik::pulsar.error_02') }}',
                    opacity: .9,
                    styling: 'fontawesome'
                })
                return false;
            }

            if(nEmails.length > 1)
            {
                new PNotify({
                    type:   'error',
                    title:  '{{ trans('comunik::pulsar.import_error') }}',
                    text:   '{{ trans('comunik::pulsar.error_03') }}',
                    opacity: .9,
                    styling: 'fontawesome'
                })
                return false;
            }

            if(nMobiles.length > 1)
            {
                new PNotify({
                    type:   'error',
                    title:  '{{ trans('comunik::pulsar.import_error') }}',
                    text:   '{{ trans('comunik::pulsar.error_04') }}',
                    opacity: .9,
                    styling: 'fontawesome'
                })
                return false;
            }

            // validamos que haya elegido un campo pais
            var nCountry = $(".fields").filter(function() {
                return this.value == "country_041";
            });

            if($('[name="country"]').val() == '' && nCountry.length == 0)
            {
                new PNotify({
                    type:   'error',
                    title:  '{{ trans('comunik::pulsar.import_error') }}',
                    text:   '{{ trans('comunik::pulsar.error_05') }}',
                    opacity: .9,
                    styling: 'fontawesome'
                })
                return false;
            }

            // validamos que haya elegido un campo grupo
            var nGroups = $(".fields").filter(function() {
                return this.value == "id_040";
            });

            if($('[name="groups[]"]').val() == null && nGroups.length == 0)
            {
                new PNotify({
                    type:   'error',
                    title:  '{{ trans('comunik::pulsar.import_error') }}',
                    text:   '{{ trans('comunik::pulsar.error_06') }}',
                    opacity: .9,
                    styling: 'fontawesome'
                })
                return false;
            }

            $(".form-horizontal").submit();
        }
    </script>
@stop

@section('mainContent')
<div class="row">
    <form class="form-horizontal" method="post" action="{{ route('importComunikContact') }} ">
        {!! csrf_field() !!}
        <div class="col-md-12">
            <a href="javascript:void(0)"  onclick="importData()" class="btn marginB10"><i class="fa fa-download"></i> {{ trans_choice('pulsar::pulsar.import', 1) }}</a>
            <div class="widget box">
                <div class="widget-header">
                    <h4><i class="fa fa-reorder"></i> {{ trans_choice('pulsar::pulsar.import', 1) }}</h4> - ({{ $nRows }} {{ trans('comunik::pulsar.first_records') }})
                </div>
                <div class="widget-content">
                    <table class="table table-striped table-bordered table-hover table-checkable table-responsive datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                @for($i=0; $i < $nColumns; $i++)
                                <th>
                                    <select name="column{{ $i }}" class="fields">
                                        <option value="">{{ trans_choice('pulsar::pulsar.field', 1) }}</option>
                                        @foreach($fields as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </th>
                                @endfor
                                <th class="align-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($j=0; $j< $nRows; $j++)
                            <tr id="tr{{ $j }}">
                                <td>{{ $j +1 }}</td>
                                    @for($i=0; $i < $nColumns; $i++)
                                        <td>{{ $data[$j][$i] }}</td>
                                    @endfor
                                <td class="align-center">
                                    <span class="btn-group">
                                        <a href="javascript:void(0)" onclick="deleteRow({{ $j }})" class="btn btn-xs bs-tooltip"><i class="fa fa-trash"></i></a>
                                    </span>
                                </td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="table-footer">
                            <div class="col-md-4">
                                <div class="table-actions">
                                    <label>{{ trans_choice("pulsar::pulsar.country", 1) }}:</label>
                                    <select class="select2" name="country" style="width: 100%">
                                        <option value="">Seleccione un país para todos los datos</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id_002 }}">{{ $country->name_002 }}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="table-actions">
                                    <label>{{ trans_choice("pulsar::pulsar.group", 1) }}:</label>
                                    <select class="select2" name="groups[]" style="width: 100%" multiple>
                                        @foreach ($groups as $group)
                                            <option value="{{ $group->id_040 }}">{{ $group->name_040 }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input name="file" type="hidden" value='{{ $file }}'>
        <input name="data" type="hidden" value='{"deleteRows":[]}'>
    </form>
</div>
@stop