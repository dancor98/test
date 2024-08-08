<h1 class="contenedor-admin__titulo"><?php echo $titulo; ?></h1>

<?php include_once __DIR__ . '/../../templates/alertas.php'; ?>


<div class="contenedor-admin contenedor-admin__info">
    <?php if (!empty($postulaciones)) { ?>
        <div class="row">
            <?php foreach ($postulaciones as $postulacion) { ?>
                <div class="col-xl-4 col-md-6 col-xs-12 mb-4">
                    <div class="card-col">
                        <div class="card-body">
                            <h5 class="card-title carta-titulo">
                                <?php echo $postulacion->nombre . " " . $postulacion->apellido_paterno; ?>
                            </h5>
                            <p class="card-text carta-descripcion">Departamento de Interes:
                                <?php echo $postulacion->departamento->nombre; ?>
                            </p>
                            <p class="card-text carta-descripcion">Estado:
                                <?php echo $postulacion->estado; ?>
                            </p>

                            <a href="/admin/postulaciones/observar?id=<?php echo $postulacion->id; ?>" class="btn boton-carta btn-primary mb-2 w-100">
                                <i class="fa-solid fa-user-pen"></i>
                                Ver
                            </a>
                        </div>
                    </div>
                </div>
            <?php }; ?>
        </div>


    <?php } else { ?>
        <p class="text-center">No hay Postulaciones Registradas</p>
    <?php } ?>
    <?php
    echo $paginacion;
    ?>
</div>