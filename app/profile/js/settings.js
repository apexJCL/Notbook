var dataForm;
var accountForm;

$(document).ready(function () {
    dataForm = $('#profile_data_form');
    accountForm = $('#account_settings');

    dataForm.submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: app_url,
            type: 'POST',
            data: {
                'request': 'update_profile',
                'data': dataForm.serialize()
            },
            success: function (data) {
                var d = $.parseJSON(data);
                Materialize.toast(d.message, 2000);
            },
            error: function () {
                Materialize.toast('Sucedió un error, inténte más tarde',2000);
            }
        });
        return true;
    });

    accountForm.submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: app_url,
            type: 'POST',
            data: {
                'request': 'delete_account'
            },
            success: function (data) {
                var d = $.parseJSON(data);
                if(d.response === 'ok'){
                    document.location.href = "/";
                } else {
                    Materialize.toast(d.message, 3000);
                }
            },
            error: function () {
                Materialize.toast('Sucedió un error, intente más tarde');
            }
        });
        return true;
    });

    $('.collapsible').collapsible({
        accordion: false // A setting that changes the collapsible behavior to expandable instead of the default accordion style
    });
    $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 100, // Creates a dropdown of 15 years to control year
        formatSubmit: 'yyyy/mm/dd'
    });
});