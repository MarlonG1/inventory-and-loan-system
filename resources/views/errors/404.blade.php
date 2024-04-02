@extends('layouts.master')
@section('title', 'Error 404')

@section('content')
<div class=" container-fluid error-wrapper px-0">
    <div class="error-container">
        <div class="error">
            <div class="error-title">
                Error
            </div>
            <div class="error-number">
                404
            </div>
            <div class="error-description">
                Esta página no existe. <a href="/"> Regresar al inicio.</a>
            </div>
        </div>
    </div>
</div>
@endsection
