@extends('pulsar::layouts.form', ['action' => 'store'])

@section('rows')
    <!-- comunik::email_templates.create -->

    @include('pulsar::includes.html.form_text_group', ['label' => 'ID', 'name' => 'id', 'readOnly' => true, 'fieldSize' => 2])
    @include('pulsar::includes.html.form_text_group', ['label' => trans('pulsar::pulsar.name'), 'name' => 'name', 'value' => Input::old('name'), 'maxLength' => '50', 'rangeLength' => '2,50', 'required' => true])
    @include('pulsar::includes.html.form_checkbox_text_group', ['label' => trans('comunik::pulsar.include_html_link'), 'name' => 'setHtmlLink', 'value' => 1, 'inputText' => ['name' => 'htmlLink', 'value' => "Si no puede ver el correo correctamente pinche <a href='#link#' target='_blank'>pulse aquí</a>"]])
    @include('pulsar::includes.html.form_checkbox_text_group', ['label' => trans('comunik::pulsar.include_unsuscribe_link'), 'name' => 'setHtmlLink', 'value' => 1, 'inputText' => ['name' => 'htmlLink', 'value' => "Si quiere dejar de recibir mensajes <a href='#unsubscribe#' target='_blank'>pulse aquí</a>"]])
    @include('pulsar::includes.html.form_checkbox_text_group', ['label' => trans('comunik::pulsar.include_track_pixel'), 'name' => 'setHtmlLink', 'value' => 1, 'inputText' => ['name' => 'htmlLink', 'value' => "<img height='1' width='1' src='http://pulsar.reservaycata.com/pulsar/comunik/email/services/campanas/analytics/#campana#/#envio#' />"]])
    @include('pulsar::includes.html.form_text_group', ['label' => trans('pulsar::pulsar.subject'), 'name' => 'subject', 'value' => Input::old('subject'), 'maxLength' => '255', 'rangeLength' => '2,255', 'required' => true])
    <!-- TODO: evitar usar HTML dentro de vistas -->
    <div class="form-group">
        <label class="col-md-2 control-label">{{ trans('pulsar::pulsar.message') }} @include('pulsar::includes.html.required')</label>
        <div class="col-md-8">
            <input type="hidden" id="emlHeaders" name="emlHeaders" value="{{ $emlHeaders }}">
            <input type="hidden" id="header" name="header" value="{{ htmlspecialchars(Input::old('header')) }}">
            <input type="hidden" id="footer" name="footer" value="{{ htmlspecialchars(Input::old('footer')) }}">
            <input type="hidden" id="text" name="text" value="{{ htmlspecialchars(Input::old('text')) }}">
            <textarea id="body" name="body" class="form-control limited required" cols="5" rows="10">{{ Input::old('body') }}</textarea>
            {{ $errors->first('header', config('pulsar::pulsar.errorDelimiters')) }}
            {{ $errors->first('body', config('pulsar::pulsar.errorDelimiters')) }}
            {{ $errors->first('footer', config('pulsar::pulsar.errorDelimiters')) }}
        </div>
        <div class="col-md-2">
            <div class="marginB10"><a class="btn btn-inverse actionB" data-target="body" data-template="name" href="#">{{ trans('pulsar::pulsar.name') }}</a></div>
            <div class="marginB10"><a class="btn btn-inverse actionB" data-target="body" data-template="surname" href="#">{{ trans('pulsar::pulsar.surname') }}</a></div>
            <div class="marginB10"><a class="btn btn-inverse actionB" data-target="body" data-template="email" href="#">{{ trans('pulsar::pulsar.email') }}</a></div>
            <div class="marginB10"><a class="btn btn-inverse actionB" data-target="body" data-template="unsubscribe" href="#">{{ trans('comunik::pulsar.unsuscribe_link') }}</a></div>
        </div>
    </div>





    <!-- /comunik::email_templates.create -->
@stop