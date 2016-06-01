var noteTitle;
var editorInput;
var editorOutput;
var viewTab;
var private_checkbox;
var changes = null;

$(document).ready(function () {

    editorInput = $('#unparsed');
    editorOutput = $('#editorOutput');
    noteTitle = $('#title');
    viewTab = $('#tabviewer');
    editor = $('#editor');
    private_checkbox = $('#private_attribute');
    
    listener.simple_combo("alt p", function () {
        if($('#editor').length) {
            updateData();
        }
    });

    listener.simple_combo("alt v", function () {
        if($('#editor').length){
            $('ul.tabs').tabs('select_tab', 'notviewer');
        }
    });

    listener.simple_combo("alt e", function () {
        if($('#editor').length){
            $('ul.tabs').tabs('select_tab', 'noteditor');
            editorInput.focus();
            return false;
        }
    });

    $('#pdf').on('click', function () {
        $.ajax({
            url: app_url,
            type: 'POST',
            data: {
                'request': 'html2pdf',
                'nid': actualNote
            },
            success: function (data) {
                var d = $.parseJSON(data);
                Materialize.toast(d.message, 1000);
                if(d.response === 'ok')
                    window.open(window.location.origin+d.url);
            },
            error: function () {
                Materialize.toast('Ocurrió un error en el servidor');
            }
        });
    });

    
    private_checkbox.change(function () {
        $.ajax({
            url: app_url,
            type: 'POST',
            data:{
                'request': 'update_private_status',
                'status': private_checkbox[0].checked,
                'nid': actualNote
            },
            success: function (data) {
                console.debug(data);
                var d = $.parseJSON(data);
                Materialize.toast(d.message, 1000);
            }
        });
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

    viewTab.on('click', function () {
        updateData();
    });

    $(document).ready(function(){
        $('ul.tabs').tabs();
    });

});

function updateOutput(data) {
    editorOutput.html(data);
    $('pre code').each(function(i, block) {
        hljs.highlightBlock(block);
    });
}

function saveNotbook() {
    $.ajax({
        url: app_url,
        type:'POST',
        data: {
            'request': 'save_notbook',
            'nid': actualNote,
            'data': editorInput.val(),
            'title': noteTitle.val()
        },
        success: function (data) {
            var d = $.parseJSON(data);
            if(d.response === 'ok'){
                Materialize.toast('¬book guardado exitosamente', 2000);
            } else {
                alert(d.message);
            }
        }
    });
}

function updateData() {
    $.ajax({
        url: app_url,
        type: 'POST',
        data: {
            'request': 'parse',
            'data': editorInput.val(),
            'nid': actualNote,
            'title': noteTitle.val()
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