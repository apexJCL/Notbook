<div class="card custom-card white">
    <div class="card-title">
        {$notbook->title}
    </div>
    <div>
        <blockquote>
            {$notbook->unparsed|truncate:70}
        </blockquote>
    </div>
    <div class="card-action left-align">
        <a href="">Editar</a>
        <a href="">Eliminar</a>
    </div>
</div>