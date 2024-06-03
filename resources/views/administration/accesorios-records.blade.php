@extends('layouts.master')
@section('title', 'Registros de accesorios')

@section('content')
    <div class="container-fluid py-5">
        <div>
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-sm-5 col-12">
                                    <h4 class="title text-center">Registro de accesorios</h4>
                                    <div id="cantidadDeRegistros"
                                         class="d-flex py-2 justify-content-center text-center">
                                        <a href="#" id="totalDisponibles" class="px-3 m-0 activo"
                                           style="border-radius:10px 0px 0px 10px;"><i
                                                class="fa-solid fa-circle fa-2xs"></i> Disponibles
                                            00
                                        </a>
                                        <a href="#" id="totalReparacion" class="px-3 m-0 reparacion"><i
                                                class="fa-solid fa-circle fa-2xs"></i> En reparacion
                                            00</a>
                                        <a href="#" id="totalOcupados" class="px-3 m-0 finalizado"
                                           style="border-radius:0px 10px 10px 0px;"><i
                                                class="fa-solid fa-circle fa-2xs"></i> Ocupados 00
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-7 col-12 text-right my-auto">
                                    <div class="btn_group">
                                        <a href="#" id="limpiarBusqueda" onclick="cleanSearchInput()"
                                           style="display:none;"><i
                                                class="fa-solid fa-x text-white mr-1 ampliar"></i></a>
                                        <input type="text" class="form-control busqueda" placeholder="Buscar..." value>
                                        <button class="btn btn-default ampliar" title="Reload" onclick="refrescar()"><i
                                                class="fas fa-sync-alt"></i></button>
                                        <button type="button"
                                                class="btn btn-default ampliar"
                                                data-toggle="modal" data-target="#add">
                                            <i class="fa-solid fa-plus"></i>
                                        </button>
                                    </div>
                                    <div>
                                        <p class="text-white pt-4 pr-2 m-0" id="searchInfo" style="display: none;"></p>
                                    </div>
                                    <div id="entriesPerPageContainer">
                                        <div class="d-flex justify-content-end pt-3">
                                            <p class="text-white my-auto pt-1 pr-2">Entradas por pagina: </p>
                                            <div class="dropdown">
                                                <select class="custom-select" id="entradasPorPagina">
                                                    <option value="10">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 pt-4 bg-white">
                        <div class="row">
                            <div class="col-12">
                                <div class="card-tabla">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="thead-light">
                                            <tr>
                                                <th scope="col"><a href="#" id="filtradoID"
                                                                   class="d-flex align-items-center text-black justify-content-center">ID
                                                        <i class="fa-solid fa-sort pl-2"></i></a>
                                                </th>
                                                <th scope="col"><a href="#" id="filtradoNombre"
                                                                   class="d-flex align-items-center text-black justify-content-center">Tipo
                                                        <i class="fa-solid fa-sort pl-2"></i></a>
                                                </th>
                                                <th scope="col"><a href="#" id="filtradoTipo"
                                                                   class="d-flex align-items-center text-black justify-content-center">Modelo
                                                        <i class="fa-solid fa-sort pl-2"></i></a>
                                                </th>
                                                <th scope="col"><a href="#" id="filtradoMateria"
                                                                   class="d-flex align-items-center text-black justify-content-center">Identificador
                                                        <i class="fa-solid fa-sort pl-2"></i></a>
                                                </th>
                                                <th scope="col">
                                                    <a href="#" id="filtradoFecha"
                                                       class="d-flex align-items-center text-black justify-content-center">
                                                        Estado
                                                        <i class="fa-solid fa-sort pl-2"></i>
                                                    </a>
                                                </th>
                                                <th scope="col" class="text-center">Atributos</th>
                                                <th scope="col" class="text-center">Acciones</th>
                                            </tr>
                                            </thead>
                                            <tbody class="customtable">
                                            <tr class="row-template" style="display: none;">
                                                <td class="id text-center"></td>
                                                <td class="brand text-center"></td>
                                                <td class="model text-center"></td>
                                                <td class="identifier text-center"></td>
                                                <td class="status">
                                                    <div class="w-75 mx-auto">
                                                        <a href="#" class="open-changeStatus-modal" data-toggle="modal"
                                                           data-target="#changeStatus">
                                                            <p
                                                                class="estado activo d-flex align-content-center justify-content-center">
                                                            </p>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td class="d-flex justify-content-center">
                                                    <button type="button"
                                                            class="btn text-white btn-success mr-1 ampliar open-changePhoto-modal"
                                                            data-toggle="modal" data-target="#changePhoto">
                                                        <i class="fa-solid fa-image"></i>
                                                    </button>
                                                    <button type="button"
                                                            class="btn text-white btn-primario-claro mr-1 ampliar open-prestamos-modal"
                                                            data-toggle="modal" data-target="#showPrestamos">
                                                        <i class="fa-solid fa-code-branch"></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <button type="button"
                                                                class="btn btn-info mr-1 ampliar open-edit-modal"
                                                                data-toggle="modal" data-target="#edit">
                                                            <i class="fa-solid fa-pencil"></i>
                                                        </button>
                                                        <button type="button"
                                                                class="btn btn-details mr-1 ampliar open-viewObser-modal"
                                                                data-toggle="modal" data-target="#viewObser">
                                                            <i class="fa-solid fa-book"></i>
                                                        </button>
                                                        <button type="button"
                                                                class="btn btn-danger mr-1 ampliar open-delete-modal"
                                                                data-toggle="modal" data-target="#delete">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="sin-resultados" style="display: none;">
                                                <td colspan="9" class="text-center">No se encuentran registros...</td>
                                            </tr>
                                            </tbody>
                                            <tr class="thead-light">
                                                <th scope="col" class="text-center">ID</th>
                                                <th scope="col" class="text-center">Tipo</th>
                                                <th scope="col" class="text-center">Modelo</th>
                                                <th scope="col" class="text-center">Identificador</th>
                                                <th scope="col" class="text-center">Estado</th>
                                                <th scope="col" class="text-center">Atributos</th>
                                                <th scope="col" class="text-center">Acciones</th>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer py-2">
                        <div class="row">
                            <div class="b4">

                            </div>
                            <div class="col-sm-12 d-flex">
                                <div class="col-sm-6 col-6 my-auto" id="indiceDePaginas">Mostrando <b>5</b> salidas de
                                    <b>25</b>
                                    entradas
                                </div>
                                <div class="col-sm-6 col-6">
                                    <ul class="pagination justify-content-end">
                                        <li class="page-item"><a class="page-link" href="#">></a></li>
                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                                        <li class="page-item"><a class="page-link" href="#">
                                                < </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modales --}}
    <form method="POST" id="deleteForm">
        <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="eliminarTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="eliminarTitle">Eliminar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="eliminarBody">
                        <div class="form-group" style="display:none;">
                            <input type="text" name="id" class="form-control text-center"/>
                        </div>
                        <p class="text-center">¿Está seguro que desea eliminarlo?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form id="changePhotoForm" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="changePhoto" tabindex="-1" role="dialog" aria-labelledby="changePhotoTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="changePhotoTitle">Cambiar imagen
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="changePhotoBody">
                        <div class="form-group" style="display:none;">
                            <input type="text" name="id" class="form-control text-center" style="display: none;"/>
                        </div>
                        <div>
                            <small class="form-text text-center text-muted">Imagen actual</small>
                            <div class="d-flex justify-content-center py-2">
                                <img id="current-imagen" src="" alt="current-imagen" width="150">
                            </div>
                        </div>
                        <div class="form-group">
                            <small class="form-text text-muted">Nueva imagen</small>
                            <input class="form-control" required name="imagen" type="file">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Guardar cambios</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form id="changeStatusForm" method="POST">
        <div class="modal fade" id="changeStatus" tabindex="-1" role="dialog" aria-labelledby="cambiarEstadoTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="cambiarEstadoTitle">Cambiar estado
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="cambiarEstadoBody">
                        <div class="form-group" style="display:none;">
                            <input type="text" name="id" class="form-control text-center" style="display: none;"/>
                        </div>
                        <div class="form-group">
                            <small class="form-text text-muted">Estado</small>
                            <select required class="form-control" name="estado" id="estado">
                                <option class="hidden" selected disabled>Seleccione el estado</option>
                                <option>Disponible</option>
                                <option>Ocupado</option>
                                <option>En reparación</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Guardar cambios</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form id="viewObserForm" method="POST">
        <div class="modal fade" id="viewObser" tabindex="-1" role="dialog" aria-labelledby="viewObserTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="viewObserTitle">Motivo del préstamo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="viewObserBody">
                        <input type="text" name="id" class="form-control text-center" style="display: none;"/>
                        <textarea name="observations" id="observations"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success">Guardar cambios</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="modal fade" id="showPrestamos" tabindex="-1" role="dialog" aria-labelledby="showPrestamosTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="showPrestamosTitle">Prestamo asignado al accesorio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body px-5 py-4" id="showPrestamosBody">
                    <table class="tabla-reporte" width="100%" style="border: 0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Fecha de prestación</th>
                        </tr>
                        </thead>
                        <tbody class="report-tbody">
                        <tr class="report-row-template">
                            <td class="id"></td>
                            <td class="estado text-center"></td>
                            <td class="fecha text-center"></td>
                        </tr>
                        <tr class="report-row-sin-resultados" style="display: none;">
                            <td colspan="3" class="text-center">No hay prestamo asignado...</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <form id="editForm" method="POST">
        <div id="edit" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
             aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="editTitle">Editar accesorios</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body px-5 py-4" id="editBody">
                        <form id="prestamoForm" action="">
                            <div class="col-md-12 d-flex">
                                <input type="text" name="id" class="form-control text-center" style="display: none;"/>
                                <div class="col-sm-6 mr-2">
                                    <div class="form-group">
                                        <small class="form-text text-muted">Tipo de accesorio</small>
                                        <select required class="form-control" id="marca" name="marca">
                                            <option class="hidden" selected disabled>Seleccione el tipo de accesorio
                                            </option>
                                            <option>Teclado</option>
                                            <option>Mouse</option>
                                            <option>Cargador</option>
                                            <option>Cable</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <small class="form-text text-muted">Identificador</small>
                                        <input required type="text" class="form-control"
                                               name="identificador"
                                               placeholder="Ingrese el identificador del equipo"
                                               value=""/>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <small class="form-text text-muted">Modelo</small>
                                        <input required autocomplete="off" type="text" name="modelo"
                                               class="form-control"
                                               placeholder="Ingrese el modelo del equipo"
                                               value=""/>
                                    </div>
                                    <div class="form-group pr-0">
                                        <small class="form-text text-muted">Estado</small>
                                        <select required class="form-control" id="estado-edit" name="estado">
                                            <option class="hidden" selected disabled>Seleccione el
                                                estado
                                            </option>
                                            <option>Disponible</option>
                                            <option>En reparación</option>
                                            <option>Ocupado</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-group">
                                <small class="form-text text-muted">Observaciones</small>
                                <textarea name="observaciones-edit" id="observaciones-edit"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success">Guardar cambios</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form id="addForm" method="POST" action="{{route('register-new-inventory')}}" enctype="multipart/form-data">
        @csrf
        <div id="add" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
             aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="addTitle">Nuevo accesorio</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body px-5 py-4" id="addBody">
                        <form id="prestamoForm" action="">
                            <div class="col-md-12 px-0 d-flex">
                                <div class="col-sm-6 px-0 mr-2">
                                    <div class="form-group">
                                        <small class="form-text text-muted">Tipo de accesorio</small>
                                        <select required class="form-control" id="marca" name="marca">
                                            <option class="hidden" selected disabled>Seleccione el tipo de accesorio
                                            </option>
                                            <option>Teclado</option>
                                            <option>Mouse</option>
                                            <option>Cargador</option>
                                            <option>Cable</option>
                                        </select>
                                    </div>

                                    <input type="text" name="tipo" value="Accesorio" style="display: none;">
                                    <div class="form-group">
                                        <small class="form-text text-muted">Identificador</small>
                                        <input required type="text" class="form-control"
                                               name="identificador"
                                               placeholder="Ingrese el identificador del accesorio"
                                               value=""/>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <small class="form-text text-muted">Modelo</small>
                                        <input required autocomplete="off" type="text" name="modelo"
                                               class="form-control"
                                               placeholder="Ingrese el modelo del accesorio"
                                               value=""/>
                                    </div>
                                    <div class="form-group pr-0">
                                        <small class="form-text text-muted">Estado</small>
                                        <select required class="form-control" id="estado-edit" name="estado">
                                            <option class="hidden" selected disabled>Seleccione el
                                                estado
                                            </option>
                                            <option>Disponible</option>
                                            <option>En reparación</option>
                                            <option>Ocupado</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <small class="form-text text-muted">Imagen</small>
                                <input class="form-control" required name="imagen" type="file">
                            </div>
                            <div class="form-group form-group">
                                <small class="form-text text-muted">Observaciones</small>
                                <textarea name="observaciones" id="observaciones-edit"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success">Guardar cambios</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
@section('scripts')
    {{--    <script>--}}
    {{--        document.getElementById('agregarEquipos').addEventListener('click', function (e) {--}}
    {{--            e.preventDefault();--}}
    {{--            const cantidad = document.getElementById('cantidad').value;--}}
    {{--            localStorage.setItem('equipos', cantidad);--}}
    {{--            const container = document.getElementById('nuevo-equipo-container');--}}
    {{--            $(container).slideUp(200);--}}
    {{--            container.innerHTML = '';--}}

    {{--            let equipoHTML = [];--}}
    {{--            for (let i = 1; i <= cantidad; i++) {--}}
    {{--                let camposDobles = i % 2 !== 0;--}}
    {{--                let colClass = (i + 1) > cantidad && camposDobles ? 'col-sm-12' : 'col-sm-6';--}}

    {{--                equipoHTML.push(`--}}
    {{--                    ${camposDobles ? '<div class="d-flex">' : ''}--}}
    {{--                        <div class="form-group ${colClass}">--}}
    {{--                            <small class="form-text text-muted">Nuevo equipo #${i}</small>--}}
    {{--                            <select id="nuevoEquipo${i}" class="equipo input_textual form-control" data-live-search="true">--}}
    {{--                                <option value="" selected disabled>Seleccione el equipo</option>--}}
    {{--                                @foreach($equiposDisponibles as $equipo)--}}
    {{--                    <option value="{{$equipo->id}}">{{$equipo->marca . ' ' . $equipo->modelo}} ({{$equipo->identificador}})</option>--}}
    {{--                                @endforeach--}}
    {{--                    </select>--}}
    {{--                </div>--}}
    {{--${!camposDobles ? '</div>' : ''}`--}}
    {{--                );--}}
    {{--            }--}}
    {{--            equipoHTML = equipoHTML.join('');--}}

    {{--            container.innerHTML = equipoHTML;--}}
    {{--            Array.from(container.getElementsByTagName('select')).forEach((elemento) => {--}}
    {{--                $(function () {--}}
    {{--                    $(elemento).selectpicker();--}}
    {{--                });--}}
    {{--            });--}}

    {{--            $(container).slideDown("slow");--}}
    {{--        });--}}


    {{--        function setEquiposToEdit(equiposId) {--}}
    {{--            const container = document.getElementById('equipos-container');--}}
    {{--            container.innerHTML = '';--}}
    {{--            let equipoHTML = [];--}}
    {{--            for (let i = 1; i <= equiposId.length; i++) {--}}
    {{--                let camposDobles = i % 2 !== 0;--}}
    {{--                let colClass = (i + 1) > equiposId.length && camposDobles ? 'col-sm-12' : 'col-sm-6';--}}

    {{--                equipoHTML.push(`--}}
    {{--                    ${camposDobles ? '<div class="d-flex justify-content-center">' : ''}--}}
    {{--                        <div class="form-group ${colClass}">--}}
    {{--                            <small class="form-text text-muted">Inventario #${i}</small>--}}
    {{--                            <select id="equipo${i}" class="input_textual form-control disable" data-live-search="true">--}}
    {{--                                <option value="" selected disabled>Seleccione el equipo</option>--}}
    {{--                                @foreach($equiposOcupados as $equipo)--}}
    {{--                    <option value="{{$equipo->id}}">{{$equipo->marca . ' ' . $equipo->modelo}} ({{$equipo->identificador}})</option>--}}
    {{--                                @endforeach--}}
    {{--                    </select>--}}
    {{--                </div>--}}
    {{--                <a href="#" onclick="showDeleteAlert(${equiposId[i - 1]})" class="d-flex align-items-center pt-2 open-delete-equipo-modal"><i class="fa-solid fa-xmark fa-lg" style="color: #df2020;"></i></a>--}}
    {{--${!camposDobles ? '</div>' : ''}`--}}
    {{--                );--}}

    {{--            }--}}
    {{--            equipoHTML = equipoHTML.join('');--}}
    {{--            container.innerHTML = equipoHTML;--}}
    {{--            let cont = 0;--}}
    {{--            Array.from(container.getElementsByTagName('select')).forEach((elemento) => {--}}
    {{--                $(function () {--}}
    {{--                    $(elemento).selectpicker();--}}
    {{--                    $(elemento).selectpicker('val', equiposId[cont] + "");--}}
    {{--                    // $(elemento).prop('disabled', true);--}}
    {{--                    // $(elemento).selectpicker('refresh');--}}
    {{--                    cont++;--}}
    {{--                });--}}
    {{--            });--}}
    {{--        }--}}
    {{--    </script>--}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if(session('success'))
            Alerts.showToastAlert({icon: 'success', title: '¡Éxito!', text: '{{ session('success') }}'});
            @elseif(session('error'))
            Alerts.showToastAlert({icon: 'error', title: '¡Error!', text: '{{ session('error') }}'});
            @endif
        });
    </script>
    <script src="{{asset('js/accesorios-records.js')}}"></script>
@endsection
