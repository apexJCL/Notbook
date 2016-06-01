var accountSearchForm;
var accountSearchOutput;

$(document).ready(function () {

    accountSearchForm = $('#search_account_form');
    accountSearchOutput = $('#account_search_output');

    accountSearchForm.submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: app_url,
            type: 'POST',
            data: {
                'request': 'search_account',
                'form': accountSearchForm.serialize()
            },
            success: function (data) {
                var d = $.parseJSON(data);
                if(d.response === 'ok') {
                    Materialize.toast('Cuenta encontrada', 1000);
                    updateAccountSearch(d.data);
                }
                else
                    Materialize.toast(d.message, 2000);
            },
            error: function () {
                Materialize.toast('Sucedió un error en el servidor', 2000);
            }
        });
    });

});


function updateAccountSearch(data) {
    accountSearchOutput.fadeOut('fast', function () {
        accountSearchOutput.html(data);
        $('pre code').each(function(i, block) {
            hljs.highlightBlock(block);
        });
        accountSearchOutput.fadeIn('fast');
    });
}