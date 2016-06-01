{extends file="{$baseurl}layout.tpl"}
{block name="body"}
    <div id="data_display">

    </div>
    <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
        <a class="btn-floating btn-large amber">
            <i class="large material-icons">menu</i>
        </a>
        <ul>
            <li><a class="btn-floating red stats" href="#stats"><i class="material-icons">insert_chart</i></a></li>
            <li><a class="btn-floating green accounts" href="#accounts"><i class="material-icons">account_circle</i></a></li>
            <li><a class="btn-floating green" href="/profile"><i class="material-icons">autorenew</i></a></li>
        </ul>
    </div>
{/block}