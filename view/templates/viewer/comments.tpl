<div id="comments">
    {if isset($smarty.session.user_logged_in) && $smarty.session.user_logged_in == "1"}
        <div class="row">
            <div class="col s12">
                <p>Deja un comentario</p>
            </div>
            <form action="" id="comment_form" method="post">
                <div class="col s12 m6">
                    <label for="comment" id="letter_counter"></label>
                        <textarea name="comment" id="comment" cols="30" rows="10"
                                  class="materialize-textarea"></textarea>
                </div>
                <div class="col s12 m6">
                    <button class="btn-flat waves-effect waves-teal">
                        <i class="material-icons">send</i>
                    </button>
                </div>
            </form>
        </div>
    {/if}
    <div class="row">
        {foreach from=$comments item=comment}

            <div class="col s12">
                <div class="card custom-card">
                    <div class="card-title">
                        <span style="font-size: 16pt"><strong>{$comment->profile->name}</strong></span>
                        <span style="font-size: 10pt">{$comment->comment_date}</span>
                        {if isset($smarty.session.pid) && $comment->profile_id == $smarty.session.pid}
                            <span class="activator"><i class="material-icons right">settings</i></span>
                        {/if}
                    </div>
                    <hr>
                    <div class="card-content">
                        {$comment->comment}
                    </div>
                    {if isset($smarty.session.pid) && $comment->profile_id == $smarty.session.pid}
                        <div class="card-reveal">
                            <span class="card-title">
                                <i class="material-icons right">close</i>
                            </span>
                            <a onclick="deleteComment({$comment->id})" class="waves-effect waves-red btn-flat">
                                <i class="material-icons">delete</i>
                            </a>
                        </div>
                    {/if}
                </div>
            </div>
        {/foreach}
    </div>
</div>