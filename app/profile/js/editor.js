var editorInput;
var editorOutput;
var changes = null;

$(document).ready(function () {

    editorInput = $('#unparsed');
    editorOutput = $('#editorOutput');

    editor = $('#editor');
    
    listener.simple_combo("alt p", function () {
        if($('#editor').length) {
            $.ajax({
                url: app_url,
                type: 'POST',
                data: {
                    'request': 'parse',
                    'data': editorInput.val(),
                    'nid': actualNote
                },
                success: function (data) {
                    var d = $.parseJSON(data);
                    if (d.response === 'ok')
                        updateOutput(d.data);
                    else alert(d.message);
                },
                error: function () {
                    Materialize.toast('Ha ocurrido un error', 2000);
                }
            });
        }
    });

    editorInput.keydown(function(e) {
        if(e.keyCode === 9) { // tab was pressed
            // get caret position/selection
            var start = this.selectionStart;
            var end = this.selectionEnd;

            var $this = $(this);
            var value = $this.val();

            // set textarea value to: text before caret + tab + text after caret
            $this.val(value.substring(0, start)
                + "\t"
                + value.substring(end));

            // put caret at right position again (add one for the tab)
            this.selectionStart = this.selectionEnd = start + 1;

            // prevent the focus lose
            e.preventDefault();
        }
    });

});

function updateOutput(data) {
    editorOutput.slideUp('fast', function () {
        editorOutput.html(data);
        $('pre code').each(function(i, block) {
            hljs.highlightBlock(block);
        });
        editorOutput.slideDown('fast');
    });
}

function saveNotbook() {
    $.ajax({
        url: app_url,
        type:'POST',
        data: {
            'request': 'save_notbook',
            'nid': actualNote,
            'data': editorInput.val()
        },
        success: function (data) {
            console.debug(data);
            var d = $.parseJSON(data);
            if(d.response === 'ok'){
                Materialize.toast('¬book guardado exitosamente', 2000);
            } else {
                alert(d.message);
            }
        }
    });
}