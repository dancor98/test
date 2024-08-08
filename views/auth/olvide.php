<div class="contenedor-login">
    <div class="columna columna1">
        <div class="login">
            <h2 class="login__heading"> <?php echo $titulo; ?> </h2>
            <?php
            require_once __DIR__ . '/../templates/alertas.php';
            ?>
            <form action="/olvide" method="POST" class="formulario">
                <div class="formulario__campo">
                    <label for="correo_electronico" class="formulario__label formulario__label--login">Correo
                        Electronico:</label>
                    <input type="email" class="formulario__input" placeholder="Tu Email" id="correo_electronico" name="correo_electronico">
                </div>
                <input type="submit" value="Enviar Instrucciones" class="formulario__submit">
            </form>

            <div class="acciones">
                <a href="/login" class="acciones__enlace--login">Ya tienes cuenta? Iniciar Sesion</a>
            </div>
        </div>
    </div>

</div>