<div class="collection">
    {foreach from=$accounts item=account}
        <a href="#accounts" onclick="showAccount({$account->id})" class="collection-item">
            {$account->email}
        </a>
    {/foreach}
</div>