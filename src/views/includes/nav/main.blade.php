<li{!! Miscellaneous::setCurrentOpenPage(['comunik-contact','comunik-group','comunik-email-campaign','comunik-email-template','comunik-email-preference']) !!}>
    <a href="javascript:void(0)"><i class="icomoon-icon-feed"></i>{{ trans('comunik::pulsar.package_name') }}</a>
    <ul class="sub-menu">
        @if(session('userAcl')->allows('comunik-contact', 'access'))
            <li{!! Miscellaneous::setCurrentPage('comunik-contact') !!}><a href="{{ route('comunikContact') }}"><i class="fa fa-user"></i>{{ trans_choice('pulsar::pulsar.contact', 2) }}</a></li>
        @endif
        @if(session('userAcl')->allows('comunik-group', 'access'))
            <li{!! Miscellaneous::setCurrentPage('comunik-group') !!}><a href="{{ route('comunikGroup') }}"><i class="fa fa-users"></i>{{ trans_choice('pulsar::pulsar.group', 2) }}</a></li>
        @endif
        <li{!! Miscellaneous::setCurrentOpenPage(['comunik-email-campaign','comunik-email-template','comunik-email-preference']) !!}>
            <a href="javascript:void(0)"><i class="fa fa-envelope-o"></i>Email Services</a>
            <ul class="sub-menu" >
                @if(session('userAcl')->allows('comunik-email-campaign', 'access'))
                    <li{!! Miscellaneous::setCurrentPage('comunik-email-campaign') !!}><a href="{{ route('comunikEmailCampaign') }}"><i class="fa fa-bookmark"></i>{{ trans_choice('comunik::pulsar.campaign', 2) }}</a></li>
                @endif
                @if(session('userAcl')->allows('comunik-email-template', 'access'))
                    <li{!! Miscellaneous::setCurrentPage('comunik-email-template') !!}><a href="{{ route('comunikEmailTemplate') }}"><i class="fa fa-pencil-square-o"></i>{{ trans_choice('pulsar::pulsar.template', 2) }}</a></li>
                @endif
                @if(session('userAcl')->allows('comunik-email-preference', 'access'))
                    <li{!! Miscellaneous::setCurrentPage('comunik-email-preference') !!}><a href="{{ route('emailPreference') }}"><i class="fa fa-cog"></i>{{ trans_choice('pulsar::pulsar.preference', 2) }}</a></li>
                @endif
            </ul>
        </li>
    </ul>
</li>