<div class="container" style="padding-top: 25px">
    <div class="card-panel">
        <form action="/" method="post">
            <div class="row">
                <div class="input-field black-text col s12">
                    <i class="material-icons prefix">email</i>
                    <input type="text" name="email" id="email" class="validate" placeholder="Correo Electrónico">
                </div>
                <div class="input-field black-text col s12">
                    <i class="material-icons prefix">lock</i>
                    <input type="password" name="password" id="password" class="validate" placeholder="Contraseña">
                </div>
            </div>
            <div class="row center-align">
                <div class="col s12">
                    <button class="btn waves-effect waves-light" type="submit" name="action">Iniciar Sesión
                    </button>
                </div>
            </div>
            <div class="accent-2">
                <a href="">¿Olvidaste tu contraseña?</a>
            </div>
            <div class="accent-2">
                <a href="">Regístrate</a>
            </div>
            <input type="hidden" name="choice" value="login">
        </form>
    </div>
</div>