var accountSearchForm;
var accountSearchOutput;
var accountPager;
var index = 1;
var max_index;

$(document).ready(function () {

    accountSearchForm = $('#search_account_form');
    accountSearchOutput = $('#account_search_output');
    accountPager = $('#account_pager');

    max_index = Math.ceil(parseFloat($('#account_counter').html()) / 5);

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

    $('#pager'+index).addClass('active');
});


function updateAccountSearch(data) {
    accountSearchOutput.fadeOut('fast', function () {
        accountSearchOutput.html(data);
        accountSearchOutput.fadeIn('fast');
    });
}

function updateAccountPager(data) {
    accountPager.fadeOut('fast', function () {
        accountPager.html(data);
        accountPager.fadeIn('fast');
    });
}

function accountPage(id) {
    $('#pager'+index).removeClass('active');
    index = id;
    $('#pager'+id).addClass('active');
    // Change
    $.ajax({
        url: '/app/admin/Admin.php',
        type: 'POST',
        data: {
            'request': 'account_page',
            'page': index-1
        },
        success: function (data) {
            var d = $.parseJSON(data);
            if(d.response === 'ok')
                updateAccountPager(d.data);
            else Materialize.toast(d.message, 1000);
        }
    });
    return true;
}

function prevPage() {
    if(index-1 > 0){
        accountPage(index-1);
    }
}

function nextPage() {
    if(index+1 <= max_index){
        accountPage(index+1);
    }
}

function showAccount(id) {
    $.ajax({
        url: '/app/admin/Admin.php',
        type: 'POST',
        data: {
            'request': 'search_account',
            'id': id
        },
        success: function (data) {
            var d = $.parseJSON(data);
            if(d.response === 'ok'){
                Materialize.toast('Cuenta encontrada', 2000);
                updateAccountSearch(d.data);
            }
            else
                Materialize.toast(d.message, 2000);
        },
        error: function () {
            Materialize.toast('Error en el servidor', 2000);
        }
    });
}