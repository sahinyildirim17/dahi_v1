@extends('layouts.guest')
@section('title','Kullanıcı Girişi')
@section('content')
    <form class="card card-md" action="{{ route('login') }}" method="post" autocomplete="off">
        @csrf

        <div class="card-body">
            <h2 class="card-title text-center mb-4">{{ __('Kullanıcı Girişi') }}</h2>

            <div class="mb-3">
                <label class="form-label">{{ __('E-posta adresi') }}</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('Enter email') }}" required autofocus tabindex="1">
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">
                    {{ __('Parola') }}
                    @if (Route::has('password.request'))
                    <span class="form-label-description">
                        <a class="text-dernek" href="{{ route('password.request') }}" tabindex="5">{{ __('Parolamı unuttum') }}</a>
                    </span>
                    @endif
                </label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}" required tabindex="2">
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="form-check">
                    <input type="checkbox" class="form-check-input" tabindex="3" name="remember" />
                    <span class="form-check-label">{{ __('Beni hatırla') }}</span>
                </label>
            </div>

            <div class="form-footer">
                <button type="submit" class="btn btn-dernek w-100" tabindex="4">{{ __('Giriş Yap') }}</button>
            </div>
        </div>
    </form>

    @if (Route::has('register'))
    <div class="text-center text-muted mt-3">
        {{ __("Hesabınız yok mu?") }} <a class="text-dernek" href="{{ route('register') }}" tabindex="-1">{{ __('Kayıt ol') }}</a>
    </div>
    @endif

@endsection
