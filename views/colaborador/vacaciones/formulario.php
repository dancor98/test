<fieldset class="formulario__fieldset">

    <div class="formulario__campo">
        <input type="text" class="formulario__input" name="colaborador_id" id="colaborador_id"
            value="<?php echo $_SESSION['id']; ?>" hidden>
    </div>
    <div class="formulario__campo">
        <input type="text" class="formulario__input" name="estado" id="estado" value="Pendiente" hidden>
    </div>

    <div class="formulario__campo">
        <label for="fecha" class="formulario__label">fecha Solicitud:</label>
        <input type="date" class="formulario__input" name="fecha" id="fecha" placeholder="fecha de la Empresa"
            value="<?php echo date('Y-m-d'); ?>" readonly>
    </div>

    <div class="formulario__campo">
        <label for="cantidad" class="formulario__label">Cantidad de dias:</label>
        <input type="number" class="formulario__input" name="cantidad" id="cantidad"
            placeholder="Cantidad de dias a disfrutar" value="<?php echo $vacacion->cantidad; ?>" require>
    </div>

    <div class="row row-campo">
        <div class="col">
            <label for="desde" class="formulario__label">desde:</label>
            <input type="date" class="form-control formulario__input" id="desde" name="desde"
                value="<?php echo $vacacion->desde; ?>" require>
        </div>
        <div class="col">
            <label for="hasta" class="formulario__label">hasta:</label>
            <input type="date" class="form-control formulario__input" id="hasta" name="hasta"
                value="<?php echo $vacacion->hasta; ?>" require>
        </div>
    </div>

    <div class="formulario__campo">
        <label for="detalle" class="formulario__label">Detalle:</label>
        <input type="text" class="formulario__input" name="detalle" id="detalle" placeholder="Detalle de la solicitud"
            value="<?php echo $vacacion->detalle; ?>" require>
    </div>