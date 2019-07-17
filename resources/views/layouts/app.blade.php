<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  @stack('css')
</head>
<body>
  <div id="app">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
          <img src="{{ asset('images/logo.png') }}" alt="" style="height: 100px">
          {{-- {{ config('app.name', 'Laravel') }} --}}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a href="{{ route('discussions.index') }}" class="nav-link btn btn-outline-primary text-white">Discussions</a>
            </li>
          </ul>

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
              <li class="nav-item">
                <a class="nav-link btn btn-primary text-white btn-sm text-uppercase mr-2" href="{{ route('login') }}">{{ __('Login') }}</a>
              </li>
              @if (Route::has('register'))
                <li class="nav-item">
                  <a class="nav-link btn btn-primary btn-sm text-uppercase text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
              @endif
            @else
            <li class="nav-item">
              <a href="{{ route('users.notifications') }}" class="nav-link">
                <span class="badge badge-info text-white">
                  {{ auth()->user()->unreadNotifications->count() }}
                  Notifications
                </span>
              </a>
            </li>  
              <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
                </div>
              </li>
            @endguest
          </ul>
        </div>
      </div>
    </nav>




    @if (!in_array(request()->path(), ['login', 'register', 'password/email', 'password-reset', '/']))
      <main class="py-4 container">
      <div class="row">
        <div class="col-md-4">
          @auth
            <a href="{{ route('discussions.create') }}" 
               class="btn btn-outline-primary mb-2 w-100">Add new discussion</a>  
             @else
               <a href="{{ route('login') }}" 
                  class="btn btn-outline-primary  mb-2 w-100"><small class="h6">Sign in to add Discussion</small></a>
                @endauth
                <div class="card">
                  <div class="card-header bg-dark text-white">Channels</div>
                  <div class="card-body">
                    <ul class="list-group list-group-flush">
                      @foreach ($channels as $channel)
                        <li class="list-group-item">
                          <a href="{{ route('discussions.index') }}?channel={{ $channel->slug }}" class="text-info font-weight-bold nav-link">{{ $channel->name }} <span class="h4">&rarr;</span></a>
                        </li> 
                      @endforeach
                    </ul>
                  </div>
                </div>


        </div>
        <div class="col-md-8 animated fadeIn">
          @yield('content')
        </div>
      </div>
      </main>

    @else
      <main class="animated fadeIn">
      @yield('content')
      </main>
    @endif

  </div>

  <!-- scripts -->
  <script src="{{ asset('js/app.js') }}"></script>
  @stack('js')
</body>
</html>
