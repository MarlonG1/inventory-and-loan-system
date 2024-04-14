@extends('layouts.session')
@section('title', 'Inicio de sesión')

@section('content')
    <form method="post" action="{{route('login')}}" enctype="multipart/form-data">
        @csrf
        <div class="d-flex justify-content-center pb-5">
            <h3 class="mr-3"><strong>Portal de prestamos</strong></h3>
            <img src="/img/logo-transparente.png" width="40px" height="40px" alt="">
        </div>
        <h2 class="text-center">Bienvenido! 👋</h2>
        <div class="form-group pb-3"><input class="form-control" required name="email" type="email"
                                            placeholder="Correo electrónico">
        </div>
        <div class="form-group"><input class="form-control" required name="password" type="password" placeholder="Contraseña">
        </div>
        <div class="form-group pb-2">
            <div class="d-flex justify-content-between">
                <div class="form-check"><input class="form-check-input" type="checkbox" value=""
                                               id="flexCheckDefault"> <label class="form-check-label"
                                                                             for="flexCheckDefault">
                        Mantener sesión </label></div>
                <div><a href="#" class=" color-secundario ">Olvide la contraseña</a></div>
            </div>
        </div>
        <div class="form-group">
            <button class="btn btn-block btn-primario text-white" type="submit">Iniciar
                sesión
            </button>
        </div>
        <p class="text-center">¿No tienes cuenta aun? crea una <a href="{{route('registro')}}" class="color-secundario ">ahora
                mismo</a>!</p>

        <div class="d-flex align-items-center">
            <hr class="w-25" style="border-top: 3px solid rgba(0, 0, 0, .1);">
            <p class="m-0 font-weight-normal">O continua con</p>
            <hr class="w-25" style="border-top: 3px solid rgba(0, 0, 0, .1);">
        </div>
        <div class="text-center pt-2">
            <a href="/google-redirect/redirect" class="btn btn-sesiones ampliar">
                <img width="20px" src="https://www.svgrepo.com/show/475656/google-color.svg" loading="lazy" alt="google logo">
            </a>
        </div>
    </form>
@endsection
