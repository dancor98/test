<?php include_once __DIR__ . '/../../templates/alertas.php'; ?>


<div class="contenedor-admin contenedor-admin__info">

    <h1 class="contenedor-admin__titulo"><?php echo $titulo; ?></h1>

    <div class="row justify-content-end botones-acciones">
        <div class="col-12 col-md-auto mb-2 mb-md-0">
            <div class="boton-acciones">
                <a href="/admin/departamentos/crear" class="boton-acciones__texto">
                    <i class="fa-solid fa-circle-plus icono-admin"></i>
                    Crear Departamento
                </a>
            </div>
        </div>
    </div>

    <?php if (!empty($departamentos)) { ?>

    <div class="table-responsive">
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th class="table__th" scope="col">ID</th>
                    <th class="table__th" scope="col">Departamento</th>
                    <th class="table__th" scope="col"></th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php foreach ($departamentos as $departamento) { ?>
                <tr class="table__tr">
                    <td class="table__td">
                        <?php echo $departamento->id; ?>
                    </td>
                    <td class="table__td">
                        <?php echo $departamento->nombre; ?>
                    </td>
                    <td class="table__td table__td--acciones">
                        <form method="POST" action="/admin/departamentos/eliminar">
                            <input type="hidden" name="id" value="<?php echo $departamento->id; ?>">
                            <button class="btn boton-carta btn-danger mb-2 w-100" type="submit">
                                <i class="fa-solid fa-circle-xmark"></i>
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                <?php }; ?>
            </tbody>
        </table>
    </div>

    <?php } else { ?>
    <p class="text-center">No hay Departamentos Activos</p>
    <?php } ?>

    <?php
    echo $paginacion;
    ?>
</div>