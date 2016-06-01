{extends file="{$baseurl}layout.tpl"}
{block name="body"}
    <div class="row">
        <h1 class="roboto-light">{$notbook->title}</h1>
    </div>
    <div class="row ulist">
        <div class="card custom-card z-depth-1">
            {$notbook->parsed}
        </div>
        <div class="chip">
            {$notbook->profile->name}
        </div>
        <div class="chip">
            {$notbook->last_parsed_date}
        </div>
    </div>
    <div class="row">
        <h5>Comentarios</h5>
        <hr>
    </div>
    {include file="{$baseurl}comments.tpl"}
    <link rel="stylesheet" href="/css/github.css">
    <script src="/js/highlight.pack.js"></script>
    <script src="/app/viewer/js/viewer.js"></script>
{/block}