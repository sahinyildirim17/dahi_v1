@extends('layouts.app')

@section('custom_styles')
    <style>
        .carousel-caption {
            position: absolute;
            left: 0;
            bottom: 0;
            right: 0;
            background: rgba(105, 89, 162,  0.7)
        }

    </style>

@endsection
@section('title', "Anasayfa")

@section('content')
    <div class="page-body">
        <div class="container-xl">

            <div class="alert alert-danger">
                <div class="row">
                    <div class="col-auto">
                        <div class="alert-title">
                            {{ __('Maçlar:') }}
                        </div>
                    </div>
                    <div class="col">
                    <div id="divCarousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                        <div class="carousel-item active">
                            <strong>TFFHGD Niğde internet sitemiz aktif! Site Başlığı: {{ config('settings.title') }}</strong>
                        </div>

                        <div class="carousel-item">
                            TEST 2
                        </div>

                        <div class="carousel-item">
                            TEST 3
                        </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-auto">

                    </div>
                </div>


            </div>
            <div class="row">
                <div class="col-md-8 col-12">
                    <div class="card">
                    <div class="card-body p-0">
                    <div id="carousel-captions" class="carousel slide pointer-event" data-bs-ride="carousel">
                      <div class="carousel-inner">
                          @foreach($featured_posts as $key => $featured_post)
                              <div class="carousel-item {{$key==0 ? 'active' : ''}}">
                                  <img class="d-block w-100" alt="" src="{{$featured_post->getFirstMediaUrl('featured_photos')!=''?$featured_post->getFirstMediaUrl('featured_photos'):env('APP_URL').'/img/featured_post_default.png'}}">
                                  <div class="carousel-caption d-none d-md-block ps-3 pe-3 bg-opacity-10">
                                      <h3>{{$featured_post->title}}</h3>
                                      <p>{{trim(strip_tags(substr($featured_post->content,0,250))).'...'}}</p>
                                  </div>
                              </div>
                          @endforeach
                      </div>
                      <a class="carousel-control-prev" href="#carousel-captions" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Önceki</span>
                      </a>
                      <a class="carousel-control-next" href="#carousel-captions" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Sonraki</span>
                      </a>
                    </div>
                  </div>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    @if(count($other_posts)>0)
                    <div class="card mb-3 mt-3 mt-lg-0">
                        <div class="list-group list-group-flush">
                            @foreach($other_posts as $other_post)
                                <li class="list-group-item p-2">
                                    <div class="row">
                                        <div class="col-auto">
                                            <span class="avatar p-1 pe-0 {{$other_post->post_type==1 ? 'bg-success' : 'bg-warning'}}"><i class="fa {{$other_post->post_type==1 ? 'fa-newspaper' : 'fa-bullhorn'}}"></i></span>
                                        </div>
                                        <div class="col-auto">
                                            <a href="https://www.nigdeihk.com/duyurular/12/ilep-6-il-egitimi-500" class="text-black text-decoration-none">{{$other_post->title}}</a><span><br><small>{{$other_post->created_at->translatedFormat('jS F Y - l - H:i')}}</small></span>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-6 text-center"><a href="" class="text-dark btn"><i class="fa fa-bullhorn me-2"></i>Tüm Duyurular</a></div>
                                <div class="col-6 text-center"><a href="" class="text-dark btn"><i class="fa fa-newspaper me-2"></i>Tüm Haberler</a></div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="card mb-3 ">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-earth me-2"></i>Bağlantılar</h3>
                        </div>
                        <div class="card-body">
                        <div class="row g-3">
                          <div class="col-6">
                            <div class="row g-3 align-items-center">
                              <a href="#" class="col-auto">
                                <span class="avatar p-1"><img src="{{ url('img/tff02.png') }}" alt=""></span>
                              </a>
                              <div class="col text-truncate">
                                <a href="#" class="text-reset d-block text-truncate">TFF</a>
                                <div class="text-muted text-truncate mt-n1">tff.org</div>
                              </div>
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="row g-3 align-items-center">
                              <a href="#" class="col-auto">
                                <span class="avatar" style="background-image: url(./static/avatars/002f.jpg)"></span>
                              </a>
                              <div class="col text-truncate">
                                <a href="#" class="text-reset d-block text-truncate">Kellie Skingley</a>
                                <div class="text-muted text-truncate mt-n1">6 days ago</div>
                              </div>
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="row g-3 align-items-center">
                              <a href="#" class="col-auto">
                                <span class="avatar" style="background-image: url(./static/avatars/003f.jpg)"></span>
                              </a>
                              <div class="col text-truncate">
                                <a href="#" class="text-reset d-block text-truncate">Christabel Charlwood</a>
                                <div class="text-muted text-truncate mt-n1">today</div>
                              </div>
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="row g-3 align-items-center">
                              <a href="#" class="col-auto">
                                <span class="avatar">HS</span>
                              </a>
                              <div class="col text-truncate">
                                <a href="#" class="text-reset d-block text-truncate">Haskel Shelper</a>
                                <div class="text-muted text-truncate mt-n1">yesterday</div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card mt-3 mt-lg-0">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-list me-2"></i>Puan Durumu</h3>
                        </div>
                    </div>
                </div>
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
