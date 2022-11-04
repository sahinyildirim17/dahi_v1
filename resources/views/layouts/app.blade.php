<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>@yield('title') - {{config('settings.title')}}</title>

    @vite('resources/sass/app.scss')
    @vite('resources/css/custom.css')
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Quicksand">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons@latest/iconfont/tabler-icons.min.css">
    <!-- Custom styles for this Page-->
    @livewireStyles

    @yield('custom_styles')

</head>
<body class="theme-light" style="font-family: Quicksand">
    <div class="page">
        <div class="sticky-top">
			<header class="navbar navbar-expand-md navbar-light sticky-top d-print-none">
				<div class="container-xl">
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
						<span class="navbar-toggler-icon"></span>
					</button>
					<h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
						<a href=".">
						<img src="{{ url('img/logo.png') }}" width="110" height="32" alt="Tabler" class="navbar-brand-image">
						</a>
					</h1>
					<div class="navbar-nav flex-row order-md-last">
						@guest
						<a href="{{route('login')}}" class="btn mt-1 mb-1 btn-dernek d-none d-sm-block" rel="noreferrer">
							<!-- Download SVG icon from http://tabler-icons.io/i/heart -->
							<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
								<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
								<circle cx="12" cy="7" r="4"></circle>
								<path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
							</svg>
							Kullanıcı Girişi
						</a>
						<a href="{{route('login')}}" class="btn mt-1 mb-1 d-block d-sm-none btn-dernek" rel="noreferrer">
							<!-- Download SVG icon from http://tabler-icons.io/i/heart -->
							<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user m-0" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
								<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
								<circle cx="12" cy="7" r="4"></circle>
								<path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
							</svg>
						</a>
						@endguest
						@auth
						<div class="nav-item dropdown">
							<a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
								<span class="avatar avatar-sm" style="background-image: url(https://eu.ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }})"></span>
								<div class="d-none d-xl-block ps-2">
									{{ auth()->user()->name ?? null }}
								</div>
							</a>
							<div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
								@if(auth()->user()->can('panel'))
								<a href="{{ route('panel.index') }}" class="dropdown-item">{{ __('Yönetim Paneli') }}</a>
								@endif
								<a href="{{ route('profile.index') }}" class="dropdown-item">{{ __('Bilgilerim') }}</a>
								<div class="dropdown-divider"></div>
								<form method="POST" action="{{ route('logout') }}">
									@csrf
									<a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); this.closest('form').submit();">
										{{ __('Çıkış') }}
									</a>
								</form>
							</div>
						</div>
						@endauth

					</div>
				</div>
			</header>

         	 @include('layouts.navigation')

			</div>
			<div class="page-wrapper">

				@yield('content')

				<footer class="footer footer-dark bg-dernek-acik d-print-none">
					<div class="container-xl">
						<div class="row text-center align-items-center flex-row-reverse">
							<div class="col-lg-auto ms-lg-auto">
								<ul class="list-inline list-inline-dots mb-0">
									<li class="list-inline-item"><a href="https://preview.tabler.io/license.html" target="_blank" class="text-white" rel="noopener">Yardım</a></li>
									<li class="list-inline-item"><a href="https://github.com/tabler/tabler" target="_blank" class="text-white" rel="noopener">İletişim</a></li>
								</ul>
							</div>
							<div class="col-12 col-lg-auto mt-3 mt-lg-0">
								<ul class="list-inline list-inline-dots mb-0">
									<li class="list-inline-item">
										&copy; {{ date('Y') }}
										<a href="https://dahi.app" class="text-white">{{config('settings.app_name')}}</a>
									</li>
									<li class="list-inline-item">
										versiyon {{config('settings.app_version')}}
								</ul>
							</div>
						</div>
					</div>
				</footer>
        	</div>
      	</div>
    </div>

    <!-- Core plugin JavaScript-->
    @vite('resources/js/app.js')

    @livewireScripts
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />
    @if (session()->has('alert'))
    <script>
        Swal.fire({
            icon: '{{session('alert')['icon']}}',
            title: '{{session('alert')['title']}}',
            text: '{{session('alert')['text']}}',
            confirmButtonText: 'Tamam',
        })
    </script>
    @endif
    <!-- Page level custom scripts -->
    @yield('custom_scripts')

</body>
</html>
