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
                                        <a href="#" id="limpiarBusqueda" onclick="limpiarBusqueda();"
                                           style="display:none;"><i
                                                class="fa-solid fa-x text-white mr-1 ampliar"></i></a>
                                        <input type="text" class="form-control busqueda" placeholder="Buscar..." value>
                                        <button class="btn btn-default ampliar" title="Reload" onclick="refrescar()"><i
                                                class="fas fa-sync-alt"></i></button>
                                        <a target="_blank" href="./view/facturacion/rep_solicitud.php"
                                           class="btn btn-default ampliar" title="Pdf"><i
                                                class="fas fa-file-pdf"></i></a>
                                        <a href="./index.php?k=./view/solicitud-equipo" class="btn btn-default ampliar"
                                           title="Agregar"><i class="fa-solid fa-plus"></i></a>
                                    </div>
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
                                                    <a href="#" class="abrir-modal-cambiarEstado" data-toggle="modal"
                                                       data-target="#cambiarEstado">
                                                        <p
                                                            class="estado activo d-flex align-content-center justify-content-center">
                                                        </p>
                                                    </a>
                                                </td>
                                                <td class="administration">
                                                    <div class="d-flex justify-content-center">
                                                        <a href="{{route('pdf', ['prestamoId' => 2])}}" target="_blank"
                                                                class="btn btn-registro btn-info mr-1 ampliar">
                                                            <i class="fa-solid fa-file-pdf"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <button type="button"
                                                                class="btn btn-registro btn-info mr-1 ampliar abrir-modal-editar"
                                                                data-toggle="modal" data-target="#editar">
                                                            <i class="fa-solid fa-pencil"></i>
                                                        </button>
                                                        <button type="button"
                                                                class="btn btn-registro btn-details mr-1 ampliar abrir-modal-motivo"
                                                                data-toggle="modal" data-target="#motivo">
                                                            <i class="fa-solid fa-book"></i>
                                                        </button>
                                                        <button type="button"
                                                                class="btn btn-danger btn-registro mr-1 ampliar abrir-modal-eliminar"
                                                                data-toggle="modal" data-target="#eliminar">
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
@endsection
@section('scripts')
    <script src="{{asset('js/prestamos-records.js')}}"></script>
@endsection
