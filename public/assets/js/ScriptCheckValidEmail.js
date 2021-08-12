$(document).ready(function () {
    const baseUrl = "http://127.0.0.1:8000/";
    $('#register_email').blur(function () {
        const error_email = '';
        const email = $('#register_email').val();
        const _token = $('input[name="_token"]').val();
        const filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

        if (!filter.test(email)) {
            $('#register_email').addClass('is-invalid');
            $('#register_email_field').addClass('invalid-feedback');
            $('#register_email_field').html('Email Format Wrong');
            $('#register_submit').attr('disabled', 'disabled');
        } else {
            $.ajax({
                url: baseUrl + "register/checkemail",
                method: "POST",
                data: { register_email: email, _token: _token },
                success: function (result) {
                    if (result == true) {
                        $('#register_email').removeClass('is-invalid');
                        $('#register_submit').attr('disabled', false);
                    } else {
                        $('#register_email').addClass('is-invalid');
                        $('#register_email_field').addClass('invalid-feedback');
                        $('#register_email_field').html('Email Not Available');
                        $('#register_submit').attr('disabled', 'disabled');
                    }
                }
            });
        }
    });

    $('#login_email').blur(function () {
        const error_email = '';
        const email = $('#login_email').val();
        const filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

        if (!filter.test(email)) {
            $('#login_email').addClass('is-invalid');
            $('#login_email_field').addClass('invalid-feedback');
            $('#login_email_field').html('Email Format Wrong');
            $('#login_submit').attr('disabled', 'disabled');
        } else {
            $('#login_email').removeClass('is-invalid');
            $('#login_submit').attr('disabled', false);
        }
    });
});