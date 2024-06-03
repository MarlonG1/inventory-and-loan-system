@extends('layouts.master')
@section('title', 'Registros de prestamos')

@section('content')
    <div class="container-fluid py-5">
        <div>
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-sm-5 col-12">
                                    <h4 class="title text-center">Registro de prestamos</h4>
                                    <div id="cantidadDeRegistros"
                                         class="d-flex py-2 justify-content-center text-center">
                                        <a href="#" id="totalActivos" class="px-3 m-0 activo"
                                           style="border-radius:10px 0px 0px 10px;"><i
                                                class="fa-solid fa-circle fa-2xs"></i> Activos
                                            00
                                        </a>
                                        <a href="#" id="totalPendientes" class="px-3 m-0 pendiente"><i
                                                class="fa-solid fa-circle fa-2xs"></i> Pendientes
                                            00</a>
                                        <a href="#" id="totalFinalizados" class="px-3 m-0 finalizado"
                                           style="border-radius:0px 10px 10px 0px;"><i
                                                class="fa-solid fa-circle fa-2xs"></i> Finalizados 00
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
                                        <a href="/solicitud-equipo" class="btn btn-default ampliar"
                                           title="Agregar"><i class="fa-solid fa-plus"></i></a>
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
                                                                   class="d-flex align-items-center text-black justify-content-center">Materia
                                                        <i class="fa-solid fa-sort pl-2"></i></a>
                                                </th>
                                                <th scope="col">
                                                    <a href="#" id="filtradoFecha"
                                                       class="d-flex align-items-center text-black justify-content-center">
                                                        Fecha
                                                        <i class="fa-solid fa-sort pl-2"></i>
                                                    </a>
                                                </th>
                                                <th scope="col">Horario</th>
                                                <th scope="col">Estado</th>
                                                <th scope="col">Administración</th>
                                                <th scope="col" class="text-center">Acciones</th>
                                            </tr>
                                            </thead>
                                            <tbody class="customtable">
                                            <tr class="row-template" style="display: none;">
                                                <td class="id"></td>
                                                <td class="completeName"></td>
                                                <td class="type"></td>
                                                <td class="course"></td>
                                                <td class="requestDate"></td>
                                                <td class="time"></td>
                                                <td class="status">
                                                    <a href="#" class="open-chageStatus-modal" data-toggle="modal"
                                                       data-target="#changeStatus">
                                                        <p
                                                            class="estado activo d-flex align-content-center justify-content-center">
                                                        </p>
                                                    </a>
                                                </td>
                                                <td class="administration">
                                                    <div class="d-flex justify-content-center">
                                                        <a href="#" target="_blank"  style="display: none"
                                                           class="btn btn-primario-claro mr-1 ampliar report-ticket text-white">
                                                            <i class="fa-solid fa-ticket-simple"></i>
                                                        </a>
                                                        <a href="#" target="_blank"
                                                           class="btn btn-primario-claro mr-1 ampliar report-pdf text-white">
                                                            <i class="fa-solid fa-file-pdf"></i>
                                                        </a>
                                                        <button type="button"
                                                                class="btn text-white btn-info mr-1 px-2 ampliar open-computers-modal"
                                                                data-toggle="modal" data-target="#showComputers">
                                                            <i class="fa-solid fa-laptop"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <button type="button"
                                                                class="btn btn-info mr-1 ampliar open-edit-modal"
                                                                data-toggle="modal" data-target="#edit">
                                                            <i class="fa-solid fa-pencil"></i>
                                                        </button>
                                                        <button type="button"
                                                                class="btn btn-details mr-1 ampliar open-reason-modal"
                                                                data-toggle="modal" data-target="#viewReason">
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
                                                <th scope="col">ID</th>
                                                <th scope="col">Nombre</th>
                                                <th scope="col">Tipo</th>
                                                <th scope="col">Materia</th>
                                                <th scope="col">Fecha</th>
                                                <th scope="col">Horario</th>
                                                <th scope="col">Estado</th>
                                                <th scope="col">Administración</th>
                                                <th scope="col">Acciones</th>
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
                            <select required class="form-control" name="estado">
                                <option class="hidden" selected disabled>Seleccione el estado</option>
                                <option>Activo</option>
                                <option>Pendiente</option>
                                <option>Finalizado</option>
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

    <form id="viewReasonForm" method="POST">
        <div class="modal fade" id="viewReason" tabindex="-1" role="dialog" aria-labelledby="motivoTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="motivoTitle">Motivo del préstamo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="motivoBody">
                        <input type="text" name="id" class="form-control text-center" style="display: none;"/>
                        <textarea name="motivo" id="motivo"></textarea>
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
                    <h5 class="modal-title text-center" id="showComputersTitle">Equipos asignados al préstamo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body px-5 py-4" id="eliminarBody">
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
                            <td class="identifcador"></td>
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
                        <h5 class="modal-title text-center" id="editTitle">Editar prestamo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body px-5 py-4" id="editBody">
                        <form id="prestamoForm" action="">
                            <div class="tab-content">
                                <div class="tab-pane fade show active">
                                    <div class="row formulario-form">
                                        <div class="col-12">
                                            <div class="d-flex">
                                                <div class="form-group col-6 pl-0">
                                                    <input type="text" name="id" class="form-control text-center"
                                                           style="display: none;"/>
                                                    <small class="form-text text-muted">Nombre del solicitante</small>
                                                    <select name="userId" id="userId"
                                                            class="selectpicker input_textual form-control"
                                                            data-live-search="true">
                                                        <option value="">Seleccione el usuario</option>
                                                        @foreach($usuarios as $usuario)
                                                            <option
                                                                value="{{$usuario->id}}">{{$usuario->name}} {{$usuario->lastname}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-6 pr-0">
                                                    <small class="form-text text-muted">Agregar más equipos</small>
                                                    <div class=" d-flex">
                                                        <input autocomplete="off" type="number"
                                                               id="cantidad" class="form-control"
                                                               placeholder="Agregar más equipos"
                                                               value=""/>
                                                        <a href="#" onclick="" id="agregarEquipos"
                                                           class="btn btn-primario-claro ampliar text-white"><i
                                                                class="fa-solid fa-check"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="equipos-container"></div>
                                            <div id="nuevo-equipo-container"></div>
                                            <div>
                                                <small class=" form-text text-muted">Motivo de la solicitud</small>
                                                <textarea id="motivo-edit" name="motivo"
                                                          placeholder="Ingrese el motivo de la solicitud"
                                                          value=""></textarea>
                                            </div>
                                            <div class="form-group">
                                                <small class="form-text text-muted">Asignatura</small>
                                                <select name="asignaturaId" id="asignaturaId"
                                                        class="selectpicker input_textual form-control"
                                                        data-live-search="true">
                                                    <option value="" selected disabled>Seleccione la asignatura
                                                    </option>
                                                    @foreach($asignaturas as $asignatura)
                                                        <option
                                                            value="{{$asignatura->id}}">{{$asignatura->nombre}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <small class="form-text text-muted">Aula</small>
                                                <select name="aulaId" id="aulaId"
                                                        class="selectpicker input_textual form-control"
                                                        data-live-search="true">
                                                    <option value="">Seleccione el aula</option>
                                                    @foreach($aulas as $aula)
                                                        <option value="{{$aula->id}}">{{$aula->aula}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <small class="form-text text-muted">Hora de recibido</small>
                                                <input required type="time" name="horaInicio" class="form-control"
                                                       placeholder="Ingrese la hora de recibido" value=""/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <small class="form-text text-muted">Fecha de solicitud</small>
                                                <input required type="date" name="fechaPrestamo" class="form-control"
                                                       value=""/>
                                            </div>

                                            <div class="form-group">
                                                <small class="form-text text-muted">Hora de entrega</small>
                                                <input required type="time" minlength="10" maxlength="10" name="horaFin"
                                                       class="form-control" placeholder="Ingrese la hora de entrega"
                                                       value=""/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
    <script>
        document.getElementById('agregarEquipos').addEventListener('click', function (e) {
            e.preventDefault();
            const cantidad = document.getElementById('cantidad').value;
            localStorage.setItem('equipos', cantidad);
            const container = document.getElementById('nuevo-equipo-container');
            $(container).slideUp(200);
            container.innerHTML = '';

            let equipoHTML = [];
            for (let i = 1; i <= cantidad; i++) {
                let camposDobles = i % 2 !== 0;
                let colClass = (i + 1) > cantidad && camposDobles ? 'col-sm-12' : 'col-sm-6';

                equipoHTML.push(`
                    ${camposDobles ? '<div class="d-flex">' : ''}
                        <div class="form-group ${colClass}">
                            <small class="form-text text-muted">Nuevo equipo #${i}</small>
                            <select id="nuevoEquipo${i}" class="equipo input_textual form-control" data-live-search="true">
                                <option value="" selected disabled>Seleccione el equipo</option>
                                @foreach($equiposDisponibles as $equipo)
                    <option value="{{$equipo->id}}">{{$equipo->marca . ' ' . $equipo->modelo}} ({{$equipo->identificador}})</option>
                                @endforeach
                    </select>
                </div>
${!camposDobles ? '</div>' : ''}`
                );
            }
            equipoHTML = equipoHTML.join('');

            container.innerHTML = equipoHTML;
            Array.from(container.getElementsByTagName('select')).forEach((elemento) => {
                $(function () {
                    $(elemento).selectpicker();
                });
            });

            $(container).slideDown("slow");
        });


        function setEquiposToEdit(equiposId) {
            const container = document.getElementById('equipos-container');
            container.innerHTML = '';
            let equipoHTML = [];
            for (let i = 1; i <= equiposId.length; i++) {
                let camposDobles = i % 2 !== 0;
                let colClass = (i + 1) > equiposId.length && camposDobles ? 'col-sm-12' : 'col-sm-6';

                equipoHTML.push(`
                    ${camposDobles ? '<div class="d-flex justify-content-center">' : ''}
                        <div class="form-group ${colClass}">
                            <small class="form-text text-muted">Equipo #${i}</small>
                            <select id="equipo${i}" class="input_textual form-control disable" data-live-search="true">
                                <option value="" selected disabled>Seleccione el equipo</option>
                                @foreach($equiposOcupados as $equipo)
                    <option value="{{$equipo->id}}">{{$equipo->marca . ' ' . $equipo->modelo}} ({{$equipo->identificador}})</option>
                                @endforeach
                    </select>
                </div>
                <a href="#" onclick="showDeleteAlert(${equiposId[i - 1]})" class="d-flex align-items-center pt-2 open-delete-equipo-modal"><i class="fa-solid fa-xmark fa-lg" style="color: #df2020;"></i></a>
${!camposDobles ? '</div>' : ''}`
                );

            }
            equipoHTML = equipoHTML.join('');
            container.innerHTML = equipoHTML;
            let cont = 0;
            Array.from(container.getElementsByTagName('select')).forEach((elemento) => {
                $(function () {
                    $(elemento).selectpicker();
                    $(elemento).selectpicker('val', equiposId[cont] + "");
                    // $(elemento).prop('disabled', true);
                    $(elemento).selectpicker('refresh');
                    cont++;
                });
            });
        }
    </script>
    <script src="{{asset('js/prestamos-records.js')}}"></script>
@endsection
