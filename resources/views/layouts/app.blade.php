<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Video Meetings') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Video Meetings') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @auth
                            @can('admin_area')
                                <li class="nav-item">
                                    <a href="{{ route('banners.index') }}" class="nav-link">Banners</a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('categories.index') }}" class="nav-link">Categories</a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('users.index') }}" class="nav-link">Users</a>
                                </li>
                            @endcan
                            <li class="nav-item">
                                <a href="{{ route('users.meeting', auth()->user()->roomName) }}" class="nav-link">Meetings</a>
                            </li>
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a href="{{ route('users.show', Auth::user()) }}" class="dropdown-item">Profile</a>

                                    <a href="{{ route('users.edit', Auth::user()) }}" class="dropdown-item">Edit</a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
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
        </nav>

        <main class="py-4">
            {{--@if(session()->has('success') || session()->has('failure') || session()->has('warning'))--}}
                <div class="row">
                    <div class="col-12">
                        @if(session()->has('success'))
                            @foreach(\Illuminate\Support\Arr::flatten([session()->get('success')]) as $success)
                                <div class="alert alert-success alert-dismissible text-center " role="alert">
                                    {{ $success }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" data-dismiss="alert">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endforeach
                        @endif
                        @if(session()->has('failure'))
                            @foreach(\Illuminate\Support\Arr::flatten([session()->get('failure')]) as $failure)
                                <div class="alert alert-danger alert-dismissible text-center" role="alert">
                                    {{ $failure }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" data-dismiss="alert">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endforeach
                        @endif
                        @if(session()->has('warning'))
                            @foreach(\Illuminate\Support\Arr::flatten([session()->get('warning')]) as $warning)
                                <div class="alert alert-warning alert-dismissible text-center" role="alert">
                                    <div>{{$warning}}</div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" data-dismiss="alert">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endforeach
                        @endif
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                    </div>
                </div>
            {{--@endif--}}
            @yield('content')
        </main>
    </div>
    @yield('footer-content')
</body>
</html>
