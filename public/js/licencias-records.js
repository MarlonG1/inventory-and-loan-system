let currentPage = 0;

document.addEventListener('DOMContentLoaded', async function () {
    await getLicenciasFromAPI(1);

    document.getElementById('entradasPorPagina').addEventListener('change', async function () {
        const entriesPerPage = this.value;
        localStorage.setItem('entriesPerPage', entriesPerPage);
        await getLicenciasFromAPI(1);
    });


    try {
        const elementoDePaginacion = document.querySelector(".pagination");

        elementoDePaginacion.addEventListener("click", async function (event) {
            if (event.target.tagName === "A") {
                event.preventDefault();

                const nuevaPagina = parseInt(event.target.getAttribute("data-page"));
                await getLicenciasFromAPI(nuevaPagina);
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

            await getLicenciasFromAPI(currentPage, searchTerm);
        });

        await getLicenciasFromAPI(1);
    } catch (error) {
        console.error("Error al cargar datos:", error);
    }
});

async function getLicenciasFromAPI(page, searchTerm = '') {
    const entriesPerPage = document.getElementById('entradasPorPagina').value = localStorage.getItem('entriesPerPage') === null ? 5 : localStorage.getItem('entriesPerPage');

    if (page === null) {
        return;
    }

    const filters = `include=inventario&page=${page}&searchTerm=${searchTerm}&entriesPerPage=${entriesPerPage}`;
    try {
        const response = await LicenciaAPI.getLicencias(filters);
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

        setTable(response);
    } catch (error) {
        console.error("Error al cargar datos:", error);
    }
}

function setTable(datadb) {
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
        `<a href="#" id="totalDisponibles" class="px-3 m-0 activo" style="border-radius:10px 0px 0px 10px;"><i class="fa-solid fa-circle fa-2xs"></i> Disponibles ${totales.totalDeActivas}</a>` +
        `<a href="#" id="totalPorRenovar" class="px-3 m-0 reparacion"><i class="fa-solid fa-circle fa-2xs"></i> En reparación ${totales.totalPorRenovar}</a>` +
        `<a href="#" id="totalInactivas" class="px-3 m-0 inactiva"><i class="fa-solid fa-circle fa-2xs"></i> Inactivas ${totales.totalDeInactivas}</a>` +
        `<a href="#" id="totalVencidas" class="px-3 m-0 finalizado" style="border-radius:0px 10px 10px 0px;"><i class="fa-solid fa-circle fa-2xs"></i> Ocupados ${totales.totalVencidas}</a>`;

    document.getElementById('open-add-modal').addEventListener("click", () => showAddModal());
}

function newRow(licencia) {
    const row = document.querySelector(".row-template").cloneNode(true);
    const tbody = document.querySelector('.customtable');

    row.classList.remove('row-template')
    row.style.display = '';

    const valueMapping = {
        '.id': 'id',
        '.name': 'nombre',
        '.type': 'tipo',
        '.units': 'unidad',
    }

    Object.entries(valueMapping).forEach(([selector, property]) => {
        row.querySelector(selector).textContent = licencia[property];
    });

    const date = licencia.fecha_vencimiento.split("-").reverse().join("/");

    const estadoElement = row.querySelector(".estado");
    estadoElement.innerHTML = '<i class="fa-solid fa-circle fa-2xs my-auto mr-1"></i>' + licencia.estado;
    estadoElement.classList.remove("activo", "finalizado", "reparacion", "inactiva");

    const statusMapping = {
        'Activa': 'activo',
        'Por renovar': 'reparacion',
        'Inactiva': 'inactiva',
        'Vencida': 'finalizado'
    }

    estadoElement.classList.add(statusMapping[licencia.estado]);
    row.querySelector('.date').textContent = date;
    row.querySelector('.open-viewObser-modal').addEventListener("click", () => showObservationsModal(licencia.id, licencia.observaciones));
    row.querySelector('.open-chageStatus-modal').addEventListener("click", () => showChangeStatusModal(licencia.id, licencia.estado));
    row.querySelector('.open-delete-modal').addEventListener("click", () => showDeleteModal(licencia.id));
    row.querySelector('.open-computers-modal').addEventListener("click", () => showComputersModal(licencia));
    row.querySelector('.open-edit-modal').addEventListener("click", () => showEditModal(licencia));
    tbody.appendChild(row);
}

function setPagination(data) {
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

function showComputersModal(licencia) {
    const tbody = document.querySelector('.report-tbody');
    const rowTemplate = document.querySelector(".report-row-template")
    const noResults = document.querySelector('.report-row-sin-resultados');

    Array.from(tbody.children).forEach((fila) => {
        if (fila !== rowTemplate && fila !== noResults) {
            fila.remove();
        }
    });

    if (licencia.inventario.length === 0) {
        noResults.style.display = '';
        return;
    }

    noResults.style.display = 'none';
    licencia.inventario.forEach((equipo) => {
        const row = document.querySelector(".report-row-template").cloneNode(true);
        row.classList.remove('report-row-template')
        row.style.display = '';

        row.querySelector('.id').innerText = equipo.id;
        row.querySelector('.equipo').innerText = `${equipo.marca} ${equipo.modelo}`;
        row.querySelector('.identificador').innerText = equipo.identificador;
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
        Alerts.showToastAlert(await LicenciaAPI.deleteLicencia(id));
        await getLicenciasFromAPI(currentPage);
    });
}

function showChangeStatusModal(id, estado) {
    const elements = ["id"];
    setModalElements('#changeStatus', elements, [id]);

    document.getElementById('estado').querySelectorAll('option').forEach(option => {
        if (option.value === estado) {
            option.selected = true;
        }
    });

    document.getElementById('changeStatusForm').addEventListener('submit', async function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        $(`#changeStatus`).modal("hide");
        const id = formData.get('id');

        Alerts.showToastAlert(await LicenciaAPI.patchLicencia(id, formData));
        await getLicenciasFromAPI(currentPage);
    });
}

function showObservationsModal(id, observations) {
    const elements = ['id'];
    tinymce.get("observations").setContent(observations);

    setModalElements('#viewObser', elements, [id]);

    document.getElementById('viewObserForm').addEventListener('submit', async function (e) {
        e.preventDefault();
        $(`#viewObser`).modal("hide");

        const formData = new FormData(this);
        formData.set('observaciones', tinymce.get('observations').getContent());
        const id = formData.get('id');

        Alerts.showToastAlert(await LicenciaAPI.patchLicencia(id, formData));
        await getLicenciasFromAPI(currentPage);
    });
}

function showEditModal(licencia) {
    const elements = ['id', 'nombre', 'fechaAdquisicion', 'unidad', 'fechaVencimiento', 'clave'];
    tinymce.get("observations-edit").setContent(licencia.observaciones);
    // const ids = equipo.equipos.map(equipo => equipo.id);
    //
    // document.getElementById('nuevo-equipo-container').innerHTML = '';
    // document.getElementById('cantidad').value = null;

    setModalElements("#edit", elements, [ licencia.id, licencia.nombre, licencia.fecha_adquisicion, licencia.unidad, licencia.fecha_vencimiento, licencia.clave]);
    // setEquiposToEdit(ids);

    document.getElementById('estado-edit').querySelectorAll('option').forEach(option => {
        if (option.value === licencia.estado) {
            option.selected = true;
        }
    });
    document.getElementById('tipo').querySelectorAll('option').forEach(option => {
        if (option.value === licencia.tipo) {
            option.selected = true;
        }
    });

    document.getElementById('editForm').addEventListener('submit', async function (e) {
        e.preventDefault();
        $(`#edit`).modal("hide");

        const formData = new FormData(this);
        const id = formData.get('id');

        Alerts.showToastAlert(await LicenciaAPI.putLicencia(id, formData));
        await getLicenciasFromAPI(currentPage);
    });
}

function showAddModal() {
    document.getElementById('addForm').addEventListener('submit', async function (e) {
        e.preventDefault();

        const formData = new FormData(this);
        $(`#add`).modal("hide");

        Alerts.showToastAlert(await LicenciaAPI.postLicencia(formData));
        await getLicenciasFromAPI(currentPage);
    });
}

tinymce.init({
    selector: 'textarea',
    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount linkchecker',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
    height: 250
});

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
            const response = await unlickLicencia(id);
            $(`#edit`).modal("hide");
            Alerts.showToastAlert(response);
            await getLicenciasFromAPI(currentPage);
        }
    });
}

async function cleanSearchInput() {

    document.querySelector(".busqueda").value = "";
    document.querySelector("#entriesPerPageContainer").style.display = "";
    document.querySelector('#searchInfo').style.display = 'none';
    document.getElementById("limpiarBusqueda").style.display = "none";
    await getLicenciasFromAPI(1);
}


