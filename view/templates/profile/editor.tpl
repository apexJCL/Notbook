<div class="section fullscreen" id="editor">

    <div class="row">
        <div class="col s12">
            <ul class="tabs">
                <li class="tab col s3 waves-effect"><a href="#noteditor"><i
                                class="material-icons teal-text">edit</i></a></li>
                <li class="tab col s3 waves-effect"><a id="tabviewer" href="#notviewer"><i
                                class="material-icons teal-text">book</i></a></li>
                <li class="tab col s3 waves-effect"><a id="tabviewer" href="#notproperties"><i
                                class="material-icons teal-text">settings</i></a></li>
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
<textarea name="title" maxlength="100" id="title" cols="30" rows="1" contenteditable="false"
          class="materialize-textarea">{$notbook->title}</textarea>
                </span>
                <span>
                    <label for="content">Cuerpo</label>
<textarea name="unparsed" id="unparsed" cols="50" rows="10" contenteditable="true"
          class="materialize-textarea">{$notbook->unparsed}</textarea>
                </span>
                </div>
            </div>
        </div>
        <div id="notviewer" class="col s12 ulist">
            <div id="editorOutput">
                {$notbook->parsed}
            </div>
        </div>
        <div id="notproperties" class="container">
            <div class="row">
                <div class="col s12">
                    <h4 class="roboto-light center-align">Propiedades</h4>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <label>Creado</label>
                    <span>{$notbook->created}</span>
                </div>
                <div class="col s12">
                    <label>Última Modificación</label>
                    <span>{$notbook->last_parsed_date}</span>
                </div>
                <div class="col s12">
                    <div class="switch">
                        <label>
                            Privado
                            <input type="checkbox" id="private_attribute"
                                    {if  $notbook->private == "1"}
                                        checked
                                    {/if}
                            >
                            <span class="lever"></span>
                        </label>
                    </div>
                </div>
                <div class="col s12">
                    <a class="btn-flat waves-effect waves-teal right" id="pdf">
                        Guardar como PDF
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Scripts -->
<script src="/app/profile/js/editor.js"></script>
