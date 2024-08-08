<div class="contenedor-login">
    <div class="columna columna1">
        <div class="login">
            <h2 class="login__heading"> <?php echo $titulo; ?> </h2>
            <?php
            require_once __DIR__ . '/../templates/alertas.php';
            ?>

            <?php if ($token_valido) { ?>
                <form method="POST" class="formulario">
                    <div class="formulario__campo">
                        <label for="contrasena" class="formulario__label--login">Nueva Contrasena:</label>
                        <input type="password" class="formulario__input" placeholder="Tu nueva contrasena" id="contrasena" name="contrasena">
                    </div>
                    <input type="submit" value="Reestablecer contrasena" class="formulario__submit">
                </form>

                <div class="acciones">
                    <a href="/login" class="acciones__enlace--login">Ya tienes cuenta? Iniciar Sesion</a>
                </div>
            <?php } ?>

        </div>
    </div>

</div>