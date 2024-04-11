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
            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i
                    class="fa-solid fa-table mr-3"></i>Registros</a>
            <ul class="collapse list-unstyled" id="homeSubmenu">
                <li>
                    <a href="{{route('registros-prestamos')}}">Registros de prestamos</a>
                </li>
                <li>
                    <a href="#">Registros de usuarios</a>
                </li>
                <li>
                    <a href="#">Registros de equipos</a>
                </li>
                <li>
                    <a href="#">Registros de licencias</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#"><i class="fa-solid fa-chart-line mr-2"></i> Estadísticas</a>
        </li>
        <li>
            <a href="#"><i class="fa-solid fa-computer mr-2"></i>
                Equipos</a>
        </li>
        <li>
            <a href="#"><i class="fa-solid fa-compact-disc mr-2"></i>
                Licencias</a>
        </li>
        <li>
            <a href="#"><i
                    class="fa-regular fa-keyboard mr-2"></i></i> Accesorios</a>
        </li>
        <li>
            <a href="#"><i class="fa-solid fa-memory mr-2"></i>
                Componentes</a>
        </li>
    </ul>
</nav>
