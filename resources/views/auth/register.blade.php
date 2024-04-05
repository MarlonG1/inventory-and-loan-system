@extends('layouts.session')
@section('title', 'Registro')

@section('content')
    <form method="post" action="{{route('registro')}}" enctype="multipart/form-data">
        @csrf
        <div class="d-flex justify-content-center pb-2">
            <h3 class="mr-3"><strong>Portal de prestamos</strong></h3>
            <img src="img/logo-transparente.png" width="40px" height="40px" alt="">
        </div>
        <h2 class="text-center">Formulario de registro</h2>
        <div class="d-flex">
            <div class="form-group pb-2 mr-4"><input class="form-control" required name="name" type="text"
                                                     placeholder="Nombre">
            </div>
            <div class="form-group pb-2"><input class="form-control" required name="lastname" type="text"
                                                placeholder="Apellido">
            </div>
        </div>
        <div class="d-flex">
            <div class="form-group pb-2 mr-4"><input class="form-control" required name="phone" type="text"
                                                     placeholder="Teléfono">
            </div>
            <div class="form-group pb-2"><input class="form-control" required name="birthDate" type="date">
            </div>
        </div>
        <div class="d-flex">
            <div class="form-group pb-2 mr-4"><input class="form-control" required name="dui" type="text"
                                                     placeholder="DUI">
            </div>
            <div class="form-group pb-2"><input class="form-control" required name="carnet" type="text"
                                                placeholder="Carnet">
            </div>
        </div>
        <div class="form-group pb-2"><input class="form-control" required name="email" type="email"
                                            placeholder="Correo electrónico">
        </div>
        <div class="d-flex pb-2">
            <div class="form-group pl-0 mr-4"><input class="form-control" type="password" required name="password"
                                                     placeholder="Contraseña">
            </div>
            <div class="form-group pr-0"><input class="form-control" type="password" required
                                                name="password_confirmation" placeholder="Repetir contraseña">
            </div>
        </div>
        <div class="form-group pb-2">
            <p class="text-center mb-2">Foto de perfil</p>
            <input class="form-control" required name="image" type="file">
        </div>
        <div class="form-group">
            <button class="btn btn-block btn-primario text-white" type="submit">Registrarse
            </button>
        </div>
        <p class="text-center">¿Ya tienes una cuenta? <a href="{{route('login')}}" class="color-secundario ">Inicia
                sesión.</a></p>
    </form>
@endsection
@section('alerts')
    <div id="error-popup-container" class="overlay d-none">
        <div id="error-popup" class="alert alert-danger alert-dismissible fade show">
            <strong><i class="fa-solid fa-circle-exclamation"></i> Errores encontrados:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @if($errors->any())
            document.getElementById('error-popup-container').classList.remove('d-none');
            @endif
        });

        document.querySelectorAll('[data-dismiss="alert"]').forEach(function(button) {
            button.addEventListener('click', function() {
                document.getElementById('error-popup-container').classList.add('d-none');
            });
        });
    </script>
@endsection
