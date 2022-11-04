@extends('layouts.app')

@section('custom_styles')

@endsection
@section('title', "Hesap Güvenliği")
<style>
  #page-content-div .nav-link.active {
    color: #6959a2 !important;
    background-color: white !important;
  }

  #page-content-div .nav-link:hover {
    color: white !important;
    background-color: #322785 !important;
  }
</style>
@section('content')
<div class="page-body">
  <div class="container-xl">
    <div class="page-wrapper">
      <div class="row" id="page-content-div">
          @if(Session::has('confirmed'))
              <div class="alert alert-success">
                  {{Session::get('confirmed')}}
              </div>
          @endif
          @if($last_failed_login->count()>0)
                  <div class="card mb-3">
                      <div class="card-header text-danger">
                          <i class="fa fa-exclamation-circle me-2"></i> Başarısız Giriş {{$last_failed_login->count()>1?'Denemeleri':'Denemesi'}}
                      </div>
                      <div class="card-status-top bg-danger"></div>
                      <div class="card-body">
                          <p class="text-muted">
                              İncelemediğiniz başarısız giriş deneme{{$last_failed_login->count()>1?'ler':''}}niz var. Aşağıda detayları belirtilen giriş işlem{{$last_failed_login->count()>1?'ler':''}}i size ait değil ise lütfen şifrenizi değiştirin. Hesabınızın güvenliğini artırmak için iki adımlı doğrulamayı kullanabilirsiniz.
                          </p>
                          <table class="table table-bordered table-responsive" style="font-size: 0.85rem">
                              <thead>
                                  <tr>
                                      <th class="text-center">Tarih</th>
                                      <th class="text-center">Saat</th>
                                      <th class="text-center">IP Adresi</th>
                                      <th class="text-center">İşletim Sistemi</th>
                                      <th class="text-center">Tarayıcı</th>
                                      <th class="text-center">Tahmini Konum</th>
                                      <th class="text-center">İşlem</th>
                                  </tr>
                              </thead>
                              <tbody>
                              @foreach($last_failed_login as $login)
                                  <tr>
                                      <td class="text-center">{{\Carbon\Carbon::parse($login['created_at'])->format('d.m.Y')}}</td>
                                      <td class="text-center">{{\Carbon\Carbon::parse($login['created_at'])->format('H:i')}}</td>
                                      <td class="text-center">{{$login['properties']['ip']}}</td>
                                      <td class="text-center">{{$login['properties']['agent']['device']?:''}} {{$login['properties']['agent']['device']?' - ':''}} {{$login['properties']['agent']['platform']}}</td>
                                      <td class="text-center">{{$login['properties']['agent']['browser'].' ('.$login['properties']['agent']['browser_version'].')'}}</td>
                                      <td class="text-center">{{$login['properties']['location']['countryCode'].' - '.$login['properties']['location']['regionName']}} - <a href="http://maps.google.com/maps?q={{$login['properties']['location']['latitude']}},{{$login['properties']['location']['longitude']}}"><i class="fa fa-location-dot"></i> Haritada Gör</a></td>
                                      <td class="text-center">
                                          <form action="{{route('profile.secure.confirmFailedLogin')}}" method="post" class="m-0">
                                              @csrf
                                              <input type="hidden" name="log_id" value="{{$login->id}}">
                                              <button class="btn btn-success btn-sm"><i class="fa fa-check-circle me-2"></i>Bu İşlem Bana Ait</button>
                                              <a href="" class="btn btn-danger btn-sm"><i class="fa fa-key me-2"></i>Şifremi Değiştir</a>
                                          </form>
                                      </td>
                                  </tr>
                              @endforeach
                              </tbody>
                              <tfoot>
                              <tr>
                                  <td colspan="6">
                                      <small>*Konum bilgileri IP adresinden alınmaktadır ve yaklaşık konumu gösterir.</small>
                                  </td>
                              </tr>
                              </tfoot>
                          </table>
                      </div>
                  </div>
              @else
              <div class="alert alert-success text-success">
                  <p><i class="fa fa-check-circle me-2"></i>Hesabınızda güvenlik riski bulunamadı.</p>
              </div>
              @endif
      </div>
    </div>
  </div>
</div>
@endsection
@section('custom_scripts')

@endsection
