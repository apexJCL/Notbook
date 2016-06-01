var commentDisplay;
var letterCounter;
var commentForm;
var comment;
var max_letters = 200;
var actualNote;

$(document).ready(function () {

    commentForm = $('#comment_form');
    commentDisplay = $('#comments');
    comment = $('#comment');
    letterCounter = $('#letter_counter');
    letterCounter.html(max_letters);
    actualNote = window.location.pathname.replace("/view/nid=", "");

    $('pre code').each(function (i, block) {
        hljs.highlightBlock(block);
    });

    commentForm.submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: '/app/viewer/Viewer.php',
            type: 'POST',
            data: {
                'request': 'comment',
                'data': comment.val(),
                'nid': actualNote
            },
            success: function (data) {
                var d = $.parseJSON(data);
                if(d.response === 'ok')
                    updateOutput(d.data);
                Materialize.toast(d.message);
            }
        });
    });

    $('.logout').click(function () {
        $.ajax({
            url: '/app/profile/UserProfile.php',
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

    comment.on('keydown', function (e) {
        if(e.keyCode === 8)
            return true;
        else
            return (comment.val().length+1 <= max_letters);
    });

    comment.on('keyup', function () {
        letterCounter.html(max_letters - (comment.val().length));
    });



});

function updateOutput(data) {
    commentDisplay.fadeOut('fast', function () {
        commentDisplay.html(data);
        $('pre code').each(function(i, block) {
            hljs.highlightBlock(block);
        });
        commentDisplay.fadeIn('fast');
    });
}