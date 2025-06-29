function toast(mensaje) {
    var toastEl = document.getElementById('mensaje');
    toastEl.querySelector('.toast-body').textContent = mensaje;
    var toast = new bootstrap.Toast(toastEl);
    toast.show();
}