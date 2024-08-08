<?php include_once __DIR__ . '/../../templates/alertas.php'; ?>


<div class="contenedor-admin contenedor-admin__info">
    <h1 class="contenedor-admin__titulo"><?php echo $titulo; ?></h1>

    <?php if (!empty($vacaciones)) { ?>
    <div class="row">
        <?php foreach ($vacaciones as $vacacion) { ?>
        <div class="col-xl-4 col-md-6 col-xs-12 mb-4">
            <div class="card-col">
                <?php if ($vacacion->colaborador->foto === "null") { ?>
                <picture class="colaborador-picture">
                    <source srcset="/../img/colaboradores/default.png" type="image/png">
                    <img class="colaborador-picture--imagen-carta" loading="lazy" width="200" height="300"
                        src="/../img/colaboradores/default.png" alt="Imagen Ponente">
                </picture>
                <?php } else { ?>
                <picture class="colaborador-picture">
                    <source srcset="/../<?php echo $vacacion->colaborador->foto; ?>.webp" type="image/webp">
                    <source srcset="/../<?php echo $vacacion->colaborador->foto; ?>.png" type="image/png">
                    <img class="colaborador-picture--imagen-carta" loading="lazy" width="200" height="300"
                        src="/../<?php echo $vacacion->colaborador->foto; ?>.webp" alt="Imagen Ponente">
                </picture>
                <?php } ?>
                <div class="card-body">
                    <h5 class="card-title carta-titulo">
                        <?php echo $vacacion->colaborador->nombre . " " . $vacacion->colaborador->apellido_paterno; ?>
                    </h5>
                    <p class="card-text carta-descripcion">Cedula: <?php echo $vacacion->colaborador->cedula; ?>
                    </p>
                    <a href="/admin/vacaciones/lista?page=1&id=<?php echo $vacacion->colaborador_id; ?>"
                        class="btn boton-carta  mb-2 w-100 boton-carta--editar">
                        <i class="fa-solid fa-eye"></i>
                        Ver vacaciones solicitadas
                    </a>
                </div>
            </div>
        </div>
        <?php }; ?>
    </div>

    <?php } else { ?>
    <p class="text-center">No hay Incapacidades Registradas</p>
    <?php } ?>
    <?php echo $paginacion; ?>

</div>