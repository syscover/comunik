@extends('pulsar::layouts.form')

@section('rows')
    <!-- comunik::email_pattern.create -->
    @include('pulsar::includes.html.form_text_group', [
        'fieldSize' => 2,
        'label' => 'ID',
        'name' => 'id',
        'value' => isset($object->id_049)? $object->id_049 : null,
        'readOnly' => true
    ])
    @include('pulsar::includes.html.form_text_group', [
        'label' => trans('pulsar::pulsar.name'),
        'name' => 'name',
        'value' => old('name', isset($object->name_049)? $object->name_049 : null),
        'maxLength' => '255',
        'rangeLength' => '2,255',
        'required' => true
    ])
    @include('pulsar::includes.html.form_text_group', [
        'label' => trans('pulsar::pulsar.subject'),
        'name' => 'subject',
        'value' => old('subject', isset($object->subject_049)? $object->subject_049 : null),
        'maxLength' => '255',
        'rangeLength' => '2,255'
    ])
    @include('pulsar::includes.html.form_select_group', [
        'fieldSize' => 3,
        'label' => trans_choice('comunik::pulsar.operator', 1),
        'name' => 'operator',
        'value' => old('operator', isset($object->operator_049)? $object->operator_049 : null),
        'objects' => $operators,
        'idSelect' => 'id',
        'nameSelect' => 'name'
    ])
    @include('pulsar::includes.html.form_text_group', [
        'label' => trans('pulsar::pulsar.message'),
        'name' => 'message',
        'value' => old('message', isset($object->message_049)? $object->message_049 : null),
        'maxLength' => '255',
        'rangeLength' => '2,255'
    ])
    @include('pulsar::includes.html.form_select_group', [
        'fieldSize' => 6,
        'label' => trans_choice('pulsar::pulsar.action', 1),
        'name' => 'actionPattern',
        'value' => old('actionPattern', isset($object->action_049)? $object->action_049 : null),
        'objects' => $actions,
        'idSelect' => 'id',
        'nameSelect' => 'name',
        'required' => true
    ])
    <!-- /comunik::email_pattern.create -->
@stop