<div class="contenedor-postulacion postulacion">
    <h1 class="contenedor-admin__titulo"><?php echo $titulo; ?></h1>

    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

    <form method="POST" action="/carreras" enctype="multipart/form-data" class="formulario">

        <fieldset class="formulario__fieldset">


            <legend class="formulario__legend">Informacion Personal</legend>

            <div class="row row-campo">
                <div class="col">
                    <label for="fecha_postulacion" class="formulario__label">Fecha de postulacion:</label>
                    <input type="text" name="fecha_postulacion" id="fecha_postulacion" class="form-control formulario__input" value="<?php echo date('Y-m-d'); ?>" readonly>
                </div>
            </div>
            <div class="row row-campo">
                <div class="col">
                    <label for="nombre" class="formulario__label">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" class="form-control formulario__input" value="<?php echo $carrera->nombre; ?>" placeholder="Ingresa tu nombre" require>
                </div>
                <div class="col">
                    <label for="apellido_paterno" class="formulario__label">Apellido:</label>
                    <input type="text" name="apellido_paterno" id="apellido_paterno" class="form-control formulario__input" value="<?php echo $carrera->apellido_paterno; ?>" placeholder="Ingresa tu primer Apellido" require>
                </div>
                <div class="col">
                    <label for="apellido_materno" class="formulario__label">Apellido:</label>
                    <input type="text" name="apellido_materno" id="apellido_materno" class="form-control formulario__input" value="<?php echo $carrera->apellido_materno; ?>" placeholder="Ingresa tu segundo apellido" require>
                </div>
            </div>
            <div class="row row-campo">
                <div class="col">
                    <label for="cedula" class="formulario__label">Cedula:</label>
                    <input type="number" name="cedula" id="cedula" class="form-control formulario__input" value="<?php echo $carrera->cedula; ?>" placeholder="Ingresa tu cedula" require>
                </div>
                <div class="col">
                    <label for="fecha_nacimiento" class="formulario__label">Fecha Nacimiento:</label>
                    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control formulario__input" value="<?php echo $carrera->fecha_nacimiento; ?>" require>
                </div>
                <div class="col">
                    <label for="genero" class="formulario__label">Genero:</label>
                    <select class="form-control formulario__input" id="genero" name="genero">
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                        <option value="Prefiero no decir">Prefiero no decir</option>
                    </select>
                </div>
            </div>
            <div class="row row-campo">
                <div class="col">
                    <label for="telefono" class="formulario__label">Telefono:</label>
                    <input type="tel" name="telefono" id="telefono" class="form-control formulario__input" value="<?php echo $carrera->telefono; ?>" placeholder="Ingresa tu telefono" require>
                </div>
                <div class="col">
                    <label for="correo" class="formulario__label">Correo Electronico:</label>
                    <input type="email" name="correo" id="correo" class="form-control formulario__input" value="<?php echo $carrera->correo; ?>" placeholder="Ingresa tu correo electronico" require>
                </div>
            </div>


            <legend class="formulario__legend">Postulacion</legend>

            <div class="row row-campo">
                <div class="col">
                    <label for="departamento" class="formulario__label">Departamento de Interes:</label>
                    <select class="form-control formulario__input" id="departamento" name="departamento_id">
                        <option value="">- Seleccionar -</option>
                        <?php foreach ($departamentos as $departamento) { ?>
                            <option <?php echo ($carrera->departamento_id === $departamento->id) ? 'selected' : '' ?> value="<?php echo $departamento->id; ?>"><?php echo $departamento->nombre; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col">
                    <label for="pretencion_salarial" class="formulario__label">Pretencion Salarial:</label>
                    <input type="number" name="pretencion_salarial" id="pretencion_salarial" class="form-control formulario__input" value="<?php echo $carrera->pretencion_salarial; ?>" placeholder="Ingresa tu pretencion salarial" require>
                </div>
            </div>

            <div class="formulario__campo">
                <label for="mensaje" class="formulario__label">Mensaje para el reclutador:</label>
                <textarea class="formulario__textarea" name="mensaje" id="mensaje" require><?php echo $carrera->mensaje; ?></textarea>
            </div>


            <div class="formulario__campo">
                <label for="cv" class="formulario__label">Cargar CV:</label>
                <input type="file" class="formulario__input" name="cv" id="cv" accept="application/pdf" require>
                <div id="passwordHelpBlock" class="form-text">
                    Aqui debe cargar su CV.
                </div>
            </div>

            <input class="formulario__submit formulario__submit--registrar" type="submit" value="Postularme">
    </form>

</div>

<div class="modal" id="exito" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <i class="fa-solid fa-bell" id="icono-exito"></i>
                <h5 class="modal-title titulo-modal">Mensaje</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="modal-mensaje">Se envio tu postulacion con exito</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-modal" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="error" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <i class="fa-solid fa-triangle-exclamation" id="icono-error"></i>
                <h5 class="modal-title titulo-modal">Mensaje</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="modal-mensaje">Hubo un error, intentelo mas tarde.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-modal" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>