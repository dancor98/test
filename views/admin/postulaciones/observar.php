<div class="contenedor-formulario">
    <h1 class="contenedor-admin__titulo"><?php echo $titulo; ?></h1>
    <div class="row justify-content-end botones-acciones">
        <div class="col-12 col-md-auto mb-2 mb-md-0">
            <div class="boton-acciones">
                <a href="javascript:void(0);" id="backButton" class="boton-acciones__texto">
                    <i class="fa-solid fa-rotate-left icono-admin"></i>
                    Volver
                </a>
            </div>
        </div>
    </div>

    <?php include_once __DIR__ . '/../../templates/alertas.php'; ?>

    <form method="POST" enctype="multipart/form-data" class="formulario" id="FormularioInterno">
        <fieldset class="formulario__fieldset">
            <legend class="formulario__legend">Informacion Personal del Postulante</legend>

            <div class="row row-campo">
                <div class="col">
                    <label for="nombre" class="formulario__label">Nombre:</label>
                    <input type="text" class="form-control formulario__input" id="nombre" name="nombre"
                        value="<?php echo $postulacion->nombre . " " . $postulacion->apellido_paterno; ?>" readonly>
                </div>
            </div>

            <div class="row row-campo">
                <div class="col">
                    <label for="cedula" class="formulario__label">Cedula:</label>
                    <input type="text" class="form-control formulario__input" id="cedula" name="cedula"
                        value="<?php echo $postulacion->cedula; ?>" readonly>
                </div>
                <div class="col">
                    <label for="fecha_nacimiento" class="formulario__label">Fecha de nacimiento:</label>
                    <input type="text" class="form-control formulario__input" id="fecha_nacimiento"
                        name="fecha_nacimiento" value="<?php echo $postulacion->fecha_nacimiento; ?>" readonly>
                </div>
                <div class="col">
                    <label for="genero" class="formulario__label">Genero:</label>
                    <input type="text" class="form-control formulario__input" id="genero" name="genero"
                        value="<?php echo $postulacion->genero; ?>" readonly>
                </div>
            </div>
            <div class="row row-campo">
                <div class="col">
                    <label for="telefono" class="formulario__label">Telefono:</label>
                    <input type="text" class="form-control formulario__input" id="telefono" name="telefono"
                        value="<?php echo $postulacion->telefono; ?>" readonly>
                </div>
                <div class="col">
                    <label for="correo" class="formulario__label">Correo Electronico:</label>
                    <input type="text" class="form-control formulario__input" id="correo" name="correo"
                        value="<?php echo $postulacion->correo; ?>" readonly>
                </div>
            </div>

            <legend class="formulario__legend">Informacion para la postulacion</legend>

            <div class="row row-campo">
                <div class="col">
                    <label for="departamento_id" class="formulario__label">departameno de interes:</label>
                    <input type="text" class="form-control formulario__input" id="departamento_id"
                        name="departamento_id" value="<?php echo $postulacion->departamento->nombre; ?>" readonly>
                </div>
                <div class="col">
                    <label for="pretencion_salarial" class="formulario__label">Pretencion salarial:</label>
                    <input type="text" class="form-control formulario__input" id="pretencion_salarial"
                        name="pretencion_salarial" value="₡ <?php echo $postulacion->pretencion_salarial; ?>" readonly>
                </div>
            </div>

            <div class="formulario__campo">
                <label for="mensaje" class="formulario__label">mensaje:</label>
                <textarea name="mensaje" id="mensaje" class="formulario__textarea" readonly><?php echo $postulacion->mensaje; ?>
                </textarea>
            </div>
            <a href="/../<?php echo $postulacion->cv; ?>" class="btn boton-carta btn-primary mb-2"
                download="CV - <?php echo $postulacion->nombre . ' ' . $postulacion->apellido_paterno; ?>">
                <i class="fa-solid fa-money-check-dollar"></i>
                Descargar CV
            </a>

            <fieldset class="formulario__fieldset">
                <legend class="formulario__legend">Informacion de Estado</legend>

                <div class="formulario__campo">
                    <label for="estado" class="formulario__label">Estado:</label>
                    <select class="formulario__select" id="estado" name="estado">
                        <option value="" disabled selected><?php echo $postulacion->estado; ?></option>
                        <option value="Recibida">Recibida</option>
                    </select>
                </div>
            </fieldset>
            <input class="formulario__submit formulario__submit--registrar" type="submit" value="Actualizar Estado"
                id="botonSubmit">
    </form>


    <div class="modal" id="exito" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <i class="fa-solid fa-bell" id="icono-exito"></i>
                    <h5 class="modal-title titulo-modal">Mensaje</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="modal-mensaje">Se actualizo el estado con exito.</p>
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
                    <p class="modal-mensaje">Hubo un error en la actualizacion del estado, intentelo mas tarde.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-modal" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

</div>