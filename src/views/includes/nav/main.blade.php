        <li{!! Miscellaneous::setCurrentOpenPage(['comunik-contact','comunik-group','comunik-email-campaign']) !!}>
            <a href="javascript:void(0);"><i class="icomoon-icon-feed"></i>Comunik</a>
            <ul class="sub-menu">
                @if(Session::get('userAcl')->isAllowed(Auth::user()->profile_010, 'comunik-contact', 'access'))
                    <li{{ Miscellaneous::setCurrentPage('comunik-contact') }}><a href="{{ route('ComunikContact') }}"><i class="icomoon-icon-address-book"></i>{{ trans_choice('pulsar::pulsar.contact', 2) }}</a></li>
                @endif
                @if(Session::get('userAcl')->isAllowed(Auth::user()->profile_010, 'comunik-group', 'access'))
                    <li{!! Miscellaneous::setCurrentPage('comunik-group') !!}><a href="{{ route('ComunikGroup') }}"><i class="icomoon-icon-users-2"></i>{{ trans_choice('pulsar::pulsar.group', 2) }}</a></li>
                @endif
                <li{!! Miscellaneous::setCurrentOpenPage(['comunik-email-campaign']) !!}>
                    <a href="javascript:void(0);"><i class="icon-envelope-alt"></i>Email Services</a>
                    <ul class="sub-menu" >
                        @if(Session::get('userAcl')->isAllowed(Auth::user()->profile_010, 'comunik-email-campaign', 'access'))
                            <li{!! Miscellaneous::setCurrentPage('comunik-email-campaign') !!}><a href="{{ route('ComunikGroup') }}"><i class="icon-bookmark"></i>{{ trans_choice('comunik::pulsar.campaign', 2) }}</a></li>
                        @endif
                    </ul>
                </li>
            </ul>
        </li>