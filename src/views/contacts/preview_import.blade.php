@extends('pulsar::layouts.modal')

@section('css')
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/jquery.select2/css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/jquery.select2.custom/css/select2.css') }}">
@stop

@section('script')
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/plugins/uniform/jquery.uniform.min.js') }}"></script>
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
            alert("ok");
        }
    </script>
@stop

@section('mainContent')
<div class="row">
    <form class="form-horizontal" method="post" action="{{ route('importComunikContact') }} ">
        {!! csrf_field() !!}
        <div class="col-md-12">
            <a href="javascript:void(0)"  onclick="importData()" class="btn marginB10"><i class="fa fa-download"></i> {{ trans_choice('pulsar::pulsar.import', 1) }}</a>
            <div class="widget box" style="display: inline-block">
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
                                        @foreach($fields as $field)
                                            <option value="{{ $field->id }}">{{ $field->name }}</option>
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
                                        <?php foreach ($countries as $country): ?>
                                        <option value="{{ $country->id_002 }}">{{ $country->name_002 }}</option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="table-actions">
                                    <label>{{ trans_choice("pulsar::pulsar.group", 1) }}:</label>
                                    <select class="select2" name="groups[]" style="width: 100%" multiple>
                                        <?php foreach ($groups as $group): ?>
                                        <option value="{{ $group->id_040 }}">{{ $group->name_040 }}</option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input name="data" type="hidden" value='{"deleteRows":[]}'>
    </form>
</div>
@stop