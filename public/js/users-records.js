let currentPage = 0;

document.addEventListener('DOMContentLoaded', async function () {
    await getUsersFromAPI(1);

    document.getElementById('entradasPorPagina').addEventListener('change', async function () {
        const entriesPerPage = this.value;
        localStorage.setItem('entriesPerPage', entriesPerPage);
        await getUsersFromAPI(1);
    });


    try {
        const elementoDePaginacion = document.querySelector(".pagination");

        elementoDePaginacion.addEventListener("click", async function (event) {
            if (event.target.tagName === "A") {
                event.preventDefault();

                const nuevaPagina = parseInt(event.target.getAttribute("data-page"));
                await getUsersFromAPI(nuevaPagina);
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

            await getUsersFromAPI(currentPage, searchTerm);
        });

        await getUsersFromAPI(1);
    } catch (error) {
        console.error("Error al cargar datos:", error);
    }
});

async function getUsersFromAPI(page, searchTerm = '') {
    const entriesPerPage = document.getElementById('entradasPorPagina').value = localStorage.getItem('entriesPerPage') === null ? 5 : localStorage.getItem('entriesPerPage');

    if (page === null) {
        return;
    }

    const filters = `include=departamento,carrera&page=${page}&searchTerm=${searchTerm}&entriesPerPage=${entriesPerPage}`;
    try {
        const response = await UserAPI.getUsers(filters);
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

function newRow(user) {
    const row = document.querySelector(".row-template").cloneNode(true);
    const tbody = document.querySelector('.customtable');

    row.classList.remove('row-template')
    row.style.display = '';

    const valueMapping = {
        '.id': 'id',
        '.type': 'type',
    }

    Object.entries(valueMapping).forEach(([selector, property]) => {
        row.querySelector(selector).textContent = user[property];
    });

    row.querySelector('.completeName').innerText = `${user.name} ${user.lastname}`;
    row.querySelector('.career').innerText = `${user.carrera.nombre}`;
    row.querySelector('.open-delete-modal').addEventListener("click", () => showDeleteModal(user.id));
    row.querySelector('.open-edit-modal').addEventListener("click", () => showEditModal(user));
    row.querySelector('.open-changePassword-modal').addEventListener("click", () => showChangePasswordModal(user));
    row.querySelector('.open-changePhoto-modal').addEventListener("click", () => showchangePhotoModal(user));

    tbody.appendChild(row);
}

function showChangePasswordModal(user) {
    const elements = ['id'];
    setModalElements("#changePassword", elements, [user.id]);

    document.getElementById('changePasswordForm').addEventListener('submit', async function (e) {
        e.preventDefault();
        $(`#changePassword`).modal("hide");

        const formData = new FormData(this);
        const id = formData.get("id");
        Alerts.showToastAlert(await UserAPI.patchUser(id, formData));
    });
}

function showchangePhotoModal(user) {
    const elements = ['id'];
    setModalElements("#changePhoto", elements, [user.id]);
    const timestamp = new Date().getTime();
    document.querySelector("#profile-photo").src = `${user.image}?t=${timestamp}`;

    const form =  document.getElementById('changePhotoForm');
    form.action = `users/change-photo/${user.id}`
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

function showDeleteModal(id) {
    const elements = ["id"];
    setModalElements('#delete', elements, [id]);

    document.getElementById('deleteForm').addEventListener('submit', async function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        const id = formData.get("id");
        $(`#delete`).modal("hide");
        const response = await UserAPI.deleteUser(id);
        Alerts.showToastAlert(response);

        if(response.asociados){
            Swal.fire({
                title: '¿Deseas eliminar los prestamos asociados junto al usuario?',
                text: "¡No podrás revertir esto!",
                icon: 'question',
                showCancelButton: true,
                cancelButtonColor: '#3085d6',
                confirmButtonColor: '#d33',
                confirmButtonText: 'Sí, borrarlo!',
            }).then(async (result) => {
                if (result.isConfirmed) {
                    const response = await UserAPI.deleteUserWithPrestamos(id);
                    $(`#delete`).modal("hide");
                    Alerts.showToastAlert(response);
                    await getUsersFromAPI(currentPage);
                }
            });
        }
    });
}

function showEditModal(user) {
    const elements = ['id', 'name', 'lastname', 'email', 'phone', 'birthDate', 'carnet'];

    $('#carreraId').selectpicker('val', user.carrera_id + "");
    $('#departamentoId').selectpicker('val', user.departamento_id + "");
    setModalElements("#edit", elements, [user.id, user.name, user.lastname, user.email, user.phone, user.birth_date, user.carnet]);

    document.getElementById('editForm').addEventListener('submit', async function (e) {
        e.preventDefault();
        $(`#edit`).modal("hide");

        const formData = new FormData(this);
        const id = formData.get("id");

        Alerts.showToastAlert(await UserAPI.patchUser(id, formData));
        await getUsersFromAPI(currentPage);
    });
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
            const response = await unlickLicencia(id);
            $(`#edit`).modal("hide");
            Alerts.showToastAlert(response);
            await getUsersFromAPI(currentPage);
        }
    });
}

async function cleanSearchInput() {

    document.querySelector(".busqueda").value = "";
    document.querySelector("#entriesPerPageContainer").style.display = "";
    document.querySelector('#searchInfo').style.display = 'none';
    document.getElementById("limpiarBusqueda").style.display = "none";
    await getUsersFromAPI(1);
}


