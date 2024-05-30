import {buildRoute} from "./RouteBuilder.js";

export default class MessagesAPI {
    constructor(httpClient) {
        this.httpClient = httpClient;
    }

    async sendInformationMail(idPrestamo){
        const route = buildRoute('send/informationEmail', idPrestamo);
        return this.httpClient.get(route);
    }
}
