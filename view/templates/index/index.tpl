{extends file="layout.tpl"}
{block name="body"}
    <link rel="stylesheet" href="/css/github.css">
    <script src="/js/highlight.pack.js"></script>
    <script src="/js/main.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
    <div id="home" class="section">
        <h1 class="">
            ¬book
        </h1>
        <p class="flow-text">
            Porque hacer tus apuntes, nunca había sido tan fácil y con tanto estilo.
        </p>
        <div id="demo" class="section">
            <div class="row">
                <div class="col s10 m6">
                    <div class="card custom-card darken-1">
                        <div>
                            <pre style="word-wrap: break-word;"><code class="{$class}">{$pre}</code></pre>
                        </div>
                    </div>
                </div>
                <div class="col s10 m6">
                    <div class="card custom-card">
                        <div>
                            {$post}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="section" id="about">
        <div class="row">
            <div class="col m12">
                <h3 class="roboto-light">¿Qué es notbook?</h3>
                <p class="flow-text" style="text-align: justify">
                    No es una libreta, sino una nueva forma de redactar tus documentos.
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col m6">
                <div class="card custom-card">
                    <pre><code class="markdown">{$about_unparsed}</code></pre>
                </div>
            </div>
            <div class="col m6">
                <div class="card custom-card ulist">
                    {$about}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col m6">
                <div class="card custom-card">
                    <pre>{$code_unparsed}</pre>
                </div>
            </div>
            <div class="col m6">
                <div class="card custom-card">
                    {$code}
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row" id="register">
        <h3 class="roboto-light" id="register-title">
            Regístrate
        </h3>
        {include file="register_layout.tpl"}
    </div>
    <hr>
    <div class="row" id="login">
        <h3 class="roboto-light">
            Inicia Sesión
        </h3>
        {include file="login_form.tpl"}
    </div>
{/block}