@extends('layouts.guest')
@section('title','Parolamı Unuttum')
@section('content')

    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif

    <form class="card card-md" action="{{ route('password.email') }}" method="post" autocomplete="off">
        @csrf

        <div class="card-body">
            <h2 class="card-title text-center mb-4">{{ __('Parolamı Unuttum') }}</h2>

            <p class="text-muted mb-4">Aşağıdaki formu doldurduğunuzda kayıtlı e-posta adresinize şifrenizi sıfırlamanız için bir bağlantı gönderilecektir.</p>

            <div class="mb-3">
                <label class="form-label">{{ __('E-Posta Adresi') }}</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control form-control-user @error('email') is-invalid @enderror">
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-footer">
                <button type="submit" class="btn btn-dernek w-100">
                    {{ __('Sıfırlama Bağlantısı Gönder') }}
                </button>
            </div>
        </div>
    </form>

    @if (Route::has('login'))
    <div class="text-center text-muted mt-3">
        {{ __('Hesabınıza giriş yapmak mı istiyorsunuz?') }} <a href="{{ route('login') }}" tabindex="-1">{{ __('Giriş Yap') }}</a>
    </div>
    @endif

@endsection
