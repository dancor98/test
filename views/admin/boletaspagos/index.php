<?php include_once __DIR__ . '/../../templates/alertas.php'; ?>


<div class="contenedor-admin contenedor-admin__info">
    <h1 class="contenedor-admin__titulo"><?php echo $titulo; ?></h1>

    <div class="row justify-content-end botones-acciones">
        <div class="col-12 col-md-auto mb-2 mb-md-0">
            <div class="boton-acciones">
                <a href="/admin/colaboradores" class="boton-acciones__texto">
                    <i class="fa-solid fa-circle-plus icono-admin"></i>
                    Crear Boleta de Pago
                </a>
            </div>
        </div>
        <div class="col-12 col-md-auto">
            <div class="boton-acciones">
                <a href="/admin/boletaspagos/cargar" class="boton-acciones__texto">
                    <i class="fa-solid fa-download icono-admin"></i>
                    Cargar CSV
                </a>
            </div>
        </div>
    </div>

    <?php if (!empty($boletaspagos)) { ?>
        <div class="row">
            <?php foreach ($boletaspagos as $boletapago) { ?>
                <div class="col-xl-4 col-md-6 col-xs-12 mb-4">
                    <div class="card-col">
                        <?php if ($boletapago->colaborador->foto === "null") { ?>
                            <picture class="colaborador-picture">
                                <source srcset="/../img/colaboradores/default.png" type="image/png">
                                <img class="colaborador-picture--imagen-carta" loading="lazy" width="200" height="300" src="/../img/colaboradores/default.png" alt="Imagen Ponente">
                            </picture>
                        <?php } else { ?>
                            <picture class="colaborador-picture">
                                <source srcset="/../<?php echo $boletapago->colaborador->foto; ?>.webp" type="image/webp">
                                <source srcset="/../<?php echo $boletapago->colaborador->foto; ?>.png" type="image/png">
                                <img class="colaborador-picture--imagen-carta" loading="lazy" width="200" height="300" src="/../<?php echo $boletapago->colaborador->foto; ?>.webp" alt="Imagen Ponente">
                            </picture>
                        <?php } ?>
                        <div class="card-body">
                            <h5 class="card-title carta-titulo">
                                <?php echo $boletapago->colaborador->nombre . " " . $boletapago->colaborador->apellido_paterno; ?>
                            </h5>
                            <p class="card-text carta-descripcion">Cedula: <?php echo $boletapago->colaborador->cedula; ?>
                            </p>
                            <a href="/admin/boletaspagos/lista?page=1&id=<?php echo $boletapago->colaborador_id; ?>" class="btn boton-carta  mb-2 w-100 boton-carta--editar">
                                <i class="fa-solid fa-eye"></i>
                                Ver Boletas de pago
                            </a>
                        </div>
                    </div>
                </div>
            <?php }; ?>
        </div>

    <?php } else { ?>
        <p class="text-center">No hay Boletas de Pago Registradas</p>
    <?php } ?>
    <?php echo $paginacion; ?>


    <div class="modal" id="exito" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <i class="fa-solid fa-bell" id="icono-exito"></i>
                    <h5 class="modal-title titulo-modal">Mensaje</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="modal-mensaje">Se creo la boleta con exito.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-modal" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="error_guardar" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <i class="fa-solid fa-triangle-exclamation" id="icono-error"></i>
                    <h5 class="modal-title titulo-modal">Mensaje</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="modal-mensaje">Hubo un error al guardarlo, intentelo mas tarde.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-modal" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="error_abrir_archivo" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <i class="fa-solid fa-triangle-exclamation" id="icono-error"></i>
                    <h5 class="modal-title titulo-modal">Mensaje</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="modal-mensaje">Hubo un error al abrir el archivo, intentelo mas tarde.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-modal" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="error_procesamiento" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <i class="fa-solid fa-triangle-exclamation" id="icono-error"></i>
                    <h5 class="modal-title titulo-modal">Mensaje</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="modal-mensaje">Hubo un error en el procesamiento, intentelo mas tarde.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-modal" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="error_desconocido" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <i class="fa-solid fa-triangle-exclamation" id="icono-error"></i>
                    <h5 class="modal-title titulo-modal">Mensaje</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="modal-mensaje">Hubo un error desconocido, intentelo mas tarde.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-modal" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

</div>