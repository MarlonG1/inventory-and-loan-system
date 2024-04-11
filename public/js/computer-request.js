document.addEventListener('DOMContentLoaded', function () {


    document.getElementById('prestamoForm').addEventListener('submit', async function (e) {
        e.preventDefault();

        let formData = new FormData(this);
        formData.set('motivo', tinymce.get('motivo').getContent());
        formData.set('estado', 'Activo');
        const data = formDataToJSON(formData);

        const response = await fetch('/api/v1/prestamos', {
            method: 'POST',
            body: data,
            headers: {
                'Accept': 'application/json',
                'Content-Type': "application/json",
            },
        });

        if (response.ok){
            const dataPrestamo = await response.json();
            // console.log(dataPrestamo.data.id);
            await assingEquiposToPrestamo(dataPrestamo.data.id);

        }
    });
});


async function assingEquiposToPrestamo(idPrestamo) {
    const equipoCount = localStorage.getItem('equipos');

    for (let i = 1; i <= equipoCount; i++) {
        let idEquipo = document.getElementById(`equipo${i}`).value;
        await setEquipoToPrestamo(idEquipo, idPrestamo)
    }
}

async function setEquipoToPrestamo(idEquipo, idPrestamo) {

    let formData = new FormData();
    formData.set('prestamoId', idPrestamo);
    formData.set('estado', 'Ocupado');
    const data = formDataToJSON(formData);

    console.log(
      idEquipo + '/' + formData.get('prestamoId') + '-' + formData.get('estado')
    );

    const response = await fetch(`/api/v1/equipos/${idEquipo}`, {
        method: 'PATCH',
        body: data,
        headers: {
            'Accept': 'application/json',
            'Content-Type': "application/json",
        },
    });

    if (!response.ok) {
        console.log('error al setear el equipo al equipo')
    } else {
        console.log(await response.json());
    }
}

function formDataToJSON(formData) {
    const obj = {};
    for (const [key, value] of formData.entries()) {
        obj[key] = value;
    }

    console.log(JSON.stringify(obj));
    return JSON.stringify(obj);
}


tinymce.init({
    selector: 'textarea',
    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount linkchecker',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
    height: 250
});
