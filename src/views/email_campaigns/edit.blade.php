@extends('pulsar::layouts.form', ['action' => 'update'])

@section('script')
    @parent
    <!-- comunik::email_campaigns.edit -->
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
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">

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
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/datetimepicker/js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/duallistbox/jquery.duallistbox.1.3.1.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            //--------------- Customm Dual multi select ------------------//
            $.configureBoxes({
                textShowing: '{{ trans('pulsar::pulsar.showing') }}',
                textOf: '{{ trans('pulsar::pulsar.of') }}'
            });

            //--------------- Customm Dual multi select ------------------//
            $.configureBoxes({
                textShowing: '{{ trans('pulsar::pulsar.showing') }}',
                textOf: '{{ trans('pulsar::pulsar.of') }}',
                box1View: 'box3View',
                box1Storage: 'box3Storage',
                box1Filter: 'box3Filter',
                box1Clear: 'box3Clear',
                box1Counter: 'box3Counter',
                box2View: 'box4View',
                box2Storage: 'box4Storage',
                box2Filter: 'box4Filter',
                box2Clear: 'box4Clear',
                box2Counter: 'box4Counter',
                to1: 'to3',
                to2: 'to4',
                allTo1: 'allTo3',
                allTo2: 'allTo4'
            });

            //$('#report').hide();

            // bottoms to insert patterns
            $('.actionB').bind("click", function () {
                var insert = '#'+$(this).attr('data-template')+'#';
                var target = $(this).attr('data-target');

                insertAtCaret(target, insert);

                $("[name='"+target+"']").focus();
            });

            if($('[name="theme"]').val() == "") {
                $('#btContent').hide();
            }

            // set elements to email template
            $('[name="setHtmlLink"]').bind("click", function () {
                if($('[name="setHtmlLink"]').is(':checked')) {
                    $('[name="htmlLink"]').attr('readonly', false);
                }
                else
                {
                    $('[name="htmlLink"]').attr('readonly',true);
                }
            });
            $('[name="setUnsubscribeLink"]').bind("click", function () {
                if($('[name="setUnsubscribeLink"]').is(':checked')) {
                    $('[name="unsubscribeLink"]').attr('readonly',false);
                }
                else{
                    $('[name="unsubscribeLink"]').attr('readonly',true);
                }
            });
            $('[name="setTrackPixel"]').bind("click", function () {
                if($('[name="setTrackPixel"]').is(':checked')){
                    $('[name="trackPixel"]').attr('readonly',false);
                }
                else{
                    $('[name="trackPixel"]').attr('readonly',true);
                }
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

            $('.wysiwyg').froalaEditor({
                language: '{{ config('app.locale') }}',
                placeholderText: '{{ trans('cms::pulsar.type_something') }}',
                toolbarInline: false,
                toolbarSticky: true,
                tabSpaces: true,
                shortcutsEnabled: ['show', 'bold', 'italic', 'underline', 'strikeThrough', 'indent', 'outdent', 'undo', 'redo', 'insertImage', 'createLink'],
                toolbarButtons: ['fullscreen', 'bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'fontFamily', 'fontSize', '|', 'color', 'inlineStyle', 'paragraphStyle', '|', 'paragraphFormat', 'align', 'formatOL', 'formatUL', 'outdent', 'indent', 'quote', 'insertHR', '|', 'wildcard', '-', 'insertLink', 'insertImage', 'insertVideo', 'insertTable', 'undo', 'redo', 'clearFormatting', 'selectAll', 'html'],
                heightMin: 250,
                enter: $.FroalaEditor.ENTER_BR,
                key: '{{ config('pulsar.froalaEditorKey') }}'
            });

            /*
             *   Cargamos los settings de un theme en el campo data, cuando cambiamos el selector de themes,
             *   estos settings los cargaremos con javascript desde el content buider
             */
            $('[name="theme"]').on('change', function() {
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
                    $('#btContent').attr('href', url.replace('theme', $('[name="theme"]').val()));

                    $.ajax({
                        type:       "POST",
                        url:        "{{ asset(config('comunik.themesFolder')) }}/" + $('[name="theme"]').val() + '/settings.json',
                        dataType:   "json",
                        success:  function(data) {
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

        var checkSpamScore = function() {

            var email = $('#header').val() + $('#body').val() + $('#footer').val();

            if(email == "") {
                $.msgbox("<div style=\"font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;\">No hay contenidos que valorar</div><br><br>", {type:"alert", buttons: [{type: "submit", value: "Aceptar"}]});
                return;
            }
            else {
                var emlHeaders  = $('#emlHeaders').val();
                var d           = new Date();
                var days        = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
                var months      = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                var date        = days[d.getDay()] + ', ' + d.getDate() + ' '+ months[d.getMonth()] + ' ' + d.getFullYear() + ' ' + (d.getHours() <10?'0':'') + d.getHours() + ':' + (d.getMinutes() <10?'0':'') + d.getMinutes() + ':' + (d.getSeconds() <10?'0':'') + d.getSeconds() + ' +0000';

                emlHeaders = emlHeaders.replace('#returpath#',  'info@syscover.com');
                emlHeaders = emlHeaders.replace('#date#',       date);
                emlHeaders = emlHeaders.replace('#subject#',    $('[name="asunto"]').val());
                emlHeaders = emlHeaders.replace('#from#',       'info@syscover.com');
                emlHeaders = emlHeaders.replace('#to#',         'info@syscover.com');
                emlHeaders = emlHeaders.replace('#envelopeto#', 'info@syscover.com');
                emlHeaders = emlHeaders.replace('#text#',       $('[name="text"]').val());
                emlHeaders = emlHeaders.replace('#html#',       email);
            }

            $.cssLoader.show({
                useLayer: false
            });

            var dataRequest = {
                email:      emlHeaders,
                options:    "long"
            };

            $.ajax({
                type:       "POST",
                url:        "{{ URL::to(Config::get('pulsar.appName').'/comunik/email/services/spam/score') }}" ,
                dataType:   "json",
                data:       dataRequest,
                success:  function(data) {

                    $('#report').html(data.report);
                    $('#report').fadeIn();
                    $('.knob').countTo({
                        from: 0,
                        to: data.score,
                        speed: 1000,
                        decimals: 2,
                        refreshInterval: 10,
                        onUpdate: function(value) {
                            $(this).val(value.toFixed(2));
                            $(".knob").trigger('change');
                        },
                        onComplete: function(value) {

                            $('#knob-color').countTo({
                                from: 0,
                                to: data.score,
                                speed: 1000,
                                decimals: 2,
                                refreshInterval: 10,
                                onUpdate: function(value)
                                {
                                    var color = getColorForPercentage((10 - (value / 2)) / 10);
                                    $(".knob").trigger('configure', { 'fgColor': color });
                                    $(".knob").trigger('change');
                                },
                                onComplete: function(value)
                                {
                                    $.cssLoader.hide();
                                    $.msgbox("<div style=\"font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;\">Comprobación finalizada</div><div>Su puntuación ha sido de: "+ value + " Spam score</div>", {type:"info", buttons: [{type: "submit", value: "Aceptar"}]});
                                }
                            });
                            $(".knob").trigger('change');
                        }
                    });
                },
                error:function(objXMLHttpRequest){
                    //error
                }
            });
        }
    </script>
    <!-- /comunik::email_campaigns.edit -->
@stop
@section('rows')
    <!-- comunik::email_campaigns.edit -->
    @include('pulsar::includes.html.form_text_group', ['label' => 'ID', 'name' => 'id', 'value' => $object->id_044, 'readOnly' => true, 'fieldSize' => 2])
    @include('pulsar::includes.html.form_text_group', ['label' => trans('pulsar::pulsar.name'), 'name' => 'name', 'value' => $object->name_044, 'maxLength' => '50', 'rangeLength' => '2,50', 'required' => true])
    @include('pulsar::includes.html.form_select_group', ['label' => trans_choice('pulsar::pulsar.account', 1), 'name' => 'emailAccount', 'value' => $object->email_account_044, 'objects' => $emailAccounts, 'idSelect' => 'id_013', 'nameSelect' => 'email_013', 'class' => 'form-control select2', 'required' => true, 'data' => ['language' => config('app.locale'), 'width' => '50%', 'error-placement' => 'select2-section-outer-container']])
    @include('pulsar::includes.html.form_section_header', ['label' => trans_choice('pulsar::pulsar.content', 2), 'icon' => 'fa fa-newspaper-o'])
    @include('pulsar::includes.html.form_select_group', ['label' => trans_choice('pulsar::pulsar.template', 1), 'name' => 'template', 'value' => $object->template_044, 'objects' => $templates, 'idSelect' => 'id_043', 'nameSelect' => 'name_043', 'class' => 'form-control select2', 'data' => ['language' => config('app.locale'), 'width' => '50%', 'error-placement' => 'select2-section-outer-container']])

    @include('pulsar::includes.html.form_checkbox_text_group', ['label' => trans('comunik::pulsar.include_html_link'), 'name' => 'setHtmlLink', 'value' => 1, 'checked' => true, 'inputText' => ['name' => 'htmlLink', 'value' => trans('comunik::pulsar.html_link_value')]])
    @include('pulsar::includes.html.form_checkbox_text_group', ['label' => trans('comunik::pulsar.include_unsubscribe_link'), 'name' => 'setUnsubscribeLink', 'value' => 1, 'checked' => true, 'inputText' => ['name' => 'unsubscribeLink', 'value' => trans('comunik::pulsar.unsubscribe_link_value')]])
    @include('pulsar::includes.html.form_checkbox_text_group', ['label' => trans('comunik::pulsar.include_track_pixel'), 'name' => 'setTrackPixel', 'value' => 1, 'checked' => true, 'inputText' => ['name' => 'trackPixel', 'value' =>trans('comunik::pulsar.track_pixel_value', ['url' => url(config('pulsar.appName') . config('comunik.trackPixel'))])]])
    @include('pulsar::includes.html.form_text_group', ['label' => trans('pulsar::pulsar.subject'), 'name' => 'subject', 'value' => $object->subject_044, 'maxLength' => '255', 'rangeLength' => '2,255', 'required' => true])
    <!-- TODO: evitar usar HTML dentro de vistas -->
    <div class="form-group">
        <label class="col-md-2 control-label">{{ trans('pulsar::pulsar.message') }} @include('pulsar::includes.html.required')</label>
        <div class="col-md-10">
            <input type="hidden" id="emlHeaders" name="emlHeaders" value="{{ $emlHeaders }}">
            <input type="hidden" id="header" name="header" value="{{ htmlspecialchars($object->header_044) }}">
            <input type="hidden" id="footer" name="footer" value="{{ htmlspecialchars($object->footer_044) }}">
            <input type="hidden" id="text" name="text" value="{{ htmlspecialchars(Input::old('text')) }}">
            <textarea id="body" name="body" class="form-control limited required wysiwyg" cols="5" rows="10">{{ $object->body_044 }}</textarea>
            {{ $errors->first('header', config('pulsar::pulsar.errorDelimiters')) }}
            {{ $errors->first('body', config('pulsar::pulsar.errorDelimiters')) }}
            {{ $errors->first('footer', config('pulsar::pulsar.errorDelimiters')) }}
        </div>
    </div>
    @include('pulsar::includes.html.form_select_group', ['label' => trans_choice('pulsar::pulsar.theme', 1), 'name' => 'theme', 'value' => $object->theme_044, 'objects' => $themes, 'idSelect' => 'folder', 'nameSelect' => 'name', 'class' => 'form-control select2', 'data' => ['language' => config('app.locale'), 'width' => '50%', 'error-placement' => 'select2-section-outer-container']])
    <div class="form-group">
        <div class="col-md-offset-2 col-md-4">
            <div><a id="btContent" class="btn btn-info mfp-iframe">Insertar theme</a></div>
        </div>
    </div>
    @include('pulsar::includes.html.form_section_header', ['label' => trans_choice('pulsar::pulsar.preference', 2), 'icon' => 'fa fa-cog'])
    @include('pulsar::includes.html.form_datetimepicker_group', ['label' => trans('comunik::pulsar.shipping_date'), 'name' => 'shippingDate', 'value' => date(config('pulsar.datePattern') . ' H:i', $object->shipping_date_044), 'fieldSize' => 5, 'data' => ['format' => Miscellaneous::convertFormatDate(config('pulsar.datePattern')) . ' HH:mm', 'locale' => config('app.locale')]])
    <div class="form-group">
        <label class="col-md-2 control-label"></label>
        <div class="col-md-10">
            <small>En caso de no seleccionar ninguna fecha, el envío se realizará de forma inmediata.</small>
        </div>
    </div>
    @include('pulsar::includes.html.form_datetimepicker_group', ['label' => trans('comunik::pulsar.persistence_date'), 'name' => 'persistenceDate', 'value' => date(config('pulsar.datePattern') . ' H:i', $object->persistence_date_044), 'fieldSize' => 5, 'data' => ['format' => Miscellaneous::convertFormatDate(config('pulsar.datePattern')) . ' HH:mm', 'locale' => config('app.locale')], 'inputs' => [
        ['label' => trans('pulsar::pulsar.sorting'), 'name' => 'sorting', 'labelSize' => 2, 'fieldSize' => 2, 'value' => $object->sorting_044]
    ]])
    <div class="form-group">
        <label class="col-md-2 control-label"></label>
        <div class="col-md-10">
            <small>Fecha de finalización de campaña, se enviará esta campaña a todos los nuevos concactos asignados a los grupos de esta campaña, no rellenar en caso de no desear activar la persistencia.</small>
        </div>
    </div>
    @include('pulsar::includes.html.form_section_header', ['label' => trans('comunik::pulsar.shipping_groups'), 'icon' => 'fa fa-users'])
    @include('pulsar::includes.html.form_dual_list_group', ['name' => 'groups', 'objectsSelect' => $object->groups, 'objects' => $groups, 'idSelect' => 'id_040', 'nameSelect' => 'name_040', 'idList1' => 1, 'idList2' => 2, 'required' => true])
    @include('pulsar::includes.html.form_section_header', ['label' => trans('comunik::pulsar.shipping_countries'), 'icon' => 'fa fa-globe'])
    @include('pulsar::includes.html.form_dual_list_group', ['name' => 'countries', 'objectsSelect' => $object->countries->where('lang_002', Auth::user()->lang_010), 'objects' => $countries, 'idSelect' => 'id_002', 'nameSelect' => 'name_002', 'idList1' => 3, 'idList2' => 4, 'required' => true])
    <!-- /comunik::email_campaigns.edit -->
@stop