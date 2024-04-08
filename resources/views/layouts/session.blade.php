<!doctype html>
<html lang="en">
<meta charset="UTF-8">
@include('partials.enlaces')
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title')</title>

<body>
<div class="container-fluid register-photo">
    <div class="form-container">
        <div class="image-holder"></div>
        @yield('content', 'login')
    </div>
</div>

@include('errors.popupError')
@yield('scripts')
<script>
    @if($errors->any())
    document.getElementById('error-popup-container').classList.remove('d-none');
    @endif

    document.querySelectorAll('[data-dismiss="alert"]').forEach(function (button) {
        button.addEventListener('click', function () {
            document.getElementById('error-popup-container').classList.add('d-none');
        });
    });
</script>
</body>
</html>
