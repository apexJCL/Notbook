<div class="card custom-card">
    <div class="card-title">
        Comentarios más recientes
    </div>
    <div class="card-content">
        {foreach from=$last_comments item=comment}
            <div class="card custom-card black white-text">
                <div class="card-title">
                    {$comment->name}
                    <i class="material-icons activator right">settings</i>
                </div>
                <div class="card-content small">
                    <span class="clean-comment">{$comment->comment|truncate:50}</span>
                </div>
                <div class="card-reveal">
                    <div class="card-title">
                                        <span class="card-title grey-text text-darken-4"><i
                                                    class="material-icons right">close</i></span>
                    </div>
                    <div class="card-content">
                        <a href="/view/nid={$comment->notbook_id}"><i
                                    class="material-icons">visibility</i></a>
                        <a href="/view/nid={$comment->notbook_id}"><i
                                    class="material-icons">delete</i></a>
                    </div>
                </div>
            </div>
        {/foreach}
    </div>
</div>