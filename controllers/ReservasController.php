<?php

namespace Controllers;

use MVC\Router;

use Model\Colaboradores;

class ReservasController
{

    public static function index(Router $router)
    {
        session_start();
        // Validar que el usuario esté logueado y sea administrador
        if (!isset($_SESSION['admin']) || $_SESSION['admin']) {
            header('Location: /login');
            return;
        }

        $rol_usuario = $_SESSION['admin'];

        $colaborador = Colaboradores::find($_SESSION['id']);

        $router->render('colaborador/reservaciones/index', [
            'titulo' => 'Reservacion de Salas',
            'rol_usuario' => $rol_usuario,
            'colaborador' => $colaborador
        ]);
    }
}
