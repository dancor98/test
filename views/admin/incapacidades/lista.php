<?php include_once __DIR__ . '/../../templates/alertas.php'; ?>


<div class="contenedor-admin contenedor-admin__info">
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

    <!-- Dropdown de filtro de meses -->
    <div class="row">
        <div class="col">
            <div class="formulario__campo">
                <label for="periodo" class="formulario__label">Estado:</label>
                <select class="formulario__select" id="filtroEstado">
                    <option value="">Todas</option>
                    <option value="Pendiente">Pendientes</option>
                    <option value="Recibida">Recibidas</option>

                </select>
            </div>
        </div>
    </div>

    <?php if (!empty($incapacidades)) { ?>
        <div class="table-responsive">
            <table class="table">
                <thead class="table__thead">
                    <tr>
                        <th class="table__th" scope="col">ID</th>
                        <th class="table__th" scope="col">Colaborador</th>
                        <th class="table__th" scope="col">Cedula</th>
                        <th class="table__th" scope="col">Creada</th>
                        <th class="table__th" scope="col">Desde</th>
                        <th class="table__th" scope="col">Hasta</th>
                        <th class="table__th" scope="col">Estado</th>
                        <th class="table__th" scope="col"></th>
                        <th class="table__th" scope="col"></th>
                    </tr>
                </thead>
                <tbody class="table__tbody">
                    <?php foreach ($incapacidades as $incapacidad) { ?>
                        <tr class="table__tr">
                            <td class="table__td">
                                <?php echo $incapacidad->id; ?>
                            </td>
                            <td class="table__td">
                                <?php echo $incapacidad->colaborador->nombre . ' ' . $incapacidad->colaborador->apellido_paterno; ?>
                            </td>
                            <td class="table__td">
                                <?php echo $incapacidad->colaborador->cedula; ?>
                            </td>
                            <td class="table__td">
                                <?php echo $incapacidad->fecha; ?>
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
                                <a class="table__accion table__accion--editar" href="/../<?php echo $incapacidad->boleta; ?>" download="Boleta Incapacidad <?php echo $incapacidad->colaborador->nombre . ' ' . $incapacidad->colaborador->apellido_paterno . '-' . $incapacidad->fecha; ?>">
                                    Descargar
                                </a>
                            </td>
                            <td class="table__Td">
                                <a class="table__accion table__accion--editar" href="/admin/incapacidades/observar?id=<?php echo $incapacidad->id; ?>">
                                    <i class="fa-solid fa-eye"></i>
                                    Ver
                                </a>
                            </td>
                        </tr>
                    <?php }; ?>
                </tbody>
            </table>
        </div>

    <?php } else { ?>
        <p class="text-center">No hay incapacidades registradas</p>
    <?php } ?>
    <?php
    echo $paginacion;
    ?>
</div>