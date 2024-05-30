import {buildRoute} from "./RouteBuilder.js";

export default class PrestamoAPI{

    endPointName = 'prestamos';
    constructor(httpClient) {
        this.httpClient = httpClient;
    }
    async getPrestamos(filters = ''){
        const route = buildRoute(this.endPointName, null, filters);
        return this.httpClient.get(route);
    }
    async getPrestamoById(id, filters = ''){
        const route = buildRoute(this.endPointName, filters, id);
        return this.httpClient.get(route);
    }
    async postPrestamo(formData){
        const route = buildRoute(this.endPointName);
        return this.httpClient.post(route, formData)
    }
    async putPrestamo(id, formData){
        const route = buildRoute(this.endPointName, id);
        return this.httpClient.put(route, formData)
    }
    async patchPrestamo(id, formData){
        const route = buildRoute(this.endPointName, id);
        return this.httpClient.patch(route, formData)
    }
    async deletePrestamo(id){
        const route = buildRoute(this.endPointName, id);
        return this.httpClient.delete(route);
    }
}

