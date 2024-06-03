@extends('layouts.master')
@section('title', 'POS')

@section('content')
    <div class="pos-container container my-5">
        <div class="sellables-container mb-3">
            <div class="sellables">
                <div class="mx-4">
                    <div class="d-flex justify-content-center categories">
                        <a href="#" class="btn btn-primario text-white category-template mr-2" style="display: none">Marca</a>
                    </div>
                </div>


                <div class="item-group-wrapper">
                    <div class="item-group d-flex justify-content-center equipos">
                        <a style="display: none" href="#" class="item px-2 pt-2 equipo-template">
                            <span class="badge-equipo text-center ">Informacion</span>
                            <img class="equipo" src=""
                                 alt="Imagen" width="100%" height="75%">
                        </a>
                    </div>
                </div>
            </div>

            <div class="register-wrapper">
                <div class="register">
                    <div class="products my-auto pt-3 pb-4" style="width: 100%">
                        <div class="col-sm-12 pt-1 px-3 ">
                            <small class="form-text text-muted pb-1">Equipos seleccionados</small>
                            <div class="mx-auto pb-3" style="height: 130px; overflow-y: auto">
                                <table class="tabla-reporte" width="100%" style="border: 0">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-center">Equipo</th>
                                        <th><i class="fa-solid fa-x"></i></th>
                                    </tr>
                                    </thead>
                                    <tbody class="report-tbody">
                                    <tr class="row-template" style="display: none;">
                                        <td class="count"></td>
                                        <td class="equipo text-center"></td>
                                        <td class="action"></td>
                                    </tr>
                                    <tr class="no-results" style="display: none;">
                                        <td colspan="3" class="text-center">No hay equipos asignados...</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <form id="prestamoForm" action="">
                            <div class="form-group">
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
                                <small class="form-text text-muted">Fecha de solicitud</small>
                                <input required type="date" name="fechaPrestamo" class="form-control" value=""/>
                            </div>
                            <div class=" d-flex">
                                <div class="form-group col-sm-6">
                                    <small class="form-text text-muted">Hora de recibido</small>
                                    <input required type="time" name="horaInicio" class="form-control"
                                           placeholder="Ingrese la hora de recibido" value=""/>
                                </div>
                                <div class="form-group col-sm-6">
                                    <small class="form-text text-muted">Hora de entrega</small>
                                    <input required type="time" minlength="10" maxlength="10" name="horaFin"
                                           class="form-control" placeholder="Ingrese la hora de entrega" value=""/>
                                </div>
                            </div>
                            <div class="pay-button pt-2">
                                <input id="enviarForm" required type="submit"
                                       class="btn btn-block btn-primario-claro ampliar text-white"
                                       value="Realizar prestamo"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
                            <input type="text" id="id" class="form-control text-center"/>
                        </div>
                        <p class="text-center">¿Está seguro que desea eliminarlo?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>

        @endsection
        @section('scripts')
            <script>const equiposMap = @json($cantidadPorMarca);</script>
            <script src="{{asset('js/pos.js')}}"></script>
@endsection
