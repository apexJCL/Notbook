var app_url = '/app/profile/UserProfile.php';
var form = null;
var contentDisplay = null;
var new_note_modal = null;
var fab = null;

$(document).ready(function () {

    form = $('#new-notbook-form');
    contentDisplay = $('#contentDisplay');
    new_note_modal = $('#modal1');
    fab = $('.fixed-action-btn');

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
                console.debug(data);
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
                alert('Error :(');
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
            alert('Error :(');
        }
    });
}

function content_switch(data) {
    contentDisplay.slideUp('fast', function () {
        contentDisplay.html(data);
        contentDisplay.slideDown('fast');
        contentDisplay.offset().top;
    });
    fab.closeFAB();
}

function edit(id) {
    $.ajax({
        url: app_url,
        type: 'POST',
        data:{
            'request': 'edit',
            'nid': id
        },
        success: function (data) {
            console.debug(data);
            var d = $.parseJSON(data);
            if(d.response === 'ok')
                content_switch(d.data);
            else
                alert(d.message);
        },
        error: function (data) {
            alert(data)
        }
    });
}