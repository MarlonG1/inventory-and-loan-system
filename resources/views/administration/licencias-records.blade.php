@extends('layouts.master')
@section('title', 'Registros de licencias')

@section('content')
    <div class="container-fluid py-5">
        <div>
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-sm-6 col-12">
                                    <h4 class="title text-center">Registro de licencias</h4>
                                    <div id="cantidadDeRegistros"
                                         class="d-flex py-2 justify-content-center text-center">
                                        <a href="#" id="totalDisponibles" class="px-3 m-0 activo"
                                           style="border-radius:10px 0px 0px 10px;"><i
                                                class="fa-solid fa-circle fa-2xs"></i> Activas
                                            00
                                        </a>
                                        <a href="#" id="totalPorRenovar" class="px-3 m-0 reparacion"><i
                                                class="fa-solid fa-circle fa-2xs"></i> Por renovar
                                            00</a>
                                        <a href="#" id="totalInactivas" class="px-3 m-0 inactiva"><i
                                                class="fa-solid fa-circle fa-2xs"></i> Inactivas
                                            00</a>
                                        <a href="#" id="totalVencidas" class="px-3 m-0 finalizado"
                                           style="border-radius:0px 10px 10px 0px;"><i
                                                class="fa-solid fa-circle fa-2xs"></i> Vencidas 00
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12 text-right my-auto">
                                    <div class="btn_group">
                                        <a href="#" id="limpiarBusqueda" onclick="cleanSearchInput()"
                                           style="display:none;"><i
                                                class="fa-solid fa-x text-white mr-1 ampliar"></i></a>
                                        <input type="text" class="form-control busqueda" placeholder="Buscar..." value>
                                        <button class="btn btn-default ampliar" title="Reload" onclick="refrescar()"><i
                                                class="fas fa-sync-alt"></i></button>
                                        <button type="button"
                                                id="open-add-modal"
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
                                                                   class="d-flex align-items-center text-black justify-content-center">Nombre
                                                        <i class="fa-solid fa-sort pl-2"></i></a>
                                                </th>
                                                <th scope="col"><a href="#" id="filtradoTipo"
                                                                   class="d-flex align-items-center text-black justify-content-center">Tipo
                                                        <i class="fa-solid fa-sort pl-2"></i></a>
                                                </th>
                                                <th scope="col"><a href="#" id="filtradoMateria"
                                                                   class="d-flex align-items-center text-black justify-content-center">Unidades
                                                        <i class="fa-solid fa-sort pl-2"></i></a>
                                                </th>
                                                <th scope="col"><a href="#"
                                                                   class="d-flex align-items-center text-black justify-content-center">Fecha
                                                        vencimiento
                                                        <i class="fa-solid fa-sort pl-2"></i></a>
                                                </th>
                                                <th scope="col" width="20%">
                                                    <a href="#" id="filtradoFecha"
                                                       class="d-flex align-items-center text-black justify-content-center">
                                                        Estado
                                                        <i class="fa-solid fa-sort pl-2"></i>
                                                    </a>
                                                </th>
                                                <th scope="col" class="text-center">Acciones</th>
                                            </tr>
                                            </thead>
                                            <tbody class="customtable">
                                            <tr class="row-template" style="display: none;">
                                                <td class="id text-center"></td>
                                                <td class="name text-center"></td>
                                                <td class="type text-center"></td>
                                                <td class="units text-center"></td>
                                                <td class="date text-center"></td>
                                                <td class="status">
                                                    <div class="w-75 mx-auto">
                                                        <a href="#" class="open-chageStatus-modal" data-toggle="modal"
                                                           data-target="#changeStatus">
                                                            <p
                                                                class="estado activo d-flex align-content-center justify-content-center">
                                                            </p>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <button type="button"
                                                                class="btn btn-info mr-1 ampliar open-edit-modal"
                                                                data-toggle="modal" data-target="#edit">
                                                            <i class="fa-solid fa-pencil"></i>
                                                        </button>
                                                        <button type="button"
                                                                class="btn text-white btn-primario-claro mr-1 ampliar open-computers-modal"
                                                                data-toggle="modal" data-target="#showComputers">
                                                            <i class="fa-solid fa-code-branch"></i>
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
                                                <th scope="col" class="text-center">Nombre</th>
                                                <th scope="col" class="text-center">Tipo</th>
                                                <th scope="col" class="text-center">Unidades</th>
                                                <th scope="col" class="text-center">Fecha de vencimiento</th>
                                                <th scope="col" class="text-center">Estado</th>
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
                            <select required class="form-control" id="estado" name="estado">
                                <option class="hidden" selected disabled>Seleccione el estado</option>
                                <option>Activa</option>
                                <option>Inactiva</option>
                                <option>Vencida</option>
                                <option>Por renovar</option>
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
        <div class="modal fade" id="viewObser" tabindex="-1" role="dialog" aria-labelledby="motivoTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="viewObserTitle">Observaciones</h5>
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

    <div class="modal fade" id="showComputers" tabindex="-1" role="dialog" aria-labelledby="showComputersTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="showComputersTitle">Equipos asignados a la licencia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body px-5 py-4" id="showComputersBody">
                    <table class="tabla-reporte" width="100%" style="border: 0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Equipo</th>
                            <th>Identificador</th>
                            <th>Estado</th>
                        </tr>
                        </thead>
                        <tbody class="report-tbody">
                        <tr class="report-row-template">
                            <td class="id"></td>
                            <td class="equipo"></td>
                            <td class="identificador"></td>
                            <td class="estado"></td>
                        </tr>
                        <tr class="report-row-sin-resultados" style="display: none;">
                            <td colspan="4" class="text-center">No hay equipos asignados...</td>
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
                        <h5 class="modal-title text-center" id="editTitle">Editar licencia</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body px-5 py-4" id="editBody">
                        <div class="col-md-12 d-flex">
                            <input type="text" name="id" class="form-control text-center" style="display: none;"/>
                            <div class="col-sm-6 mr-2">
                                <div class="form-group">
                                    <div class="form-group">
                                        <small class="form-text text-muted">Nombre de la licencia</small>
                                        <input required type="text" class="form-control"
                                               name="nombre"
                                               placeholder="Ingrese el nombre de la licencia"
                                               value=""/>
                                    </div>
                                    <small class="form-text text-muted">Tipo de licencia</small>
                                    <select required class="form-control" id="tipo" name="tipo">
                                        <option class="hidden" selected disabled>Seleccione el tipo de licencia
                                        </option>
                                        <option>Sistema operativo</option>
                                        <option>Sistema contable</option>
                                        <option>Antivirus</option>
                                        <option>Base de datos</option>
                                        <option>Ofimática</option>
                                        <option>Programación</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <small class="form-text text-muted">Fecha de adquisición</small>
                                    <input required autocomplete="off" type="date" name="fechaAdquisicion"
                                           class="form-control"
                                           value=""/>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <small class="form-text text-muted">Unidad</small>
                                    <input required autocomplete="off" type="text" name="unidad"
                                           class="form-control"
                                           placeholder="Ingrese la unidad"
                                           value=""/>
                                </div>
                                <div class="form-group">
                                    <small class="form-text text-muted">Estado</small>
                                    <select required class="form-control" id="estado-edit" name="estado">
                                        <option class="hidden" selected disabled>Seleccione el estado</option>
                                        <option>Activa</option>
                                        <option>Inactiva</option>
                                        <option>Vencida</option>
                                        <option>Por renovar</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <small class="form-text text-muted">Fecha de vencimiento</small>
                                    <input required autocomplete="off" type="date" name="fechaVencimiento"
                                           class="form-control"
                                           value=""/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <small class="form-text text-muted">Clave</small>
                            <input required autocomplete="off" type="text" name="clave"
                                   class="form-control"
                                   placeholder="Ingrese la clave"
                                   value=""/>
                        </div>
                        <div>
                            <small class="form-text text-muted">Observaciones de licencia</small>
                            <textarea name="observaciones" id="observations-edit"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success">Guardar cambios</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form id="addForm" method="POST">
        <div id="add" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
             aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="addTitle">Nueva licencia</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body px-5 py-4" id="addBody">
                        <div class="col-md-12 px-0 d-flex">
                            <div class="col-sm-6 mr-2 px-0">
                                <div class="form-group">
                                    <div class="form-group">
                                        <small class="form-text text-muted">Nombre de la licencia</small>
                                        <input required type="text" class="form-control"
                                               name="nombre"
                                               placeholder="Ingrese el nombre de la licencia"
                                               value=""/>
                                    </div>
                                    <small class="form-text text-muted">Tipo de licencia</small>
                                    <select required class="form-control" id="tipo" name="tipo">
                                        <option class="hidden" selected disabled>Seleccione el tipo de licencia
                                        </option>
                                        <option>Sistema operativo</option>
                                        <option>Sistema contable</option>
                                        <option>Antivirus</option>
                                        <option>Base de datos</option>
                                        <option>Ofimática</option>
                                        <option>Programación</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <small class="form-text text-muted">Fecha de adquisición</small>
                                    <input required autocomplete="off" type="date" name="fechaAdquisicion"
                                           class="form-control"
                                           value=""/>
                                </div>
                            </div>
                            <div class="col-sm-6 px-0">
                                <div class="form-group">
                                    <small class="form-text text-muted">Unidad</small>
                                    <input required autocomplete="off" type="text" name="unidad"
                                           class="form-control"
                                           placeholder="Ingrese la unidad"
                                           value=""/>
                                </div>
                                <div class="form-group">
                                    <small class="form-text text-muted">Estado</small>
                                    <select required class="form-control" id="estado-edit" name="estado">
                                        <option class="hidden" selected disabled>Seleccione el estado</option>
                                        <option>Activa</option>
                                        <option>Inactiva</option>
                                        <option>Vencida</option>
                                        <option>Por renovar</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <small class="form-text text-muted">Fecha de vencimiento</small>
                                    <input required autocomplete="off" type="date" name="fechaVencimiento"
                                           class="form-control"
                                           value=""/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <small class="form-text text-muted">Clave</small>
                            <input required autocomplete="off" type="text" name="clave"
                                   class="form-control"
                                   placeholder="Ingrese la clave"
                                   value=""/>
                        </div>
                        <div>
                            <small class="form-text text-muted">Observaciones de licencia</small>
                            <textarea name="observaciones" id="observations-edit"></textarea>
                        </div>
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
    <script src="{{asset('js/licencias-records.js')}}"></script>
@endsection
