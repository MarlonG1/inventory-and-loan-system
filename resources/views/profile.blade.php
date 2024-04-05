@extends('layouts.master')
@section('title', 'Perfil')

@section('content')
    <div class="container bg-white my-xl-5 shadow-lg border-5" style="border-radius:30px">
        <div class="main-body py-5 ">
            <div class="row gutters-sm">
                <div class="col-md-1"></div>
                <div class="col-md-3 my-auto">
                    <div class="card">
                        <div class="card-body shadow-sm">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img id="foto-perfil" src="" alt="Admin" class="rounded-circle" width="150">
                                <div class="mt-3">
                                    <h4 id="nombre">John Doe</h4>
                                    <p id="tipo" class="text-secondary m-0">
                                        Docente
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 my-auto">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <h6 class="mb-0">Nombre completo</h6>
                                </div>
                                <p id='nombreCompleto' class=" text-secondary m-0">
                                    Usuario
                                </p>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-4">
                                    <h6 class="mb-0">Correo</h6>
                                </div>
                                <p id=correo class=" text-secondary m-0">
                                    usuario@ejemplo.com
                                </p>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-4">
                                    <h6 class="mb-0">Fecha de nacimiento</h6>
                                </div>
                                <p id='fechaDeRegistro' class=" text-secondary m-0">
                                    2024/01/01
                                </p>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-4">
                                    <h6 class="mb-0">Teléfono</h6>
                                </div>
                                <p id='telefono' class=" text-secondary m-0">
                                    0000-0000
                                </p>
                            </div>
                            <hr>
                            <div class="row text-center">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Carnet</h6>
                                </div>
                                <p id='carnet' class="col-sm-3 text-secondary m-0">
                                    0000-AA-000
                                </p>
                                <div class="col-sm-3">
                                    <h6 class="mb-0">DUI</h6>
                                </div>
                                <p id='dui' class=" text-secondary m-0">
                                    00000000-0
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", async function () {
            const response = await fetch('api/v1/users', {
                method: "GET",
            });

            if (response.ok) {
                const data = await response.json();
                console.log(data);
            } else {
                console.log("Error al cargar los datos del usuario")
            }
        });
    </script>
@endsection
