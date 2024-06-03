
const selectedEquipo = [];

document.addEventListener('DOMContentLoaded', function () {

    document.getElementById('prestamoForm').addEventListener('submit', async function (e) {
        e.preventDefault();

        let formData = new FormData(this);
        formData.set('motivo', '');
        formData.set('estado', 'Activo');

        await CompositeProcesses.createNewPrestamo(formData, selectedEquipo);
    });

    let categoryContainer = document.querySelector('.categories');
    document.querySelector('.no-results').style.display = '';

    for (let i = 0; i < equiposMap.length; i++) {
        const element = document.querySelector('.category-template').cloneNode(true);
        element.classList.remove('category-template');
        element.style.display = '';

        element.innerHTML = `${equiposMap[i].nombre} <span class="badge badge-secundario ">${equiposMap[i].cantidad}</span>`;
        element.addEventListener('click', async function (evt) {
            evt.preventDefault();

            categoryContainer.querySelectorAll('.active').forEach(item => {
                item.classList.remove('active');
            });

            this.classList.toggle('active');
            setEquipoCards(await getEquiposFromAPI(equiposMap[i].nombre));
        })

        categoryContainer.appendChild(element);
    }
});

function showDeleteAlert(position) {
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
            selectedEquipo.splice(selectedEquipo.indexOf({numero: selectedEquipo[position].id}), 1);
            setEquipoIntoTable();
            Alerts.showToastAlert({icon: 'success', title: 'Inventario eliminado con exito!'});
            $('#deleteModal').modal('hidden');
        }
    });
}

function setEquipoCards(equipos) {
    const equiposContainer = document.querySelector('.equipos');

    Array.from(document.querySelectorAll('.item')).forEach(equipo => {
        if (!equipo.classList.contains('equipo-template')) {
            equipo.remove();
        }
    });

    for (let i = 0; i < equipos.length; i++) {
        const equipo = document.querySelector('.equipo-template').cloneNode(true);
        equipo.classList.remove('equipo-template');
        equipo.style.display = '';

        if (selectedEquipo.some(e => e.id === equipos[i].id)) {
            equipo.classList.add('selected');
        }

        equipo.addEventListener('click', function (evt) {
            evt.preventDefault();
            this.classList.toggle('selected');

            if (this.classList.contains('selected')) {
                selectedEquipo.push({id: equipos[i].id, marca: equipos[i].marca + ' - ' + equipos[i].modelo});
            } else {
                selectedEquipo.splice(selectedEquipo.indexOf({numero: equipos[i].id}), 1);
            }

            setEquipoIntoTable();
        });

        equipo.querySelector('span').innerHTML = `<strong>${equipos[i].marca}</strong> <br> ${equipos[i].modelo}`;
        equipo.querySelector('img').src = equipos[i].imagen;
        equiposContainer.appendChild(equipo);
    }
}

function cleanTable() {
    const table = document.querySelector('.report-tbody');
    console.log(table)

    Array.from(table.querySelectorAll('tr')).forEach(row => {
        if (!row.classList.contains('row-template') && !row.classList.contains('no-results')) {
            row.remove();
        }
    });
}

function setEquipoIntoTable() {

    const table = document.querySelector('.report-tbody');
    // $(table).slideUp(200);
    cleanTable();

    const noResults = document.querySelector('.no-results');
    if (selectedEquipo.length === 0) {
        noResults.style.display = '';
        return;
    }

    noResults.style.display = 'none';
    for (let i = 0; i < selectedEquipo.length; i++) {
        const newRow = document.querySelector('.row-template').cloneNode(true);
        newRow.classList.remove('row-template');
        newRow.style.display = '';

        newRow.querySelector('.count').innerHTML = i + 1;
        newRow.querySelector('.equipo').innerHTML = selectedEquipo[i].marca;
        newRow.querySelector('.action').innerHTML = `<a href="#"><i class="fa-solid fa-x" style="color: var(--primario)"></i></a>`;

        newRow.querySelector('.action').querySelector('a').addEventListener('click', function (evt) {
            evt.preventDefault();
            showDeleteAlert(i);
        });

        table.appendChild(newRow);
        // $(newRow).slideDown("slow");
    }
}

async function getEquiposFromAPI(marca) {
    const filters = `marca[eq]=${marca}&estado[eq]=Disponible`
    const reponse = await InventarioAPI.getData(filters);
    return reponse.data;
}



