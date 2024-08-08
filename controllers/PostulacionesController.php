<?php


namespace Controllers;

use Model\Carreras;
use Classes\Paginacion;
use Classes\Email;
use Model\Departamentos;
use MVC\Router;


class PostulacionesController
{


    public static function index(Router $router)
    {
        session_start();
        // Validar que el usuario esté logueado y sea administrador
        if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
            header('Location: /login');
            return;
        }

        $rol_usuario = $_SESSION['admin'];

        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if (!$pagina_actual || $pagina_actual < 1) {
            header('Location: /admin/postulaciones?page=1');
        }

        $registros_por_paginas = 10;
        $total = Carreras::total();
        $paginacion = new Paginacion($pagina_actual, $registros_por_paginas, $total);

        if ($paginacion->total_paginas() < $pagina_actual) {
            header('Location: /admin/postulaciones?page=1');
        }

        $postulaciones = Carreras::paginar($registros_por_paginas, $paginacion->offset());

        //Extrae las llaves foraneas
        foreach ($postulaciones as $postulacion) {
            $postulacion->departamento = Departamentos::find($postulacion->departamento_id);
        }

        $router->render('admin/postulaciones/index', [
            'titulo' => 'Postulaciones',
            'postulaciones' => $postulaciones,
            'rol_usuario' => $rol_usuario,
            'paginacion' => $paginacion->paginacion()
        ]);
    }

    //funcion para editar el etado de las Vacaciones
    public static function observar(Router $router)
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
            header('Location: /admin/postulaciones');
        }

        //Obtener Postulacion a Editar
        $postulacion = Carreras::find($id);
        $postulacion->departamento = Departamentos::find($postulacion->departamento_id);

        if (!$postulacion) {
            header('Location: /admin/postulaciones');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            // Validar que el usuario esté logueado y sea administrador
            if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
                header('Location: /login');
                return;
            }

            $estado_data = ['estado' => $_POST['estado']];
            $postulacion->sincronizar($estado_data);
            $alertas = $postulacion->validar();

            if (empty($alertas)) {
                $resultado = $postulacion->guardar();

                if ($resultado) {
                    // Enviar email
                    $estado_nuevo = $_POST['estado'];
                    $email = new Email($postulacion->correo, $postulacion->nombre, $estado_nuevo);
                    $email->enviarEstadoPostulacion();
                    header('Location: /admin/postulaciones?estado=exito');
                }
            }
        }


        $router->render('admin/postulaciones/observar', [
            'titulo' => 'Postulacion',
            'alertas' => $alertas,
            'rol_usuario' => $rol_usuario,
            'postulacion' => $postulacion
        ]);
    }
}
