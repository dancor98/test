<h1 class="contenedor-admin__titulo"><?php echo $titulo; ?></h1>

<?php include_once __DIR__ . '/../../templates/alertas.php'; ?>

<div class="contenedor-colab contenedor-admin__info">

    <?php if (!empty($boletaspagos)) { ?>


        <div class="table-responsive">
            <table class="table" id="tablaBoletas">
                <thead class="table__thead">
                    <tr>
                        <th class="table__th" scope="col">Colaborador</th>
                        <th class="table__th" scope="col">Cedula</th>
                        <th class="table__th" scope="col">Fecha Creacion</th>
                        <th class="table__th" scope="col">Periodo</th>
                        <th class="table__th" scope="col">Empresa</th>
                        <th class="table__th" scope="col"></th>
                    </tr>
                </thead>
                <tbody class="table__tbody">
                    <?php foreach ($boletaspagos as $boletapago) { ?>
                        <tr class="table__tr">
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
                                <?php echo $boletapago->empresa->nombre; ?>
                            </td>
                            <td class="table__td">
                                <a class="table__accion table__accion--editar" href="/../<?php echo $incapacidad->boleta; ?>" download="Boleta incapacidad <?php echo $incapacidad->colaborador->nombre . ' ' . $incapacidad->colaborador->apellido_paterno . '-' . $incapacidad->fecha; ?>">
                                    <i class="fa-solid fa-download"></i>Descargar
                                </a>
                            </td>
                        </tr>
                    <?php }; ?>
                </tbody>
            </table>
        </div>

    <?php } else { ?>
        <p class="text-center">No tienes boletas de pago</p>
    <?php } ?>
    <?php
    echo $paginacion;
    ?>
</div>