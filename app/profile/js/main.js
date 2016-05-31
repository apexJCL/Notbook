var app_url = '/app/profile/UserProfile.php';
var form = null;
var contentDisplay = null;
var new_note_modal = null;
var fab = null;
var editor = null;
var listener;
var actualNote = null;

$(document).ready(function () {
    
    form = $('#new-notbook-form');
    contentDisplay = $('#contentDisplay');
    new_note_modal = $('#new_notbook_modal');
    fab = $('.fixed-action-btn');

    listener = new window.keypress.Listener();

    listener.simple_combo("alt s", function () {
        if($('#editor').length)
            saveNotbook();
        return false;
    });

    listener.simple_combo("alt c", function () {
        if($('#editor').length)
            closeNotbook();
        return false;
    });

    listener.simple_combo("alt n", function () {
        new_note_modal.openModal();
        return false;
    });

    $('.modal-trigger').leanModal();

    form.submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: app_url,
            type: 'POST',
            data: {
                'request': 'new-notbook',
                'settings': form.serialize()
            },
            success: function (data) {
                var d = $.parseJSON(data);
                if(d.response === 'ok'){
                    edit(d.nid);
                }
            },
            error: function (data) {
                alert('Ocurrió un error :(');
            }
        });
        new_note_modal.closeModal();
        fab.closeFAB();
        form.trigger("reset");
    });

    $('.my-notbooks').click(showNotbooks);

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

    $('#settings').click(function () {
        $.ajax({
            url: app_url,
            type: 'POST',
            data: {
                'request': 'settings'
            },
            success: function (data) {
                var d = $.parseJSON(data);
                if(d.response === 'ok'){
                    content_switch(d.data);
                }
            },
            error: function () {
                alert('Error :(');
            }
        });
    });
    hashLocation((window.location.hash).replace('#','').split('#'));
});

function showNotbooks() {
    $.ajax({
        url: app_url,
        type: 'POST',
        data: {
            'request': 'notbooks'
        },
        success: function (data) {
            var d = $.parseJSON(data);
            if (d.response === 'ok') {
                content_switch(d.data);
            }
        },
        error: function () {
            Materialize.toast('Sucedió un error mostrando sus ¬books', 5000);
        }
    });
}

function content_switch(data) {
    contentDisplay.slideUp('fast', function () {
        contentDisplay.html(data);
        contentDisplay.slideDown('fast');
    });
    fab.closeFAB();
}

function deleteNotbook(nid) {
    $.ajax({
        url: app_url,
        type: 'POST',
        data: {
            'request': 'delete_notbook',
            'nid': nid
        },
        success: function (data) {
            var d = $.parseJSON(data);
            Materialize.toast(d.message, 1000);
        },
        error: function () {
            Materialize.toast('Ha ocurrido un error', 1000);
        }
    });
    showNotbooks();
}

function edit(id) {
    actualNote = id;
    $.ajax({
        url: app_url,
        type: 'POST',
        data:{
            'request': 'edit',
            'nid': id
        },
        success: function (data) {
            var d = $.parseJSON(data);
            if(d.response === 'ok')
                content_switch(d.data);
            else
                Materialize.toast(d.message, 2000);
        },
        error: function (data) {
            alert(data)
        }
    });
}

function hashLocation(url){
    switch (url[0]){
        case 'edit':
            if((url.length - 1) > url.indexOf('edit')){
                edit(url[1]);
                actualNote = url[1];
            }
            break;
        default:
        case 'notbooks':
            showNotbooks();
            break;
    }
}