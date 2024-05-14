<nav class="navbar navbar-expand-lg barra">
    <div class="container-fluid">
        @auth
            @if(auth()->user()->type === 'Administrador' && Route::current()->getName() !== 'dashboard')
                <div class="my-auto mr-3">
                    <a href="#" id="sidebarCollapse" class="text-white nav-link">
                        <i class="fas fa-align-left fa-lg ampliar"></i>
                    </a>
                </div>
            @endif
        @endauth
        <a class="navbar-brand" href="/">
            <img src="img/logo.png" alt="UNICAES" width="60" height=60">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars text-white
            " aria-hidden="true"></i>
        </button>
        <div class="collapse navbar-collapse justify-content-start" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link ampliar" aria-current="page" href="/">Inicio</a>
                <a class="nav-link ampliar" href="#">Equipos</a>
                @auth
                    @if(auth()->user()->type === 'Administrador')
                        <a class="nav-link ampliar" href="{{route('solicitud-equipo')}}">Solicitud de equipos</a>
                        <a class="nav-link ampliar" href="{{route('dashboard')}}">Dashboard <i
                                class="fa-solid fa-gauge ml-1" aria-hidden="true"></i></a>
                    @else
                        <a class="nav-link ampliar" href="{{route('solicitud-equipo')}}">Solicitud de equipos</a>
                    @endif
                @endauth
                <a class="nav-link ampliar" href="/faqs">FAQs</a>
            </div>
            <div class="ml-auto d-flex justify-content-center py-3">
                @auth
                    <p class="text-white mr-3 my-0">{{ auth()->user()->name }}</p>
                    <div class="dropdown">
                        <a class="text-white " type="button" id="triggerId" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            <i class="fa-solid fa-user fa-xl ampliar mr-4"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId"
                             style="min-width:1rem;">
                            <a class="dropdown-item text-dark" href="{{route('perfil')}}">Perfil</a>
                            <div class="dropdown-divider"></div>
                            <form action="{{route('logout')}}" method="post">
                                @csrf
                                <button class="dropdown-item" type="submit">Cerrar sesión</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{route('login')}}"><i class="fa-solid fa-user fa-xl ampliar mr-4"></i></a>
                @endauth
            </div>
        </div>
    </div>
</nav>
<div class="linea"></div>
