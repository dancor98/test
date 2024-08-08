<?php

namespace Controllers;

use Model\Carreras;
use Model\Colaboradores;
use Model\Vacaciones;
use MVC\Router;

class DashboardController
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

        $colaboradoresTotal = Colaboradores::totalGeneral();
        $solicitudvacacionesN = Vacaciones::totalVacacionesN();
        $postulacionesTotal = Carreras::totalPostulaciones();

        $router->render('admin/dashboard/index', [
            'titulo' => 'Modulos Disponibles',
            'colaboradoresTotal' => $colaboradoresTotal,
            'solicitudvacacionesN' => $solicitudvacacionesN,
            'rol_usuario' => $rol_usuario,
            'postulacionesTotal' => $postulacionesTotal
        ]);
    }
}
