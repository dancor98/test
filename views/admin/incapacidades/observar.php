<h1 class="contenedor-admin__titulo"><?php echo $titulo; ?></h1>

<div class="container mt-5">
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

        <!-- Informacion Colaborador -->
        <fieldset class="formulario__fieldset">
            <legend class="formulario__legend">Informacion Colaborador</legend>

            <div class="row row-campo">
                <div class="col">
                    <label for="nombre" class="formulario__label">Nombre:</label>
                    <input type="text" class="form-control formulario__input"
                        value="<?php echo $incapacidad->colaborador->nombre ?? ''; ?>" readonly>
                </div>
                <div class="col">
                    <label for="apellido_paterno" class="formulario__label">Apellido:</label>
                    <input type="text" class="form-control formulario__input"
                        value="<?php echo $incapacidad->colaborador->apellido_paterno ?? ''; ?>" readonly>
                </div>
                <div class="col">
                    <label for="apellido_materno" class="formulario__label">Apellido:</label>
                    <input type="text" class="form-control formulario__input"
                        value="<?php echo $incapacidad->colaborador->apellido_materno ?? ''; ?>" readonly>
                </div>
            </div>

            <div class="formulario__campo">
                <label for="cedula" class="formulario__label">Cedula:</label>
                <input type="text" class="formulario__input" name="cedula" id="cedula" placeholder="cedula colaborador"
                    value="<?php echo $incapacidad->colaborador->cedula ?? ''; ?>" readonly>
            </div>
        </fieldset>

        <!-- Informacion Incapacidad -->
        <fieldset class="formulario__fieldset">
            <legend class="formulario__legend">Informacion Incapacidad</legend>
            <div class="formulario__campo">
                <label for="motivo" class="formulario__label">Motivo Incapacidad:</label>
                <textarea name="motivo" id="motivo" class="formulario__textarea"
                    readonly> <?php echo $incapacidad->motivo; ?> </textarea>
            </div>
            <div class="formulario__campo">
                <label for="cantidad_dias" class="formulario__label">Dias Incapacitado:</label>
                <input type="number" class="formulario__input" name="cantidad_dias" id="cantidad_dias"
                    value="<?php echo $incapacidad->cantidad_dias ?? ''; ?>" readonly>
            </div>
            <a href="/../<?php echo $incapacidad->boleta; ?>" class="btn boton-carta btn-primary mb-2"
                download="Boleta Incapacidad <?php echo $incapacidad->colaborador->nombre . ' ' . $incapacidad->colaborador->apellido_paterno . '-' . $incapacidad->fecha; ?>">
                <i class="fa-solid fa-download"></i>
                Descargar
            </a>
            </legend>
        </fieldset>
        <fieldset class="formulario__fieldset">
            <legend class="formulario__legend">Informacion de Estado</legend>

            <div class="formulario__campo">
                <label for="estado" class="formulario__label">Estado:</label>
                <select class="formulario__select" id="estado" name="estado">
                    <option value="" disabled selected><?php echo $incapacidad->estado; ?></option>
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