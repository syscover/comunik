@extends('pulsar::layouts.form', ['action' => 'store'])

@section('script')
    @parent
    <!-- comunik::email_campaigns.create -->
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
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/duallistbox/jquery.duallistbox.1.3.1.js') }}"></script>

    @include('comunik::email_campaigns.includes.common_script', ['action' => 'create'])
    <!-- /comunik::email_campaigns.create -->
@stop
@section('rows')
    <!-- comunik::email_campaigns.create -->
    @include('pulsar::includes.html.form_text_group', ['label' => 'ID', 'name' => 'id', 'readOnly' => true, 'fieldSize' => 2])
    @include('pulsar::includes.html.form_text_group', ['label' => trans('pulsar::pulsar.name'), 'name' => 'name', 'value' => old('name'), 'maxLength' => '50', 'rangeLength' => '2,50', 'required' => true])
    @include('pulsar::includes.html.form_select_group', ['label' => trans_choice('pulsar::pulsar.account', 1), 'name' => 'emailAccount', 'value' => old('emailAccount'), 'objects' => $emailAccounts, 'idSelect' => 'id_013', 'nameSelect' => 'email_013', 'class' => 'select2', 'required' => true, 'data' => ['language' => config('app.locale'), 'width' => '50%', 'error-placement' => 'select2-section-outer-container']])
    @include('pulsar::includes.html.form_section_header', ['label' => trans_choice('pulsar::pulsar.content', 2), 'icon' => 'fa fa-newspaper-o'])
    @include('pulsar::includes.html.form_select_group', ['label' => trans_choice('pulsar::pulsar.template', 1), 'name' => 'template', 'value' => old('template'), 'objects' => $templates, 'idSelect' => 'id_043', 'nameSelect' => 'name_043', 'class' => 'select2', 'data' => ['language' => config('app.locale'), 'width' => '50%', 'error-placement' => 'select2-section-outer-container']])

    @include('pulsar::includes.html.form_checkbox_text_group', ['label' => trans('comunik::pulsar.include_html_link'), 'name' => 'setHtmlLink', 'value' => 1, 'checked' => true, 'inputText' => ['name' => 'htmlLink', 'value' => trans('comunik::pulsar.html_link_value')]])
    @include('pulsar::includes.html.form_checkbox_text_group', ['label' => trans('comunik::pulsar.include_unsubscribe_link'), 'name' => 'setUnsubscribeLink', 'value' => 1, 'checked' => true, 'inputText' => ['name' => 'unsubscribeLink', 'value' => trans('comunik::pulsar.unsubscribe_link_value')]])
    @include('pulsar::includes.html.form_checkbox_text_group', ['label' => trans('comunik::pulsar.include_track_pixel'), 'name' => 'setTrackPixel', 'value' => 1, 'checked' => true, 'inputText' => ['name' => 'trackPixel', 'value' => "<img height='1' width='1' src='" . route('statisticsComunikEmailCampaign', ['campaign' => '#campaign#', 'historicalId' => '#historicalId#']) . "'>"]])
    @include('pulsar::includes.html.form_text_group', ['label' => trans('pulsar::pulsar.subject'), 'name' => 'subject', 'value' => old('subject'), 'maxLength' => '255', 'rangeLength' => '2,255', 'required' => true])
    <!-- TODO: evitar usar HTML dentro de vistas -->
    <div class="form-group">
        <label class="col-md-2 control-label">{{ trans('pulsar::pulsar.message') }} @include('pulsar::includes.html.required')</label>
        <div class="col-md-10">
            <input type="hidden" id="emlHeaders" name="emlHeaders" value="{{ $emlHeaders }}">
            <input type="hidden" id="header" name="header" value="{{ htmlspecialchars(old('header')) }}">
            <input type="hidden" id="body" name="body" value="{{ htmlspecialchars(old('body')) }}">
            <input type="hidden" id="footer" name="footer" value="{{ htmlspecialchars(old('footer')) }}">
            <input type="hidden" id="text" name="text" value="{{ htmlspecialchars(old('text')) }}">
            <textarea name="wysiwyg" class="form-control limited required wysiwyg" cols="5" rows="10">{{ old('body') }}</textarea>
            {{ $errors->first('header', config('pulsar::pulsar.errorDelimiters')) }}
            {{ $errors->first('body', config('pulsar::pulsar.errorDelimiters')) }}
            {{ $errors->first('footer', config('pulsar::pulsar.errorDelimiters')) }}
        </div>
    </div>
    @include('pulsar::includes.html.form_select_group', ['label' => trans_choice('pulsar::pulsar.theme', 1), 'name' => 'theme', 'value' => old('theme'), 'objects' => $themes, 'idSelect' => 'folder', 'nameSelect' => 'name', 'class' => 'select2', 'data' => ['language' => config('app.locale'), 'width' => '50%', 'error-placement' => 'select2-section-outer-container']])
    <div class="form-group">
        <div class="col-md-offset-2 col-md-4">
            <div><a id="btContent" class="btn btn-info mfp-iframe">Insertar theme</a></div>
        </div>
    </div>
    @include('pulsar::includes.html.form_section_header', ['label' => trans_choice('pulsar::pulsar.preference', 2), 'icon' => 'fa fa-cog'])
    @include('pulsar::includes.html.form_datetimepicker_group', ['label' => trans('comunik::pulsar.shipping_date'), 'name' => 'shippingDate', 'value' => old('shippingDate'), 'fieldSize' => 5, 'data' => ['format' => Miscellaneous::convertFormatDate(config('pulsar.datePattern')) . ' HH:mm', 'locale' => config('app.locale')]])
    <div class="form-group">
        <label class="col-md-2 control-label"></label>
        <div class="col-md-10">
            <small>En caso de no seleccionar ninguna fecha, el envío se realizará de forma inmediata.</small>
        </div>
    </div>
    @include('pulsar::includes.html.form_datetimepicker_group', ['label' => trans('comunik::pulsar.persistence_date'), 'name' => 'persistenceDate', 'value' => old('persistenceDate'), 'fieldSize' => 5, 'data' => ['format' => Miscellaneous::convertFormatDate(config('pulsar.datePattern')) . ' HH:mm', 'locale' => config('app.locale')], 'inputs' => [
        ['label' => trans('pulsar::pulsar.sorting'), 'name' => 'sorting', 'labelSize' => 2, 'fieldSize' => 2]
    ]])
    <div class="form-group">
        <label class="col-md-2 control-label"></label>
        <div class="col-md-10">
            <small>Fecha de finalización de campaña, se enviará esta campaña a todos los nuevos concactos asignados a los grupos de esta campaña, no rellenar en caso de no desear activar la persistencia.</small>
        </div>
    </div>
    @include('pulsar::includes.html.form_section_header', ['label' => trans('comunik::pulsar.shipping_groups'), 'icon' => 'fa fa-users'])
    @include('pulsar::includes.html.form_dual_list_group', ['name' => 'groups', 'value' => old('groups'), 'objects' => $groups, 'idSelect' => 'id_040', 'nameSelect' => 'name_040', 'idList1' => 1, 'idList2' => 2, 'required' => true])
    @include('pulsar::includes.html.form_section_header', ['label' => trans('comunik::pulsar.shipping_countries'), 'icon' => 'fa fa-globe'])
    @include('pulsar::includes.html.form_dual_list_group', ['name' => 'countries', 'value' => old('countries'), 'objects' => $countries, 'idSelect' => 'id_002', 'nameSelect' => 'name_002', 'idList1' => 3, 'idList2' => 4, 'required' => true])
    <!-- /comunik::email_campaigns.create -->
@stop