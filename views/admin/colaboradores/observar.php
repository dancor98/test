<h1 class="contenedor-admin__titulo"><?php echo $titulo; ?></h1>

<div class="contenedor-formulario">
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

    <?php include_once __DIR__ . '/../../templates/alertas.php'; ?>

    <form class="formulario">

        <fieldset class="formulario__fieldset">
            <legend class="formulario__legend">Informacion Personal</legend>

            <div class="row row-campo">
                <div class="col">
                    <label for="nombre" class="formulario__label">Nombre:</label>
                    <input type="text" class="formulario__input form-control" name="nombre" id="nombre"
                        placeholder="Nombre Colaborador" value="<?php echo $colaborador->nombre ?? ''; ?>" readonly>
                </div>
                <div class="col">
                    <label for="apellido_paterno" class="formulario__label">Apellido:</label>
                    <input type="text" class="formulario__input form-control" name="apellido_paterno"
                        id="apellido_paterno" placeholder="Apellido paterno"
                        value="<?php echo $colaborador->apellido_paterno ?? ''; ?>" readonly>
                </div>
                <div class="col">
                    <label for="apellido_materno" class="formulario__label">Apellido:</label>
                    <input type="text" class="formulario__input form-control" name="apellido_materno"
                        id="apellido_materno" placeholder="Apellido materno"
                        value="<?php echo $colaborador->apellido_materno ?? ''; ?>" readonly>
                </div>
            </div>

            <div class="row row-campo">
                <div class="col">
                    <label for="cedula" class="formulario__label">Cedula:</label>
                    <input type="number" class="formulario__input form-control" name="cedula" id="cedula"
                        placeholder="cedula colaborador" value="<?php echo $colaborador->cedula ?? ''; ?>" readonly>
                </div>
                <div class="col">
                    <label for="fecha_nacimiento" class="formulario__label">Fecha Nacimiento:</label>
                    <input type="date" class="formulario__input form-control" name="fecha_nacimiento"
                        id="fecha_nacimiento" placeholder="" value="<?php echo $colaborador->fecha_nacimiento ?? ''; ?>"
                        readonly>
                </div>
            </div>

            <div class="row row-campo">
                <div class="col">
                    <label for="correo_electronico" class="formulario__label">Correo:</label>
                    <input type="email" class="formulario__input form-control" name="correo_electronico"
                        id="correo_electronico" placeholder="Correo Electronico"
                        value="<?php echo $colaborador->correo_electronico ?? ''; ?>" readonly>
                </div>
                <div class="col">
                    <label for="telefono" class="formulario__label">Telefono:</label>
                    <input type="number" class="formulario__input form-control" name="telefono" id="telefono"
                        placeholder="" value="<?php echo $colaborador->telefono ?? ''; ?>" readonly>
                </div>
            </div>
        </fieldset>

        <fieldset class="formulario__fieldset">
            <legend class="formulario__legend">Informacion Medica</legend>

            <div class="row row-campo">
                <div class="col">
                    <label for="nombre_emergencia" class="formulario__label">Nombre:</label>
                    <input type="text" class="formulario__input form-control" name="nombre_emergencia"
                        id="nombre_emergencia" placeholder="Nombre Contacto de Emergencia"
                        value="<?php echo $colaborador->nombre_emergencia ?? ''; ?>" readonly>
                </div>
                <div class="col">
                    <label for="telefono_emergencia" class="formulario__label">Telefono:</label>
                    <input type="tel" class="formulario__input form-control" name="telefono_emergencia"
                        id="telefono_emergencia" placeholder="Telefono Contacto Emergencia"
                        value="<?php echo $colaborador->telefono_emergencia ?? ''; ?>" readonly>
                </div>
            </div>

        </fieldset>


        <fieldset class="formulario__fieldset">
            <legend class="formulario__legend">Informacion Trabajo</legend>

            <div class="row row-campo">
                <div class="col">
                    <label for="departamento" class="formulario__label">Departamento:</label>
                    <input type="text" class="formulario__input form-control" name="puesto" id="puesto" placeholder=""
                        value="<?php echo $colaborador->departamento->nombre ?? ''; ?>" readonly>

                </div>
                <div class="col">
                    <label for="puesto" class="formulario__label">Puesto:</label>
                    <input type="text" class="formulario__input form-control" name="puesto" id="puesto" placeholder=""
                        value="<?php echo $colaborador->puesto ?? ''; ?>" readonly>
                </div>
            </div>

            <div class="formulario__campo">
                <label for="empresa" class="formulario__label">empresa:</label>
                <input type="text" class="formulario__input form-control" name="puesto" id="puesto" placeholder=""
                    value="<?php echo $colaborador->empresa->nombre ?? ''; ?>" readonly>

            </div>

            <div class="formulario__campo">
                <label for="salario" class="formulario__label">Salario:</label>
                <input type="text" class="formulario__input form-control" name="salario" id="salario" placeholder=""
                    value="₡ <?php echo $colaborador->salario ?? ''; ?>" readonly>
            </div>

            <div class="formulario__campo">
                <label for="fecha_ingreso" class="formulario__label">Fecha Ingreso:</label>
                <input type="text" class="formulario__input form-control" name="fecha_ingreso" id="fecha_ingreso"
                    placeholder="" value="<?php echo $colaborador->fecha_ingreso ?? ''; ?>" readonly>
            </div>


        </fieldset>
    </form>

    <a href="/admin/boletaspagos/lista?page=1&id=<?php echo $colaborador->id; ?>"
        class="btn boton-carta  mb-2 w-100 boton-carta--editar">
        Boletas de pago
    </a>
    <a href="/admin/vacaciones/lista?page=1&id=<?php echo $colaborador->id; ?>"
        class="btn boton-carta  mb-2 w-100 boton-carta--editar">
        vacaciones
    </a>
    <a href="/admin/incapacidades/lista?page=1&id=<?php echo $colaborador->id; ?>"
        class="btn boton-carta  mb-2 w-100 boton-carta--editar">
        Incapacidades
    </a>

</div>