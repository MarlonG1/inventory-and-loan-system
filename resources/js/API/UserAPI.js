import {buildRoute} from "./RouteBuilder.js";

export default class UserAPI {

    endPointName = 'users';

    constructor(httpClient) {
        this.httpClient = httpClient;
    }

    async getUsers(filters = '') {
        const route = buildRoute(this.endPointName, null, filters);
        return this.httpClient.get(route);
    }

    async getUserById(id, filters = '') {
        const route = buildRoute(this.endPointName, filters, id);
        return this.httpClient.get(route);
    }

    async postUser(formData) {
        const route = buildRoute(this.endPointName);
        return this.httpClient.post(route, formData)
    }

    async putUser(id, formData) {
        const route = buildRoute(this.endPointName, id);
        return this.httpClient.put(route, formData)
    }

    async patchUser(id, formData) {
        const route = buildRoute(this.endPointName, id);
        return this.httpClient.patch(route, formData)
    }

    async deleteUser(id) {
        const route = buildRoute(this.endPointName, id);
        return this.httpClient.delete(route);
    }

    async deleteUserWithPrestamos(id) {
        const route = buildRoute('users/destroy-with-prestamos', id, "");
        return this.httpClient.get(route);
    }
}

