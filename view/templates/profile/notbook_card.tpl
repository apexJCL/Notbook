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
        <a class="waves-effect waves-red btn-flat teal-text" href="#delete">Eliminar</a>
    </div>
</div>