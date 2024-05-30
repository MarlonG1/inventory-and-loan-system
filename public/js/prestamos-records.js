let currentPage = 0;

document.addEventListener('DOMContentLoaded', async function () {
    await getPrestamosFromAPI(1);

    document.getElementById('entradasPorPagina').addEventListener('change', async function () {
        const entriesPerPage = this.value;
        localStorage.setItem('entriesPerPage', entriesPerPage);
        await getPrestamosFromAPI(1);
    });


    try {
        const elementoDePaginacion = document.querySelector(".pagination");

        elementoDePaginacion.addEventListener("click", async function (event) {
            if (event.target.tagName === "A") {
                event.preventDefault();

                const nuevaPagina = parseInt(event.target.getAttribute("data-page"));
                await getPrestamosFromAPI(nuevaPagina);
                currentPage = nuevaPagina;
            }
        });
    } catch (error) {
        console.error("Error al cargar datos:", error);
    }

    try {
        const inputBusqueda = document.querySelector(".busqueda");

        inputBusqueda.addEventListener("input", async function () {
            const searchTerm = inputBusqueda.value.trim();
            const searchInfo = document.getElementById('searchInfo');
            const entriesPerPageContainer = document.getElementById('entriesPerPageContainer');

            if (inputBusqueda.value.length > 0) {
                entriesPerPageContainer.style.display='none';
                searchInfo.style.display = '';
                document.getElementById("limpiarBusqueda").style.display = "";
            } else {
                entriesPerPageContainer.style.display='';
                searchInfo.style.display = 'none';
                document.getElementById("limpiarBusqueda").style.display = "none"
            }

            await getPrestamosFromAPI(currentPage, searchTerm);
        });

        await getPrestamosFromAPI(1);
    } catch (error) {
        console.error("Error al cargar datos:", error);
    }
});

async function getPrestamosFromAPI(page, searchTerm = '') {
    const entriesPerPage = document.getElementById('entradasPorPagina').value = localStorage.getItem('entriesPerPage') === null ? 5 : localStorage.getItem('entriesPerPage');

    if (page === null) {
        return;
    }

    const filters = `include=carrera,asignatura,user,equipos&page=${page}&searchTerm=${searchTerm}&entriesPerPage=${entriesPerPage}`;
    try {
        const response = await PrestamoAPI.getPrestamos(filters);
        const entriesPerPageContainer = document.getElementById('entriesPerPageContainer');
        const searchInfo = document.getElementById('searchInfo');


        if (searchTerm === '') {
            document.querySelector('.pagination').innerHTML = setPagination(response);
            setEntriesPerPage(response.meta.total);

        } else {
            document.querySelector('.pagination').innerHTML = "Se muestran todos los resultados en una sola página."
            document.getElementById("indiceDePaginas").innerHTML = "Total de resultados: " + response.count;
            searchInfo.innerHTML = `Resultados de la búsqueda: <b>${response.count}</b>`;
        }

        setTablePrestamos(response);
    } catch (error) {
        console.error("Error al cargar datos:", error);
    }
}

function setTablePrestamos(datadb) {
    cleanTable();
    datadb.data.forEach((prestamo, index) => {
        newRow(prestamo);
    });

    setHeaderInfo(datadb.otherInformation);
}

function setEntriesPerPage(total) {
    const entriesPerPageElement = document.getElementById('entradasPorPagina');
    entriesPerPageElement.innerHTML = '';
    const options = [5, 10, 25, 50, 100];

    if (total === 0) {
        entriesPerPageElement.innerHTML = '<option value="0">0</option>';
        return;
    }

    options.forEach(option => {
        if (option <= total) {
            entriesPerPageElement.innerHTML += `<option value="${option}">${option}</option>`;
        }
    });

    const storageValue = localStorage.getItem("entriesPerPage");

    if (storageValue && options.includes(parseInt(storageValue))) {
        entriesPerPageElement.value = storageValue;
    }
}

function setHeaderInfo(totales) {
    document.getElementById("cantidadDeRegistros").innerHTML =
        `<a href="#" id="totalActivos" class="px-3 m-0 activo" style="border-radius:10px 0px 0px 10px;"><i class="fa-solid fa-circle fa-2xs"></i> Activos ${totales.totalDeActivos}</a>` +
        `<a href="#" id="totalPendientes" class="px-3 m-0 pendiente"><i class="fa-solid fa-circle fa-2xs"></i> Pendientes ${totales.totalDePendientes}</a>` +
        `<a href="#" id="totalFinalizados" class="px-3 m-0 finalizado" style="border-radius:0px 10px 10px 0px;"><i class="fa-solid fa-circle fa-2xs"></i> Finalizados ${totales.totalDeFinalizados}</a>`;
}

function newRow(prestamo) {
    const row = document.querySelector(".row-template").cloneNode(true);
    const tbody = document.querySelector('.customtable');

    row.classList.remove('row-template')
    row.style.display = '';

    const valueMapping = {
        '.id': 'id',
    }

    Object.entries(valueMapping).forEach(([selector, property]) => {
        row.querySelector(selector).textContent = prestamo[property];
    });


    const date = prestamo.fecha_prestamo.split("-").reverse().join("/");
    const startTime = prestamo.hora_inicio.slice(0, -3);
    const endTime = prestamo.hora_fin.slice(0, -3);
    const estadoElement = row.querySelector(".estado");

    estadoElement.innerHTML = '<i class="fa-solid fa-circle fa-2xs my-auto mr-1"></i>' + prestamo.estado;
    estadoElement.classList.remove("activo", "finalizado", "pendiente");
    estadoElement.classList.add(prestamo.estado.toLowerCase());

    row.querySelector('.report').href = `/pdf/${prestamo.id}`
    row.querySelector('.completeName').innerText = `${prestamo.user.name} ${prestamo.user.lastname}`;
    row.querySelector('.course').innerText = `${prestamo.asignatura.nombre}`;
    row.querySelector('.type').innerText = prestamo.user.type;
    row.querySelector(".requestDate").textContent = date;
    row.querySelector(".time").textContent = `${startTime} - ${endTime}`;
    row.querySelector('.open-reason-modal').addEventListener("click", () => showReasonModal(prestamo.id, prestamo.motivo));
    row.querySelector('.open-chageStatus-modal').addEventListener("click", () => showChangeStatusModal(prestamo.id));
    row.querySelector('.open-delete-modal').addEventListener("click", () => showDeleteModal(prestamo.id));
    row.querySelector('.open-computers-modal').addEventListener("click", () => showComputersModal(prestamo));
    row.querySelector('.open-edit-modal').addEventListener("click", () => showEditModal(prestamo));

    tbody.appendChild(row);
}

function setPagination(data) {
    console.log(data)
    const {last_page, current_page} = data.meta;
    const entriesInfo = document.getElementById("indiceDePaginas");
    const entriesPerPage = data.count;
    const totalPages = data.meta.total;
    let paginacionHTML = "";
    let startPage = Math.max(1, current_page - 3);
    let endPage = Math.min(last_page, current_page + 3);

    entriesInfo.innerHTML = `Mostrando <b>${entriesPerPage}</b> entradas de <b>${totalPages}</b> salidas`;

    paginacionHTML += `<li class="page-item"><a class="page-link" href="#" data-page="1">&lt;&lt;</a></li>`;
    paginacionHTML += `<li class="page-item"><a class="page-link" href="#" data-page="${current_page !== 1 ? current_page - 1 : 1}">&lt;</a></li>`;
    for (let i = startPage; i <= endPage; i++) {
        let label = i;
        paginacionHTML += `<li class="page-item ${i === current_page ? "active" : ""}"><a class="page-link" href="#" data-page="${label}">${label}</a></li>`;
    }
    paginacionHTML += `<li class="page-item"><a class="page-link" href="#" data-page="${current_page !== last_page ? current_page + 1 : last_page}">&gt;</a></li>`;
    paginacionHTML += `<li class="page-item"><a class="page-link" href="#" data-page="${last_page}">&gt;&gt;</a></li>`;

    return paginacionHTML;
}

function cleanTable() {
    const tbody = document.querySelector(".customtable");
    const filaMolde = document.querySelector(".row-template");
    const sinResultados = document.querySelector(".sin-resultados");

    Array.from(tbody.children).forEach((fila) => {
        if (fila !== filaMolde && fila !== sinResultados) {
            fila.remove();
        }
    });
}

function setModalElements(modalID, elements, data) {
    const form = document.getElementById(modalID.slice(1) + "Form");
    elements.forEach((element, index) => {
        form.elements[element].value = data[index];
    });
    $(modalID).modal("show");
}

function showComputersModal(prestamo) {
    const tbody = document.querySelector('.report-tbody');
    const rowTemplate = document.querySelector(".report-row-template")
    const noResults = document.querySelector('.report-row-sin-resultados');

    Array.from(tbody.children).forEach((fila) => {
        if (fila !== rowTemplate && fila !== noResults) {
            fila.remove();
        }
    });

    if (prestamo.equipos.length === 0) {
        noResults.style.display = '';
        return;
    }

    noResults.style.display = 'none';
    prestamo.equipos.forEach((equipo) => {
        const row = document.querySelector(".report-row-template").cloneNode(true);
        row.classList.remove('report-row-template')
        row.style.display = '';

        row.querySelector('.id').innerText = equipo.id;
        row.querySelector('.equipo').innerText = `${equipo.marca} ${equipo.modelo}`;
        row.querySelector('.identifcador').innerText = equipo.identificador;
        row.querySelector('.estado').innerText = equipo.estado

        tbody.appendChild(row);
    });
}

function showDeleteModal(id) {
    const elements = ["id"];
    setModalElements('#delete', elements, [id]);

    document.getElementById('deleteForm').addEventListener('submit', async function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        $(`#delete`).modal("hide");
        Alerts.showToastAlert(await PrestamoAPI.deletePrestamo(id));
        await getPrestamosFromAPI(currentPage);
    });
}

function showChangeStatusModal(id) {
    const elements = ["id"];
    setModalElements('#changeStatus', elements, [id]);

    document.getElementById('changeStatusForm').addEventListener('submit', async function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        $(`#changeStatus`).modal("hide");
        const id = formData.get('id');

        Alerts.showToastAlert(await PrestamoAPI.patchPrestamo(id, formData));
        await getPrestamosFromAPI(currentPage);
    });
}

function showReasonModal(id, motivo) {
    const elements = ['id'];
    tinymce.get("motivo").setContent(motivo);

    setModalElements('#viewReason', elements, [id]);

    document.getElementById('viewReasonForm').addEventListener('submit', async function (e) {
        e.preventDefault();
        $(`#viewReason`).modal("hide");

        const formData = new FormData(this);
        formData.set('motivo', tinymce.get('motivo').getContent());

        console.log(formData.get('motivo') + " " + formData.get('id'));
        const id = formData.get('id');

        Alerts.showToastAlert(await PrestamoAPI.patchPrestamo(id, formData));
        await getPrestamosFromAPI(currentPage);
    });
}

function showEditModal(prestamo) {
    const elements = ['id', 'fechaPrestamo', 'horaInicio', 'horaFin'];
    tinymce.get("motivo-edit").setContent(prestamo.motivo);
    const ids = prestamo.equipos.map(equipo => equipo.id);

    document.getElementById('nuevo-equipo-container').innerHTML = '';
    document.getElementById('cantidad').value = null;

    $('#userId').selectpicker('val', prestamo.user_id + "");
    $('#aulaId').selectpicker('val', prestamo.aula_id + "");
    $('#carreraId').selectpicker('val', prestamo.carrera_id + "");
    $('#asignaturaId').selectpicker('val', prestamo.asignatura_id + "");
    setModalElements("#edit", elements, [prestamo.id, prestamo.fecha_prestamo, prestamo.hora_inicio, prestamo.hora_fin]);
    setEquiposToEdit(ids);

    document.getElementById('editForm').addEventListener('submit', async function (e) {
        e.preventDefault();
        $(`#edit`).modal("hide");

        const formData = new FormData(this);
        const id = formData.get('id');
        formData.set('motivo', tinymce.get('motivo-edit').getContent());

        await linkEquiposToPrestamo(prestamo.id);
        Alerts.showToastAlert(await PrestamoAPI.putPrestamo(id, formData));
        await getPrestamosFromAPI(currentPage);
    });
}

tinymce.init({
    selector: 'textarea',
    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount linkchecker',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
    height: 250
});

async function unlinkEquipo(id) {
    let formData = new FormData();
    formData.append('prestamo_id', null);
    formData.append('estado', 'Disponible');

    return await EquipoAPI.patchEquipo(id, formData);
}

function showDeleteAlert(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonColor: '#3085d6',
        confirmButtonColor: '#d33',
        confirmButtonText: 'Sí, borrarlo!'
    }).then(async (result) => {
        if (result.isConfirmed) {
            const response = await unlinkEquipo(id);
            $(`#edit`).modal("hide");
            Alerts.showToastAlert(response);
            await getPrestamosFromAPI(currentPage);
        }
    });
}

async function linkEquiposToPrestamo(idPrestamo) {
    let formData = new FormData();
    formData.set('prestamoId', idPrestamo);
    formData.set('estado', 'Ocupado');

    const equipos = document.querySelectorAll('select.equipo');

    console.log(equipos)

    equipos.forEach(equipo => {
        EquipoAPI.patchEquipo(equipo.value, formData);
    });
}

async function cleanSearchInput() {

    document.querySelector(".busqueda").value = "";
    document.querySelector("#entriesPerPageContainer").style.display = "";
    document.querySelector('#searchInfo').style.display = 'none';
    document.getElementById("limpiarBusqueda").style.display = "none";
    await getPrestamosFromAPI(1);
}


