        <li{!! Miscellaneous::setCurrentOpenPage(['comunik-contact','comunik-group','comunik-email-campaign','comunik-email-template','comunik-email-preference']) !!}>
            <a href="javascript:void(0)"><i class="icomoon-icon-feed"></i>Comunik</a>
            <ul class="sub-menu">
                @if(session('userAcl')->isAllowed(Auth::user()->profile_010, 'comunik-contact', 'access'))
                    <li{!! Miscellaneous::setCurrentPage('comunik-contact') !!}><a href="{{ route('ComunikContact') }}"><i class="fa fa-user"></i>{{ trans_choice('pulsar::pulsar.contact', 2) }}</a></li>
                @endif
                @if(session('userAcl')->isAllowed(Auth::user()->profile_010, 'comunik-group', 'access'))
                    <li{!! Miscellaneous::setCurrentPage('comunik-group') !!}><a href="{{ route('ComunikGroup') }}"><i class="fa fa-users"></i>{{ trans_choice('pulsar::pulsar.group', 2) }}</a></li>
                @endif
                <li{!! Miscellaneous::setCurrentOpenPage(['comunik-email-campaign','comunik-email-template','comunik-email-preference']) !!}>
                    <a href="javascript:void(0)"><i class="fa fa-envelope-o"></i>Email Services</a>
                    <ul class="sub-menu" >
                        @if(session('userAcl')->isAllowed(Auth::user()->profile_010, 'comunik-email-campaign', 'access'))
                            <li{!! Miscellaneous::setCurrentPage('comunik-email-campaign') !!}><a href="{{ route('ComunikEmailCampaign') }}"><i class="fa fa-bookmark"></i>{{ trans_choice('comunik::pulsar.campaign', 2) }}</a></li>
                        @endif
                        @if(session('userAcl')->isAllowed(Auth::user()->profile_010, 'comunik-email-template', 'access'))
                            <li{!! Miscellaneous::setCurrentPage('comunik-email-template') !!}><a href="{{ route('ComunikEmailTemplate') }}"><i class="fa fa-pencil-square-o"></i>{{ trans_choice('pulsar::pulsar.template', 2) }}</a></li>
                        @endif
                        @if(session('userAcl')->isAllowed(Auth::user()->profile_010, 'comunik-email-preference', 'access'))
                            <li{!! Miscellaneous::setCurrentPage('comunik-email-preference') !!}><a href="{{ route('EmailServicesPreference') }}"><i class="fa fa-cog"></i>{{ trans_choice('pulsar::pulsar.preference', 2) }}</a></li>
                        @endif
                    </ul>
                </li>
            </ul>
        </li>