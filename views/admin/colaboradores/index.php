<?php include_once __DIR__ . '/../../templates/alertas.php'; ?>


<div class="contenedor-admin contenedor-admin__info">

    <h1 class="contenedor-admin__titulo"><?php echo $titulo; ?></h1>

    <div class="row justify-content-end botones-acciones">
        <div class="col-12 col-md-auto mb-2 mb-md-0">
            <div class="boton-acciones">
                <a href="/admin/colaboradores/crear" class="boton-acciones__texto">
                    <i class="fa-solid fa-circle-plus icono-admin"></i>
                    Crear Colaborador
                </a>
            </div>
        </div>
        <div class="col-12 col-md-auto">
            <div class="boton-acciones">
                <a href="/admin/colaboradores/descargar-tabla-csv" class="boton-acciones__texto">
                    <i class="fa-solid fa-download icono-admin"></i>
                    Descargar Info
                </a>
            </div>
        </div>
    </div>

    <?php if (!empty($colaboradores)) { ?>

        <div class="row">
            <?php foreach ($colaboradores as $colaborador) { ?>
                <div class="col-xl-4 col-md-6 col-xs-12 mb-4">
                    <div class="card-col">
                        <a href="/admin/colaboradores/observar?id=<?php echo $colaborador->id; ?>">
                            <i class="fa-regular fa-eye icon-eye icono-ver"></i>
                        </a>
                        <?php if ($colaborador->foto === "null") { ?>
                            <picture class="colaborador-picture">
                                <source srcset="/../img/colaboradores/default.png" type="image/png">
                                <img class="colaborador-picture--imagen-carta" loading="lazy" width="200" height="300" src="/../img/colaboradores/default.png" alt="Imagen Ponente">
                            </picture>
                        <?php } else { ?>
                            <picture class="colaborador-picture">
                                <source srcset="/../<?php echo $colaborador->foto; ?>.webp" type="image/webp">
                                <source srcset="/../<?php echo $colaborador->foto; ?>.png" type="image/png">
                                <img class="colaborador-picture--imagen-carta" loading="lazy" width="200" height="300" src="/../<?php echo $colaborador->foto; ?>.webp" alt="Imagen Ponente">
                            </picture>
                        <?php } ?>
                        <div class="card-body">
                            <h5 class="card-title carta-titulo">
                                <?php echo $colaborador->nombre . " " . $colaborador->apellido_paterno; ?></h5>
                            <p class="card-text carta-descripcion">Cedula: <?php echo $colaborador->cedula; ?></p>
                            <p class="card-text carta-descripcion">Puesto Actual: <?php echo $colaborador->puesto; ?></p>
                            <p class="card-text carta-descripcion">Salario Actual: ₡<?php echo $colaborador->salario; ?></p>


                            <a href="/admin/boletaspagos/crear?id=<?php echo $colaborador->id; ?>" class="btn boton-carta  mb-2 w-100">
                                <i class="fa-solid fa-money-check-dollar"></i>
                                Crear Boleta Pago
                            </a>
                            <a href="/admin/colaboradores/editar?id=<?php echo $colaborador->id; ?>" class="btn boton-carta  mb-2 w-100 boton-carta--editar">
                                <i class="fa-solid fa-user-pen"></i>
                                Editar
                            </a>
                            <form method="POST" action="/admin/colaboradores/eliminar">
                                <input type="hidden" name="id" value="<?php echo $colaborador->id; ?>">
                                <button class="btn boton-carta  mb-2 w-100 boton-carta--eliminar" type="submit">
                                    <i class="fa-solid fa-circle-xmark"></i>
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php }; ?>

        </div>

    <?php } else { ?>
        <p class="text-center">No hay Colaboradores Activos</p>
    <?php } ?>

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
                    <p class="modal-mensaje">Se actualizo el colaborador con exito.</p>
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
                    <p class="modal-mensaje">Hubo un error en la edicion del colaborador, intentelo mas tarde.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-modal" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
</div>