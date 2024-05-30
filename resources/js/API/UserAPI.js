import {buildRoute} from "./RouteBuilder.js";

export default class UserAPI {

    endPointName = 'users';

    constructor(httpClient) {
        this.httpClient = httpClient;
    }

    async getEquipos(filters = '') {
        const route = buildRoute(this.endPointName, null, filters);
        return this.httpClient.get(route);
    }

    async getEquipoById(id, filters = '') {
        const route = buildRoute(this.endPointName, filters, id);
        return this.httpClient.get(route);
    }

    async postEquipo(formData) {
        const route = buildRoute(this.endPointName);
        return this.httpClient.post(route, formData)
    }

    async putEquipo(id, formData) {
        const route = buildRoute(this.endPointName, id);
        return this.httpClient.put(route, formData)
    }

    async patchEquipo(id, formData) {
        const route = buildRoute(this.endPointName, id);
        return this.httpClient.patch(route, formData)
    }

    async deleteEquipo(id) {
        const route = buildRoute(this.endPointName, id);
        return this.httpClient.delete(route);
    }

    async assingEquipoIntoPrestamo(idPrestamo, otherInfo){
        if (Array.isArray(otherInfo)){
            await this.assingEquipoByPOS(idPrestamo, otherInfo);
        } else {
            await this.assingEquipoByForm(idPrestamo, otherInfo)
        }
    }

    async assingEquipoByPOS(idPrestamo, selectedEquipo) {
        for (let i = 1; i <= selectedEquipo.length; i++) {
            let idEquipo = selectedEquipo[i].id;
            await setEquipoToPrestamo(idEquipo, idPrestamo)
        }
    }

    async assingEquipoByForm(idPrestamo, equipoCount) {
        for (let i = 1; i <= equipoCount; i++) {
            let idEquipo = document.getElementById(`equipo${i}`).value;
            await this.setEquipoToPrestamo(idEquipo, idPrestamo)
        }
    }

    async setEquipoToPrestamo(idEquipo, idPrestamo) {
        try {
            let formData = new FormData();
            formData.set('prestamoId', idPrestamo);
            formData.set('estado', 'Ocupado');

            return this.patchEquipo(idEquipo, formData)
        } catch (e){
            console.log(e)
        }
    }
}

