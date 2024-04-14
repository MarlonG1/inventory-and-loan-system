document.addEventListener("DOMContentLoaded", async function () {
    const lastYear = `${new Date().getFullYear() - 1}-12-31`;
    const currentYear = `${new Date().getFullYear() + 1}-01-01`

    const apiRoutes = [
        fetch(`/api/v1/prestamos?includeAll=true&fechaPrestamo[gt]=${lastYear}&fechaPrestamo[lt]=${currentYear}`),
        fetch('/api/v1/equipos'),
        fetch('/api/v1/licencias'),
    ];

    try {
        const res = await Promise.all(apiRoutes);
        const data = await Promise.all(res.map((item) => {
            return item.json();
        }));

        const dataProcessed = {
            'prestamos': data[0],
            'equipos': data[1],
            'licencias': data[2],
        }

        console.log(dataProcessed.prestamos)

        const cardHeadersValue = {
            totalEquipos: dataProcessed.equipos.meta.total,
            totalLicencias: dataProcessed.licencias.meta.total,
        };

        setCardsValues(cardHeadersValue);
        actualizarInformacion(dataProcessed.prestamos)
    } catch (e) {
        console.log('Algo salio mal: ' + e)
    }
});

function setCardsValues(headers) {
    document.getElementById("totalEquipos").innerText = headers.totalEquipos;
    document.getElementById("totalLicencias").innerText = headers.totalLicencias;
}

function actualizarInformacion(prestamos) {
    setPrestamoStatusPieChart(prestamos.otherInformation);
    setPrestamoTimeLineByWeek(prestamos.data);
    setPrestamoTimeLineByMonth(prestamos.data);
}

function setPrestamoStatusPieChart(datadb) {
    var datos = {
        labels: [
            `Activos ${datadb.totalDeActivos}`,
            `Pendientes ${datadb.totalDePendientes}`,
            `Finalizados ${datadb.totalDeFinalizados}`,
        ],
        datasets: [
            {
                label: "Cantidad",
                data: [
                    datadb.totalDeActivos,
                    datadb.totalDePendientes,
                    datadb.totalDeFinalizados,
                ],
                backgroundColor: ["#23bd5a", "#767d79", "#d95858"],
            },
        ],
    };

    new Chart(document.getElementById("graficaDePrestamos"), {
        type: "pie",
        data: datos,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: "top",
                },
                title: {
                    display: true,
                    text: "Total de prestamos",
                },
            },
        },
    });
}

function setPrestamoTimeLineByMonth(datadb) {
    const labels = [
        "Enero",
        "Febrero",
        "Marzo",
        "Abril",
        "Mayo",
        "Junio",
        "Julio",
        "Agosto",
        "Septiembre",
        "Octubre",
        "Noviembre",
        "Diciembre",
    ];

    const currentYear = new Date().getFullYear();

    const prestamos = Array.from({length: 12}, (_, index) => {
        return datadb.filter((prestamo) => {
            const fechaPrestamo = new Date(prestamo.fecha_prestamo);
            return fechaPrestamo.getFullYear() === currentYear && fechaPrestamo.getMonth() === index;
        }).length;
    });


    const data = {
        labels: labels,
        datasets: [
            {
                label: "Prestamos",
                data: prestamos,
                borderColor: ["#9a2323"],
                backgroundColor: ["#700e0e"],
            },
        ],
    };

    const config = {
        type: "line",
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: "top",
                },
                title: {
                    display: true,
                    text: "Prestamos realizados por mes",
                },
            },
        },
    };


    new Chart(document.getElementById("graficaDePrestamosPorMes"), config);
}

function setPrestamoTimeLineByWeek(datadb) {
    const labels = [
        "Lunes",
        "Martes",
        "Miercoles",
        "Jueves",
        "Viernes",
        "Sabado",
        "Domingo",
    ];

    const currentDate = new Date();
    const currentDayOfWeek = currentDate.getUTCDay();
    const startOfWeek = new Date(Date.UTC(currentDate.getUTCFullYear(), currentDate.getUTCMonth(),
        currentDate.getUTCDate() - (currentDayOfWeek === 0 ? 6 : currentDayOfWeek - 1)));

    const prestamos = Array.from({length: 7}, (_, index) => {
        const dayOfWeekStart = new Date(startOfWeek.getTime() + index * 24 * 60 * 60 * 1000);
        const dayOfWeekEnd = new Date(dayOfWeekStart.getTime() + 24 * 60 * 60 * 1000 - 1);
        return datadb.filter((prestamo) => {
            const fechaPrestamo = new Date(prestamo.fecha_prestamo);
            return (
                fechaPrestamo >= dayOfWeekStart &&
                fechaPrestamo <= dayOfWeekEnd
            );
        }).length;
    });

    const data = {
        labels: labels,
        datasets: [
            {
                label: "Prestamos",
                data: prestamos,
                backgroundColor: ["#9a2323"],
            },
        ],
    };

    const config = {
        type: "bar",
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: "top",
                },
                title: {
                    display: true,
                    text: "Prestamos realizados por semana",
                },
            },
        },
    };
    new Chart(document.getElementById("graficaDePrestamosPorSemana"), config);
}
