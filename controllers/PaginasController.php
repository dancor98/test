<?php

namespace Controllers;

use Model\Carreras;
use MVC\Router;
use Model\Departamentos;

class PaginasController
{

    public static function index(Router $router)
    {
        $router->render('paginas/index', [
            'titulo' => 'inicio',
        ]);
    }
    public static function nosotros(Router $router)
    {
        $router->render('paginas/nosotros', [
            'titulo' => 'Nosotros',
        ]);
    }
    public static function productosServicios(Router $router)
    {
        $router->render('paginas/productos-servicios', [
            'titulo' => 'Productos y Servicios',
        ]);
    }
    public static function localidades(Router $router)
    {
        $router->render('paginas/localidades', [
            'titulo' => 'Localidades',
        ]);
    }

    public static function carreras(Router $router)
    {

        $alertas = [];
        $carrera = new Carreras();

        $departamentos = Departamentos::all('ASC');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $carrera->sincronizar($_POST);
            $alertas = $carrera->validar();



            // Manejar la carga del archivo PDF
            if (isset($_FILES['cv']) && $_FILES['cv']['error'] === UPLOAD_ERR_OK) {
                $nombreArchivo = $_FILES['cv']['name'];
                $rutaTemporal = $_FILES['cv']['tmp_name'];
                $carpetaDestino = __DIR__ . '/../public/uploads/postulaciones/'; // Ruta dentro de 'public'

                // Crear la carpeta si no existe
                if (!is_dir($carpetaDestino)) {
                    mkdir($carpetaDestino, 0755, true);
                }

                // Limpiar el nombre del archivo
                $nombreArchivo = strtolower(str_replace([' ', '_'], '-', $nombreArchivo));
                $nombreArchivo = preg_replace('/[^a-z0-9\-\.]/', '', $nombreArchivo);

                // Mover el archivo a la carpeta destino
                $rutaArchivo = $carpetaDestino . uniqid() . '-' . $nombreArchivo;
                if (move_uploaded_file($rutaTemporal, $rutaArchivo)) {
                    // Guardar la ruta relativa a 'public' en la base de datos
                    $carrera->cv = 'uploads/postulaciones/' . basename($rutaArchivo);
                } else {
                    $alertas[] = 'Error al mover el archivo PDF.';
                }
            } else {
                $alertas[] = 'Error al cargar el archivo PDF.';
            }

            if (empty($alertas)) {
                $resultado = $carrera->guardar();

                if ($resultado) {
                    header('Location: /carreras?estado=exito');
                    return;
                } else {
                    header('Location: /carreras?estado=error');
                }
            }
        }


        $router->render('paginas/carreras', [
            'titulo' => 'Postularme',
            'alertas' => $alertas,
            'departamentos' => $departamentos,
            'carrera' => $carrera
        ]);
    }


    public static function error(Router $router)
    {
        $router->render('paginas/error', [
            'titulo' => 'Error 404 - Pagina no encontrada'
        ]);
    }
}
