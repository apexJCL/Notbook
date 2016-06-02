<h4 class="roboto-light">Resultado Búsqueda</h4>


<ul class="collapsible" data-collapsible="accordion">
    <li>
        <div class="collapsible-header"><i class="material-icons">account_circle</i>Datos Personales</div>
        <div class="collapsible-body">
            <div class="container">
                <form action="#" method="post" id="profile_data_form">
                    <input type="hidden" id="id" name="id" value="{if !empty($profile)}
                        {$profile->id}
                    {/if}">
                    <div class="row">
                        <div class="col s12 m6">
                            <label for="name">Nombre
                                <input type="text" name="name" value="{if !empty($profile)}
                                {$profile->name}
                                {/if}
                                ">
                            </label>
                        </div>
                        <div class="col s12 m6">
                            <label for="last_name">Apellidos
                                <input type="text" name="last_name" value="{if !empty($profile)}{$profile->last_name}"{/if}>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m6">
                            <label for="birthdate">Fecha Nacimiento</label>
                            <input type="date" name="birthdate" data-value='{if !empty($profile)}{$profile->birthdate|date_format:"%Y-%m-%d"}{/if}' class="datepicker">
                        </div>
                        <div class="col s12 m6">
                            <button class="btn green waves-effect">
                                Actualizar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </li>
    <li>
        <div class="collapsible-header"><i class="material-icons">fingerprint</i>Acceso</div>
        <div class="collapsible-body">
            <div class="container">
                <div class="row">
                    <form action="#" method="post" id="account_data_form">
                        <input type="hidden" id="id" name="id" value="{$account->id}">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">https</i>
                            <input type="password" id="password" name="password" class="validate">
                        </div>
                        <div class="input-field col s12">
                            <i class="material-icons prefix">email</i>
                            <input type="email" id="email" name="email" value="{$account->email}">
                        </div>
                        <div class="col s12">
                            <button class="btn green waves-effect">
                                Actualizar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </li>
    <li>
        <div class="collapsible-header"><i class="material-icons">warning</i>Precaución</div>
        <div class="collapsible-body">
            <a href="#accounts" class="btn-flat waves-effect waves-red" onclick="deleteAccount({$account->id})">Eliminar Cuenta</a>
        </div>
    </li>
</ul>
<script src="/app/admin/js/account_data.js"></script>