<div class="section">
    <h4 class="roboto-light">Ajustes</h4>
    <ul class="collapsible" data-collapsible="accordion">
        <li>
            <div class="collapsible-header"><i class="material-icons">account_circle</i>Datos Personales</div>
            <div class="collapsible-body">
                <div class="container">
                    <div class="row">
                        <form action="#" method="post" id="profile_data_form">
                            <div class="col s12 m6">
                                <label for="name">Nombre</label>
                                <input id="name" name="name" type="text" value="{$profile->name}">
                            </div>
                            <div class="col s12 m6">
                                <label for="last_name">Apellido(s)</label>
                                <input id="last_name" name="last_name" type="text" value="{$profile->last_name}">
                            </div>
                            <div class="col s12 m6">
                                <label for="birthdate">Fecha Nacimiento</label>
                                <input type="date" name="birthdate" data-value='{$profile->birthdate|date_format:"%Y-%m-%d"}' class="datepicker">
                            </div>
                            <div class="col s12">
                                <button class="btn waves-effect">
                                    <i class="material-icons">save</i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <div class="collapsible-header"><i class="material-icons">report_problem</i>Propiedades de la cuenta</div>
            <div class="collapsible-body">
                <div class="container">
                    <div class="row">
                        <div class="col s12 m6">
                            <form action="#" method="post" id="account_settings">
                                <button class="btn red waves-effect waves-red">
                                    Eliminar Cuenta
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
    <script src="/app/profile/js/settings.js"></script>
</div>