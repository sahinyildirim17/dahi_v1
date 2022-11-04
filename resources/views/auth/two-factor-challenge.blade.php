@extends('layouts.guest-wo-logo')

@section('content')
    <form class="card card-md" action="{{ url('two-factor-challenge') }}" method="post" autocomplete="off" id="form_code" style="@error('recovery_code') display:none @enderror">
        @method('post')
        @csrf
        <div class="card-body">
            <h2 class="card-title text-center mb-4">{{ __('İki Adımlı Doğrulama') }}</h2>

            <div class="mb-3">
                <label class="form-label">{{ __('Doğrulama Kodu') }}</label>
                <input type="text" name="code" value="{{ old('code') }}" class="form-control @error('code') is-invalid @enderror" placeholder="{{ __('Uygulamanızdaki doğrulama kodunu girin.') }}" required autofocus tabindex="1">
                @error('code')
                <div class="invalid-feedback">Doğrulama kodu geçersiz.</div>
                @enderror
            </div>
            <div class="form-footer">
                <button type="submit" class="btn btn-dernek w-100" tabindex="4">{{ __('Giriş Yap') }}</button>
            </div>
        </div>
        <div class="card-footer text-center">
            <a href="#" id="show_form_recovery_code">Kurtarma kodu kullanmak istiyorum.</a>
        </div>
    </form>
    <form class="card card-md" action="{{ url('two-factor-challenge') }}" method="post" autocomplete="off" id="form_recovery_code" style="@error('recovery_code') display:block @else display:none @enderror">
        @method('post')
        @csrf
        <div class="card-body">
            <h2 class="card-title text-center mb-4">{{ __('İki Adımlı Doğrulama') }}</h2>

            <div class="mb-3">
                <label class="form-label">{{ __('Kurtarma Kodu') }}</label>
                <input type="text" name="recovery_code" value="{{ old('recovery_code') }}" class="form-control @error('recovery_code') is-invalid @enderror" placeholder="{{ __('Mevcut kurtarma kodlarınızdan birini girin.') }}" required autofocus tabindex="1">
                @error('recovery_code')
                <div class="invalid-feedback">Kurtarma kodu geçersiz.</div>
                @enderror
            </div>
            <div class="form-footer">
                <button type="submit" class="btn btn-dernek w-100" tabindex="4">{{ __('Giriş Yap') }}</button>
            </div>
        </div>
        <div class="card-footer text-center">
            <a href="#" id="show_form_code">Doğrulama kodu kullanmak istiyorum.</a>
        </div>
    </form>
@endsection
@section('page_script')
    <script>
        $('#show_form_recovery_code').on('click',function (){
            $('#form_code').hide();
            $('#form_recovery_code').show();
        })
        $('#show_form_code').on('click',function (){
            $('#form_recovery_code').hide();
            $('#form_code').show();
        })
    </script>
@endsection
