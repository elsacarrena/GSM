<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Personnel GSM') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Personnel GSM') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                                 {{-- @if (Route::has('superieur.accueil'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('superieur.accueil') }}">{{ __('Accueil') }}</a>
                                </li>
                                @endif --}}

                             @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Se connecter') }}</a>
                                </li>
                            @endif

                            @if (Route::has('inscription_superieur'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('inscription_superieur') }}">{{ __('S\'enregistrer') }}</a>
                                </li>
                            @endif

                             @else
                             <li class="nav-item">
                                <a class="nav-link" href="{{ route('superieur.accueil') }}">{{ __('Accueil') }}</a>
                            </li>


                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ route('employe.create') }}">
                                        {{ __('Ajouter un  employé') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('employe.profilListe') }}">
                                        {{ __('Liste des employés') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('chef_service.create') }}">
                                        {{ __('Ajouter un chef de service') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('chef_service.profilListe') }}">
                                        {{ __('Liste des chefs de service') }}
                                    </a>


                                    <a class="dropdown-item" href="{{ route('stagiaires.create') }}">
                                        {{ __('Ajouter un  stagiaire') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('stagiaires.profilListe') }}">
                                        {{ __('Liste des stagiaires') }}
                                    </a>


                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Se déconnecter') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>



                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @if(session('success'))
                <div class ="container">
                    <div class = "alert alert-success">
                        {{session('success')}}
                    </div>
                </div>
            @endif
            @if(session('error'))
            <div class ="container">
                <div class = "alert alert-danger">
                    {{session('error')}}
                </div>
            </div>
        @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
