var app_url = '/app/admin/Admin.php';
var dataOutput;

$(document).ready(function () {

    dataOutput = $('#data_display');

   $('.logout').click(function () {
       $.ajax({
           url: app_url,
           type: 'POST',
           data: {
               'request': 'logout'
           },
           success: function (data) {
               var d = $.parseJSON(data);
               if (d.response === 'ok') {
                   if (d.redirect == 'true')
                       document.location.href = "/";
               }
           },
           error: function () {
               Materialize.toast('Cerrando sesión', 1000);
           }
       });
   });

    $('.stats').on('click', function () {
       showStats();
    });

    $('.accounts').on('click', function () {
       manageAccounts();
    });

    hashLocation((window.location.hash).replace('#','').split('#'));

});

function showStats() {
    $.ajax({
        url: app_url,
        type: 'POST',
        data: {
            'request': 'stats'
        },
        success: function (data) {
            var d = $.parseJSON(data);
            if(d.response === 'ok')
                updateOutput(d.data);
            else
                Materialize.toast(d.message, 3000);
        },
        error: function () {
            Materialize.toast('Sucedió un error', 2000);
        }
    });
}

function manageAccounts() {
    $.ajax({
        url: app_url,
        type: 'POST',
        data: {
            'request': 'accounts'
        },
        success: function (data) {
            var d = $.parseJSON(data);
            if(d.response === 'ok')
                updateOutput(d.data);
            else
                Materialize.toast(d.message, 3000);
        },
        error: function () {
            Materialize.toast('Sucedió un error', 2000);
        }
    });
}


function updateOutput(data) {
    dataOutput.fadeOut('fast', function () {
        dataOutput.html(data);
        $('pre code').each(function(i, block) {
            hljs.highlightBlock(block);
        });
        dataOutput.fadeIn('fast');
    });
}

function hashLocation(url){
    switch (url[0]){
        case 'stats':
            showStats();
            return true;
        case 'accounts':
            manageAccounts();
            return true;
    }
    showStats();
}