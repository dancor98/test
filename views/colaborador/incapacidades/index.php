<h1 class="contenedor-admin__titulo"><?php echo $titulo; ?></h1>

<?php include_once __DIR__ . '/../../templates/alertas.php'; ?>


<div class="contenedor-colab contenedor-admin__info">

    <div class="row justify-content-end botones-acciones">
        <div class="col-12 col-md-auto mb-2 mb-md-0">
            <div class="boton-acciones">
                <a href="/colaborador/incapacidades/crear" class="boton-acciones__texto">
                    <i class="fa-solid fa-circle-plus icono-admin"></i>
                    Cargar Incapacidad
                </a>
            </div>
        </div>
    </div>

    <?php if (!empty($incapacidades)) { ?>
        <div class="table-responsive">
            <table class="table">
                <thead class="table__thead">
                    <tr>
                        <th class="table__th" scope="col">Colaborador</th>
                        <th class="table__th" scope="col">Cedula</th>
                        <th class="table__th" scope="col">Creada</th>
                        <th class="table__th" scope="col">Cant de Dias</th>
                        <th class="table__th" scope="col">Desde</th>
                        <th class="table__th" scope="col">Hasta</th>
                        <th class="table__th" scope="col">Estado</th>
                        <th class="table__th" scope="col"></th>
                    </tr>
                </thead>
                <tbody class="table__tbody">
                    <?php foreach ($incapacidades as $incapacidad) { ?>
                        <tr class="table__tr">
                            <td class="table__td">
                                <?php echo $incapacidad->colaborador->nombre . ' ' . $boletapago->colaborador->apellido_paterno; ?>
                            </td>
                            <td class="table__td">
                                <?php echo $incapacidad->colaborador->cedula; ?>
                            </td>
                            <td class="table__td">
                                <?php echo $incapacidad->fecha; ?>
                            </td>
                            <td class="table__td">
                                <?php echo $incapacidad->cantidad_dias; ?>
                            </td>
                            <td class="table__td">
                                <?php echo $incapacidad->desde; ?>
                            </td>
                            <td class="table__td">
                                <?php echo $incapacidad->hasta; ?>
                            </td>
                            <td class="table__td">
                                <?php echo $incapacidad->estado; ?>
                            </td>
                            <td class="table__td">
                                <a class="table__accion table__accion--editar" href="/../<?php echo $incapacidad->boleta; ?>" download="Boleta incapacidad <?php echo $incapacidad->colaborador->nombre . ' ' . $incapacidad->colaborador->apellido_paterno . '-' . $incapacidad->fecha; ?>">
                                    <i class="fa-solid fa-download"></i>
                                    Descargar
                                </a>
                            </td>
                        </tr>
                    <?php }; ?>
                </tbody>
            </table>
        </div>
    <?php } else { ?>
        <p class="text-center">No hay Incapacidades Registradas</p>
    <?php } ?>
</div>

<?php echo $paginacion; ?>