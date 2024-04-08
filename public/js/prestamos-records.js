document.addEventListener('DOMContentLoaded', async function () {

    const response = await fetch('api/v1/prestamos?includeUser=true', {
        method: 'GET',
    })

    if (response.ok) {
        const apiResponse = await response.json();
        setHeaderInfo(apiResponse.data.totales);

        apiResponse.data.prestamos.forEach((prestamo, index) =>{
            newRow(prestamo);
        });

    } else {
        console.log('Ocurrio un error en la peticion');
    }
});

function setHeaderInfo(totales){
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
        '.id' : 'id',
        '.course' : 'asignatura',
    }

    Object.entries(valueMapping).forEach(([selector, property]) => {
        row.querySelector(selector).textContent = prestamo[property];
    });

    row.querySelector('.completeName').innerText = `${prestamo.user.name} ${prestamo.user.lastname}`;
    row.querySelector('.type').innerText = prestamo.user.type;

    const date = prestamo.fechaPrestamo.split("-").reverse().join("/");
    const startTime = prestamo.horaInicio.slice(0, -3);
    const endTime = prestamo.horaFin.slice(0, -3);
    const estadoElement = row.querySelector(".estado");

    estadoElement.innerHTML = '<i class="fa-solid fa-circle fa-2xs my-auto mr-1"></i>' + prestamo.estado;
    estadoElement.classList.remove("activo", "finalizado", "pendiente");
    estadoElement.classList.add(prestamo.estado.toLowerCase());

    row.querySelector(".requestDate").textContent = date;
    row.querySelector(".time").textContent = `${startTime} - ${endTime}`;

    tbody.appendChild(row);
}


// let paginaActual = 1;
// let padreActual = null;
// let iconoActual = null;
//
// document.addEventListener("DOMContentLoaded", async function () {
//     const IDModales = ["editar", "cambiarEstado", "eliminar", "motivo"];
//     const IDFormularios = [
//         "editarForm",
//         "estadoForm",
//         "eliminarForm",
//         "editarMotivoForm",
//     ];
//     const rutaAPI = [
//         "./php/actions/prestamos/editar.php",
//         "./php/actions/prestamos/cambiar-estado.php",
//         "./php/actions/prestamos/eliminar.php",
//         "./php/actions/prestamos/cambiar-motivo.php",
//     ];
//
//     const filtros = [
//         "filtradoID",
//         "filtradoNombre",
//         "filtradoTipo",
//         "filtradoMateria",
//         "filtradoCantidad",
//         "filtradoFecha",
//     ];
//     const columna = [
//         "id",
//         "nombreSolicitante",
//         "tipoSolicitante",
//         "asignatura",
//         "cantidad",
//         "fecha",
//     ];
//
//     filtros.forEach((IDElemento, index) => {
//         generarIconoFiltrado(IDElemento, columna[index]);
//     });
//
//     IDModales.forEach((IDmodal, index) => {
//         cargarModales(IDmodal, IDFormularios[index], rutaAPI[index]);
//     });
//
//     // Cargar datos de la tabla
//     try {
//         const elementoDePaginacion = document.querySelector(".pagination");
//
//         elementoDePaginacion.addEventListener("click", async function (event) {
//             if (event.target.tagName === "A") {
//                 event.preventDefault();
//
//                 const nuevaPagina = parseInt(event.target.getAttribute("data-pagina"));
//                 await actualizarTabla(nuevaPagina);
//                 paginaActual = nuevaPagina;
//             }
//         });
//         await actualizarTabla(1);
//     } catch (error) {
//         console.error("Error al cargar datos:", error);
//     }
//
//     // Buscar datos de la tabla
//     try {
//         const inputBusqueda = document.querySelector(".busqueda");
//
//         inputBusqueda.addEventListener("input", async function () {
//             const terminoBusqueda = inputBusqueda.value.trim();
//
//             if (inputBusqueda.value.length > 0) {
//                 document.getElementById("limpiarBusqueda").style.display = "";
//             }
//
//             await actualizarTabla(paginaActual, terminoBusqueda);
//         });
//
//         await actualizarTabla(1);
//     } catch (error) {
//         console.error("Error al cargar datos:", error);
//     }
// });
//
// function cargarModales(IDmodal, IDformulario, rutaAPI) {
//     document
//         .getElementById(IDformulario)
//         .addEventListener("submit", async function (e) {
//             e.preventDefault();
//
//             try {
//                 const formData = new FormData(this);
//
//                 if (IDmodal === "motivo") {
//                     const tinycloud = tinymce.get("motivoText").getContent();
//                     formData.append("motivo", tinycloud);
//                 }
//
//                 $(`#${IDmodal}`).modal("hide");
//
//                 const response = await fetch(rutaAPI, {
//                     method: "POST",
//                     body: formData,
//                 });
//
//                 if (response.ok) {
//                     const data = await response.json();
//                     mostrarAlerta(data);
//                 }
//             } catch (error) {
//                 console.error("Error al editar:", error);
//             }
//         });
// }
// async function actualizarTabla(pagina, busqueda = "") {
//     try {
//         let url = `./php/actions/prestamos/obtener-prestamos.php?pagina=${pagina}&entradasPorPagina=${
//             localStorage.getItem("entradasPorPagina") || 10
//         }&columna=${localStorage.getItem("columna") || "id"}&orden=${
//             localStorage.getItem("orden") || "ASC"
//         }`;
//
//         if (busqueda !== "") {
//             url += `&busqueda=${encodeURIComponent(busqueda)}`;
//         }
//
//         const response = await fetch(url, {
//             method: "GET",
//             headers: {
//                 "Content-Type": "application/x-www-form-urlencoded",
//             },
//         });
//
//         if (response.ok) {
//             const data = await response.json();
//             establecerDatosEnTabla(data);
//
//             const elementoDePaginacion = document.querySelector(".pagination");
//
//             elementoDePaginacion.innerHTML =
//                 busqueda === ""
//                     ? generarPaginacion(data.totalDeFilas, pagina)
//                     : "Se muestran todos los resultados en una sola página.";
//
//             // elementoDePaginacion.innerHTML = generarPaginacion(
//             //   data.totalDeFilas,
//             //   pagina
//             // );
//
//             const cantidadDeRegistros =
//                 `<a href="#" onclick="filtrarPorEstado('Activo');" id="totalActivos" class="px-3 m-0 activo" style="border-radius:10px 0px 0px 10px;"><i class="fa-solid fa-circle fa-2xs"></i> Activos ${data.totalDeActivos}</a>` +
//                 `<a href="#" onclick="filtrarPorEstado('Pendiente');" id="totalPendientes" class="px-3 m-0 pendiente"><i class="fa-solid fa-circle fa-2xs"></i> Pendientes ${data.totalDePendientes}</a>` +
//                 `<a href="#" onclick="filtrarPorEstado('Finalizado');" id="totalFinalizados" class="px-3 m-0 finalizado" style="border-radius:0px 10px 10px 0px;"><i class="fa-solid fa-circle fa-2xs"></i> Finalizados ${data.totalDeFinalizados}</a>`;
//
//             if (busqueda == "") {
//                 document.getElementById("cantidadDeRegistros").innerHTML =
//                     cantidadDeRegistros;
//             } else {
//                 document.getElementById("cantidadDeRegistros").innerHTML =
//                     '<p class="m-0 text-center pendiente px-3" style="border-radius:20px;">Total de registros encontrados: ' +
//                     data.totalDeFilas +
//                     "</p>";
//             }
//         }
//     } catch (error) {
//         console.error("Error al actualizar la tabla:", error);
//     }
// }
//
// function establecerDatosEnTabla(data) {
//     const { totalDeFilas, registros } = data;
//
//     limpiarTabla();
//
//     const busqueda = document
//         .querySelector(".busqueda")
//         .value.trim()
//         .toLowerCase();
//
//     const filtroDeRegistros = registros.filter((registro) => {
//         for (const letra in registro) {
//             if (
//                 registro.hasOwnProperty(letra) &&
//                 typeof registro[letra] === "string"
//             ) {
//                 if (registro[letra].toLowerCase().includes(busqueda)) {
//                     return true;
//                 }
//             }
//         }
//         return false;
//     });
//
//     generarTotalDeEntradas(totalDeFilas);
//
//     const textoDeEntradas = document.getElementById("indiceDePaginas");
//     textoDeEntradas.innerHTML = `Mostrando <b>${filtroDeRegistros.length}</b> salidas de <b>${totalDeFilas}</b> salidas`;
//
//     const ningunResultado = document.querySelector(".sin-resultados");
//
//     if (filtroDeRegistros.length > 0) {
//         filtroDeRegistros.forEach(agregarFila);
//         ningunResultado.style.display = "none";
//     } else {
//         ningunResultado.style.display = "";
//     }
// }
//
// function limpiarTabla() {
//     const tbody = document.querySelector(".customtable");
//     const filaMolde = document.querySelector(".fila-molde");
//     const sinResultados = document.querySelector(".sin-resultados");
//
//     Array.from(tbody.children).forEach((fila) => {
//         if (fila !== filaMolde && fila !== sinResultados) {
//             fila.remove();
//         }
//     });
// }
//
// function generarPaginacion(totalDeFilas, paginaActual) {
//     const registrosPorPagina = localStorage.getItem("entradasPorPagina") || 10;
//     const totalDePaginas = Math.ceil(totalDeFilas / registrosPorPagina);
//
//     let paginacionHTML = "";
//     let inicio, fin, inicioFinal, finFinal;
//
//     if (totalDePaginas > 5) {
//         // Ajustar el rango de páginas para mostrar alrededor de la página actual
//         if (paginaActual <= 3) {
//             inicio = 1;
//             fin = 5;
//         } else if (paginaActual >= totalDePaginas - 2) {
//             inicio = totalDePaginas - 4;
//             fin = totalDePaginas;
//         } else {
//             inicio = paginaActual - 2;
//             fin = paginaActual + 2;
//         }
//
//         inicioFinal = 1;
//         finFinal = totalDePaginas;
//
//         paginacionHTML += `<li class="page-item"><a class="page-link" aria-label="start" data-pagina="${inicioFinal}" href="#">&lt;&lt;</a></li>`;
//
//         paginacionHTML += `<li class="page-item"><a class="page-link" aria-label="Previous" data-pagina="${
//             paginaActual - 1 > 0 ? paginaActual - 1 : 1
//         }" href="#">&lt;</a></li>`;
//
//         for (let i = inicio; i <= fin; i++) {
//             paginacionHTML += `<li class="page-item ${
//                 i === paginaActual ? "active" : ""
//             }"><a class="page-link" data-pagina="${i}" href="#">${i}</a></li>`;
//         }
//
//         paginacionHTML += `<li class="page-item"><a class="page-link" aria-label="Next" data-pagina="${
//             paginaActual + 1 < totalDePaginas ? paginaActual + 1 : totalDePaginas
//         }" href="#">&gt;</a></li>`;
//
//         paginacionHTML += `<li class="page-item"><a class="page-link" aria-label="start" data-pagina="${finFinal}" href="#">&gt;&gt;</a></li>`;
//     } else {
//         for (let i = 1; i <= totalDePaginas; i++) {
//             paginacionHTML += `<li class="page-item ${
//                 i === paginaActual ? "active" : ""
//             }"><a class="page-link" data-pagina="${i}" href="#">${i}</a></li>`;
//         }
//     }
//
//     return paginacionHTML;
// }
//
// function agregarFila(data) {
//     const filaMolde = document.querySelector(".fila-molde");
//     const tbody = document.querySelector(".customtable");
//
//     const nuevaFila = filaMolde.cloneNode(true);
//     nuevaFila.classList.remove("fila-molde");
//     nuevaFila.style.display = "";
//
//     const mapeoPropiedades = {
//         ".id": "id",
//         ".nombre-solicitante": "nombreSolicitante",
//         ".tipo": "tipoSolicitante",
//         ".materia": "asignatura",
//         ".cantidad": "cantidad",
//     };
//
//     const fecha = data.fecha.split("-").reverse().join("/");
//     const horaRecibido = data.horaRecibido.slice(0, -3);
//     const horaEntrega = data.horaEntrega.slice(0, -3);
//
//     nuevaFila.querySelector(".fecha-solicitud").textContent = fecha;
//
//     nuevaFila.querySelector(
//         ".tiempo-prestacion"
//     ).textContent = `${horaRecibido} - ${horaEntrega}`;
//
//     const estadoElement = nuevaFila.querySelector(".estado");
//
//     estadoElement.innerHTML =
//         '<i class="fa-solid fa-circle fa-2xs my-auto mr-1"></i>' + data.estado;
//     estadoElement.classList.remove("activo", "finalizado", "pendiente");
//     estadoElement.classList.add(data.estado.toLowerCase());
//
//     Object.entries(mapeoPropiedades).forEach(([selector, propiedad]) => {
//         nuevaFila.querySelector(selector).textContent = propiedad.includes("-")
//             ? data[propiedad.split(" - ")[0]] +
//             " - " +
//             data[propiedad.split(" - ")[1]]
//             : data[propiedad];
//     });
//
//     //Configuracion de modales para cada fila
//
//     nuevaFila
//         .querySelector(".abrir-modal-editar")
//         .addEventListener("click", () => mostrarModalEditar(data));
//     nuevaFila
//         .querySelector(".abrir-modal-motivo")
//         .addEventListener("click", () => mostrarModalMotivo(data));
//     nuevaFila
//         .querySelector(".abrir-modal-cambiarEstado")
//         .addEventListener("click", () => mostrarModalCambiarEstado(data));
//     nuevaFila
//         .querySelector(".abrir-modal-eliminar")
//         .addEventListener("click", () => mostrarModalEliminar(data));
//
//     tbody.appendChild(nuevaFila);
// }
//
// function mostrarModalEditar(data) {
//     document.getElementById("id-editar").value = data.id;
//     tinymce.get("motivo-text").setContent(data.motivo);
//     document.getElementById("tipo").value = data.tipoSolicitante;
//     document.getElementById("asignatura").value = data.asignatura;
//     document.getElementById("horaRecibido").value = data.horaRecibido;
//     document.getElementById("horaEntrega").value = data.horaEntrega;
//     document.getElementById("cantidad").value = data.cantidad;
//     document.getElementById("fecha").value = data.fecha;
//     $("#editar").modal("show");
// }
//
// function mostrarModalMotivo(data) {
//     document.getElementById("id-editarMotivo").value = data.id;
//     tinymce.get("motivoText").setContent(data.motivo);
//     $("#motivo").modal("show");
// }
//
// function mostrarModalCambiarEstado(data) {
//     document.getElementById("id-estado").value = data.id;
//     $("#cambiarEstado").modal("show");
// }
//
// function mostrarModalEliminar(data) {
//     document.getElementById("id-eliminar").value = data.id;
//     $("#eliminar").modal("show");
// }
//
// function mostrarAlerta(data) {
//     swal({
//         title: data.status,
//         text: data.message,
//         icon: data.img,
//         button: "OK",
//     }).then((confirmed) => {
//         actualizarTabla(paginaActual);
//     });
// }
//
// function refrescar() {
//     location.reload();
// }
//
// async function filtrarPorEstado(estado) {
//     const busqueda = document.querySelector(".busqueda");
//     busqueda.value = estado;
//     document.getElementById("limpiarBusqueda").style.display = "";
//     await actualizarTabla(1, estado);
// }
//
// function generarTotalDeEntradas(totalDeEntradas) {
//     const textoDeEntradas = document.getElementById("entradasPorPagina");
//     let html = "";
//     const opciones = [10, 25, 50, 100];
//     for (let i = 0; i < opciones.length; i++) {
//         if (totalDeEntradas >= opciones[i]) {
//             html += `<option value="${opciones[i]}">${opciones[i]}</option>`;
//         }
//     }
//     textoDeEntradas.innerHTML = html;
//
//     const valorAlmacenado = localStorage.getItem("entradasPorPagina");
//
//     if (valorAlmacenado && opciones.includes(parseInt(valorAlmacenado))) {
//         textoDeEntradas.value = valorAlmacenado;
//     }
//
//     textoDeEntradas.addEventListener("change", function () {
//         const nuevoValor = this.value;
//         localStorage.setItem("entradasPorPagina", nuevoValor);
//
//         actualizarTabla(1);
//     });
// }
//
// function generarIconoFiltrado(IDElemento, columna) {
//     const padre = document.getElementById(IDElemento);
//     const busqueda = document.querySelector(".busqueda");
//
//     padre.addEventListener("click", async function (event) {
//         event.preventDefault();
//         const icono = padre.querySelector("i");
//         if (padreActual !== padre) {
//             if (padreActual && iconoActual) {
//                 iconoActual.classList.remove("fa-sort-up");
//                 iconoActual.classList.remove("fa-sort-down");
//                 iconoActual.classList.add("fa-sort");
//             }
//             padreActual = padre;
//             iconoActual = icono;
//         }
//
//         orden = "ASC";
//
//         if (icono.classList.contains("fa-sort-up")) {
//             icono.classList.remove("fa-sort");
//             icono.classList.remove("fa-sort-up");
//             icono.classList.add("fa-sort-down");
//             orden = "DESC";
//         } else if (icono.classList.contains("fa-sort-down")) {
//             icono.classList.remove("fa-sort-down");
//             icono.classList.add("fa-sort");
//         } else {
//             icono.classList.remove("fa-sort");
//             icono.classList.add("fa-sort-up");
//         }
//
//         localStorage.setItem(
//             "columna",
//             icono.classList.contains("fa-sort") ? "id" : columna
//         );
//         localStorage.setItem("orden", orden);
//         await actualizarTabla(paginaActual, busqueda.value);
//     });
// }
//
// function limpiarBusqueda() {
//     document.querySelector(".busqueda").value = "";
//     document.getElementById("limpiarBusqueda").style.display = "none";
//     actualizarTabla(1);
// }
