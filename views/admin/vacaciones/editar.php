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
            <legend class="formulario__legend">Informacion de Solicitud</legend>

            <div class="row row-campo">
                <div class="col">
                    <label for="desde" class="formulario__label">desde:</label>
                    <input type="date" class="form-control formulario__input" id="desde" name="desde" value="<?php echo $vacacion->desde; ?>" readonly>
                </div>
                <div class="col">
                    <label for="hasta" class="formulario__label">hasta:</label>
                    <input type="date" class="form-control formulario__input" id="hasta" name="hasta" value="<?php echo $vacacion->hasta; ?>" readonly>
                </div>
            </div>

            <div class="formulario__campo">
                <label for="cantidad" class="formulario__label">Cantidad de dias:</label>
                <input type="text" class="form-control formulario__input" id="cantidad" name="cantidad" value="<?php echo $vacacion->cantidad; ?>" readonly>
            </div>

            <div class="formulario__campo">
                <label for="detalle" class="formulario__label">Detalle:</label>
                <textarea name="detalle" id="detalle" class="formulario__textarea" readonly><?php echo $vacacion->detalle; ?></textarea>
            </div>
        </fieldset>
        <fieldset class="formulario__fieldset">
            <legend class="formulario__legend">Informacion de Estado</legend>

            <div class="formulario__campo">
                <label for="estado" class="formulario__label">Estado:</label>
                <select class="formulario__select" id="estado" name="estado">
                    <?php if (strpos($vacacion->estado, 'Pendiente') !== false) : ?>
                        <option value="" disabled selected><?php echo $vacacion->estado; ?></option>
                        <option value="En Revision">En Revision</option>
                        <option value="Aprobadas">Aprobadas</option>
                        <option value="Rechazadas">Rechazadas</option>
                    <?php elseif (strpos($vacacion->estado, 'En Revision') !== false) : ?>
                        <option value="" disabled selected><?php echo $vacacion->estado; ?></option>
                        <option value="Aprobadas">Aprobadas</option>
                        <option value="Rechazadas">Rechazadas</option>
                    <?php elseif (strpos($vacacion->estado, 'Aprobadas') !== false || strpos($vacacion->estado, 'Rechazadas') !== false) : ?>
                        <option value="" disabled selected><?php echo $vacacion->estado; ?></option>
                        <option value="Rebajadas">Rebajadas</option>
                    <?php endif; ?>
                </select>
            </div>

            <div class="formulario__campo">
                <label for="comentario" class="formulario__label">Comentario (En caso de Rechazo o querer agregar algun
                    comentario visible para el colaborador):</label>
                <textarea name="comentario" id="comentario" class="formulario__textarea"><?php echo $vacacion->comentario; ?></textarea>
            </div>

        </fieldset>



        <input class="formulario__submit formulario__submit--registrar" type="submit" value="Actualizar Estado" id="botonSubmit">
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
                    <p class="modal-mensaje">Se actualizo el estado de la solicitud con exito.</p>
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
                    <p class="modal-mensaje">Hubo un error al actualizar el estado, intentelo mas tarde.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-modal" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
</div>