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
                <label for="estado" class="formulario__label">Estado:</label>
                <select class="formulario__select" id="filtroEstado">
                    <option value="">Todas</option>
                    <option value="Pendiente">Pendientes</option>
                    <option value="En Revision">En Revision</option>
                    <option value="Aprobadas">Aprobadas</option>
                    <option value="Rechazadas">Rechazadas</option>
                    <option value="Rebajadas">Rebajadas</option>
                </select>
            </div>
        </div>
    </div>

    <?php if (!empty($vacaciones)) { ?>
        <div class="table-responsive">
            <table class="table">
                <thead class="table__thead">
                    <tr>
                        <th class="table__th" scope="col">ID</th>
                        <th class="table__th" scope="col">Colaborador</th>
                        <th class="table__th" scope="col">Cedula</th>
                        <th class="table__th" scope="col">Fecha de Solicitud</th>
                        <th class="table__th" scope="col">Cant Dias Solicitados</th>
                        <th class="table__th" scope="col">Estado</th>
                        <th class="table__th" scope="col"></th>
                    </tr>
                </thead>
                <tbody class="table__tbody">
                    <?php foreach ($vacaciones as $vacacion) { ?>
                        <tr class="table__tr">
                            <td class="table__td">
                                <?php echo $vacacion->id; ?>
                            </td>
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
                                <?php echo $vacacion->estado; ?>
                            </td>
                            <td class="table__td">
                                <a class="table__accion table__accion--editar" href="/admin/vacaciones/editar?id=<?php echo $vacacion->id; ?>">
                                    <i class="fa-solid fa-edit"></i>
                                    Ver y editar
                                </a>
                            </td>
                        </tr>
                    <?php }; ?>
                </tbody>
            </table>
        </div>

    <?php } else { ?>
        <p class="text-center">No hay vacaciones registradas</p>
    <?php } ?>
    <?php
    echo $paginacion;
    ?>
</div>