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
                <label for="periodo" class="formulario__label">Periodo:</label>
                <select class="formulario__select" id="filtroPeriodo">
                    <option value="">Todos los meses</option>
                    <option value="Enero">Enero</option>
                    <option value="Febrero">Febrero</option>
                    <option value="Marzo">Marzo</option>
                    <option value="Abril">Abril</option>
                    <option value="Mayo">Mayo</option>
                    <option value="Junio">Junio</option>
                    <option value="Julio">Julio</option>
                    <option value="Agosto">Agosto</option>
                    <option value="Septiembre">Septiembre</option>
                    <option value="Octubre">Octubre</option>
                    <option value="Noviembre">Noviembre</option>
                    <option value="Diciembre">Diciembre</option>
                </select>
            </div>
        </div>
    </div>

    <?php if (!empty($boletaspagos)) { ?>
        <div class="table-responsive">
            <table class="table">
                <thead class="table__thead">
                    <tr>
                        <th class="table__th" scope="col">ID</th>
                        <th class="table__th" scope="col">Colaborador</th>
                        <th class="table__th" scope="col">Cedula</th>
                        <th class="table__th" scope="col">Creada</th>
                        <th class="table__th" scope="col">Periodo</th>
                        <th class="table__th" scope="col"></th>
                    </tr>
                </thead>
                <tbody class="table__tbody">
                    <?php foreach ($boletaspagos as $boletapago) { ?>
                        <tr class="table__tr">
                            <td class="table__td">
                                <?php echo $boletapago->id; ?>
                            </td>
                            <td class="table__td">
                                <?php echo $boletapago->colaborador->nombre . ' ' . $boletapago->colaborador->apellido_paterno; ?>
                            </td>
                            <td class="table__td">
                                <?php echo $boletapago->colaborador->cedula; ?>
                            </td>
                            <td class="table__td">
                                <?php echo $boletapago->fecha; ?>
                            </td>
                            <td class="table__td">
                                <?php echo $boletapago->periodo; ?>
                            </td>
                            <td class="table__td">
                                <a class="table__accion table__accion--editar" href="/../<?php echo $boletapago->archivo_pdf; ?>" download="Boleta Pago <?php echo $boletapago->colaborador->nombre . ' ' . $boletapago->colaborador->apellido_paterno . '-' . $boletapago->fecha; ?>">
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
        <p class="text-center">No hay Boletas de pago creadas.</p>
    <?php } ?>
    <?php echo $paginacion; ?>
</div>