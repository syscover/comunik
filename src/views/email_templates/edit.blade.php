@extends('pulsar::layouts.form', ['action' => 'update'])

@section('head')
    @parent
    <!-- comunik::email_templates.create -->
    <!-- Froala -->
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/css/froala_editor.min.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/css/froala_style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/css/plugins/char_counter.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/css/plugins/code_view.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/css/plugins/colors.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/css/plugins/emoticons.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/css/plugins/file.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/css/plugins/fullscreen.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/css/plugins/image_manager.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/css/plugins/image.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/css/plugins/line_breaker.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/css/plugins/table.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/css/plugins/video.css') }}">
    <!-- /Froala -->
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/jquery.magnific-popup/magnific-popup.css') }}">

    <!-- Froala -->
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/js/froala_editor.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/js/plugins/char_counter.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/js/plugins/align.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/js/plugins/code_view.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/js/plugins/colors.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/js/plugins/emoticons.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/js/plugins/entities.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/js/plugins/file.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/js/plugins/font_family.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/js/plugins/font_size.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/js/plugins/fullscreen.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/js/plugins/image.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/js/plugins/image_manager.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/js/plugins/inline_style.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/js/plugins/line_breaker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/js/plugins/link.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/js/plugins/lists.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/js/plugins/paragraph_format.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/js/plugins/paragraph_style.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/js/plugins/quote.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/js/plugins/table.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/js/plugins/save.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/js/plugins/url.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/js/plugins/video.min.js') }}"></script>

    @if(config('app.locale') != 'en')
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/js/languages/' . config('app.locale') . '.js') }}"></script>
    @endif
    <!-- /Froala -->
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/jquery.magnific-popup/jquery.magnific-popup.min.js') }}"></script>

    @include('comunik::email_templates.includes.common_script', ['action' => 'update'])
    <!-- /comunik::email_templates.create -->
@stop
@section('rows')
    <!-- comunik::email_templates.create -->
    @include('pulsar::includes.html.form_text_group', ['label' => 'ID', 'name' => 'id', 'value' => $object->id_043, 'readOnly' => true, 'fieldSize' => 2])
    @include('pulsar::includes.html.form_text_group', ['label' => trans('pulsar::pulsar.name'), 'name' => 'name', 'value' => $object->name_043, 'maxLength' => '50', 'rangeLength' => '2,50', 'required' => true])
    @include('pulsar::includes.html.form_checkbox_text_group', ['label' => trans('comunik::pulsar.include_html_link'), 'name' => 'setHtmlLink', 'value' => 1, 'checked' => false, 'inputText' => ['name' => 'htmlLink', 'value' => trans('comunik::pulsar.html_link_value')]])
    @include('pulsar::includes.html.form_checkbox_text_group', ['label' => trans('comunik::pulsar.include_unsubscribe_link'), 'name' => 'setUnsubscribeLink', 'value' => 1, 'checked' => false, 'inputText' => ['name' => 'unsubscribeLink', 'value' => trans('comunik::pulsar.unsubscribe_link_value')]])
    @include('pulsar::includes.html.form_checkbox_text_group', ['label' => trans('comunik::pulsar.include_track_pixel'), 'name' => 'setTrackPixel', 'value' => 1, 'checked' => false, 'inputText' => ['name' => 'trackPixel', 'value' => "<img height='1' width='1' src='" . route('statisticsComunikEmailCampaign', ['campaign' => '#campaign#', 'historicalId' => '#historicalId#']) . "'>"]])
    @include('pulsar::includes.html.form_text_group', ['label' => trans('pulsar::pulsar.subject'), 'name' => 'subject', 'value' => $object->subject_043, 'maxLength' => '255', 'rangeLength' => '2,255', 'required' => true])
    <!-- TODO: evitar usar HTML dentro de vistas -->
    <div class="form-group">
        <label class="col-md-2 control-label">{{ trans('pulsar::pulsar.message') }} @include('pulsar::includes.html.required')</label>
        <div class="col-md-10">
            <input type="hidden" name="header" value="{{ htmlspecialchars($object->header_043) }}">
            <input type="hidden" name="body" value="{{ htmlspecialchars($object->body_043) }}">
            <input type="hidden" name="footer" value="{{ htmlspecialchars($object->footer_043) }}">
            <input type="hidden" name="text" value="{{ htmlspecialchars($object->text_043) }}">
            <input type="hidden" name="data" value="{{ htmlspecialchars($object->data_043) }}">
            <textarea name="wysiwyg" class="form-control limited required wysiwyg" cols="5" rows="10">{{ $object->body_043 }}</textarea>
            {{ $errors->first('header', config('pulsar::pulsar.errorDelimiters')) }}
            {{ $errors->first('body', config('pulsar::pulsar.errorDelimiters')) }}
            {{ $errors->first('footer', config('pulsar::pulsar.errorDelimiters')) }}
        </div>
    </div>
    @include('pulsar::includes.html.form_select_group', ['label' => trans_choice('pulsar::pulsar.theme', 1), 'name' => 'theme', 'value' => $object->theme_043, 'objects' => $themes, 'idSelect' => 'folder', 'nameSelect' => 'name', 'class' => 'select2', 'data' => ['language' => config('app.locale'), 'width' => '50%', 'error-placement' => 'select2-section-outer-container']])
    <div class="form-group">
        <div class="col-md-offset-2 col-md-4">
            <div><a id="btContent" class="btn btn-info mfp-iframe">Insertar theme</a></div>
        </div>
    </div>
    <!-- /comunik::email_templates.create -->
@stop