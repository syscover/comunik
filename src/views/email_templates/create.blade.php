@extends('pulsar::layouts.form', ['action' => 'store'])

@section('script')
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

    <script type="text/javascript">
        $(document).ready(function() {

            //$('#report').hide();

            if($('[name="theme"]').val() == "") {
                $('#btContent').hide();
            }

            // checks to links
            $('[name="setHtmlLink"]').bind("click", function () {
                if($('[name="setHtmlLink"]').is(':checked'))
                    $('[name="htmlLink"]').attr('readonly', false);
                else
                    $('[name="htmlLink"]').attr('readonly',true);
            });

            $('[name="setUnsubscribeLink"]').bind("click", function () {
                if($('[name="setUnsubscribeLink"]').is(':checked'))
                    $('[name="unsubscribeLink"]').attr('readonly',false);
                else
                    $('[name="unsubscribeLink"]').attr('readonly',true);
            });

            $('[name="setTrackPixel"]').bind("click", function () {
                if($('[name="setTrackPixel"]').is(':checked'))
                    $('[name="trackPixel"]').attr('readonly',false);
                else
                    $('[name="trackPixel"]').attr('readonly',true);
            });

            /*TODO: revisar funcionalidades froala */
            $.FroalaEditor.DefineIcon('wildcard', {NAME: 'fa fa-star'});
            $.FroalaEditor.RegisterCommand('wildcard', {
                title: '{{ trans_choice('pulsar::pulsar.wildcard', 2) }}',
                type: 'dropdown',
                focus: false,
                undo: false,
                refreshAfterCallback: true,
                options: {
                    'name': '{{ trans('pulsar::pulsar.name') }}',
                    'surname': '{{ trans('pulsar::pulsar.surname') }}',
                    'email': '{{ trans('pulsar::pulsar.email') }}',
                    'birthDate': '{{ trans('pulsar::pulsar.birth_date') }}',
                    'unsubscribe': '{{ trans('comunik::pulsar.unsubscribe') }}',
                    'date': '{{ trans('pulsar::pulsar.date') }}',
                },
                callback: function (cmd, val) {
                    if(val == 'name') this.html.insert('#name#')
                    if(val == 'surname') this.html.insert('#surname#')
                    if(val == 'email') this.html.insert('#email#')
                    if(val == 'birthDate') this.html.insert('#birthDate#')
                    if(val == 'unsubscribe') this.html.insert('#unsubscribe#')
                    if(val == 'date') this.html.insert('#date#')
                }
            });

            $.FroalaEditor.DefineIcon('preview', {NAME: 'fa fa-eye'});
            $.FroalaEditor.RegisterCommand('preview', {
                title: '{{ trans('pulsar::pulsar.preview') }}',
                focus: false,
                undo: false,
                refreshAfterCallback: false,
                callback: function () {
                    $.magnificPopup.open({
                        type: 'iframe',
                        iframe: {
                            markup: '<div class="mfp-iframe-scaler your-special-css-class">'+
                            '<div class="mfp-close"></div>'+
                            '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
                            '</div>'
                        },
                        items: {
                            src: 'http://www.syscover.com'
                        }
                    });
                }
            });

            $('.wysiwyg').froalaEditor({
                language: '{{ config('app.locale') }}',
                placeholderText: '{{ trans('cms::pulsar.type_something') }}',
                toolbarInline: false,
                toolbarSticky: true,
                tabSpaces: true,
                shortcutsEnabled: ['show', 'bold', 'italic', 'underline', 'strikeThrough', 'indent', 'outdent', 'undo', 'redo', 'insertImage', 'createLink'],
                toolbarButtons: ['fullscreen', 'bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'fontFamily', 'fontSize', '|', 'color', 'inlineStyle', 'paragraphStyle', '|', 'paragraphFormat', 'align', 'formatOL', 'formatUL', 'outdent', 'indent', 'quote', 'insertHR', '|', 'wildcard', 'preview', '-', 'insertLink', 'insertImage', 'insertVideo', 'insertTable', 'undo', 'redo', 'clearFormatting', 'selectAll', 'html'],
                heightMin: 250,
                enter: $.FroalaEditor.ENTER_BR,
                key: '{{ config('pulsar.froalaEditorKey') }}'
            });

            // on submit, get content from wysiwyg
            $("#recordForm").on('submit', function(event) {
                $("[name=body]").val($('[name=wysiwyg]').froalaEditor('html.get'));
            });




            /*
             *   Cargamos los settings de un theme en el campo data, cuando cambiamos el selector de themes,
             *   estos settings los cargaremos con javascript desde el content buider
             */
            $('[name="theme"]').on('change', function() {

                // if theme is not select
                if($('[name="theme"]').val() == '') {
                    $('#btContent').fadeOut();

                    $('[name="setHtmlLink"]').prop('checked', true);
                    $('[name="htmlLink"]').attr('readonly', false);
                    $('[name="setUnsubscribeLink"]').prop('checked', true);
                    $('[name="unsubscribeLink"]').attr('readonly',false);

                    $.uniform.update();
                }
                else
                {
                    $('#btContent').fadeIn();
                    var url = '{{ route('contentbuilder', ['package' => 'comunik', 'theme' => 'theme', 'input' => 'body']) }}';

                    // set link on btContent who has magnific popup loaded
                    $('#btContent').attr('href', url.replace('theme', $('[name="theme"]').val()));

                    $.ajax({
                        type:       "POST",
                        url:        "{{ asset(config('comunik.themesFolder')) }}/" + $('[name="theme"]').val() + '/settings.json',
                        dataType:   "json",
                        success:  function(data) {

                            // include settings from theme in data field
                            $('#data').val(JSON.stringify(data));

                            $('[name="setHtmlLink"]').prop('checked', false);
                            $('[name="htmlLink"]').attr('readonly', true);
                            $('[name="setUnsubscribeLink"]').prop('checked', false);
                            $('[name="unsubscribeLink"]').attr('readonly',true);

                            $.uniform.update();
                        },
                        error:function(objXMLHttpRequest){
                            //error
                        }
                    });
                }
            });

            // set magnific popup
            $('#btContent').magnificPopup({
                type: 'iframe',
                iframe: {
                    markup: '<div class="mfp-iframe-scaler your-special-css-class">'+
                    '<div class="mfp-close"></div>'+
                    '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
                    '</div>'
                }
            });
        });

        //var getValueContentBuilder = function(html, dataRequest) {
        var getValueContentBuilder = function(html) {

            var url = '{{ route('contentbuilderBlocks', ['theme' => 'theme']) }}';
            $.ajax({
                type:       "POST",
                url:        url.replace('theme', $('[name="theme"]').val()),
                dataType:   "json",
                headers:    { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                data:       {
                    themeFolder: '{{ config('comunik.themesFolder') }}/'
                },
                success:  function(data)
                {
                    $('#header').val(data.header);
                    //$('.wysiwyg').val(html);
                    $('.wysiwyg').froalaEditor('html.set', html);
                    $('#footer').val(data.footer);

                    //$('#data').val(JSON.stringify(dataRequest));  //establecemos los valores actualizados
                },
                error:function(objXMLHttpRequest){
                    //error
                }
            });
        }
    </script>
    <!-- /comunik::email_templates.create -->
@stop
@section('rows')
    <!-- comunik::email_templates.create -->
    @include('pulsar::includes.html.form_text_group', ['label' => 'ID', 'name' => 'id', 'readOnly' => true, 'fieldSize' => 2])
    @include('pulsar::includes.html.form_text_group', ['label' => trans('pulsar::pulsar.name'), 'name' => 'name', 'value' => Input::old('name'), 'maxLength' => '50', 'rangeLength' => '2,50', 'required' => true])
    @include('pulsar::includes.html.form_checkbox_text_group', ['label' => trans('comunik::pulsar.include_html_link'), 'name' => 'setHtmlLink', 'value' => 1, 'checked' => true, 'inputText' => ['name' => 'htmlLink', 'value' => "Si no puede ver el correo correctamente pinche <a href='#link#' target='_blank'>pulse aquí</a>"]])
    @include('pulsar::includes.html.form_checkbox_text_group', ['label' => trans('comunik::pulsar.include_unsubscribe_link'), 'name' => 'setUnsubscribeLink', 'value' => 1, 'checked' => true, 'inputText' => ['name' => 'unsubscribeLink', 'value' => "Si quiere dejar de recibir mensajes <a href='#unsubscribe#' target='_blank'>pulse aquí</a>"]])
    @include('pulsar::includes.html.form_checkbox_text_group', ['label' => trans('comunik::pulsar.include_track_pixel'), 'name' => 'setTrackPixel', 'value' => 1, 'checked' => true, 'inputText' => ['name' => 'trackPixel', 'value' => "<img height='1' width='1' src='http://pulsar.reservaycata.com/pulsar/comunik/email/services/campanas/analytics/#campana#/#envio#' />"]])
    @include('pulsar::includes.html.form_text_group', ['label' => trans('pulsar::pulsar.subject'), 'name' => 'subject', 'value' => Input::old('subject'), 'maxLength' => '255', 'rangeLength' => '2,255', 'required' => true])
    <!-- TODO: evitar usar HTML dentro de vistas -->
    <div class="form-group">
        <label class="col-md-2 control-label">{{ trans('pulsar::pulsar.message') }} @include('pulsar::includes.html.required')</label>
        <div class="col-md-10">
            <input type="hidden" id="emlHeaders" name="emlHeaders" value="{{ $emlHeaders }}">
            <input type="hidden" id="header" name="header" value="{{ htmlspecialchars(Input::old('header')) }}">
            <input type="hidden" id="body" name="body" value="{{ htmlspecialchars(Input::old('body')) }}">
            <input type="hidden" id="footer" name="footer" value="{{ htmlspecialchars(Input::old('footer')) }}">
            <input type="hidden" id="text" name="text" value="{{ htmlspecialchars(Input::old('text')) }}">
            <textarea id="body" name="wysiwyg" class="form-control limited required wysiwyg" cols="5" rows="10">{{ Input::old('body') }}</textarea>
            {{ $errors->first('header', config('pulsar::pulsar.errorDelimiters')) }}
            {{ $errors->first('body', config('pulsar::pulsar.errorDelimiters')) }}
            {{ $errors->first('footer', config('pulsar::pulsar.errorDelimiters')) }}
        </div>
    </div>
    @include('pulsar::includes.html.form_select_group', ['label' => trans_choice('pulsar::pulsar.theme', 1), 'name' => 'theme', 'value' => Input::old('theme'), 'objects' => $themes, 'idSelect' => 'folder', 'nameSelect' => 'name', 'class' => 'form-control select2', 'data' => ['language' => config('app.locale'), 'width' => '50%', 'error-placement' => 'select2-section-outer-container']])
    <div class="form-group">
        <div class="col-md-offset-2 col-md-4">
            <div><a id="btContent" class="btn btn-info mfp-iframe">Insertar theme</a></div>
        </div>
    </div>
    <!-- /comunik::email_templates.create -->
@stop