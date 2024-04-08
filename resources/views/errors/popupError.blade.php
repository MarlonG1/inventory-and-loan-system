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
