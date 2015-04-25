@extends('pulsar::layouts.form', ['action' => 'update'])

@section('rows')
    <!-- comunik::groups.create -->
    @include('pulsar::includes.html.form_text_group', ['label' => 'ID', 'name' => 'id', 'value' => $object->id_029, 'readOnly' => true, 'fieldSize' => 2])
    @include('pulsar::includes.html.form_text_group', ['label' => trans('pulsar::pulsar.name'), 'name' => 'name', 'value' => $object->name_029, 'maxLength' => '50', 'rangeLength' => '2,50', 'required' => true])
    <!-- /comunik::groups.create -->
@stop