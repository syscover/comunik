<!-- comunik::email_template.breadcrumbs -->
<li>
    <a href="javascript:void(0)">{{ trans('comunik::pulsar.package_name') }}</a>
</li>
<li class="current">
    <a href="{{ route($routeSuffix) }}">{{ trans_choice($objectTrans, 2) }}</a>
</li>
<!-- /.comunik::email_template.breadcrumbs -->