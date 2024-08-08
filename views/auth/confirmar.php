<div class="contenedor-login">
    <div class="columna columna1">
        <div class="login">
            <h2 class="login__heading"> <?php echo $titulo; ?> </h2>
            <?php
            require_once __DIR__ . '/../templates/alertas.php';
            ?>


            <?php if (isset($alertas['exito'])) { ?>
                <div class="acciones--centrar">
                    <a href="/login" class="acciones__enlace--login">Iniciar Sesion</a>
                </div>
            <?php } ?>


        </div>
    </div>

</div>