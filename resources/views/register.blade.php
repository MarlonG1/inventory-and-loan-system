@extends('layouts.session')
@section('title', 'Registro')

@section('content')
    <form method="post">
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
        <div class="form-group pb-2"><input class="form-control" required name="password" placeholder="Contraseña">
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
