<div class="row">
<h4 class="center-align roboto-light">{$title}</h4>
{foreach from=$data item=notbook}
<div class="col s12 m4">
{include file="{$baseurl}notbook_card.tpl"}
</div>
{/foreach}
</div>