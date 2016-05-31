<div class="section fullscreen" id="editor">

    <div class="row">
        <div class="col s12">
            <ul class="tabs">
                <li class="tab col s3 waves-effect"><a class="active" href="#noteditor">Editor</a></li>
                <li class="tab col s3 waves-effect"><a id="tabviewer" href="#notviewer">Vista Procesada</a></li>
                <!--
                <li class="tab col s3 disabled"><a href="#test3">Disabled Tab</a></li>
                <li class="tab col s3"><a href="#test4">Test 4</a></li>
                -->
            </ul>
        </div>
        <div id="noteditor" class="col s12">
            <div class="col s12">
                <div class="container">
                <span>
                    <label for="title">Título</label>
<textarea name="title" maxlength="100" id="title" cols="30" rows="1" contenteditable="false" class="materialize-textarea">{$notbook->title}</textarea>
                </span>
                <span>
                    <label for="content">Cuerpo</label>
<textarea name="unparsed" id="unparsed" cols="50" rows="10" contenteditable="true" class="materialize-textarea">{$notbook->unparsed}</textarea>
                </span>
                </div>
            </div>
        </div>
        <div id="notviewer" class="col s12">
            <div id="editorOutput">
                {$notbook->parsed}
            </div>
        </div>
    </div>
</div>
<!-- Scripts -->
<script src="/app/profile/js/editor.js"></script>
