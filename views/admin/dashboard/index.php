<div class="contenedor-admin">

    <div class="row">
        <div class="col-xl-3 col-md-6">
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
        <div class="col-xl-3 col-md-6">
            <div class="card-dashboard">
                <h2 class="contenedor-admin__fecha">
                    <i class="fa-solid fa-plane-departure icono-admin"></i>
                    Nuevas Solicitudes
                </h2>
                <h2 class="contenedor-admin__fecha">
                    <?php echo $solicitudvacacionesN; ?>
                </h2>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card-dashboard">
                <h2 class="contenedor-admin__fecha">
                    <i class="fa-solid fa-users-line icono-admin"></i>
                    Colaboradores Activos
                </h2>
                <h2 class="contenedor-admin__fecha">
                    <?php echo $colaboradoresTotal; ?>
                </h2>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card-dashboard">
                <h2 class="contenedor-admin__fecha">
                    <i class="fa-solid fa-file icono-admin"></i>
                    Nuevas Postulaciones
                </h2>
                <h2 class="contenedor-admin__fecha">
                    <?php echo $postulacionesTotal; ?>
                </h2>
            </div>
        </div>
    </div>

    <h2 class="contenedor-admin__titulo"><?php echo $titulo; ?></h2>

    <div class="row">
        <div class="col-xl-6 col-md-6 ">
            <a href="/admin/incapacidades">
                <div class="card-admin">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fa-solid fa-hospital-user icono-admin"></i>
                            Incapacidades
                        </h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-6 col-md-6 ">
            <a href="/admin/vacaciones">
                <div class="card-admin">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fa-solid fa-plane-departure icono-admin"></i>Solicitudes</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-6 col-md-6 ">
            <a href="/admin/colaboradores">
                <div class="card-admin">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fa-solid fa-users-line icono-admin"></i>Colaboradores</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-6 col-md-6 ">
            <a href="/admin/boletaspagos">
                <div class="card-admin">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fa-solid fa-money-check-dollar icono-admin"></i>Salarios</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-6 col-md-6 ">
            <a href="/admin/departamentos">
                <div class="card-admin">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fa-solid fa-building-user icono-admin"></i>Departamentos</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-6 col-md-6 ">
            <a href="/admin/empresas">
                <div class="card-admin">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fa-solid fa-building icono-admin"></i>Empresas</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-6 col-md-6 ">
            <a href="/admin/postulaciones">
                <div class="card-admin">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fa-regular fa-file icono-admin"></i>Postulaciones</h5>
                    </div>
                </div>
            </a>
        </div>
    </div>

</div>