document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('prestamoForm').addEventListener('submit', async function (e) {
        e.preventDefault();

        let formData = new FormData(this);
        formData.set('motivo', tinymce.get('motivo').getContent());
        formData.set('estado', 'Activo');

        const equipos = document.querySelectorAll('select.equipo');
        await CompositeProcesses.createNewPrestamo(formData, equipos);
    });
});

tinymce.init({
    selector: 'textarea',
    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount linkchecker',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
    height: 250
});
