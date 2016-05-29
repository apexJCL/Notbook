$(document).ready(function () {

    $("#register_form").validate({
        rules: {
            password: {
                required: true,
                minlength: 8
            },
            password_ver: {
                equalTo: '#password'
            },
            email: {
                required: true,
                email: true
            },
            name: {
                required: true
            },
            last_name:{
                required: true
            }
        },
        messages: {
            password: {
                minlength: "Longitud mínima: 8 caracteres"
            },
            password_ver: "Las contraseñas no coinciden",
            email: "Ingrese un correo válido",
            name: "Ingrese su nombre",
            last_name: "Ingrese su apellido"
        }
    });

    $('#register_form').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: '/controller/IndexController.php',
            type: 'POST',
            data: {
                'choice': 'register',
                'form': $('#register_form').serialize()
            },
            success: function (data) {
                var d = $.parseJSON(data);
                if(d.response === 'ok'){
                    document.location.href = d.action;
                } else {
                    $('#register-title').text(d.message);
                }
            },
            error: function (data) {
                console.debug(data);
            }
        });
    });
});