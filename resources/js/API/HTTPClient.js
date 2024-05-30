import {getConfigValue} from "./APIConfig.js";

export default class HTTPClient {
    static defaultHeaders = getConfigValue('defaultHeaders');
    static requestOptions = getConfigValue('requestOptions');

    static async get(endPoint) {
        return await fetch(endPoint, {
            method: 'GET',
            headers: this.defaultHeaders,
            credentials: this.requestOptions.Credentials,
        })
            .then(response => {
                const contentType = response.headers.get('content-type');
                if (contentType && contentType.includes('application/json')) {
                    return response.json();
                } else {
                    console.log(response.text());
                    return {data: [], links: {}, meta: {}};
                }
            })
            .catch(err => console.log('Ocurrio un error al obtener los datos', err));
    }

    static async post(endPoint, formData) {
        return await fetch(endPoint, {
            method: 'POST',
            headers: this.defaultHeaders,
            credentials: this.requestOptions.Credentials,
            body: JSON.stringify(Object.fromEntries(formData))
        }).then(response => {
            const contentType = response.headers.get('content-type');
            if (contentType && contentType.includes('application/json')) {
                return response.json();
            } else {
                console.log(response.text());
                return {};
            }
        })
            .catch(err => console.log('Ocurrio un error al guardar los datos', err));
    }

    static async put(endPoint, formData) {
        return await fetch(endPoint, {
            method: 'PUT',
            headers: this.defaultHeaders,
            credentials: this.requestOptions.Credentials,
            body: JSON.stringify(Object.fromEntries(formData))
        }).then(response => {
            const contentType = response.headers.get('content-type');
            if (contentType && contentType.includes('application/json')) {
                return response.json();
            } else {
                console.log(response.text());
                return {};
            }
        })
            .catch(err => console.log('Ocurrio un error al modificar los datos', err));
    }

    static async patch(endPoint, formData) {
        return await fetch(endPoint, {
            method: 'PATCH',
            headers: this.defaultHeaders,
            credentials: this.requestOptions.Credentials,
            body: JSON.stringify(Object.fromEntries(formData))
        }).then(response => {
            const contentType = response.headers.get('content-type');
            if (contentType && contentType.includes('application/json')) {
                return response.json();
            } else {
                console.log(response.text());
                return {};
            }
        })
            .catch(err => console.log('Ocurrio un error al modificar los datos', err));
    }

    static async delete(endPoint) {
        return await fetch(endPoint, {
            method: 'DELETE',
            headers: this.defaultHeaders,
            credentials: this.requestOptions.Credentials,
        }).then(response => {
            const contentType = response.headers.get('content-type');
            if (contentType && contentType.includes('application/json')) {
                return response.json();
            } else {
                console.log(response.text());
                return {};
            }
        })
            .catch(err => console.log('Ocurrio un error al eliminar los datos', err));
    }
}
