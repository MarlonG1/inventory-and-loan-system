@extends('layouts.master')
@section('title', 'Registro de usuarios')

@section('content')
    <div class="container-fluid py-5">
        <div>
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-sm-5 col-12 d-flex align-items-center justify-content-center">
                                    <h4 class="title text-center">Registro de usuarios</h4>
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
                                                class="btn btn-default ampliar open-newUser-modal"
                                                data-toggle="modal" data-target="#newUser">
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
                                                                   class="d-flex align-items-center text-black justify-content-center">Carrera
                                                        <i class="fa-solid fa-sort pl-2"></i></a>
                                                </th>
                                                <th scope="col" class="text-center">Acciones</th>
                                            </tr>
                                            </thead>
                                            <tbody class="customtable">
                                            <tr class="row-template" style="display: none;">
                                                <td class="id"></td>
                                                <td class="completeName"></td>
                                                <td class="type"></td>
                                                <td class="career"></td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <button type="button"
                                                                class="btn btn-registro btn-info py-2 mr-1 ampliar open-edit-modal"
                                                                data-toggle="modal" data-target="#edit">
                                                            <i class="fa-solid fa-pencil"></i>
                                                        </button>
                                                        <button type="button"
                                                                class="btn btn-registro btn-success py-2 mr-1 ampliar open-changePhoto-modal"
                                                                data-toggle="modal" data-target="#changePhoto">
                                                            <i class="fa-solid fa-image"></i>
                                                        </button>
                                                        <button type="button"
                                                                class="btn btn-registro btn-details py-2 mr-1 ampliar open-changePassword-modal"
                                                                data-toggle="modal" data-target="#changePassword">
                                                            <i class="fa-solid fa-key"></i>
                                                        </button>
                                                        <button type="button"
                                                                class="btn btn-danger btn-registro py-2 mr-1 ampliar open-delete-modal"
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
                                                <th scope="col">Carrera</th>
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form id="changePasswordForm" method="POST">
        <div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="changePasswordTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="changePasswordTitle">Cambiar contraseña
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="changePasswordBody">
                        <div class="form-group" style="display:none;">
                            <input type="text" name="id" class="form-control text-center" style="display: none;"/>
                        </div>
                        <div class="form-group">
                            <small class="form-text text-muted">Nueva contraseña</small>
                            <input type="password" autocomplete="off" placeholder="Ingrese la nueva contraseña"
                                   name="password" class="form-control text-center"/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Guardar cambios</button>
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
                        <h5 class="modal-title text-center" id="changePhotoTitle">Cambiar foto de perfil
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
                            <small class="form-text text-center text-muted">Foto de perfil actual</small>
                            <div class="d-flex justify-content-center py-2">
                                <img id="profile-photo" src="" alt="profile_photo" class="rounded-circle" width="150">
                            </div>
                        </div>
                        <div class="form-group">
                            <small class="form-text text-muted">Nueva foto de perfil</small>
                            <input class="form-control" required name="image" type="file">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Guardar cambios</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form id="editForm" method="POST">
        <div id="edit" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
             aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="editTitle">Editar usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body  py-4" id="editBody">
                        <div class="form-group" style="display:none;">
                            <input type="text" name="id" class="form-control text-center"/>
                        </div>
                        <div class="d-flex col-sm-12">
                            <div class="form-group px-0 pb-2 mr-2 col-sm-6">
                                <small class="form-text text-muted">Nombre de usuario</small>
                                <input class="form-control" required
                                       name="name" type="text"
                                       placeholder="Nombre">
                            </div>
                            <div class="form-group px-0 pb-2 col-sm-6">
                                <small class="form-text text-muted">Apellido de usuario</small>
                                <input class="form-control" required
                                       name="lastname" type="text"
                                       placeholder="Apellido">
                            </div>
                        </div>
                        <div class="d-flex col-sm-12">
                            <div class="form-group px-0 pb-2 mr-2 col-sm-6">
                                <small class="form-text text-muted">Teléfono de usuario</small>
                                <input class="form-control" required
                                       name="phone" type="text"
                                       placeholder="Teléfono">
                            </div>
                            <div class="form-group pb-2 col-sm-6 px-0">
                                <small class="form-text text-muted">Fecha de nacimiento</small>
                                <input class="form-control" required
                                       name="birthDate" type="date">
                            </div>
                        </div>
                        <div class="d-flex col-sm-12">
                            <div class="form-group pb-2 mr-2 col-sm-6 px-0">
                                <small class="form-text text-muted">Departamento de origen</small>
                                <select name="departamentoId" id="departamentoId"
                                        class="selectpicker input_textual form-control"
                                        data-live-search="true">
                                    <option value="" selected disabled>Departamento
                                    </option>
                                    @foreach($departamentos as $departamento)
                                        <option
                                            value="{{$departamento->id}}">{{$departamento->nombre}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group pb-2 col-sm-6 px-0">
                                <small class="form-text text-muted">Carnet de usuario</small>
                                <input class="form-control" required name="carnet" type="text"
                                       placeholder="Carnet">
                            </div>
                        </div>
                        <div class="d-flex col-sm-12">
                            <div class="d-flex flex-column col-sm-6 mr-2 px-0 pb-4">
                                <small class="form-text text-muted">Carrera del usuario</small>
                                <select name="carreraId" id="carreraId"
                                        class="selectpicker input_textual form-control"
                                        data-live-search="true">
                                    <option value="" selected disabled>Carrera
                                    </option>
                                    @foreach($carreras as $carrera)
                                        <option
                                            value="{{$carrera->id}}">{{$carrera->nombre}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-6 px-0">
                                <small class="form-text text-muted">Tipo </small>
                                <select required class="form-control" name="estado">
                                    <option>Estudiante</option>
                                    <option>Docente</option>
                                    <option>Administrador</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <small class="form-text text-muted">Correo del usuario</small>
                            <input class="form-control" required name="email" type="email"
                                   placeholder="Correo electrónico">
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

    <form id="newUserForm" method="POST" action="{{route('register-new-user')}}" enctype="multipart/form-data">
        @csrf
        <div id="newUser" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
             aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="newUserTitle">Nuevo usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body  py-4" id="newUserBody">
                        <div class="col-sm-12">
                            <div class="d-flex">
                                <div class="form-group col-sm-6 ">
                                    <small class="form-text text-muted">Nombre de usuario</small>
                                    <input class="form-control" required name="name"
                                                                             type="text"
                                                                             placeholder="Nombre">
                                </div>
                                <div class="form-group col-sm-6 ">
                                    <small class="form-text text-muted">Apellido de usuario</small>
                                    <input class="form-control" required
                                                                             name="lastname"
                                                                             type="text"
                                                                             placeholder="Apellido">
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="form-group  col-sm-6">
                                    <small class="form-text text-muted">Teléfono</small>
                                    <input class="form-control" required name="phone"
                                                                             type="text"
                                                                             placeholder="Teléfono">
                                </div>
                                <div class="form-group  col-sm-6">
                                    <small class="form-text text-muted">Fecha de cumpleaños</small>
                                    <input class="form-control" required
                                                                             name="birthDate"
                                                                             type="date">
                                </div>
                            </div>
                            <div class="d-flex col-sm-12 p-0">
                                <div class="form-group  col-sm-6">
                                    <small class="form-text text-muted">Departamento</small>
                                    <select name="departamentoId"
                                            class="selectpicker input_textual form-control"
                                            data-live-search="true">
                                        <option value="" selected disabled>Departamento
                                        </option>
                                        @foreach($departamentos as $departamento)
                                            <option
                                                value="{{$departamento->id}}">{{$departamento->nombre}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group  col-sm-6 ">
                                    <small class="form-text text-muted">Carnet</small>
                                    <input class="form-control" required name="carnet" type="text"
                                           placeholder="Carnet">
                                </div>
                            </div>
                            <div class="d-flex col-sm-12  px-0">
                                <div class="col-sm-6 ">
                                    <small class="form-text text-muted">Carrera</small>
                                    <select name="carreraId"
                                            class="selectpicker input_textual form-control"
                                            data-live-search="true">
                                        <option value="" selected disabled>Carrera
                                        </option>
                                        @foreach($carreras as $carrera)
                                            <option
                                                value="{{$carrera->id}}">{{$carrera->nombre}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6 ">
                                    <small class="form-text text-muted">Tipo de usuario</small>
                                    <select required class="form-control" name="type">
                                        <option>Estudiante</option>
                                        <option>Docente</option>
                                        <option>Administrador</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm- pt-2">
                                <div class="form-group px-0 ">
                                    <small class="form-text text-muted">Correo</small>
                                    <input class="form-control" required name="email"
                                                                         type="email"
                                                                         placeholder="Correo electrónico">
                                </div>
                                <div class="d-flex ">
                                    <div class="form-group col-sm-6 pl-0">
                                        <small class="form-text text-muted">Contraseña</small>
                                        <input class="form-control" type="password"
                                                                             required
                                                                             name="password"
                                                                             placeholder="Contraseña">
                                    </div>
                                    <div class="form-group  col-sm-6 pr-0">
                                        <small class="form-text text-muted">Repetir contraseña</small>
                                        <input class="form-control" type="password" required
                                                                        name="password_confirmation"
                                                                        placeholder="Repetir contraseña">
                                    </div>
                                </div>
                                <div class="form-group pb-2">
                                    <p class="text-center mb-2">Foto de perfil</p>
                                    <input class="form-control" required name="image" type="file">
                                </div>
                            </div>
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
<script src="{{asset('js/users-records.js')}}"></script>
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if(session('success'))
            Alerts.showToastAlert({icon: 'success', title: '¡Éxito!', text: '{{ session('success') }}'});
            @elseif(session('error'))
            Alerts.showToastAlert({icon: 'error', title: '¡Error!', text: '{{ session('error') }}'});
            @endif
        });
    </script>
@endsection
