<div class="row">
    <form class="col s12" method="post">
        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix teal-text">perm_identity</i>
                <input placeholder="María" id="first_name" name="name" type="text" class="validate">
                <label for="first_name">Nombre(s)</label>
            </div>
            <div class="input-field col s6">
                <input placeholder="Perez" id="last_name" name="last_name" type="text" class="validate">
                <label for="last_name">Apellido(s)</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix teal-text">mode_edit</i>
                <input id="password" type="password" name="password" class="validate">
                <label for="password">Contraseña</label>
            </div>
            <div class="input-field col s6">
                <input id="password_ver" type="password" name="password_ver" class="validate">
                <label for="password_ver">Repita Contraseña</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <i class="material-icons prefix teal-text">email</i>
                <input id="email" type="email" name="email" class="validate">
                <label for="email">Email</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field center">
                <button class="btn waves-effect waves-light" type="submit" name="action">Quiero mi ¬ notbook
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </div>
        <input type="hidden" name="choice" value="register">
    </form>
</div>