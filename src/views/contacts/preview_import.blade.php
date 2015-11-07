@extends('pulsar::layouts.modal')

@section('css')
    <link href="{{ URL::asset('packages/pulsar/pulsar/plugins/pnotify/jquery.pnotify.default.css') }}" type="text/css" rel="stylesheet" />
@stop

@section('script')
    @include('pulsar::pulsar.pulsar.common.block.block_script_header_form')
    <script type="text/javascript" src="<?php echo URL::asset('packages/pulsar/pulsar/plugins/pnotify/jquery.pnotify.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo URL::asset('packages/pulsar/pulsar/plugins/select2/select2.min.js'); ?>"></script>
@stop

@section('mainContent')
<div class="row">
    <form class="form-horizontal" method="post" action="{{ URL::to(Config::get('pulsar::pulsar.rootUri')) }}/comunik/contactos/import/excel/{{ $file }}">
        {{ Form::token() }}
        <!--=== Import Table ===-->
        <div class="col-md-12">
            <div class="widget box">
                <div class="widget-header">
                    <h4><i class="icon-reorder"></i> Importación</h4> - {{ $nRows }} primeros registros
                    <div class="toolbar no-padding">
                        <div class="btn-group">
                            <button type="button" onclick="testImport()" class="btn btn-xs"><i class="icon-download-alt"></i> Importar</button>
                            <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                        </div>
                    </div>
                </div>
                <div class="widget-content">
                    <table class="table table-hover table-bordered table-condensed">
                        <thead>
                            <tr>
                                <th>#</th>
                                <?php for($i=0; $i < $nColumns; $i++): ?>
                                <th>
                                    <select name="column{{ $i }}" class="fields">
                                        <option value="null">Campo</option>
                                    </select>
                                </th>
                                <?php endfor; ?>
                                <th class="align-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for($j=0; $j< $nRows; $j++): ?>
                            <tr id="tr{{ $j }}">
                                <td>{{ $j +1 }}</td>
                                <?php for($i=0; $i< $nColumns; $i++): ?>
                                <td>{{ $data[$j][$i] }}</td>
                                <?php endfor; ?>
                                <td class="align-center">
                                    <span class="btn-group">
                                        <a href="javascript:void(0);" onclick="deleteRow({{ $j }})" class="btn btn-xs bs-tooltip" title="Borrar fila"><i class="icon-trash"></i></a>
                                    </span>
                                </td>
                            </tr>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="table-footer">
                            <div class="col-md-4">
                                <div class="table-actions">
                                    <label>País:</label>
                                    <select class="select2" name="pais">
                                        <option value="null">Seleccione un país para todos los datos</option>
                                        <?php foreach ($paises as $pais): ?>
                                        <option value="{{ $pais->id_002 }}">{{ $pais->nombre_002 }}</option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="table-actions">
                                    <label>Grupos:</label>
                                    <select class="select2" name="grupos[]" multiple style="width: 90%">
                                        <?php foreach ($grupos as $grupo): ?>
                                        <option value="{{ $grupo->id_029 }}">{{ $grupo->nombre_029 }}</option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input id="data" name="data" type="hidden" value="">
        <!-- /Import Table -->
    </form>
</div>
@stop