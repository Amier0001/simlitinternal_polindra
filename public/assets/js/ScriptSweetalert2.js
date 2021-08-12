const icon = $('#flash-alert').data('flashalerticon');
const alert = $('#flash-alert').data('flashalert');
const subalert = $('#flash-alert').data('flashsubalert');

if (alert) {
    Swal.fire({
        title: alert,
        text: subalert,
        icon: icon,
        confirmButtonText: 'Ok'
    })
}
