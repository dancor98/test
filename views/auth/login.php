<div class="contenedor-login">
    <div class="columna">
        <div class="login">
            <h2 class="login__heading"> <?php echo $titulo; ?> </h2>
            <?php
            require_once __DIR__ . '/../templates/alertas.php';
            ?>
            <form action="/login" method="POST" class="formulario">
                <div class="formulario__campo">
                    <label for="correo_electronico" class="formulario__label formulario__label--login">Correo
                        Electronico:</label>
                    <input type="email" class="formulario__input" placeholder="Tu Email" id="correo_electronico" name="correo_electronico">
                </div>
                <div class="formulario__campo">
                    <label for="contrasena" class="formulario__label formulario__label--login">Contrasena:</label>
                    <input type="password" class="formulario__input" placeholder="Tu contrasena" id="contrasena" name="contrasena">
                </div>
                <input type="submit" value="Iniciar Sesion" class="formulario__submit">
            </form>
            <div class="acciones">
                <a href="/olvide" class="acciones__enlace acciones__enlace--login">Olvidaste tu contrasena?</a>
            </div>
        </div>
    </div>

</div>