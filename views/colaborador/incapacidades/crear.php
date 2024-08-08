<h1 class="contenedor-admin__titulo"><?php echo $titulo; ?></h1>

<div class="contenedor-formulario">
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

    <form method="POST" action="/colaborador/incapacidades/crear" enctype="multipart/form-data" class="formulario"
        id="FormularioInterno">

        <fieldset class="formulario__fieldset">

            <div class="formulario__campo">
                <input type="text" class="formulario__input" name="colaborador_id" id="colaborador_id"
                    placeholder="ID del Colaborador" value="<?php echo $_SESSION['id']; ?>" hidden>
            </div>

            <div class="formulario__campo">
                <label for="fecha" class="formulario__label">Fecha de ingreso de boleta:</label>
                <input type="text" class="formulario__input" name="fecha" id="fecha" placeholder="fecha de la Empresa"
                    value="<?php echo date('Y-m-d'); ?>" readonly>
            </div>

            <div class="row row-campo">
                <div class="col">
                    <label for="desde" class="formulario__label">desde:</label>
                    <input type="date" class="form-control formulario__input" id="desde" name="desde"
                        value="<?php echo $incapacidad->desde; ?>" require>
                </div>
                <div class="col">
                    <label for="hasta" class="formulario__label">hasta:</label>
                    <input type="date" class="form-control formulario__input" id="hasta" name="hasta"
                        value="<?php echo $incapacidad->hasta; ?>" require>
                </div>
            </div>

            <div class="formulario__campo">
                <label for="boleta" class="formulario__label">Cargar Boleta:</label>
                <input type="file" class="formulario__input" name="boleta" id="boleta"
                    placeholder="boleta de la Empresa" accept="application/pdf">
                <div id="passwordHelpBlock" class="form-text">
                    Aqui debe cargar su boleta de incapacidad.
                </div>
            </div>

            <div class="formulario__campo">
                <label for="motivo" class="formulario__label">Motivo Incapacidad:</label>
                <textarea class="formulario__textarea" name="motivo"
                    id="motivo"> <?php echo $incapacidad->motivo; ?> </textarea>
            </div>

            <div class="formulario__campo">
                <label for="cantidad_dias" class="formulario__label">Cantidad de dias:</label>
                <input type="number" class="formulario__input" name="cantidad_dias" id="cantidad_dias"
                    placeholder="Cantidad Dias Incapacitado" value="<?php echo $incapacidad->cantidad_dias; ?>" require
                    readonly>
            </div>

            <input class="formulario__submit formulario__submit--registrar" type="submit" value="Crear Incapacidad"
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
                    <p class="modal-mensaje">Se creo la incapacidad con exito.</p>
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
                    <p class="modal-mensaje">Hubo un error al crear la incapacidad, intentelo mas tarde.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-modal" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

</div>