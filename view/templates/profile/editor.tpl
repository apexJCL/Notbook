<div class="section fullscreen">
    <div class="row">
        <div class="col s12 m6">
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
        <div class="col s12 m6 white">
            <div class="container">
{$notbook->parsed}
            </div>
        </div>
    </div>
</div>