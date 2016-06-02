var registerForm;
var loginForm;
var indexURL = '/controller/IndexController.php';
var firstName;
var password;
var password_ver;
var password_ver_label;
var password_label;

$(document).ready(function () {

    registerForm = $('#register_form');
    loginForm = $('#login_form');
    // Form
    firstName = $('#first_name');
    password = $('#password');
    password_ver = $('#password_ver');
    password_label = $('#password_label');
    password_ver_label = $('#password_ver_label');


    //Validaton
    password.blur(function () {
        if(password.val().length <8) {
            password_label.text('Mínimo 8 caracteres');
            password_label.addClass('red-text');
        } else {
            password_label.text('Contraseña');
            password_label.removeClass('red-text');
        }
    });

    password_ver.blur(function () {
       if(password.val() != password_ver.val()){
           password_ver_label.text('Las contraseñas no coinciden');
           password_ver_label.addClass('red-text');
       } else {
           password_ver_label.text('Repita contraseña');
           password_ver_label.removeClass('red-text');
       }
    });

    registerForm.submit(function (e) {

        // Form validation
        if(password.val().length <8){
            Materialize.toast('La contraseña debe tener mínimo 8 caracteres', 3000);
            return false;
        } else if(password.val() != password_ver.val()){
            Materialize.toast('Las contraseñas no coinciden', 3000);
            return false;
        }

        e.preventDefault();
        $.ajax({
            url: indexURL,
            type: 'POST',
            data: {
                'choice': 'register',
                'form': registerForm.serialize()
            },
            success: function (data) {
                console.debug(data);
                var d = $.parseJSON(data);
                if(d.response === 'ok'){
                    document.location.href = d.action;
                } else {
                    Materialize.toast(d.message, 2500);
                }
            },
            error: function (data) {
                console.debug(data);
            }
        });
    });
    
    loginForm.submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: indexURL,
            type: 'POST',
            data: {
                'choice': 'login',
                'form': loginForm.serialize()
            },
            success: function (data) {
                var d = $.parseJSON(data);
                if(d.response === 'ok'){
                    window.location = d.location;
                } else Materialize.toast(d.message, 2000);
                    
            },
            error: function () {
                Materialize.toast('Ocurrió un error', 1000);
            }
        });
    });
});