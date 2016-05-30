<div class="card custom-card {if $notbook->private}grey lighten-4{else} white{/if}">
    <div class="card-content">
        <div class="card-title">
            <div class="row">
                <div class="col s6">
                    {$notbook->title|truncate:12}
                </div>
                <div class="col s6 right-align">
                    <i class="material-icons activator">more_vert</i>
                </div>
            </div>

        </div>
        <blockquote class="roboto-light">
            {$notbook->unparsed|truncate:42}
        </blockquote>
    </div>
    <div class="card-reveal">
        <span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i></span>
        <a class="waves-effect waves-green btn-flat teal-text" onclick="edit({$notbook->id})" href="#edit#{$notbook->id}">Editar</a>
        <a class="waves-effect waves-red btn-flat teal-text modal-trigger" href="#deleteModal{$notbook->id}">Eliminar</a>
    </div>
</div>
<div id="deleteModal{$notbook->id}" class="modal red-text">
    <div class="modal-content">
        <h4 class="roboto-light">¿Seguro que quiere eliminar {$notbook->title}</h4>
        <p>Esta acción no se puede deshacer</p>
    </div>
    <div class="modal-footer">
        <a href="#notbooks" onclick="deleteNotbook({$notbook->id})" class="modal-action modal-close waves-effect waves-red btn-flat">Eliminar</a>
    </div>
</div>
<script>
    $('.modal-trigger').leanModal();
</script>