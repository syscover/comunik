@extends('pulsar::layouts.form')

@section('head')
    @parent
    <!-- comunik::email_campaign.create -->
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/jquery.magnific-popup/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">

    <script src="{{ asset('packages/syscover/pulsar/vendor/jquery.magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('packages/syscover/pulsar/vendor/datetimepicker/js/moment.min.js') }}"></script>
    <script src="{{ asset('packages/syscover/pulsar/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('packages/syscover/pulsar/vendor/duallistbox/jquery.duallistbox.1.3.1.js') }}"></script>

    @include('pulsar::includes.html.froala_references')

    <script>
        $(document).ready(function() {

            // custom Dual multi select
            $.configureBoxes({
                textShowing: '{{ trans('pulsar::pulsar.showing') }}',
                textOf: '{{ trans('pulsar::pulsar.of') }}'
            })

            // custom Dual multi select
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
            })

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

            @if(isset($object))
                $('[name="htmlLink"]').attr('readonly', true)
                $('[name="unsubscribeLink"]').attr('readonly',true)
                $('[name="trackPixel"]').attr('readonly',true)
            @endif

            // on submit, get content from wysiwyg
            $("#recordForm").on('submit', function(event) {
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
                        success:  function(data)
                        {
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
                        error:function(objXMLHttpRequest)
                        {
                            //error
                        }
                    })
                }
            })

            // when change template
            $("[name='template']").on('change', function() {
                if($(this).val() != "")
                {
                    var url = '{{ route('apiShowComunikEmailTemplate', ['id' => '%id%', 'api' => 1]) }}'
                    $.ajax({
                        type: "POST",
                        url: url.replace('%id%', $('[name=template]').val()),
                        dataType: 'json',
                        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                        success: function(data)
                        {
                            $("[name='subject']").val(data.subject_043)
                            $("[name='header']").val(data.header_043)
                            $("[name='body']").val(data.body_043)
                            $("[name='footer']").val(data.footer_043)
                            $("[name='data']").val(data.data_043)
                            $("[name='theme']").val(data.theme_043).select2()

                            //$('.wysiwyg').froalaEditor('html.set', data.body_043)
                            $('.wysiwyg').val(data.body_043)

                            if($('[name="theme"]').val() == '') {
                                $('#btContent').fadeOut()
                            }
                            else
                            {
                                $('#btContent').fadeIn()
                                var url = '{{ route('contentbuilder', ['package' => 'comunik', 'theme' => '%theme%', 'input' => 'body']) }}'

                                // set link on btContent who has magnific popup loaded
                                $('#btContent').attr('href', url.replace('%theme%', $('[name="theme"]').val()))
                            }

                            $('[name="htmlLink"]').attr('readonly', true)
                            $('[name="unsubscribeLink"]').attr('readonly', true)
                            $('[name="trackPixel"]').attr('readonly', true)

                            $('[name="setHtmlLink"]').attr('checked', false)
                            $('[name="setUnsubscribeLink"]').attr('checked', false)
                            $('[name="setTrackPixel"]').attr('checked', false)

                            $.uniform.update()
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
    <!-- /.comunik::email_campaign.create -->
@stop

@section('rows')
    <!-- comunik::email_campaign.create -->
    @include('pulsar::includes.html.form_text_group', [
        'label' => 'ID',
        'name' => 'id',
        'value' => isset($object->id_044)? $object->id_044 : null,
        'readOnly' => true,
        'fieldSize' => 2
    ])
    @include('pulsar::includes.html.form_text_group', [
        'label' => trans('pulsar::pulsar.name'),
        'name' => 'name',
        'value' => old('name', isset($object->name_044)? $object->name_044 : null),
        'maxLength' => '255',
        'rangeLength' => '2,255',
        'required' => true
    ])
    @include('pulsar::includes.html.form_select_group', [
        'label' => trans_choice('pulsar::pulsar.account', 1),
        'name' => 'emailAccount',
        'value' => old('emailAccount', isset($object->email_account_044)? $object->email_account_044 : null),
        'objects' => $emailAccounts,
        'idSelect' => 'id_013',
        'nameSelect' => 'email_013',
        'class' => 'select2',
        'required' => true,
        'data' => [
            'language' => config('app.locale'),
            'width' => '50%',
            'error-placement' => 'select2-section-outer-container'
        ]
    ])

    @include('pulsar::includes.html.form_section_header', [
        'label' => trans_choice('pulsar::pulsar.content', 2),
        'icon' => 'fa fa-newspaper-o'
    ])
    @include('pulsar::includes.html.form_select_group', [
        'label' => trans_choice('pulsar::pulsar.template', 1),
        'name' => 'template',
        'value' => old('template', isset($object->template_044)? $object->template_044 : null),
        'objects' => $templates,
        'idSelect' => 'id_043',
        'nameSelect' => 'name_043',
        'class' => 'select2',
        'data' => [
            'language' => config('app.locale'),
            'width' => '50%',
            'error-placement' => 'select2-section-outer-container'
        ]
    ])
    @include('pulsar::includes.html.form_checkbox_text_group', [
        'label' => trans('comunik::pulsar.include_html_link'),
        'name' => 'setHtmlLink',
        'value' => 1,
        'checked' => !isset($object),
        'inputText' => [
            'name' => 'htmlLink',
            'value' => trans('comunik::pulsar.html_link_value')
        ]
    ])
    @include('pulsar::includes.html.form_checkbox_text_group', [
        'label' => trans('comunik::pulsar.include_unsubscribe_link'),
        'name' => 'setUnsubscribeLink',
        'value' => 1,
        'checked' => !isset($object),
        'inputText' => [
            'name' => 'unsubscribeLink',
            'value' => trans('comunik::pulsar.unsubscribe_link_value')
        ]
    ])
    @include('pulsar::includes.html.form_checkbox_text_group', [
        'label' => trans('comunik::pulsar.include_track_pixel'),
        'name' => 'setTrackPixel',
        'value' => 1,
        'checked' => !isset($object),
        'inputText' => [
            'name' => 'trackPixel',
            'value' => "<img height='1' width='1' src='" . route('statisticsComunikEmailCampaign', ['campaign' => '#campaign#', 'historicalId' => '#historicalId#']) . "'>"
        ]
    ])
    @include('pulsar::includes.html.form_text_group', [
        'label' => trans('pulsar::pulsar.subject'),
        'name' => 'subject',
        'value' => old('subject', isset($object->subject_044)? $object->subject_044 : null),
        'maxLength' => '255',
        'rangeLength' => '2,255',
        'required' => true
    ])

    <!-- TODO: evitar usar HTML dentro de vistas -->
    <div class="form-group">
        <label class="col-md-2 control-label">{{ trans('pulsar::pulsar.message') }} @include('pulsar::includes.html.required')</label>
        <div class="col-md-10">
            <input type="hidden" id="emlHeaders" name="emlHeaders" value="{{ $emlHeaders }}">
            <input type="hidden" id="header" name="header" value="{{ htmlspecialchars(old('header', isset($object->header_044)? $object->header_044 : null)) }}">
            <input type="hidden" id="body" name="body" value="{{ htmlspecialchars(old('body', isset($object->body_044)? $object->body_044 : null)) }}">
            <input type="hidden" id="footer" name="footer" value="{{ htmlspecialchars(old('footer', isset($object->footer_044)? $object->footer_044 : null)) }}">
            <input type="hidden" id="text" name="text" value="{{ htmlspecialchars(old('text', isset($object->text_044)? $object->text_044 : null)) }}">
            <textarea name="wysiwyg" class="form-control limited required wysiwyg" cols="5" rows="10">{{ old('body', isset($object->body_044)? $object->body_044 : null) }}</textarea>
            {{ $errors->first('header', config('pulsar::pulsar.errorDelimiters')) }}
            {{ $errors->first('body', config('pulsar::pulsar.errorDelimiters')) }}
            {{ $errors->first('footer', config('pulsar::pulsar.errorDelimiters')) }}
        </div>
    </div>

    @include('pulsar::includes.html.form_select_group', [
        'label' => trans_choice('pulsar::pulsar.theme', 1),
        'name' => 'theme',
        'value' => old('theme', isset($object->theme_044)? $object->theme_044 : null),
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
    @include('pulsar::includes.html.form_section_header', [
        'label' => trans_choice('pulsar::pulsar.preference', 2),
        'icon' => 'fa fa-cog'
    ])
    @include('pulsar::includes.html.form_datetimepicker_group', [
        'label' => trans('comunik::pulsar.shipping_date'),
        'name' => 'shippingDate',
        'fieldSize' => 5,
        'data' => [
            'format' => Miscellaneous::convertFormatDate(config('pulsar.datePattern')) . ' HH:mm',
            'locale' => config('app.locale'),
            'default-date' => old('shippingDate', isset($object->shipping_date_044)? date('Y-m-d', $object->shipping_date_044) : null)
        ]
    ])
    <div class="form-group">
        <label class="col-md-2 control-label"></label>
        <div class="col-md-10">
            <small>En caso de no seleccionar ninguna fecha, el envío se realizará de forma inmediata.</small>
        </div>
    </div>
    @include('pulsar::includes.html.form_datetimepicker_group', [
        'label' => trans('comunik::pulsar.persistence_date'),
        'name' => 'persistenceDate',
        'fieldSize' => 5,
        'data' => [
            'format' => Miscellaneous::convertFormatDate(config('pulsar.datePattern')) . ' HH:mm',
            'locale' => config('app.locale'),
            'default-date' => old('persistenceDate', isset($object->persistence_date_044)? date('Y-m-d', $object->persistence_date_044) : null)
        ],
        'inputs' => [
            [
                'labelSize' => 2,
                'fieldSize' => 2,
                'label' => trans('pulsar::pulsar.sorting'),
                'name' => 'sorting',
                'value' => old('sorting', isset($object->sorting_044)? $object->sorting_044 : null),
            ]
        ]
    ])
    <div class="form-group">
        <label class="col-md-2 control-label"></label>
        <div class="col-md-10">
            <small>Fecha de finalización de campaña, se enviará esta campaña a todos los nuevos concactos asignados a los grupos de esta campaña, no rellenar en caso de no desear activar la persistencia.</small>
        </div>
    </div>
    @include('pulsar::includes.html.form_section_header', [
        'label' => trans('comunik::pulsar.shipping_groups'),
        'icon' => 'fa fa-users'
    ])
    @include('pulsar::includes.html.form_dual_list_group', [
        'name' => 'groups',
        'value' => old('groups'),
        'objects' => $groups,
        'idSelect' => 'id_040',
        'nameSelect' => 'name_040',
        'objectsSelect' => old('groups', isset($selectGroups)? $selectGroups : null),
        'idList1' => 1,
        'idList2' => 2,
        'required' => true
    ])
    @include('pulsar::includes.html.form_section_header', [
        'label' => trans('comunik::pulsar.shipping_countries'),
        'icon' => 'fa fa-globe'
    ])
    @include('pulsar::includes.html.form_dual_list_group', [
        'name' => 'countries',
        'value' => old('countries'),
        'objects' => $countries,
        'idSelect' => 'id_002',
        'nameSelect' => 'name_002',
        'objectsSelect' => old('groups', isset($selectCountries)? $selectCountries : null),
        'idList1' => 3,
        'idList2' => 4,
        'required' => true
    ])
    @if($action == 'update')
        @include('pulsar::includes.html.form_section_header', [
            'label' => trans_choice('comunik::pulsar.statistic', 2),
            'icon' => 'fa fa-area-chart'
        ])
        @include('pulsar::includes.html.form_text_group', [
            'labelSize' => 2,
            'fieldSize' => 3,
            'label' => trans('comunik::pulsar.queue_mailings'),
            'name' => null,
            'value' => $queueMailings,
            'readOnly' => true,
            'inputs' => [
                [
                    'labelSize' => 2,
                    'fieldSize' => 3,
                    'label' => trans('comunik::pulsar.view_mailings'),
                    'name' => null,
                    'value' => $object->viewed_044,
                    'readOnly' => true
                ]
            ]
        ])
        @include('pulsar::includes.html.form_text_group', [
            'labelSize' => 2,
            'fieldSize' => 3,
            'label' => trans('comunik::pulsar.sent_mailings'),
            'name' => null,
            'value' => $sentMailings,
            'readOnly' => true,
            'inputs' => [
                [
                    'labelSize' => 2,
                    'fieldSize' => 3,
                    'label' => trans('comunik::pulsar.seen_unique_emails'),
                    'name' => null,
                    'value' => $uniqueViewMailings,
                    'readOnly' => true
                ]
        ]])
        @include('pulsar::includes.html.form_text_group', [
            'labelSize' => 2,
            'fieldSize' => 3,
            'label' => trans('comunik::pulsar.for_sending_emails'),
            'name' => null,
            'value' => $noSentMailings,
            'readOnly' => true,
            'inputs' => [
                [
                    'labelSize' => 2,
                    'fieldSize' => 3,
                    'label' => trans('comunik::pulsar.campaign_effectiveness'),
                    'name' => null,
                    'value' => $effectiveness,
                    'readOnly' => true
                ]
            ]
        ])
    @endif
    <!-- /.comunik::email_campaign.create -->
@stop