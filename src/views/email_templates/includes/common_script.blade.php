<!-- comunik::email_templates.includes.common_script -->
<script type="text/javascript">
    $(document).ready(function() {

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
                        src: ''
                    },
                    callbacks: {
                        open: function()
                        {
                            // set iframe background color
                            $('.mfp-iframe-scaler iframe').css('background', '#fff');
                            $("[name=body]").val($('[name=wysiwyg]').froalaEditor('html.get'));
                            $('.mfp-iframe').contents().find('html').html($('[name=header]').val() + $('[name=body]').val() + $('[name=footer]').val());
                        }
                    }
                });
            }
        });

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
        });

        // on submit, get content from wysiwyg
        $("#recordForm").on('submit', function(event) {
            $("[name=body]").val($('[name=wysiwyg]').froalaEditor('html.get'));
        });

        $('#btContent').on('click', function(){
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

                @if($action == 'create')
                    $('[name="setHtmlLink"]').prop('checked', true);
                    $('[name="htmlLink"]').attr('readonly', false);
                    $('[name="setUnsubscribeLink"]').prop('checked', true);
                    $('[name="unsubscribeLink"]').attr('readonly',false);

                    $.uniform.update();
                @endif
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

                        @if($action == 'create')
                            $('[name="setHtmlLink"]').prop('checked', false);
                            $('[name="htmlLink"]').attr('readonly', true);
                            $('[name="setUnsubscribeLink"]').prop('checked', false);
                            $('[name="unsubscribeLink"]').attr('readonly',true);

                            $.uniform.update();
                        @endif
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

        @if($action == 'update')
            $('[name="theme"]').trigger('change');
        @endif
    });

    // function called from pulsar::contentbuilder.index
    var getValueContentBuilder = function(html, settings)
    {
        var url = '{{ route('contentbuilderBlocks', ['theme' => 'theme']) }}';
        $.ajax({
            type:       "POST",
            url:        url.replace('theme', $('[name="theme"]').val()),
            dataType:   "json",
            headers:    { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            data:       {
                themeFolder: '{{ config('comunik.themesFolder') }}/',
                settings: settings
            },
            success:  function(data)
            {
                $('[name=header]').val(data.header);
                $('[name=body]').val(html);
                $('[name=footer]').val(data.footer);
                $('[name=data]').val(JSON.stringify(settings));

                $('.wysiwyg').froalaEditor('html.set', html);
            },
            error:function(objXMLHttpRequest)
            {
                //error
            }
        });
    }
</script>
<!-- /comunik::email_templates.includes.common_script -->