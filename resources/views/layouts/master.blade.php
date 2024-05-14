<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    @include('partials.enlaces')
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
</head>
<body onload="hideLoading()">
@include('partials.navbar')

<div class="content-loading">
    <div id="loading">
        <div id="loader"></div>
    </div>

    <div class="wrapper">
        @auth
            @if((auth()->user()->type === 'Administrador'))
                @include('administration.sidebar')
            @endif
        @endauth

        @yield('content', 'inicio')
    </div>
</div>

@if (request()->getRequestUri() === '/')
    @include('partials.carousel')
@endif

@include('partials.helpButton')
@include('partials.footer')
@yield('scripts')
@vite(['resources/js/app.js'])
<script src="{{asset('js/sidebar.js')}}"></script>
<script src="{{asset('js/miscellaneous.js')}}"></script>
<script>
    function hideLoading() {
        document.getElementById('loading').style.display = 'none';
    }
</script>
</body>
</html>
