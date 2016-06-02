<h3 class="roboto-light">
    Cuentas
</h3>
<h4 class="roboto-light">
    Todas las cuentas
</h4>
{include file="{$baseurl}accountlist.tpl"}
<div id="account_search_output">
</div>
<h3 class="roboto-light">
    Búsqueda de cuenta
</h3>
<form action="#" method="post" id="search_account_form">
    <div class="row">
        <div class="col s12 m6">
            <label for="id">Búsqueda por ID<input type="number" min="1" name="id"></label>
        </div>
        <div class="col s12 m6">
            <label for="email">Búsqueda por correo<input type="email" name="email"></label>
        </div>
    </div>
    <button class="btn waves-effect right">
        <i class="material-icons">search</i>
    </button>
</form>
<script src="/app/admin/js/account.js"></script>