import Swal from "sweetalert2";

export default class CompositeProcesses {
    constructor(prestamoAPI, equipoAPI, messagesAPI) {
        this.prestamoAPI = prestamoAPI;
        this.equipoAPI = equipoAPI;
        this.messagesAPI = messagesAPI;
    }

    async createNewPrestamo(formData, otherInfo) {
        const response = await this.prestamoAPI.postPrestamo(formData);
        await this.equipoAPI.assingEquipoIntoPrestamo(response.data.id, otherInfo);
        this.showAlertInformationMail(response.data.id);
    }

    showAlertInformationMail(id) {
        Swal.fire({
            title: 'Cargando...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
                this.messagesAPI.sendInformationMail(id)
                    .then(data => {
                        Swal.close();
                        Swal.fire({
                            icon: data.icon,
                            title: data.title,
                            text: data.text,
                        });
                    })
                    .catch(error => {
                        Swal.close();
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Algo salio mal',
                        });
                    });
            }
        });
    }

}
