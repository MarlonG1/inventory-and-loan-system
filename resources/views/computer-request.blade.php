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
                <form method="POST" id="prestamoForm" action="">
                    <div class="tab-content">
                        <div class="tab-pane fade show active">
                            <h3 class="formulario-heading">Registro de prestamo</h3>
                            <div class="row formulario-form">
                                <div class="col-12">
                                    <hr class="pb-3">
                                    <div class="d-flex">
                                        <div class="form-group col-6 pl-0">
                                            <small class="form-text text-muted">Nombre del solicitante</small>
                                            <select name="solicitante" id="solicitante"
                                                    class="selectpicker input_textual form-control"
                                                    data-live-search="true">
                                                <option value="">Seleccione el usuario</option>
                                                @foreach($usuarios as $user)
                                                    <option value="{{$user->id}}">{{$user->name}} {{$user->lastname}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-6 pr-0">
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
                                        </div>
                                    </div>
                                    <div id="equipos-container" style="display: none;"></div>
                                    <div>
                                        <small class=" form-text text-muted">Motivo de la solicitud</small>
                                        <textarea id="motivoText" name="motivoText"
                                                  placeholder="Ingrese el motivo de la solicitud" value=""></textarea>
                                    </div>
                                    <div class="form-group">
                                        <small class="form-text text-muted">Asignatura</small>
                                        <input required autocomplete="off" type="text" name="asignatura"
                                               class="form-control" placeholder="Ingrese la asignatura" value=""/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <small class="form-text text-muted">Tipo de solicitante</small>
                                        <select required class="form-control" name="tipo">
                                            <option class="hidden" selected disabled>Seleccione el tipo de solicitante
                                            </option>
                                            <option>Estudiante</option>
                                            <option>Docente</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <small class="form-text text-muted">Hora de recibido</small>
                                        <input required type="time" name="horaRecibido" class="form-control"
                                               placeholder="Ingrese la hora de recibido" value=""/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <small class="form-text text-muted">Fecha de solicitud</small>
                                        <input required type="date" name="fecha" class="form-control" value=""/>
                                    </div>

                                    <div class="form-group">
                                        <small class="form-text text-muted">Hora de entrega</small>
                                        <input required type="time" minlength="10" maxlength="10" name="horaEntrega"
                                               class="form-control" placeholder="Ingrese la hora de entrega" value=""/>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <input required type="submit"
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

        document.getElementById('agregarEquipos').addEventListener('click', function (e) {
            e.preventDefault();
            const cantidad = document.getElementById('cantidad').value;
            localStorage.setItem('equipos', cantidad);
            const container = document.getElementById('equipos-container');
            $(container).slideUp(200);
            container.innerHTML = '';
            let equipoHTML = '';

            for (let i = 1; i <= cantidad; i++) {
                let camposDobles = i % 2 !== 0
                equipoHTML += `
                ${camposDobles ? '<div class="d-flex">' : ''}
                <div class="form-group ${(i + 1) > cantidad && camposDobles ? 'col-sm-12' : 'col-sm-6'}">
                    <small class="form-text text-muted">Equipo #${i}</small>
                    <select name="equipo${i}" id="equipo${i}" class=" input_textual form-control" data-live-search="true">
                        <option value="" selected disabled>Seleccione el equipo</option>
                        @foreach($equipos as $equipo)
                <option value="{{$equipo->id}}">{{$equipo->marca . ' ' . $equipo->modelo}} ({{$equipo->identificador}})</option>
                        @endforeach
                </select>
            </div>
            ${!camposDobles ? '</div>' : ''}`;

                $(function () {
                    $(`select`).selectpicker();
                });
            }
            container.innerHTML += equipoHTML;
            $(container).slideDown("slow");
        });

        tinymce.init({
            selector: 'textarea',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount linkchecker',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            height: 250
        });

    </script>
    <script src="{{asset('js/computer-request.js')}}"></script>
@endsection
