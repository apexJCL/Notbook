$(document).ready(function () {

    var app_url = '/app/profile/UserProfile.php';

    $('.my-notbooks').click(function () {
        $.ajax({
            url: app_url,
            type: 'POST',
            data: {
                'action': 'request',
                'request': 'notbooks'
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

    $('#logout').click(function () {
        $.ajax({
            url: app_url,
            type: 'POST',
            data: {
                'action': 'request',
                'request': 'logout'
            },
            success: function (data) {
                var d = $.parseJSON(data);
                if(d.response === 'ok'){
                    if(d.redirect == 'true')
                        document.location.href="/";
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
                'action': 'request',
                'request': 'settings'
            },
            success: function (data) {
                console.debug(data);
            },
            error: function () {
                alert('Error :(');
            }
        });
    });

    function content_switch(data) {
        $('#contentDisplay').slideUp('fast', function () {
            $("#contentDisplay").html(data);
            $("#contentDisplay").slideDown('fast');
        });
        $("#contentDisplay").offset().top;
    }
});