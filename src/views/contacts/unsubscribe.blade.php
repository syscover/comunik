@extends('pulsar::layouts.modal')

@section('mainContent')
<div class="row" style="margin: 40px;">
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header"><h4><i class="icomoon-icon-address-book"></i> Unsubscribe email: {{ $contact->email_041 }}</h4></div>
            <div class="widget-content">
                @if(isset($unsubscribe))
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-md-12 text-center">
                                <h3>El mail {{ $contact->email_041 }} ha sido dado de baja correctamente</h3>
                                <h3>The email {{ $contact->email_041}} email has been discharged correctly</h3>
                            </label>
                        </div>
                    </div>
                @else
                    <form class="form-horizontal" method="post" action="{{ route('unsubscribeComunikContact') }}">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label class="col-md-12 text-center">
                                <h3>Para no recibir más comunicaciones por correo electrónico desde este remitente</h3>
                                <h3>To stop receiving email communications from this sender</h3>
                            </label>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-inverse marginR10">Pinche Aquí / Click here</button>
                                <input type="hidden" name="key" value="{{ $key or null }}">
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@stop