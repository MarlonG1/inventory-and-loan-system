let currentPage = 0;

document.addEventListener('DOMContentLoaded', async function () {
    await getEquiposFromAPI(1);

    document.getElementById('entradasPorPagina').addEventListener('change', async function () {
        const entriesPerPage = this.value;
        localStorage.setItem('entriesPerPage', entriesPerPage);
        await getEquiposFromAPI(1);
    });


    try {
        const elementoDePaginacion = document.querySelector(".pagination");

        elementoDePaginacion.addEventListener("click", async function (event) {
            if (event.target.tagName === "A") {
                event.preventDefault();

                const nuevaPagina = parseInt(event.target.getAttribute("data-page"));
                await getEquiposFromAPI(nuevaPagina);
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

            await getEquiposFromAPI(currentPage, searchTerm);
        });

        await getEquiposFromAPI(1);
    } catch (error) {
        console.error("Error al cargar datos:", error);
    }
});

async function getEquiposFromAPI(page, searchTerm = '') {
    const entriesPerPage = document.getElementById('entradasPorPagina').value = localStorage.getItem('entriesPerPage') === null ? 5 : localStorage.getItem('entriesPerPage');

    if (page === null) {
        return;
    }

    const filters = `include=licencias&tipo[eq]=Equipo&page=${page}&searchTerm=${searchTerm}&entriesPerPage=${entriesPerPage}`;
    try {
        const response = await InventarioAPI.getData(filters);
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
        `<a href="#" id="totalDisponibles" class="px-3 m-0 activo" style="border-radius:10px 0px 0px 10px;"><i class="fa-solid fa-circle fa-2xs"></i> Disponibles ${totales.totalDeDisponibles}</a>` +
        `<a href="#" id="totalReparacion" class="px-3 m-0 reparacion"><i class="fa-solid fa-circle fa-2xs"></i> En reparación ${totales.totalDeEnReparacion}</a>` +
        `<a href="#" id="totalOcupados" class="px-3 m-0 finalizado" style="border-radius:0px 10px 10px 0px;"><i class="fa-solid fa-circle fa-2xs"></i> Ocupados ${totales.totalDeOcupados}</a>`;
}

function newRow(equipo) {
    const row = document.querySelector(".row-template").cloneNode(true);
    const tbody = document.querySelector('.customtable');

    row.classList.remove('row-template')
    row.style.display = '';

    const valueMapping = {
        '.id': 'id',
        '.brand': 'marca',
        '.model': 'modelo',
        '.identifier': 'identificador',
    }

    Object.entries(valueMapping).forEach(([selector, property]) => {
        row.querySelector(selector).textContent = equipo[property];
    });

    const estadoElement = row.querySelector(".estado");
    estadoElement.innerHTML = '<i class="fa-solid fa-circle fa-2xs my-auto mr-1"></i>' + equipo.estado;
    estadoElement.classList.remove("activo", "finalizado", "reparacion");

    const statusMapping = {
        'Disponible': 'activo',
        'En reparación': 'reparacion',
        'Ocupado': 'finalizado'
    }

    estadoElement.classList.add(statusMapping[equipo.estado]);
    row.querySelector('.open-changePhoto-modal').addEventListener("click", () => showChangePhotoModal(equipo));
    row.querySelector('.open-viewObser-modal').addEventListener("click", () => showObservationsModal(equipo.id, equipo.observaciones));
    row.querySelector('.open-changeStatus-modal').addEventListener("click", () => showChangeStatusModal(equipo.id, equipo.estado));
    row.querySelector('.open-delete-modal').addEventListener("click", () => showDeleteModal(equipo.id));
    row.querySelector('.open-licencias-modal').addEventListener("click", () => showLicenciasModal(equipo));
    row.querySelector('.open-edit-modal').addEventListener("click", () => showEditModal(equipo));

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

function showChangePhotoModal(equipo) {
    const elements = ['id'];
    setModalElements("#changePhoto", elements, [equipo.id]);
    const timestamp = new Date().getTime();
    document.querySelector("#current-imagen").src = `${equipo.imagen}?t=${timestamp}`;

    const form =  document.getElementById('changePhotoForm');
    form.action = `inventario/change-inventory-photo/${equipo.id}`
}

function showLicenciasModal(equipo) {
    const tbody = document.querySelector('.report-tbody');
    const rowTemplate = document.querySelector(".report-row-template")
    const noResults = document.querySelector('.report-row-sin-resultados');

    Array.from(tbody.children).forEach((fila) => {
        if (fila !== rowTemplate && fila !== noResults) {
            fila.remove();
        }
    });

    if (equipo.licencias.length === 0) {
        noResults.style.display = '';
        return;
    }

    noResults.style.display = 'none';
    equipo.licencias.forEach((licencia) => {
        const row = document.querySelector(".report-row-template").cloneNode(true);
        row.classList.remove('report-row-template')
        row.style.display = '';

        row.querySelector('.id').innerText = licencia.id;
        row.querySelector('.nombre').innerText = `${licencia.nombre}`;
        row.querySelector('.tipo').innerText = licencia.tipo;
        row.querySelector('.estado').innerText = licencia.estado

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
        const id = formData.get('id');

        Alerts.showToastAlert(await InventarioAPI.deleteData(id));
        await getEquiposFromAPI(currentPage);
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

        Alerts.showToastAlert(await InventarioAPI.patchData(id, formData));
        await getEquiposFromAPI(currentPage);
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

        Alerts.showToastAlert(await InventarioAPI.patchData(id, formData));
        await getEquiposFromAPI(currentPage);
    });
}

function showEditModal(equipo) {
    const elements = ['id', 'modelo', 'identificador'];
    tinymce.get("observaciones-edit").setContent(equipo.observaciones);
    const ids = equipo.licencias.map(equipo => equipo.id);

    document.getElementById('estado-edit').querySelectorAll('option').forEach(option => {
        if (option.value === equipo.estado) {
            option.selected = true;
        }
    });

    document.getElementById('marca').querySelectorAll('option').forEach(option => {
        if (option.value === equipo.marca) {
            option.selected = true;
        }
    });

    setModalElements("#edit", elements, [equipo.id, equipo.modelo, equipo.identificador]);
    // setEquiposToEdit(ids);

    document.getElementById('editForm').addEventListener('submit', async function (e) {
        e.preventDefault();
        $(`#edit`).modal("hide");

        const formData = new FormData(this);
        const id = formData.get('id');
        formData.set('observaciones', tinymce.get('observaciones-edit').getContent());
        formData.set('tipo', 'Equipo');

        // await linkEquiposToPrestamo(equipo.id);
        Alerts.showToastAlert(await InventarioAPI.putData(id, formData));
        await getEquiposFromAPI(currentPage);
    });
}

tinymce.init({
    selector: 'textarea',
    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount linkchecker',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
    height: 250
});

// async function unlickLicencia(id) {
//     let formData = new FormData();
//     formData.append('prestamo_id', null);
//     formData.append('estado', 'Disponible');
//
//     return await InventarioAPI.patchEquipo(id, formData);
// }

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
            await getEquiposFromAPI(currentPage);
        }
    });
}

// async function linkEquiposToPrestamo(idPrestamo) {
//     let formData = new FormData();
//     formData.set('prestamoId', idPrestamo);
//     formData.set('estado', 'Ocupado');
//
//     const equipos = document.querySelectorAll('select.equipo');
//
//     console.log(equipos)
//
//     equipos.forEach(equipo => {
//         InventarioAPI.patchEquipo(equipo.value, formData);
//     });
// }

async function cleanSearchInput() {

    document.querySelector(".busqueda").value = "";
    document.querySelector("#entriesPerPageContainer").style.display = "";
    document.querySelector('#searchInfo').style.display = 'none';
    document.getElementById("limpiarBusqueda").style.display = "none";
    await getEquiposFromAPI(1);
}


