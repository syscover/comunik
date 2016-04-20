<li{!! is_current_resource(['comunik-contact','comunik-group','comunik-email-campaign','comunik-email-template','comunik-email-pattern','comunik-email-preference']) !!}>
    <a href="javascript:void(0)"><i class="icomoon-icon-feed"></i>{{ trans('comunik::pulsar.package_name') }}</a>
    <ul class="sub-menu">
        @if(is_allowed('comunik-contact', 'access'))
            <li{!! is_current_resource('comunik-contact') !!}><a href="{{ route('comunikContact') }}"><i class="fa fa-user"></i>{{ trans_choice('pulsar::pulsar.contact', 2) }}</a></li>
        @endif
        @if(is_allowed('comunik-group', 'access'))
            <li{!! is_current_resource('comunik-group') !!}><a href="{{ route('comunikGroup') }}"><i class="fa fa-users"></i>{{ trans_choice('pulsar::pulsar.group', 2) }}</a></li>
        @endif
        <li{!! is_current_resource(['comunik-email-campaign','comunik-email-template','comunik-email-pattern','comunik-email-preference'], true) !!}>
            <a href="javascript:void(0)"><i class="fa fa-envelope-o"></i>Email Services</a>
            <ul class="sub-menu" >
                @if(is_allowed('comunik-email-campaign', 'access'))
                    <li{!! is_current_resource('comunik-email-campaign') !!}><a href="{{ route('comunikEmailCampaign') }}"><i class="fa fa-bookmark"></i>{{ trans_choice('comunik::pulsar.campaign', 2) }}</a></li>
                @endif
                @if(is_allowed('comunik-email-template', 'access'))
                    <li{!! is_current_resource('comunik-email-template') !!}><a href="{{ route('comunikEmailTemplate') }}"><i class="fa fa-pencil-square-o"></i>{{ trans_choice('pulsar::pulsar.template', 2) }}</a></li>
                @endif
                @if(is_allowed('comunik-email-pattern', 'access'))
                    <li{!! is_current_resource('comunik-email-pattern') !!}><a href="{{ route('comunikEmailPattern') }}"><i class="fa fa-braille"></i>{{ trans_choice('pulsar::pulsar.pattern', 2) }}</a></li>
                @endif
                @if(is_allowed('comunik-email-preference', 'access'))
                    <li{!! is_current_resource('comunik-email-preference') !!}><a href="{{ route('comunikEmailPreference') }}"><i class="fa fa-cog"></i>{{ trans_choice('pulsar::pulsar.preference', 2) }}</a></li>
                @endif
            </ul>
        </li>
    </ul>
</li>