<div class="contenedor-colab">
    <div class="row">
        <div class="col-xl-3 col-md-12">
            <div class="card-dashboard">
                <h2 class="contenedor-admin__fecha">
                    <i class="fa-solid fa-calendar-days icono-admin"></i>
                    Fecha Actual
                </h2>
                <h2 class="contenedor-admin__fecha">
                    <?php echo date('d-m-y'); ?>
                </h2>
            </div>
        </div>
    </div>

    <h2 class="contenedor-admin__titulo"><?php echo $titulo; ?></h2>

    <div class="row">
        <div class="col-xl-6 ">
            <div class="card-admin">
                <a href="/colaborador/incapacidades">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fa-solid fa-hospital-user icono-admin"></i>
                            Incapacidades
                        </h5>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-xl-6 ">
            <div class="card-admin">
                <a href="/colaborador/vacaciones">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fa-solid fa-plane-departure icono-admin"></i>Vacaciones</h5>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-xl-6 ">
            <div class="card-admin">
                <a href="/colaborador/boletapago">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fa-solid fa-money-check-dollar icono-admin"></i>Boletas de pago
                        </h5>
                    </div>
                </a>
            </div>
        </div>
    </div>

</div>