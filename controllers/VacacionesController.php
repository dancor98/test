<?php

namespace Controllers;

use Classes\Email;
use Classes\Paginacion;
use Classes\PDF;
use Model\Colaboradores;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;
use Model\Departamentos;
use Model\Empresas;
use Model\Vacaciones;

class VacacionesController
{

    public static function index(Router $router)
    {
        session_start();
        // Validar que el usuario esté logueado y sea administrador
        if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
            header('Location: /login');
            return;
        }

        $rol_usuario = $_SESSION['rol'];

        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if (!$pagina_actual || $pagina_actual < 1) {
            header('Location: /admin/vacaciones?page=1');
        }

        $registros_por_paginas = 10;
        $total = Vacaciones::total();
        $paginacion = new Paginacion($pagina_actual, $registros_por_paginas, $total);

        if ($paginacion->total_paginas() < $pagina_actual) {
            header('Location: /admin/vacaciones?page=1');
        }

        $vacaciones = Vacaciones::paginarUnicos($registros_por_paginas, $paginacion->offset());

        //Extrae las llaves foraneas
        foreach ($vacaciones as $vacacion) {
            $vacacion->colaborador = Colaboradores::find($vacacion->colaborador_id);
        }

        $router->render('admin/vacaciones/index', [
            'titulo' => 'Vacaciones Solicitadas',
            'vacaciones' => $vacaciones,
            'paginacion' => $paginacion->paginacion()
        ]);
    }

    public static function lista(Router $router)
    {
        session_start();
        // Validar que el usuario esté logueado y sea administrador
        if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
            header('Location: /login');
            return;
        }

        $rol_usuario = $_SESSION['admin'];

        // Extraer el parámetro 'page' y validar
        $pagina_actual = isset($_GET['page']) ? filter_var($_GET['page'], FILTER_VALIDATE_INT) : 1;
        if (!$pagina_actual || $pagina_actual < 1) {
            $pagina_actual = 1;
        }

        // Extraer el parámetro 'id'
        $id = isset($_GET['id']) ? filter_var($_GET['id'], FILTER_VALIDATE_INT) : null;


        // Extraer el parámetro 'estado'
        $estado = isset($_GET['estado']) ? filter_var($_GET['estado'], FILTER_SANITIZE_STRING) : '';

        // Configuración de paginación
        $registros_por_paginas = 10;
        $total = Vacaciones::total();
        $paginacion = new Paginacion($pagina_actual, $registros_por_paginas, $total, $id, $estado);

        // Redirigir si la página solicitada es mayor que el total de páginas
        if ($paginacion->total_paginas() < $pagina_actual) {
            header('Location: /admin/vacaciones/lista?page=1' . ($id ? "&id={$id}" : '') . ($estado ? "&estado={$estado}" : ''));
            return;
        }

        // Obtener los registros paginados
        if ($id) {
            $vacaciones = Vacaciones::paginarID_Estado($registros_por_paginas, $paginacion->offset(), $id, $estado);
        } else {
            header('Location: /admin/vacaciones?page=1');
        }

        // Extraer las llaves foráneas
        foreach ($vacaciones as $vacacion) {
            $vacacion->colaborador = Colaboradores::find($vacacion->colaborador_id);
        }

        $router->render('admin/vacaciones/lista', [
            'titulo' => 'Vacaciones Solicitadas',
            'vacaciones' => $vacaciones,
            'rol_usuario' => $rol_usuario,
            'paginacion' => $paginacion->paginacion()
        ]);
    }

    //funcion para editar el etado de las Vacaciones
    public static function editar(Router $router)
    {
        session_start();
        // Validar que el usuario esté logueado y sea administrador
        if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
            header('Location: /login');
            return;
        }


        $rol_usuario = $_SESSION['admin'];
        $alertas = [];

        //Validar ID
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT); //vALIDA QUE REALMENTE SEA UN ENTERO

        if (!$id) {
            header('Location: /admin/vacaciones');
        }

        //Obtener Solicitud a Editar
        $vacacion = Vacaciones::find($id);

        if (!$vacacion) {
            header('Location: /admin/vacaciones');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            // Validar que el usuario esté logueado y sea administrador
            if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
                header('Location: /login');
                return;
            }

            $vacacion->sincronizar($_POST);
            $alertas = $vacacion->validar();

            if (empty($alertas)) {

                $resultado = $vacacion->guardar();

                // Enviar email
                $colaborador = Colaboradores::find($vacacion->colaborador_id);
                $estado_nuevo = $_POST['estado'];

                $email = new Email($colaborador->correo_electronico, $colaborador->nombre, $estado_nuevo);
                $email->enviarEstadoVacaciones();

                if ($resultado) {
                    if (isset($_POST['estado']) && strpos($_POST['estado'], 'Rebajadas') === 0) {
                        $colaborador->dias_utilizados = $colaborador->dias_utilizados + $vacacion->cantidad;
                        $resultado = $colaborador->guardar();
                    }

                    header('Location: /admin/vacaciones?estado=exito');
                }
            }
        }


        $router->render('admin/vacaciones/editar', [
            'titulo' => 'Editar el estado de la solicitud',
            'alertas' => $alertas,
            'rol_usuario' => $rol_usuario,
            'vacacion' => $vacacion
        ]);
    }


    //----------------------------Area Colaborador---------------------------------------//

    public static function indexColaborador(Router $router)
    {
        session_start();
        // Validar que el usuario esté logueado y sea administrador
        if (!$_SESSION || $_SESSION['admin'] === "1") {
            header('Location: /login');
            return;
        }
        $rol_usuario = $_SESSION['admin'];

        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if (!$pagina_actual || $pagina_actual < 1) {
            header('Location: /colaborador/vacaciones?page=1');
        }

        $colaborador = Colaboradores::find($_SESSION['id']);


        $registros_por_paginas = 10;
        $total = Vacaciones::total();
        $paginacion = new Paginacion($pagina_actual, $registros_por_paginas, $total);
        $colaborador_id = $_SESSION['id'];

        if ($paginacion->total_paginas() < $pagina_actual) {
            header('Location: /colaborador/vacaciones?page=1');
        }

        $vacaciones = Vacaciones::paginarColaboradores($registros_por_paginas, $paginacion->offset(), $colaborador_id);

        //Extrae las llaves foraneas
        foreach ($vacaciones as $vacacion) {
            $vacacion->colaborador = Colaboradores::find($vacacion->colaborador_id);
        }

        $router->render('colaborador/vacaciones/index', [
            'titulo' => 'Vacaciones Solicitadas',
            'vacaciones' => $vacaciones,
            'paginacion' => $paginacion->paginacion(),
            'rol_usuario' => $rol_usuario,
            'colaborador' => $colaborador
        ]);
    }

    public static function crear(Router $router)
    {
        session_start();
        // Validar que el usuario esté logueado y sea administrador
        if (!$_SESSION || $_SESSION['admin'] === "1") {
            header('Location: /login');
            return;
        }
        $rol_usuario = $_SESSION['admin'];

        $alertas = [];
        $vacacion = new Vacaciones();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            // Validar que el usuario esté logueado y sea administrador
            if (!$_SESSION || $_SESSION['admin'] === "1") {
                header('Location: /login');
                return;
            }
            $vacacion->sincronizar($_POST);
            $alertas = $vacacion->validar();
            if (empty($alertas)) {
                $resultado = $vacacion->guardar();
                $colaborador = Colaboradores::find($_SESSION['id']);
                // Enviar email
                $email = new Email($colaborador->correo_electronico, $colaborador->nombre . " " . $colaborador->apellido_paterno . " " . $colaborador->apellido_materno, '');
                $email->enviarSolicitud();

                if ($resultado) {
                    header('Location: /colaborador/vacaciones?estado=exito');
                    return;
                } else {
                    header('Location: /colaborador/vacaciones?estado=error');
                }
            }
        }

        $colaborador = Colaboradores::find($_SESSION['id']);


        $router->render('colaborador/vacaciones/crear', [
            'titulo' => 'Solicitar Vacaciones',
            'alertas' => $alertas,
            'vacacion' => $vacacion,
            'rol_usuario' => $rol_usuario,
            'colaborador' => $colaborador
        ]);
    }

    //funcion para editar las vacaciones
    public static function editarColaborador(Router $router)
    {
        session_start();
        // Validar que el usuario esté logueado y sea administrador
        if (!$_SESSION || $_SESSION['admin'] === "1") {
            header('Location: /login');
            return;
        }
        $rol_usuario = $_SESSION['admin'];

        $alertas = [];

        //Validar ID
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT); //vALIDA QUE REALMENTE SEA UN ENTERO

        if (!$id) {
            header('Location: /colaborador/vacaciones');
        }

        //Obtener Solicitud a Editar
        $vacacion = Vacaciones::find($id);

        if (!$vacacion) {
            header('Location: /colaborador/vacaciones');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            session_start();
            // Validar que el usuario esté logueado y sea administrador
            if (!$_SESSION || $_SESSION['admin'] === "1") {
                header('Location: /login');
                return;
            }

            $vacacion->sincronizar($_POST);
            $alertas = $vacacion->validar();


            if (empty($alertas)) {

                $resultado = $vacacion->guardar();

                if ($resultado) {
                    header('Location: /colaborador/vacaciones?estado=exito');
                } else {
                    header('Location: /colaborador/vacaciones?estado=error');
                }
            }
        }


        $colaborador = Colaboradores::find($_SESSION['id']);


        $router->render('colaborador/vacaciones/editar', [
            'titulo' => 'Editar Solicitud',
            'alertas' => $alertas,
            'vacacion' => $vacacion,
            'rol_usuario' => $rol_usuario,
            'colaborador' => $colaborador
        ]);
    }
}
