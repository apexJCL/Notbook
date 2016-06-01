<div class="row">
    <form  class="col s12" method="post" id="register_form">
        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix teal-text">perm_identity</i>
                <input placeholder="María" id="first_name" name="name" type="text" class="validate" required>
                <label for="first_name">Nombre(s)</label>
            </div>
            <div class="input-field col s6">
                <input placeholder="Perez" id="last_name" name="last_name" type="text" class="validate" required>
                <label for="last_name">Apellido(s)</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix teal-text">mode_edit</i>
                <input id="password" type="password" name="password" class="validate" required>
                <label for="password" id="password_label">Contraseña</label>
            </div>
            <div class="input-field col s6">
                <input id="password_ver" type="password" name="password_ver" class="validate" required>
                <label for="password_ver" id="password_ver_label">Repita Contraseña</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <i class="material-icons prefix teal-text">email</i>
                <input id="email" type="email" name="email" class="validate" required>
                <label for="email">Email</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field center">
                <button class="btn waves-effect waves-light" type="submit" name="action">Registrarse
                    <i class="material-icons right">input</i>
                </button>
            </div>
        </div>
    </form>
</div>