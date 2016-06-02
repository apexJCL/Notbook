<h3 class="roboto-light">
    Estadísticas Generales
</h3>
<div class="row">
    <div class="col s12 m6">
        <div class="card custom-card">
            <div class="card-title">
                ¬books creadas hoy
            </div>
            <div class="card-content">
                <h4 class="teal-text">{$today_notbooks}</h4>
            </div>
        </div>
    </div>
    <div class="col s12 m6">
        <div class="card custom-card">
            <div class="card-title">
                Cuentas
            </div>
            <div class="card-content">
                <h4 class="teal-text">{$amount}</h4>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col s12">
        {include file="{$baseurl}comments.tpl"}
    </div>
</div>