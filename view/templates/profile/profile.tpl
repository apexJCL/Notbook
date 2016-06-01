{extends file="{$baseurl}layout.tpl"}
{block name="body"}
    <link rel="stylesheet" href="/css/github.css">
    <script src="/js/highlight.pack.js"></script>
    <script src="/app/profile/js/main.js"></script>
    <script src="/js/keypress-2.1.4.min.js"></script>
    <div>
        <div id="contentDisplay">
            <h3 align="center" class="roboto-light">Bienvenido, {$smarty.session.name}</h3>
            <div class="center-align">
                <img class="center-align" src="/img/notbook.png" alt="" style="max-height: 256px">
            </div>
        </div>
        <div class="fixed-action-btn horizontal">
            <a class="btn-floating btn-large white">
                <i class="material-icons black-text">menu</i>
            </a>
            <ul>
                <li>
                    <a class="btn-floating teal my-notbooks" href="#notbooks">
                        <i class="material-icons">list</i>
                    </a>
                </li>
                {if isset($smarty.session.isAdmin) && $smarty.session.isAdmin == "1"}
                    <li><a href="/admin" class="btn-floating teal">
                            <i class="material-icons">autorenew</i>
                        </a></li>
                {/if}
                <li>
                    <a class="btn-floating green modal-trigger" href="#new_notbook_modal">
                        <i class="material-icons">mode_edit</i>
                    </a>
                </li>
                <li>
                    <a class="btn-floating blue modal-trigger" href="#search_modal">
                        <i class="material-icons">search</i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- Modal - New Notbook -->
    <div id="new_notbook_modal" class="modal bottom-sheet">
        <form action="" id="new-notbook-form" method="post">
            <div class="modal-content">
                <h4>Nuevo Notbook</h4>
                <div>
                    <div class="row">
                        <div class="col s12">
                            <div class="row">
                                <label for="title">Título</label>
                                <input type="text" id="title" name="title" placeholder="Mi nuevo notbook <3" autofocus>
                            </div>
                        </div>
                        <div class="col s12 m6 bottom-sheet">
                            <div class="switch">
                                <label for="switch">Privado</label>
                                <label>
                                    <input type="checkbox" id="private" name="private" checked>
                                    <span class="lever"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="waves-effect btn-flat" type="submit" name="new-notbook">Crear</button>
            </div>
        </form>
    </div>
    <!-- Modal - Search Notbooks -->
    <div id="search_modal" class="modal bottom-sheet">
        <form action="" id="search-notbooks" method="post">
            <div class="modal-content">
                <h4>Buscar</h4>
                <div>
                    <div class="row">
                        <div class="col s12">
                            <div class="row">
                                <label for="search_query">Texto</label>
                                <input type="text" id="search_query" name="search_query" placeholder="¿Qué será :v?" autofocus>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="waves-effect btn-flat" type="submit" name="new-notbook">¡Encuéntralo!</button>
            </div>
        </form>
    </div>
{/block}