<!-- Login Page -->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    {{-- Base Meta Tags --}}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Ambientes Sena</title>

    {{-- Base Stylesheets --}}
    @if(!config('adminlte.enabled_laravel_mix'))
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    {{-- Configured Stylesheets --}}
    @include('adminlte::plugins', ['type' => 'css'])

    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    @else
    <link rel="stylesheet" href="{{ mix(config('adminlte.laravel_mix_css_path', 'css/app.css')) }}">
    @endif

    {{-- Livewire Styles --}}
    @if(config('adminlte.livewire'))
    @if(app()->version() >= 7)
    @livewireStyles
    @else
    <livewire:styles />
    @endif
    @endif

    {{-- Favicon --}}
    @if(config('adminlte.use_ico_only'))
    <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}" />
    @elseif(config('adminlte.use_full_favicon'))
    <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicons/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicons/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicons/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicons/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicons/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicons/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicons/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicons/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicons/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicons/android-icon-192x192.png') }}">
    <link rel="manifest" crossorigin="use-credentials" href="{{ asset('favicons/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('favicon/ms-icon-144x144.png') }}">
    @endif

    <style>
        .background {
            background-image: url({{ asset('img/senafondo.jpg') }});
            background-size: cover; 
        }
    </style>
</head>

<body class="hold-transition login-page background">
    <div class="login-box">
        <div class="login-logo">
            <img src="{{ asset('img/logosena.jpg') }}" alt="logosena" width="100" height="100">
        </div>
    </div>
    <div class="card">
        <div class="card-body login-card-body bg-gradient-gray">
            <x-jet-validation-errors class="mb-4" />
            @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
            @endif
            <p class="login-box-msg ">Registre sus datos para iniciar sesión</p>
            <form method="post" action="{{ route('login') }}">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" id="email" name="email" class="form-control" placeholder="Correo Electronico" :value="old('email')" required autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope text-navy"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" id="password" name="password" class="form-control" placeholder="Contraseña" required autocomplete="current-password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock text-navy"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember_me" name="remember">
                            <label for="remember">
                                Recuerdame
                            </label>
                        </div>
                    </div>
                    <div class="col-6">
                        <button type="submit" class="btn bg-gradient-orange btn-block">Iniciar Sesión</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            @if (Route::has('password.request'))
            <p class="mb-1">
                <a href="{{ route('password.request') }}">
                    Olvidé mi contraseña
                </a>
            </p>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <p class="mb-1">
                <a href="{{ route('register') }}">
                    Registrar usuario
                </a>
            </p>
        </div>
    </div>

    {{-- Base Scripts --}}
    @if(!config('adminlte.enabled_laravel_mix'))
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

    {{-- Configured Scripts --}}
    @include('adminlte::plugins', ['type' => 'js'])

    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @else
    <script src="{{ mix(config('adminlte.laravel_mix_js_path', 'js/app.js')) }}"></script>
    @endif

    {{-- Livewire Script --}}
    @if(config('adminlte.livewire'))
    @if(app()->version() >= 7)
    @livewireScripts
    @else
    <livewire:scripts />
    @endif
    @endif
</body>

</html>