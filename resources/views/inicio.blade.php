@extends('layouts.master')
@section('title', 'Inicio')

@section('content')
    <div class="container-fluid p-0">
        <img src="/img/banner1.png" class="img-fluid" alt="Banner">
    </div>
@endsection
@section('scripts')
    @if(isset($token))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const token = "{{$token}}";
                setAuthToken(token);
            });
        </script>
    @endif
@endsection
