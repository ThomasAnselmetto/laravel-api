
@section('navbar')
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
  <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
          <div class="logo_laravel">
              <a class="btn btn-primary fw-bold" href="{{route('home') }}">Thomas's Projects</a>
          </div>
          {{-- config('app.name', 'Laravel') --}}
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          {{-- vedro' la dashboard dell'utente autenticato ('home') solo appunto se autenticato --}}

        @auth
          <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    {{-- il doppio underscore serve per la localization(per la traduzione) --}}
                    
                    <a class="nav-link @if(request()->routeIs('admin.projects*'))active @endif" href="{{route('home') }}">{{ __('Projects') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  @if(request()->routeIs('admin.types*'))active @endif" href="{{route('admin.types.index') }}">{{ __('Types') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('admin.technologies*'))active @endif"" href="{{route('admin.technologies.index') }}">{{ __('Technologies') }}</a>
                </li>
            
            </ul>
        @endauth

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
              <!-- Authentication Links -->
              {{-- se l'utente e' un ospite(non loggato mostra login e register)altrimenti(mostrami lo username e la dropdown che mi da le 3 voci e i rispettivi url [dashbord profile logout]) --}}
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
                      <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                          {{ Auth::user()->name }}
                      </a>
                      {{-- aggiungo route al posto deghli url e edit al prefisso profile. --}}
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="{{ route('home') }}">{{__('Dashboard')}}</a>
                      <a class="dropdown-item" href="{{ route('profile.edit') }}">{{__('Profile')}}</a>
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
</nav>




