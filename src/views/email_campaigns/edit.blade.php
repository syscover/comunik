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

    @include('comunik::email_campaigns.includes.common_script', ['action' => 'update'])
    <!-- /comunik::email_campaigns.edit -->
@stop
@section('rows')
    <!-- comunik::email_campaigns.edit -->
    @include('pulsar::includes.html.form_text_group', ['label' => 'ID', 'name' => 'id', 'value' => $object->id_044, 'readOnly' => true, 'fieldSize' => 2])
    @include('pulsar::includes.html.form_text_group', ['label' => trans('pulsar::pulsar.name'), 'name' => 'name', 'value' => $object->name_044, 'maxLength' => '50', 'rangeLength' => '2,50', 'required' => true])
    @include('pulsar::includes.html.form_select_group', ['label' => trans_choice('pulsar::pulsar.account', 1), 'name' => 'emailAccount', 'value' => $object->email_account_044, 'objects' => $emailAccounts, 'idSelect' => 'id_013', 'nameSelect' => 'email_013', 'class' => 'select2', 'required' => true, 'data' => ['language' => config('app.locale'), 'width' => '50%', 'error-placement' => 'select2-section-outer-container']])
    @include('pulsar::includes.html.form_section_header', ['label' => trans_choice('pulsar::pulsar.content', 2), 'icon' => 'fa fa-newspaper-o'])
    @include('pulsar::includes.html.form_select_group', ['label' => trans_choice('pulsar::pulsar.template', 1), 'name' => 'template', 'value' => $object->template_044, 'objects' => $templates, 'idSelect' => 'id_043', 'nameSelect' => 'name_043', 'class' => 'select2', 'data' => ['language' => config('app.locale'), 'width' => '50%', 'error-placement' => 'select2-section-outer-container']])

    @include('pulsar::includes.html.form_checkbox_text_group', ['label' => trans('comunik::pulsar.include_html_link'), 'name' => 'setHtmlLink', 'value' => 1, 'checked' => false, 'inputText' => ['name' => 'htmlLink', 'value' => trans('comunik::pulsar.html_link_value')]])
    @include('pulsar::includes.html.form_checkbox_text_group', ['label' => trans('comunik::pulsar.include_unsubscribe_link'), 'name' => 'setUnsubscribeLink', 'value' => 1, 'checked' => false, 'inputText' => ['name' => 'unsubscribeLink', 'value' => trans('comunik::pulsar.unsubscribe_link_value')]])
    @include('pulsar::includes.html.form_checkbox_text_group', ['label' => trans('comunik::pulsar.include_track_pixel'), 'name' => 'setTrackPixel', 'value' => 1, 'checked' => false, 'inputText' => ['name' => 'trackPixel', 'value' => "<img height='1' width='1' src='" . route('statisticsComunikEmailCampaign', ['campaign' => '#campaign#', 'historicalId' => '#historicalId#']) . "'>"]])
    @include('pulsar::includes.html.form_text_group', ['label' => trans('pulsar::pulsar.subject'), 'name' => 'subject', 'value' => $object->subject_044, 'maxLength' => '255', 'rangeLength' => '2,255', 'required' => true])
    <!-- TODO: evitar usar HTML dentro de vistas -->
    <div class="form-group">
        <label class="col-md-2 control-label">{{ trans('pulsar::pulsar.message') }} @include('pulsar::includes.html.required')</label>
        <div class="col-md-10">
            <input type="hidden" id="emlHeaders" name="emlHeaders" value="{{ $emlHeaders }}">
            <input type="hidden" id="header" name="header" value="{{ htmlspecialchars($object->header_044) }}">
            <input type="hidden" id="body" name="body" value="{{ htmlspecialchars($object->body_044) }}">
            <input type="hidden" id="footer" name="footer" value="{{ htmlspecialchars($object->footer_044) }}">
            <input type="hidden" id="text" name="text" value="{{ htmlspecialchars($object->text_044) }}">
            <textarea name="wysiwyg" class="form-control limited required wysiwyg" cols="5" rows="10">{{ $object->body_044 }}</textarea>
            {{ $errors->first('header', config('pulsar::pulsar.errorDelimiters')) }}
            {{ $errors->first('body', config('pulsar::pulsar.errorDelimiters')) }}
            {{ $errors->first('footer', config('pulsar::pulsar.errorDelimiters')) }}
        </div>
    </div>
    @include('pulsar::includes.html.form_select_group', ['label' => trans_choice('pulsar::pulsar.theme', 1), 'name' => 'theme', 'value' => $object->theme_044, 'objects' => $themes, 'idSelect' => 'folder', 'nameSelect' => 'name', 'class' => 'select2', 'data' => ['language' => config('app.locale'), 'width' => '50%', 'error-placement' => 'select2-section-outer-container']])
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
            <small>{{ trans('comunik::pulsar.shipping_date_notice') }}</small>
        </div>
    </div>
    @include('pulsar::includes.html.form_datetimepicker_group', ['label' => trans('comunik::pulsar.persistence_date'), 'name' => 'persistenceDate', 'value' => empty($object->persistence_date_044)? null : date(config('pulsar.datePattern') . ' H:i', $object->persistence_date_044), 'fieldSize' => 5, 'data' => ['format' => Miscellaneous::convertFormatDate(config('pulsar.datePattern')) . ' HH:mm', 'locale' => config('app.locale')], 'inputs' => [
        ['label' => trans('pulsar::pulsar.sorting'), 'name' => 'sorting', 'labelSize' => 2, 'fieldSize' => 2, 'value' => $object->sorting_044]
    ]])
    <div class="form-group">
        <label class="col-md-2 control-label"></label>
        <div class="col-md-10">
            <small>{{ trans('comunik::pulsar.campaign_persistence_notice') }}</small>
        </div>
    </div>
    @include('pulsar::includes.html.form_section_header', ['label' => trans('comunik::pulsar.shipping_groups'), 'icon' => 'fa fa-users'])
    @include('pulsar::includes.html.form_dual_list_group', ['name' => 'groups', 'objectsSelect' => $object->groups, 'objects' => $groups, 'idSelect' => 'id_040', 'nameSelect' => 'name_040', 'idList1' => 1, 'idList2' => 2, 'required' => true])
    @include('pulsar::includes.html.form_section_header', ['label' => trans('comunik::pulsar.shipping_countries'), 'icon' => 'fa fa-globe'])
    @include('pulsar::includes.html.form_dual_list_group', ['name' => 'countries', 'objectsSelect' => $object->countries->where('lang_002', Auth::user()->lang_010), 'objects' => $countries, 'idSelect' => 'id_002', 'nameSelect' => 'name_002', 'idList1' => 3, 'idList2' => 4, 'required' => true])

    @include('pulsar::includes.html.form_section_header', ['label' => trans_choice('comunik::pulsar.statistic', 2), 'icon' => 'fa fa-area-chart'])
    @include('pulsar::includes.html.form_text_group', ['labelSize' => 2, 'fieldSize' => 3, 'label' => trans('comunik::pulsar.queue_mailings'), 'name' => '', 'value' => $queueMailings, 'readOnly' => true, 'inputs' => [
        ['labelSize' => 2, 'fieldSize' => 3, 'label' => trans('comunik::pulsar.view_mailings'), 'name' => '', 'value' => $object->viewed_044, 'readOnly' => true]
    ]])
    @include('pulsar::includes.html.form_text_group', ['labelSize' => 2, 'fieldSize' => 3, 'label' => trans('comunik::pulsar.sent_mailings'), 'name' => '', 'value' => $sentMailings, 'readOnly' => true, 'inputs' => [
        ['labelSize' => 2, 'fieldSize' => 3, 'label' => trans('comunik::pulsar.seen_unique_emails'), 'name' => '', 'value' => $uniqueViewMailings, 'readOnly' => true]
    ]])
    @include('pulsar::includes.html.form_text_group', ['labelSize' => 2, 'fieldSize' => 3, 'label' => trans('comunik::pulsar.for_sending_emails'), 'name' => '', 'value' => $noSentMailings, 'readOnly' => true, 'inputs' => [
        ['labelSize' => 2, 'fieldSize' => 3, 'label' => trans('comunik::pulsar.campaign_effectiveness'), 'name' => '', 'value' => $effectiveness, 'readOnly' => true]
    ]])
    <!-- /comunik::email_campaigns.edit -->
@stop