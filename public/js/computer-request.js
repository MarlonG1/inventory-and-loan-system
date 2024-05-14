document.addEventListener('DOMContentLoaded', function () {


    document.getElementById('prestamoForm').addEventListener('submit', async function (e) {
        e.preventDefault();

        let formData = new FormData(this);
        formData.set('motivo', tinymce.get('motivo').getContent());
        formData.set('estado', 'Activo');

        const response = await fetch('/api/v1/prestamos', {
            method: 'POST',
            credentials: 'include',
            headers: {
                'Accept': 'application/json',
                'Content-Type': "application/json",
            },
            body: JSON.stringify(Object.fromEntries(formData)),
        });

        if (response.ok) {
            const dataPrestamo = await response.json();
            await assingEquiposToPrestamo(dataPrestamo.data.id);
            showAlert(dataPrestamo.data.id);
        }
    });
});


async function assingEquiposToPrestamo(idPrestamo) {
    const equipoCount = localStorage.getItem('equipos') === null ? 1 :  localStorage.getItem('equipos');

    for (let i = 1; i <= equipoCount; i++) {
        let idEquipo = document.getElementById(`equipo${i}`).value;
        await setEquipoToPrestamo(idEquipo, idPrestamo)
    }
}

async function setEquipoToPrestamo(idEquipo, idPrestamo) {

    let formData = new FormData();
    formData.set('prestamoId', idPrestamo);
    formData.set('estado', 'Ocupado');


    const response = await fetch(`/api/v1/equipos/${idEquipo}`, {
        method: 'PATCH',
        credentials: 'include',
        headers: {
            'Accept': 'application/json',
            'Content-Type': "application/json",
        },
        body: JSON.stringify(Object.fromEntries(formData)),
    });

    if (!response.ok) {
        console.log('error al setear el equipo al equipo')
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


async function sendInformationEmail(id) {
    const response = await fetch(`/send/informationEmail/${id}`, {
        method: 'GET',
        credentials: 'include',
        headers: {
            'Accept': 'application/json'
        }
    });

    return await response.json();
}

tinymce.init({
    selector: 'textarea',
    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount linkchecker',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
    height: 250
});

function showAlert(id) {
    Swal.fire({
        title: 'Cargando...',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
            sendInformationEmail(id)
                .then(data => {
                    Swal.close();
                    Swal.fire({
                        icon: data.icon,
                        title: data.title,
                        text: data.text,
                    });
                })
                .catch(error => {
                    Swal.close();
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Algo salio mal',
                    });
                });
        }
    });
}
