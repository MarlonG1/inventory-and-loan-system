@extends('layouts.master')
@section('title', 'Solicitud de equipo')

@section('content')
    <div class="container formulario my-4 shadow" style="border-radius:1rem;">
        <div class="row">
            <div class="col-md-3 formulario-left my-auto">
                <img src="./img/logo-transparente.png" class="ampliar" alt=""/>
                <p>Se le solicita pedirle cordialmente al solicitante, entregar los equipos en el mismo estado con el
                    que se
                    les presto.</p>
            </div>
            <div class="col-md-9 formulario-right">
                <form id="prestamoForm" action="">
                    <div class="tab-content">
                        <div class="tab-pane fade show active">
                            <h3 class="formulario-heading">Registro de prestamo</h3>
                            <div class="row formulario-form">
                                <div class="col-12">
                                    <hr class="pb-3">
                                    <div class="d-flex">
                                        <div class="form-group col-6 pl-0">
                                            <small class="form-text text-muted">Nombre del solicitante</small>
                                            @auth
                                                @if(auth()->user()->type === 'Administrador')
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
                                                @else
                                                    <input name="userId" id="userId" style="display: none;"
                                                           value="{{auth()->user()->id}}"/>
                                                    <p style="color: #6c757d !important;">{{auth()->user()->name}} {{auth()->user()->lastname}}
                                                    </p>
                                                @endif
                                            @endauth

                                        </div>
                                        <div class="form-group col-6 pr-0">
                                            @auth
                                                @if(auth()->user()->type !== 'Estudiante')
                                                    <small class="form-text text-muted">Cantidad de equipos</small>
                                                    <div class=" d-flex">
                                                        <input required autocomplete="off" type="number" name="cantidad"
                                                               id="cantidad" class="form-control"
                                                               placeholder="Cantidad de equipos"
                                                               value=""/>
                                                        <a href="#" onclick="" id="agregarEquipos"
                                                           class="btn btn-primario-claro ampliar text-white"><i
                                                                class="fa-solid fa-check"></i></a>
                                                    </div>
                                                @else
                                                    <div class="form-group col-sm-12">
                                                        <small class="form-text text-muted">Equipo</small>
                                                        <select name="equipo1" id="equipo1"
                                                                class="equipo selectpicker input_textual form-control"
                                                                data-live-search="true">
                                                            <option value="" selected disabled>Seleccione el equipo
                                                            </option>
                                                            @foreach($inventarios as $equipo)
                                                                <option
                                                                    value="{{$equipo->id}}">{{$equipo->marca . ' ' . $equipo->modelo}}
                                                                    ({{$equipo->identificador}})
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                @endif
                                            @endauth
                                        </div>
                                    </div>
                                    <div id="equipos-container" style="display: none;"></div>
                                    <div>
                                        <small class=" form-text text-muted">Motivo de la solicitud</small>
                                        <textarea id="motivo" name="motivo"
                                                  placeholder="Ingrese el motivo de la solicitud" value=""></textarea>
                                    </div>
                                    <div class="form-group pt-2">
                                        <small class="form-text text-muted">Asignatura</small>
                                        <select name="asignaturaId" id="asignaturaId"
                                                class="selectpicker input_textual form-control"
                                                data-live-search="true">
                                            <option value="" selected disabled>Seleccione la asignatura
                                            </option>
                                            @foreach($asignaturas as $asignatura)
                                                @if($asignatura->carrera_id === auth()->user()->carrera_id)
                                                    <option
                                                        value="{{$asignatura->id}}">{{$asignatura->nombre}}
                                                    </option>
                                                @endif
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
                                        <input required type="date" name="fechaPrestamo" class="form-control" value=""/>
                                    </div>

                                    <div class="form-group">
                                        <small class="form-text text-muted">Hora de entrega</small>
                                        <input required type="time" minlength="10" maxlength="10" name="horaFin"
                                               class="form-control" placeholder="Ingrese la hora de entrega" value=""/>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <input id="enviarForm" required type="submit"
                                               class="btn btn-md btn-primario-claro ampliar text-white"
                                               value="Realizar prestamo"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        @if(auth()->user()->type !== 'Estudiante')

        document.getElementById('agregarEquipos').addEventListener('click', function (e) {
            e.preventDefault();
            const cantidad = document.getElementById('cantidad').value;
            localStorage.setItem('equipos', cantidad);
            const container = document.getElementById('equipos-container');
            $(container).slideUp(200);
            container.innerHTML = '';

            let equipoHTML = [];
            for (let i = 1; i <= cantidad; i++) {
                let camposDobles = i % 2 !== 0;
                let colClass = (i + 1) > cantidad && camposDobles ? 'col-sm-12' : 'col-sm-6';

                equipoHTML.push(`
                    ${camposDobles ? '<div class="d-flex">' : ''}
                        <div class="form-group ${colClass}">
                            <small class="form-text text-muted">Equipo #${i}</small>
                            <select name="equipo${i}" id="equipo${i}" class="equipo input_textual form-control" data-live-search="true">
                                <option value="" selected disabled>Seleccione el equipo</option>
                                @foreach($inventarios as $equipo)
                    <option value="{{$equipo->id}}">{{$equipo->marca . ' ' . $equipo->modelo}} ({{$equipo->identificador}})</option>
                                @endforeach
                    </select>
                </div>
${!camposDobles ? '</div>' : ''}`
                );

                $(function () {
                    $(`select`).selectpicker();
                });
            }
            equipoHTML = equipoHTML.join('');

            container.innerHTML = equipoHTML;
            $(container).slideDown("slow");
        });

        @else
        localStorage.setItem('equipos', 1);
        @endif
    </script>
    <script src="{{asset('js/computer-request.js')}}"></script>
@endsection
