{extends file="layout.tpl"}
{block name="body"}
    <link rel="stylesheet" href="css/github.css">
    <script src="js/highlight.pack.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
    <div id="home" class="section">
        <h1 class="">
            ¬ notbook
        </h1>
        <p class="flow-text">
            Porque hacer tus apuntes, nunca había sido tan fácil y con tanto estilo.
        </p>
    </div>
    <div id="demo">
        <div class="row section">
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
    <hr>
    <div class="section" id="about">
        <h3 class="roboto-light">¿Qué es notbook?</h3>
        <p class="flow-text" style="text-align: justify">
            No es una libreta, sino una nueva forma de redactar tus documentos.
        </p>
        <div class="col s10 m6">
            <div class="card custom-card darken-1">
                <div>
                    <pre><code class="markdown">
### Redacta en Markdown
                    </code></pre>
                    <pre><code class="python">
print('Soporte para código');
                    </code></pre>
<pre><code class="c">
{$about_unparsed} = {$about}
</code></pre>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row" id="register">
        <h3 class="roboto-light">
            Regístrate
        </h3>
        {include file="register_layout.tpl"}
    </div>
{/block}