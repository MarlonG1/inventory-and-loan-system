import {buildRoute} from "./RouteBuilder.js";

export default class LicenciaAPI {

    endPointName = 'licencias';

    constructor(httpClient) {
        this.httpClient = httpClient;
    }

    async getLicencias(filters = '') {
        const route = buildRoute(this.endPointName, null, filters);
        return this.httpClient.get(route);
    }

    async getLicenciaByd(id, filters = '') {
        const route = buildRoute(this.endPointName, id, filters);
        return this.httpClient.get(route);
    }

    async postLicencia(formData) {
        const route = buildRoute(this.endPointName);
        return this.httpClient.post(route, formData)
    }

    async putLicencia(id, formData) {
        const route = buildRoute(this.endPointName, id);
        return this.httpClient.put(route, formData)
    }

    async patchLicencia(id, formData) {
        const route = buildRoute(this.endPointName, id);
        return this.httpClient.patch(route, formData)
    }

    async deleteLicencia(id) {
        const route = buildRoute(this.endPointName, id);
        return this.httpClient.delete(route);
    }

    // async assingEquipoIntoPrestamo(idPrestamo, otherInfo) {
    //     if (Array.isArray(otherInfo)) {
    //         await this.assingEquipoByPOS(idPrestamo, otherInfo);
    //     } else {
    //         await this.assingEquipoByForm(idPrestamo, otherInfo)
    //     }
    // }
    //
    // async assingEquipoByPOS(idPrestamo, selectedEquipo) {
    //     for (let i = 1; i <= selectedEquipo.length; i++) {
    //         let idEquipo = selectedEquipo[i - 1].id;
    //         await this.setEquipoToPrestamo(idEquipo, idPrestamo)
    //     }
    // }
    //
    // async assingEquipoByForm(idPrestamo, equiposContainer) {
    //     equiposContainer.forEach(equipo => {
    //         let idEquipo = equipo.value;
    //         this.setEquipoToPrestamo(idEquipo, idPrestamo)
    //     });
    // }
    //
    // async setEquipoToPrestamo(idEquipo, idPrestamo) {
    //     try {
    //         let formData = new FormData();
    //         formData.set('prestamoId', idPrestamo);
    //         formData.set('estado', 'Ocupado');
    //         await this.patchEquipo(idEquipo, formData)
    //     } catch (e) {
    //         console.log(e)
    //     }
    // }
}

