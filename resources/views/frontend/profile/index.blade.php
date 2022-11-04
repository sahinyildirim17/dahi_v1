@extends('layouts.app')

@section('custom_styles')

@endsection
@section('title', "Bilgilerim")
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
        <div class="col-12 col-md-4 col-lg-3">
          <div class="card bg-dernek-acik mb-3 mb-lg-0" style="height: auto;">
            <div class="card-content">
              <div class="card-body">
                <ul class="nav nav-pills flex-column navba">
                  <li class="nav-item mb-1">
                    <a href="#tab-kisisel" class="nav-link active" id="base-pill1" data-bs-toggle="tab" aria-selected="true" role="tab"><i class="fa fa-user me-2"></i> Üyelik Bilgilerim</a>
                  </li>
                  <li class="nav-item mb-1">
                    <a href="#tab-uyelik" class="nav-link" id="base-pill2" data-bs-toggle="tab" aria-selected="true" role="tab"><i class="fa fa-id-card-alt me-2"></i> Kişisel Bilgilerim</a>
                  </li>
                  <li class="nav-item mb-1">
                    <a class="nav-link waves-effect waves-dark" id="base-pill2" data-toggle="pill" href="#pill-gorev" aria-expanded="false"><i class="fa fa-suitcase me-2"></i> Görev ve Banka Bilgilerim</a>
                  </li>
                  <li class="nav-item mb-1">
                    <a class="nav-link waves-effect waves-dark" id="base-pill4" data-toggle="pill" href="#pill-adresiletisim" aria-expanded="false"><i class="fa fa-address-book me-2"></i> Adres ve İletişim Bilgilerim</a>
                  </li>
                  <li class="nav-item mb-1">
                    <a class="nav-link waves-effect waves-dark" id="base-pill5" data-toggle="pill" href="#pill-diger" aria-expanded="false"><i class="fa fa-dot-circle me-2"></i> Diğer Bilgilerim</a>
                  </li>
                  <li class="nav-item mb-1">
                    <a class="nav-link waves-effect waves-dark" id="base-pill5" data-toggle="pill" href="#pill-covid" aria-expanded="false"><i class="fa fa-hospital-user me-2"></i> Covid-19 Bilgilerim</a>
                  </li>
                  <li class="nav-item mb-1">
                    <a class="nav-link waves-effect waves-dark" id="base-pill5" data-toggle="pill" href="#pill-mazeret" aria-expanded="false"><i class="fa fa-question-circle me-2"></i> Mazeretlerim</a>
                  </li>
                  @if(auth()->user()->can('panel'))
                  <li class="nav-item mb-1">
                    <a href="#tab-permissions" class="nav-link" id="base-pill1" data-bs-toggle="tab" aria-selected="true" role="tab"><i class="fa fa-key me-2"></i> Yetkilerim</a>
                  </li>
                  @endif

                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-8 col-lg-9">
          <div class="card">
            <div class="tab-content">
              <div class="tab-pane active show" id="tab-kisisel" role="tabpanel">
                  @if (session('status') == 'two-factor-authentication-enabled')
                      <div class="mb-4 font-medium text-sm alert alert-success">
                          <p>İki adımlı doğrulama başarıyla aktifleştirildi. Lütfen aşağıdaki QR kodu uygulamanıza okutun ve kurtarma kodlarınızı güvenli bir yere kaydedin.</p>
                      </div>
                  @endif
                      @if (session('status') == 'two-factor-authentication-disabled')
                          <div class="mb-4 font-medium text-sm alert alert-success">
                              <p>İki adımlı doğrulama pasifleştirildi.</p>
                          </div>
                      @endif
                  @if (auth()->user()->two_factor_secret)
                      <div class="mb-4 font-medium text-sm card-body">
                          {!! auth()->user()->twoFactorQrCodeSvg() !!}
                          <form action="{{url('/user/two-factor-authentication')}}" method="POST">
                              @method('delete')
                              @csrf
                              <button class="btn btn-danger mt-2 mb-2" type="submit">Pasifleştir</button>
                              <br>
                              @foreach(auth()->user()->recoveryCodes() as $code)
                                  {{$code}}<br>
                              @endforeach
                          </form>
                      </div>
                  @else
                      <div class="card-body">
                          <form action="{{url('/user/two-factor-authentication')}}" method="POST">
                              @csrf
                              <button class="btn btn-success" type="submit">Aktifleştir</button>
                          </form>
                      </div>
                  @endif

              </div>
              <div class="tab-pane" id="tab-uyelik" role="tabpanel">
                <div>Fringilla egestas nunc quis tellus diam rhoncus ultricies tristique enim at diam, sem nunc amet, pellentesque id egestas velit sed</div>
              </div>
              <div class="tab-pane" id="tab-permissions" role="tabpanel">
                <div class="card-body">
                  <p>Aşağıdaki tabloda sahip olduğunuz yönetim paneli yetkilerini görebilirsiniz.</p>
                  <table class="table">
                    <thead>
                      <tr>
                        <th>YETKİ ADI</th>
                        <th>AÇIKLAMA</th>
                      </tr>
                    </thead>
                    <tbody style="font-size: 0.85rem !important;">
                      @foreach($permissions as $perm)
                      <tr>
                        <td>{{$perm['title']}}</td>
                        <td>{{$perm['description']}}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


  </div>
</div>
@endsection
@section('custom_scripts')

@endsection
