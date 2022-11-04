@extends('layouts.app')
@section('title','E-posta Doğrulaması')
@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-12 col-lg-8 mx-auto">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Yeni bir doğrulama bağlantısı e-posta adresinize gönderildi.') }}
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header align-content-center">
                            <div class="card-title align-content-center"><i class="fa fa-envelope me-1"></i> E-Posta Adresi Doğrulaması</div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-3 order-md-first text-center">
                                <img src="{{url('img/verify_email.png')}}" alt="E-posta doğrulaması gereklidir." class="m-2 w-75">
                            </div>
                            <div class="col">
                                <div class="card-body">
                                    <p>Bu sayfaya erişebilmek için e-posta adresinizi doğrulamış olmanız gerekmektedir. Doğrulanmış e-posta adresinize gönderilen tüm iletiler resmi tebligat niteliğinde olacaktır.
                                        Eğer kaydınız sonrasında doğrulama bağlantısı içeren bir e-posta almadıysanız aşağıdaki düğmeden yeni bir talepte bulunabilirsiniz.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <form method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <button type="submit" class="btn btn-dernek-acik">Doğrulama bağlantısını yeniden gönder</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
