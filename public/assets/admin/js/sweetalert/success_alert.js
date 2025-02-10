function showAlert(type, message) {
    Swal.fire({
        icon: type, // 'success' or 'error'
        title: type === 'success' ? 'Success!' : 'Error!',
        text: message,
        timer: 2000,
        showConfirmButton: false,
    });
}
