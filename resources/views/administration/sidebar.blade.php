<nav id="sidebar" class="active" style="z-index: 10;">
    <div class="sidebar-header">
        <h3 class="text-center"></i>Dashboard <i class="fa-solid fa-gauge mr-3"></i></h3>
    </div>

    <ul class="list-unstyled components">
        @if (Route::current()->getName() !== 'dashboard')
            <li>
                <a href="{{route('dashboard')}}" class="text-center">Ir al dashboard</a>
            </li>
        @endif

        <li>
            <a href="#prestamosInfo" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i
                    class="fa-solid fa-handshake mr-2"></i></i>Prestamos</a>
            <ul class="collapse list-unstyled" id="prestamosInfo">
                <li>
                    <a href="{{route('registros-prestamos')}}">Registros de prestamos</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#usersInfo" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i
                    class="fa-solid fa-users mr-2"></i>
                Usuarios</a>
            <ul class="collapse list-unstyled" id="usersInfo">
                <li>
                    <a href="{{route('registros-usuarios')}}">Registros de usuarios</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#equiposInfo" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i
                    class="fa-solid fa-computer mr-2"></i>
                Equipos</a>
            <ul class="collapse list-unstyled" id="equiposInfo">
                <li>
                    <a href="{{route('registros-equipos')}}">Registros de equipos</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#licenciasInfo" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i
                        class="fa-solid fa-compact-disc mr-2"></i>
                    Licencias</a>
                <ul class="collapse list-unstyled" id="licenciasInfo">
                    <li>
                        <a href="{{route('registros-licencias')}}">Registros de licencias</a>
                    </li>
                </ul>
        </li>
        <li>
            <a href="#accesoriosInfo" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i
                    class="fa-regular fa-keyboard mr-2"></i>
                Accesorios</a>
            <ul class="collapse list-unstyled" id="accesoriosInfo">
                <li>
                    <a href="{{route('registros-accesorios')}}">Registros de accesorios</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#dispositivosInfo" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa-solid fa-camera mr-2"></i>
                Dispositivos</a>
            <ul class="collapse list-unstyled" id="dispositivosInfo">
                <li>
                    <a href="{{route('registros-dispositivos')}}">Registros de dispositivos</a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
