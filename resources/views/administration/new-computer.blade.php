@extends('layouts.master')
@section('title', 'Nuevo equipo')

@section('content')
    <div class="container py-3 h-100 table-responsive">
        <div class="row h-100 ">
            <div class="col col-xl-12">
                <div class="card shadow" style="border-radius: 1rem;">
                    <div class="row g-0">
                        <div class="col-md-4 col-lg-4 d-none d-md-block pr-0" style="height: 100%;">
                            <img src="./img/nuevo-equipo.png" alt="login form" class="img-fluid"
                                 style="border-radius: 1rem 0 0 1rem; height: 100%;"/>
                        </div>
                        <div class="col-md-8 col-lg-8 d-flex align-items-center pl-0">
                            <div class="card-body pt-lg-5 text-black">

                                <form method="POST" id="registroForm" style="height: 100%;">
                                    <div class="tab-content d-flex">
                                        <div class="tab-pane fade show active col-sm-12">
                                            <h3 class="text-center">Formulario</h3>
                                            <hr>
                                            <div class="row formulario-form  d-flex justify-content-center">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <small class="form-text text-muted">Marca del equipo</small>
                                                        <select required class="form-control" name="marca">
                                                            <option class="hidden" selected disabled>Seleccione la marca
                                                                del equipo
                                                            </option>
                                                            <option>HP</option>
                                                            <option>Lenovo</option>
                                                            <option>Apple</option>
                                                            <option>Razer</option>
                                                            <option>Dell</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <small class="form-text text-muted">Modelo</small>
                                                        <input required autocomplete="off" type="text" name="modelo"
                                                               class="form-control"
                                                               placeholder="Ingrese el modelo del equipo"
                                                               value=""/>
                                                    </div>
                                                    <div class="form-group">
                                                        <small class="form-text text-muted">Identificador</small>
                                                        <input required type="text" class="form-control"
                                                               name="identificador"
                                                               placeholder="Ingrese el identificador del equipo"
                                                               value=""/>
                                                    </div>
                                                    <div class="d-flex">
                                                        <div class="form-group col-sm-6 pl-0">
                                                            <small class="form-text text-muted">Unidad</small>
                                                            <input required type="text" name="unidad"
                                                                   class="form-control"
                                                                   placeholder="Ingrese la unidad del equipo" value=""/>
                                                        </div>
                                                        <div class="form-group col-sm-6 pr-0">
                                                            <small class="form-text text-muted">Estado</small>
                                                            <select required class="form-control" name="estado">
                                                                <option class="hidden" selected disabled>Seleccione el
                                                                    estado del equipo
                                                                </option>
                                                                <option>Disponible</option>
                                                                <option>En reparación</option>
                                                                <option>Ocupado</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-group">
                                                        <small class="form-text text-muted">Foto del equipo</small>
                                                        <input required type="file" name="imagen"/>
                                                    </div>
                                                    <div class="form-group form-group">
                                                        <small class="form-text text-muted">Observaciones</small>
                                                        <textarea name="observaciones" id="observaciones"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pt-1 mb-3 d-flex justify-content-center">
                                        <button class="btn btn-lg text-white btn-primario" type="submit">Registrar
                                            equipo
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'anchor ',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            height: 280,
        });
    </script>
    <script src="{{ asset('js/register-computer.js') }}"></script>
@endsection
