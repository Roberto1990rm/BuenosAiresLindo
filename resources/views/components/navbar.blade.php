<nav class="navbar navbar-expand-lg navbar-light" style="background: linear-gradient(135deg, #24292E, #3A3F44);">
    <div class="container">
        <a class="navbar-brand" href="{{ route('welcome') }}" style="color: #61DAFB; font-size: 28px; font-weight: bold; font-family: fantasy;">
            Buenos Aires <i style="color:white;">Lindo</i>
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" style="border: 1px solid #61DAFB; background: #61DAFB;">
            <span class="navbar-toggler-icon" style="background: #fff;"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}" style="color: #dffb61;">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('barrios.index') }}" style="color: #61DAFB;">Barrios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('bares.index') }}" style="color: #d2fb61;">Bares</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('parques.index') }}" style="color: #61DAFB;">Parques</a>
                </li>
                <li class="nav-item me-5">
                    <a class="nav-link" href="{{ route('ocio.index') }}" style="color: #d7fb61;">Ocio</a>
                </li>
                @guest
                    <li class="nav-item">
                        @if (Route::has('login'))
                            <a class="nav-link nav-inactive" href="{{ route('login') }}" style="color: #fff;">{{ __('Iniciar sesión') }}</a>
                        @endif
                    </li>
                    <li class="nav-item">
                        @if (Route::has('register'))
                            <a class="nav-link nav-inactive" href="{{ route('register') }}" style="color: #fff;">{{ __('Registrarse') }}</a>
                        @endif
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color: #ebf1f3;">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown" style="background: #24292E;">
                            @auth
                                @if (auth()->user()->admin == 1)
                                    <a class="dropdown-item" href="{{ route('barrios.create') }}" style="color: #61DAFB;">Crear Barrio</a>
                                    <a class="dropdown-item" style="color: #61DAFB;" href="{{ route('parques.create') }}">Crear Parques</a>
                                    <a href="{{ route('ocio.create') }}" class="dropdown-item" style="color: #61DAFB;"> Crear Actividad/Ocio</a>
                                @endif
                                <a href="{{ route('bares.create') }}" class="dropdown-item" style="color: #61DAFB;">Crear un Nuevo Bar</a>
                                
                            @endauth
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color: #61DAFB;">
                                {{ __('Cerrar sesión') }}
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
