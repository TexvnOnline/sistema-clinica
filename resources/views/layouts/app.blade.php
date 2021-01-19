<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

    <title>Iniciar sesión</title>
    <!-- General CSS Files -->
    {!! Html::style('otika/assets/css/app.min.css') !!}
    {!! Html::style('otika/assets/bundles/bootstrap-social/bootstrap-social.css') !!}
    <!-- Template CSS -->
    {!! Html::style('otika/assets/css/style.css') !!}
    {!! Html::style('otika/assets/css/components.css') !!}
    <!-- Custom style CSS -->
    {!! Html::style('otika/assets/css/custom.css') !!}
    <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />


</head>
<body>
    <div class="loader"></div>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">

                    @yield('content')
                    
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    {!! Html::script('otika/assets/js/app.min.js') !!}
    <!-- JS Libraies -->
    <!-- Page Specific JS File -->
    <!-- Template JS File -->
    {!! Html::script('otika/assets/js/scripts.js') !!}
    <!-- Custom JS File -->
    {!! Html::script('otika/assets/js/custom.js') !!}
</body>
{{--  
<body>
    <div id="app">  --}}
        {{--  <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
        {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                @endif
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
    </nav> --}}

    {{--  <main class="py-4">
        @yield('content')
    </main>
    </div>
</body>  --}}

</html>
