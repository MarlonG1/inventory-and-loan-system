import Swal from 'sweetalert2';

export default class Alerts {
    Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });

    constructor(compositeProcesses) {
        this.compositeProcesses = compositeProcesses;
    }

    showToastAlert(data) {
        this.Toast.fire({
            icon: data.icon,
            title: data.title,
            text: data.text,
        });
    }
}
