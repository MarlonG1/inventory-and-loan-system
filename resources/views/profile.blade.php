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
                                <img id="profile-photo" src="" alt="profile_photo" class="rounded-circle" width="150">
                                <div class="mt-3">
                                    <h4 id="name"></h4>
                                    <p id="type" class="text-secondary m-0"></p>
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
                                <p id='completeName' class=" text-secondary m-0"></p>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-4">
                                    <h6 class="mb-0">Correo</h6>
                                </div>
                                <p id=email class=" text-secondary m-0"></p>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-4">
                                    <h6 class="mb-0">Fecha de nacimiento</h6>
                                </div>
                                <p id='birthDate' class=" text-secondary m-0"></p>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-4">
                                    <h6 class="mb-0">Teléfono</h6>
                                </div>
                                <p id='phone' class=" text-secondary m-0"></p>
                            </div>
                            <hr>
                            <div class="row text-center">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Carnet</h6>
                                </div>
                                <p id='carnet' class="col-sm-3 text-secondary m-0"></p>
                                <div class="col-sm-3">
                                    <h6 class="mb-0">DUI</h6>
                                </div>
                                <p id='dui' class=" text-secondary m-0"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const userId =  {{auth()->user()->id}};

        document.addEventListener("DOMContentLoaded", async function () {
            const response = await fetch('api/v1/users/' + userId, {
                method: "GET",
            });

            if (response.ok) {
                const user = await response.json();
                console.log(user.data);
                setUserValues(user.data)
            } else {
                console.log("Error al cargar los datos del usuario")
            }

            function setUserValues(data){
                const valueMapping = [
                    'name',
                    'type',
                    'email',
                    'birthDate',
                    'phone',
                    'carnet',
                    'dui'
                ]

                document.getElementById('completeName').textContent = data.name + ' ' + data.lastname;
                document.getElementById('profile-photo').src = 'img/profile-photos/' + data.image;
                valueMapping.forEach((value) => {
                    document.getElementById(value).textContent = data[value];
                });
            }


        });
    </script>
@endsection
