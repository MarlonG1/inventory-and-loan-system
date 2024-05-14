@extends('layouts.master')
@section('title', 'POS')

@section('content')
    <div class="pos-container container my-5">
        <div class="sellables-container">
            <div class="sellables">
                <div class="d-flex justify-content-center align-items-center">
                    <p class="m-0">Categorias: </p>
                    <div class="d-flex categories justify-content-center">
                        <select id="categories-select" class="selectpicker">
                        </select>
                    </div>
                </div>


                <div class="item-group-wrapper">
                    <div class="item-group d-flex justify-content-center equipos">
                        <a style="display: none" href="#" class="item px-2 pt-2 equipo-template">
                            <span class="badge">Informacion</span>
                            <img src=""
                                 alt="" width="100%" height="85%">
                        </a>
                    </div>
                </div>
            </div>

            <div class="register-wrapper">
                <div class="register">
                    <div class="products my-auto" style="width: 100%">
                        <h4 class="text-center py-2">Formulario de prestamo</h4>
                        <div class="col-sm-12 pt-4 px-3 ">
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
                                <small class="form-text text-muted">Carrera</small>
                                <select name="carreraId" id="carreraId"
                                        class="selectpicker input_textual form-control"
                                        data-live-search="true">
                                    <option value="" selected disabled>Seleccione la carrera
                                    </option>
                                    @foreach($carreras as $carrera)
                                        <option
                                            value="{{$carrera->id}}">{{$carrera->nombre}}
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
                            <div class="pay-button pt-4">
                                <input id="enviarForm" required type="submit"
                                       class="btn btn-block btn-primario-claro ampliar text-white"
                                       value="Realizar prestamo"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection
        @section('scripts')
            <script>const equiposMap = @json($cantidadPorMarca);</script>
            <script src="{{asset('js/pos.js')}}"></script>
@endsection
