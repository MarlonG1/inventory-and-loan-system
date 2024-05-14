const selectedEquipo = [];
document.addEventListener('DOMContentLoaded', function () {
    const categoryContainer = document.querySelector('#categories-select');
    categoryContainer.innerHTML = '';

    for (let i = 0; i < equiposMap.length; i++) {
        const optionElement = document.createElement('option');
        optionElement.value = equiposMap[i].nombre;
        optionElement.textContent = `${equiposMap[i].nombre} (${equiposMap[i].cantidad})`;
        categoryContainer.appendChild(optionElement);
    }

    $('#categories-select').selectpicker('refresh');

    document.querySelector('#categories-select').addEventListener('change', async function (event) {
        const selectedCategory = event.target.value;
        setEquipoCards(await getEquipos(selectedCategory));
    });
});

function setEquipoCards(equipos) {
    const equiposContainer = document.querySelector('.equipos');
    const equipo = document.querySelector('.equipo-template').cloneNode(true);
    equipo.classList.remove('equipo-template');
    equipo.style.display = '';
    equiposContainer.innerHTML = '';

    for (let i = 0; i < equipos.length; i++) {
        equipo.addEventListener('click', function () {

        });

        equipo.querySelector('span').textContent = `${equipos[i].marca} - ${equipos[i].modelo}`;
        equiposContainer.appendChild(equipo);
    }
}

async function getEquipos(marca) {
    const response = await fetch(`/api/v1/equipos?marca[eq]=${marca}&estado[eq]=Disponible`, {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'Credentials': 'include',
        }
    });

    const equipos = await response.json();
    return equipos.data;
}



