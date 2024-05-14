@extends('layouts.master')
@section('title', 'Dashboard')

@section('content')
    <div class="col-sm-10">
        <div class="row mx-auto col-lg-12 pt-3">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-warning card-header-icon">
                        <div class="card-icon">
                            <i class="fa-solid fa-desktop"></i>
                        </div>
                        <p class="card-category">Equipos</p>
                        <h3 class="card-title" id="totalEquipos">0
                        </h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <a href="#">Ver todo <i class="fa-solid fa-right-long"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="fa-solid fa-compact-disc"></i>
                        </div>
                        <p class="card-category">Licencias</p>
                        <h3 class="card-title" id="totalLicencias">0</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <a href="#">Ver todo <i class="fa-solid fa-right-long"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-danger card-header-icon">
                        <div class="card-icon">
                            <i class="fa-regular fa-keyboard"></i>
                        </div>
                        <p class="card-category">Accesorios</p>
                        <h3 class="card-title" id="totalAccesorios">0</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <a href="#">Ver todo <i class="fa-solid fa-right-long"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon">
                            <i class="fa-solid fa-memory"></i>
                        </div>
                        <p class="card-category">Componentes</p>
                        <h3 class="card-title" id="totalComponentes">0</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <a href="#">Ver todo <i class="fa-solid fa-right-long"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row col-xl-12 mx-auto">
            <div class="col-xl-6">
                <div class=" card card-stats pb-3 mt-0 pt-0">
                    <div style="width:100%; height: 250px;" class="d-flex justify-content-center">
                        <canvas id="graficaDePrestamosPorSemana"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class=" card card-stats py-2 mt-0">
                    <div style="width:100%; height: 250px;" class="d-flex justify-content-center">
                        <canvas id="graficaDePrestamosPorMes"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row col-xl-12 mx-auto">
            <div class="col-xl-8">
                <div class=" card card-stats pb-3 mt-0 pt-0">
                    <div  id="map" style="width:100%; height: 420px;" class="d-flex justify-content-center">
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class=" card card-stats py-3 mt-0">
                    <div style="width:100%; height: 405px;" class="d-flex justify-content-center align-items-center">
                        <canvas id="graficaDePrestamos"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const usersByDepartament = @json($usuariosPorDepartamentos);

        const departamentosObj = {};
        usersByDepartament.forEach(item => {
            departamentosObj[item.departamento] = item.cantidad;
        });
    </script>
    <script type="module" src="js/dashboard.js"></script>
    <script type="text/javascript" src="js/mapa/mapdata.js"></script>
    <script type="text/javascript" src="js/mapa/countrymap.js"></script>
@endsection
