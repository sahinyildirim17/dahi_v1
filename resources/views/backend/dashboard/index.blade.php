@extends('layouts.backend.app')

@section('custom_styles')
@section('title', "Özet")
@endsection

@section('content')
    <div class="page-body">
        <div class="container-xl">

            <div class="alert alert-success">

                        <div class="alert-title">
                            <span>Merhaba, {{auth()->user()->name.' '.auth()->user()->surname}}</span>
                        </div>
                        <span>{{config('settings.title')}} yönetim paneline hoş geldiniz. Yapabileceğiniz işlemleri <a href="">yetkilerim</a> sayfasından öğrenebilirsiniz.</span>
            </div>




        </div>
    </div>
@endsection
@section('custom_scripts')
<script>
      $(function() {

          $('.carousel').carousel({
                autoplay:true,
              interval: 500,
              keyword: false,
              pause: false,
              wrap: false
          });
      });

    </script>
@endsection
