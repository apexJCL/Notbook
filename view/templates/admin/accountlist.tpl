<h1 id="account_counter">{$amount}</h1>
<div class="center">
    <ul class="pagination">
        <li class="waves-effect" onclick="prevPage()"><a href="#accounts"><i class="material-icons">chevron_left</i></a></li>
        {for $i=1 to $pages}
            <li class="waves-effect" id="pager{$i}" onclick="accountPage({$i})">
                <a href="#accounts">{$i}</a>
            </li>
        {/for}
        <li class="waves-effect" onclick="nextPage()"><a href="#accounts"><i class="material-icons">chevron_right</i></a></li>
    </ul>
</div>
<div id="account_pager">
    {include file="{$baseurl}account_pager.tpl"}
</div>