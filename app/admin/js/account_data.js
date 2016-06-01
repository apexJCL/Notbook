var profileDataForm;
var accountDataForm;

$(document).ready(function () {
    
    profileDataForm =$('#profile_data_form');
    accountDataForm = $('#account_data_form');
    
    $('.collapsible').collapsible({
        accordion: false // A setting that changes the collapsible behavior to expandable instead of the default accordion style
    });

    $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 100, // Creates a dropdown of 15 years to control year
        formatSubmit: 'yyyy/mm/dd'
    });

    profileDataForm.submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: app_url,
            type: 'POST',
            data: {
                'request': 'profile_update',
                'data': profileDataForm.serialize()
            },
            success: function (data) {
                var d = $.parseJSON(data);
                if(d.response === 'ok')
                    updateAccountSearch('');
                Materialize.toast(d.message, 2000);
            },
            error: function () {
                Materialize.toast('Ocurrió un error en el servidor', 2000);
            }
        });
    });

    accountDataForm.submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: app_url,
            type: 'POST',
            data: {
                'request': 'account_update',
                'data': accountDataForm.serialize()
            },
            success: function (data) {
                var d = $.parseJSON(data);
                if(d.response === 'ok')
                    updateAccountSearch('');
                Materialize.toast(d.message, 2000);
            },
            error: function () {
                Materialize.toast('Ocurrió un error en el servidor', 2000);
            }
        });
    });
});


function deleteAccount(aid) {
    $.ajax({
        url: app_url,
        type: 'POST',
        data: {
            'request': 'delete_account',
            'aid': aid
        },
        success: function (data) {
            var d = $.parseJSON(data);
            if(d.response === 'ok'){
                updateAccountSearch('');
            }
            Materialize.toast(d.message, 2000);
        }
    });
}