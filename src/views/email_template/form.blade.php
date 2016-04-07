@extends('pulsar::layouts.form')

@section('head')
    @parent
    <!-- comunik::email_templates.create -->
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/jquery.magnific-popup/magnific-popup.css') }}">

    <script src="{{ asset('packages/syscover/pulsar/vendor/jquery.magnific-popup/jquery.magnific-popup.min.js') }}"></script>

    @include('pulsar::includes.html.froala_references')

    <script>
        $(document).ready(function() {

            if($('[name="theme"]').val() == "") {
                $('#btContent').hide()
            }

            // checks to links
            $('[name="setHtmlLink"]').bind("click", function () {
                if($('[name="setHtmlLink"]').is(':checked'))
                    $('[name="htmlLink"]').attr('readonly', false)
                else
                    $('[name="htmlLink"]').attr('readonly',true)
            })

            $('[name="setUnsubscribeLink"]').bind("click", function () {
                if($('[name="setUnsubscribeLink"]').is(':checked'))
                    $('[name="unsubscribeLink"]').attr('readonly',false)
                else
                    $('[name="unsubscribeLink"]').attr('readonly',true)
            })

            $('[name="setTrackPixel"]').bind("click", function () {
                if($('[name="setTrackPixel"]').is(':checked'))
                    $('[name="trackPixel"]').attr('readonly',false)
                else
                    $('[name="trackPixel"]').attr('readonly',true)
            })

            /*TODO: revisar funcionalidades froala */
            $.FroalaEditor.DefineIcon('wildcard', {NAME: 'fa fa-star'})
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
                    'date': '{{ trans_choice('pulsar::pulsar.date', 1) }}',
                },
                callback: function (cmd, val) {
                    if(val == 'name') this.html.insert('#name#')
                    if(val == 'surname') this.html.insert('#surname#')
                    if(val == 'email') this.html.insert('#email#')
                    if(val == 'birthDate') this.html.insert('#birthDate#')
                    if(val == 'unsubscribe') this.html.insert('#unsubscribe#')
                    if(val == 'date') this.html.insert('#date#')
                }
            })

            $.FroalaEditor.DefineIcon('preview', {NAME: 'fa fa-eye'})
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
                            src: ''
                        },
                        callbacks: {
                            open: function()
                            {
                                // set iframe background color
                                $('.mfp-iframe-scaler iframe').css('background', '#fff')
                                $("[name=body]").val($('[name=wysiwyg]').froalaEditor('html.get'))
                                $('.mfp-iframe').contents().find('html').html($('[name=header]').val() + $('[name=body]').val() + $('[name=footer]').val())
                            }
                        }
                    })
                }
            })

            /*
             $('.wysiwyg').froalaEditor({
             language: '{{ config('app.locale') }}',
             placeholderText: '{{ trans('pulsar::pulsar.type_something') }}',
             toolbarInline: false,
             toolbarSticky: true,
             tabSpaces: true,
             shortcutsEnabled: ['show', 'bold', 'italic', 'underline', 'strikeThrough', 'indent', 'outdent', 'undo', 'redo', 'insertImage', 'createLink'],
             toolbarButtons: ['fullscreen', 'bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'fontFamily', 'fontSize', '|', 'color', 'inlineStyle', 'paragraphStyle', '|', 'paragraphFormat', 'align', 'formatOL', 'formatUL', 'outdent', 'indent', 'quote', 'insertHR', '|', 'wildcard', 'preview', '-', 'insertLink', 'insertImage', 'insertTable', 'undo', 'redo', 'clearFormatting', 'selectAll', 'html'],
             heightMin: 250,
             enter: $.FroalaEditor.ENTER_BR,
             key: '{{ config('pulsar.froalaEditorKey') }}'
             })
             */

            // on submit, get content from wysiwyg
            $("#recordForm").on('submit', function(event) {
                //$("[name=body]").val($('[name=wysiwyg]').froalaEditor('html.get'))
                $("[name=body]").val($('[name=wysiwyg]').val())
            })

            // update content from wysiwyg to load in content builder
            $('#btContent').on('click', function(){
                //$("[name=body]").val($('[name=wysiwyg]').froalaEditor('html.get'))
                $("[name=body]").val($('[name=wysiwyg]').val())
            })

            /*
             *   Cargamos los settings de un theme en el campo data, cuando cambiamos el selector de themes,
             *   estos settings los cargaremos con javascript desde el content buider
             */
            $('[name="theme"]').on('change', function() {

                // if theme is not select
                if($('[name="theme"]').val() == '') {
                    $('#btContent').fadeOut()

                    @if($action == 'create')
                        $('[name="setHtmlLink"]').prop('checked', true)
                        $('[name="htmlLink"]').attr('readonly', false)
                        $('[name="setUnsubscribeLink"]').prop('checked', true)
                        $('[name="unsubscribeLink"]').attr('readonly',false)

                        $.uniform.update()
                    @endif
                }
                else
                {
                    $('#btContent').fadeIn()
                    var url = '{{ route('contentbuilder', ['package' => 'comunik', 'theme' => '%theme%', 'input' => 'body']) }}'

                    // set link on btContent who has magnific popup loaded
                    $('#btContent').attr('href', url.replace('%theme%', $('[name="theme"]').val()))

                    $.ajax({
                        type:       "POST",
                        url:        "{{ asset(config('comunik.themesFolder')) }}/" + $('[name="theme"]').val() + '/settings.json',
                        dataType:   "json",
                        success:  function(data) {

                            // include settings from theme in data field
                            $('#data').val(JSON.stringify(data))

                            @if($action == 'create')
                                $('[name="setHtmlLink"]').prop('checked', false)
                                $('[name="htmlLink"]').attr('readonly', true)
                                $('[name="setUnsubscribeLink"]').prop('checked', false)
                                $('[name="unsubscribeLink"]').attr('readonly',true)

                                $.uniform.update()
                            @endif
                        },
                        error:function(objXMLHttpRequest){
                            //error
                        }
                    })
                }
            })

            // set magnific popup
            $('#btContent').magnificPopup({
                type: 'iframe',
                iframe: {
                    markup: '<div class="mfp-iframe-scaler your-special-css-class">'+
                    '<div class="mfp-close"></div>'+
                    '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
                    '</div>'
                }
            })

            @if($action == 'update')
                $('[name="theme"]').trigger('change')
            @endif
        })

        // function called from pulsar::contentbuilder.index
        var getValueContentBuilder = function(html, settings)
        {
            var url = '{{ route('contentbuilderBlocks', ['theme' => '%theme%']) }}'
            $.ajax({
                type:       "POST",
                url:        url.replace('%theme%', $('[name="theme"]').val()),
                dataType:   "json",
                headers:    { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                data:       {
                    themeFolder: '{{ config('comunik.themesFolder') }}/',
                    settings: settings
                },
                success:  function(data)
                {
                    $('[name=header]').val(data.header)
                    $('[name=body]').val(html)
                    $('[name=footer]').val(data.footer)
                    $('[name=data]').val(JSON.stringify(settings))

                    $("[name=wysiwyg]").val(html)
                    //$('.wysiwyg').froalaEditor('html.set', html)
                },
                error:function(objXMLHttpRequest)
                {
                    //error
                }
            })
        }
    </script>
    <!-- /.comunik::email_templates.create -->
@stop

@section('rows')
    <!-- comunik::email_templates.create -->
    @include('pulsar::includes.html.form_text_group', [
        'label' => 'ID',
        'name' => 'id',
        'value' => isset($object->id_043)? $object->id_043 : null,
        'readOnly' => true,
        'fieldSize' => 2
    ])
    @include('pulsar::includes.html.form_text_group', [
        'label' => trans('pulsar::pulsar.name'),
        'name' => 'name',
        'value' => old('name', isset($object->name_043)? $object->name_043 : null),
        'maxLength' => '50',
        'rangeLength' => '2,50',
        'required' => true
    ])
    @include('pulsar::includes.html.form_checkbox_text_group', [
        'label' => trans('comunik::pulsar.include_html_link'),
        'name' => 'setHtmlLink',
        'value' => 1,
        'checked' => true,
        'inputText' => [
            'name' => 'htmlLink',
            'value' => trans('comunik::pulsar.html_link_value')
        ]
    ])
    @include('pulsar::includes.html.form_checkbox_text_group', [
        'label' => trans('comunik::pulsar.include_unsubscribe_link'),
        'name' => 'setUnsubscribeLink',
        'value' => 1,
        'checked' => true,
        'inputText' => [
            'name' => 'unsubscribeLink',
            'value' => trans('comunik::pulsar.unsubscribe_link_value')
        ]
    ])
    @include('pulsar::includes.html.form_checkbox_text_group', [
        'label' => trans('comunik::pulsar.include_track_pixel'),
        'name' => 'setTrackPixel',
        'value' => 1,
        'checked' => true,
        'inputText' => [
            'name' => 'trackPixel',
            'value' => "<img height='1' width='1' src='" . route('statisticsComunikEmailCampaign', ['campaign' => '#campaign#', 'historicalId' => '#historicalId#']) . "'>"
        ]
    ])
    @include('pulsar::includes.html.form_text_group', [
        'label' => trans('pulsar::pulsar.subject'),
        'name' => 'subject',
        'value' => old('subject', isset($object->subject_043)? $object->subject_043 : null),
        'maxLength' => '255',
        'rangeLength' => '2,255',
        'required' => true
    ])

    <!-- TODO: evitar usar HTML dentro de vistas -->
    <div class="form-group">
        <label class="col-md-2 control-label">{{ trans('pulsar::pulsar.message') }} @include('pulsar::includes.html.required')</label>
        <div class="col-md-10">
            <input type="hidden" name="header" value="{{ htmlspecialchars(old('header', isset($object->header_043)? $object->header_043 : null)) }}">
            <input type="hidden" name="body" value="{{ htmlspecialchars(old('body', isset($object->body_043)? $object->body_043 : null)) }}">
            <input type="hidden" name="footer" value="{{ htmlspecialchars(old('footer', isset($object->footer_043)? $object->footer_043 : null)) }}">
            <input type="hidden" name="text" value="{{ htmlspecialchars(old('text', isset($object->text_043)? $object->text_043 : null)) }}">
            <input type="hidden" name="data" value="{{ htmlspecialchars(old('data', isset($object->data_043)? $object->data_043 : null)) }}">
            <textarea name="wysiwyg" class="form-control limited required wysiwyg" cols="5" rows="10">{{ old('body', isset($object->body_043)? $object->body_043 : null) }}</textarea>
            {{ $errors->first('header', config('pulsar::pulsar.errorDelimiters')) }}
            {{ $errors->first('body', config('pulsar::pulsar.errorDelimiters')) }}
            {{ $errors->first('footer', config('pulsar::pulsar.errorDelimiters')) }}
        </div>
    </div>

    @include('pulsar::includes.html.form_select_group', [
        'label' => trans_choice('pulsar::pulsar.theme', 1),
        'name' => 'theme',
        'value' => old('theme', isset($object->theme_043)? $object->theme_043 : null),
        'objects' => $themes,
        'idSelect' => 'folder',
        'nameSelect' => 'name',
        'class' => 'select2',
        'data' => [
            'language' => config('app.locale'),
            'width' => '50%',
            'error-placement' => 'select2-section-outer-container'
        ]
    ])

    <div class="form-group">
        <div class="col-md-offset-2 col-md-4">
            <div><a id="btContent" class="btn btn-info mfp-iframe">{{ trans('comunik::pulsar.open_theme') }}</a></div>
        </div>
    </div>
    <!-- /.comunik::email_templates.create -->
@stop