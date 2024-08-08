<h1 class="contenedor-admin__titulo"><?php echo $titulo; ?></h1>

<?php include_once __DIR__ . '/../../templates/alertas.php'; ?>


<div class="contenedor-colab contenedor-admin__info">

    <div class="row justify-content-end botones-acciones">
        <div class="col-12 col-md-auto mb-2 mb-md-0">
            <div class="boton-acciones">
                <a href="/colaborador/vacaciones/crear" class="boton-acciones__texto">
                    <i class="fa-solid fa-circle-plus icono-admin"></i>
                    Crear Vacaciones
                </a>
            </div>
        </div>
    </div>
    <?php if (!empty($vacaciones)) { ?>

    <div class="table-responsive">
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th class="table__th" scope="col">Colaborador</th>
                    <th class="table__th" scope="col">Cedula</th>
                    <th class="table__th" scope="col">Fecha Solicitud</th>
                    <th class="table__th" scope="col">Cantidad</th>
                    <th class="table__th" scope="col">detalle</th>
                    <th class="table__th" scope="col">Estado</th>
                    <th class="table__th" scope="col"></th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php foreach ($vacaciones as $vacacion) { ?>
                <tr class="table__tr">
                    <td class="table__td">
                        <?php echo $vacacion->colaborador->nombre . ' ' . $vacacion->colaborador->apellido_paterno; ?>
                    </td>
                    <td class="table__td">
                        <?php echo $vacacion->colaborador->cedula; ?>
                    </td>
                    <td class="table__td">
                        <?php echo $vacacion->fecha; ?>
                    </td>
                    <td class="table__td">
                        <?php echo $vacacion->cantidad; ?>
                    </td>
                    <td class="table__td">
                        <?php echo $vacacion->detalle; ?>
                    </td>
                    <td class="table__td">
                        <?php echo $vacacion->estado; ?>
                    </td>

                    <td class="table__td--acciones">
                        <?php if (strpos($vacacion->estado, 'Pendiente') === 0) : ?>
                        <a class="table__accion table__accion--editar"
                            href="/colaborador/vacaciones/editar?id=<?php echo $vacacion->id; ?>">
                            <i class="fa-solid fa-user-pen"></i>
                            Editar
                        </a>
                        <?php else : ?>
                        <span>No es posible editar</span>
                        <?php endif; ?>
                    </td>



                </tr>
                <?php }; ?>
            </tbody>
        </table>
        <?php } else { ?>
        <p class="text-center">No hay Vacaciones Registradas</p>
        <?php } ?>
    </div>
</div>

<?php
echo $paginacion;
?>


<div class="modal" id="exito" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <i class="fa-solid fa-bell" id="icono-exito"></i>
                <h5 class="modal-title titulo-modal">Mensaje</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="modal-mensaje">Se creo la solicitud de vacaciones con exito.</p>
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
                <p class="modal-mensaje">Hubo un error en la solicitud, intentelo mas tarde.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-modal" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>