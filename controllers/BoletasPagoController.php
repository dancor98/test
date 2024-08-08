<?php

namespace Controllers;

use Classes\Email;
use Classes\PDF;
use Classes\Paginacion;
use Model\Colaboradores;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;
use Model\BoletasPago;
use Model\Empresas;

class BoletasPagoController
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
            header('Location: /admin/boletaspagos?page=1');
        }

        $registros_por_paginas = 10;
        $total = BoletasPago::total();
        $paginacion = new Paginacion($pagina_actual, $registros_por_paginas, $total);

        if ($paginacion->total_paginas() < $pagina_actual) {
            header('Location: /admin/boletaspagos?page=1');
        }

        $boletaspagos = BoletasPago::paginarUnicos($registros_por_paginas, $paginacion->offset());

        foreach ($boletaspagos as $boletapago) {
            $boletapago->colaborador = Colaboradores::find($boletapago->colaborador_id);
        }

        $router->render('admin/boletaspagos/index', [
            'titulo' => 'Boletas Pagos',
            'boletaspagos' => $boletaspagos,
            'rol_usuario' => $rol_usuario,
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

        // Extraer el parámetro 'periodo'
        $periodo = isset($_GET['periodo']) ? filter_var($_GET['periodo'], FILTER_SANITIZE_STRING) : '';


        // Configuración de paginación
        $registros_por_paginas = 15;
        $total = BoletasPago::total();
        $paginacion = new Paginacion($pagina_actual, $registros_por_paginas, $total, $id, $periodo);

        // Redirigir si la página solicitada es mayor que el total de páginas
        if ($paginacion->total_paginas() < $pagina_actual) {
            header('Location: /admin/boletaspagos/lista?page=1' . ($id ? "&id={$id}" : '') . ($periodo ? "&periodo={$periodo}" : ''));
            return;
        }

        // Obtener los registros paginados
        if ($id) {
            $boletaspagos = BoletasPago::paginarID_Periodo($registros_por_paginas, $paginacion->offset(), $id, $periodo);
        } else {
            header('Location: /admin/boletaspagos?page=1');
        }

        // Extraer las llaves foráneas
        foreach ($boletaspagos as $boletapago) {
            $boletapago->colaborador = Colaboradores::find($boletapago->colaborador_id);
        }

        $router->render('admin/boletaspagos/lista', [
            'titulo' => 'Boletas de Pago',
            'boletaspagos' => $boletaspagos,
            'rol_usuario' => $rol_usuario,
            'paginacion' => $paginacion->paginacion()
        ]);
    }



    public static function cargarDesdeCSV(Router $router)
    {
        session_start();
        // Validar que el usuario esté logueado y sea administrador
        if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
            header('Location: /login');
            return;
        }

        $rol_usuario = $_SESSION['admin'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verificar si se ha subido un archivo CSV
            if (isset($_FILES['csv_file']) && $_FILES['csv_file']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['csv_file']['tmp_name'];
                $fileName = $_FILES['csv_file']['name'];
                $fileSize = $_FILES['csv_file']['size'];
                $fileType = $_FILES['csv_file']['type'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));

                // Verificar la extensión del archivo
                if ($fileExtension === 'csv') {
                    try {
                        // Abrir el archivo CSV para lectura
                        if (($handle = fopen($fileTmpPath, 'r')) !== false) {
                            // Leer los encabezados del CSV
                            $headers = fgetcsv($handle, 1000, ",");

                            // Procesar cada fila del CSV
                            while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                                // Crear una nueva instancia de BoletasPago
                                $boletapago = new BoletasPago();

                                // Asignar los valores del CSV a la instancia, omitiendo los campos no necesarios
                                $boletapago->colaborador_id = $data[0]; //columna A
                                $boletapago->empresa_id = $data[1]; //columna B
                                $boletapago->salario_quincenal = $data[9]; //columna J
                                $boletapago->comisiones = $data[10]; //columna K
                                $boletapago->feriados = $data[11]; //columna L
                                $boletapago->total_devengado = $data[12]; //columna M
                                $boletapago->ccss = $data[13]; //columna N
                                $boletapago->impuestos_renta = $data[14]; //columna O
                                $boletapago->otras_deducciones = $data[15]; //columna P
                                $boletapago->embargo = $data[16]; //columna Q
                                $boletapago->incapacidades = $data[17]; //columna R
                                $boletapago->total_deducciones = $data[18]; //columna S
                                $boletapago->primer_quincena = $data[19]; //columna T
                                $boletapago->segunda_quincena = $data[20]; //columna U
                                $boletapago->periodo = $data[21]; //columna V
                                $boletapago->fecha = date('y-m-d');

                                // Obtener el colaborador desde la base de datos
                                $colaborador = Colaboradores::find($boletapago->colaborador_id);
                                $empresa = Empresas::find($boletapago->empresa_id);

                                if ($colaborador && $empresa) {
                                    // Generar el PDF en memoria
                                    $pdf = new PDF();
                                    $carpetaDestino = __DIR__ . '/../public/uploads/boletasPago/';
                                    $nombreArchivoPDF = $pdf->generarPDF([
                                        'nombre_empresa' => $empresa->nombre ?? '',
                                        'Fecha' => $boletapago->fecha,
                                        'Nombre' => $colaborador->nombre ?? '',
                                        'Apellido' => ($colaborador->apellido_paterno ?? '') . ' ' . ($colaborador->apellido_materno ?? ''),
                                        'Cedula' => $colaborador->cedula ?? '',
                                        'Base' => $colaborador->salario ?? '',
                                        'Quincenal' => $boletapago->salario_quincenal,
                                        'Comisiones' => $boletapago->comisiones,
                                        'Incapacidad' => $boletapago->incapacidades,
                                        'Feriados' => $boletapago->feriados,
                                        'devengado' => $boletapago->total_devengado,
                                        'Ccss' => $boletapago->ccss,
                                        'Renta' => $boletapago->impuestos_renta,
                                        'Odeducciones' => $boletapago->otras_deducciones,
                                        'Embargo' => $boletapago->embargo,
                                        'Deducciones' => $boletapago->total_deducciones,
                                        'Quincena1' => $boletapago->primer_quincena,
                                        'Quincena2' => $boletapago->segunda_quincena,
                                        'Periodo' => $boletapago->periodo
                                    ], $carpetaDestino);

                                    // Asignar el nombre del archivo generado al objeto BoletasPago
                                    $boletapago->archivo_pdf = 'uploads/boletasPago/' . basename($nombreArchivoPDF);

                                    // Guardar la boleta de pago en la base de datos
                                    $resultado = $boletapago->guardar();

                                    // Enviar el PDF por correo electrónico
                                    $correo_electronico = $colaborador->correo_electronico ?? '';
                                    $nombre_colaborador = $colaborador->nombre ?? '';
                                    $ruta_archivo = $boletapago->archivo_pdf ?? '';
                                    $email = new Email($correo_electronico, $nombre_colaborador, $ruta_archivo);
                                    $email->enviarConfirmacionBoleta();
                                }
                            }
                            fclose($handle);

                            // Redirigir después de procesar el archivo con éxito
                            header('Location: /admin/boletaspagos/cargar?estado=exito');
                            exit;
                        } else {
                            // Error al abrir el archivo
                            header('Location: /admin/boletaspagos/cargar?estado=error_abrir_archivo');
                            exit;
                        }
                    } catch (\Exception $e) {
                        // En caso de cualquier error, redirigir a la URL de error
                        header('Location: /admin/boletaspagos/cargar?estado=error_procesamiento');
                        exit;
                    }
                } else {
                    // Error de extensión del archivo
                    header('Location: /admin/boletaspagos/cargar?estado=error_extension');
                    exit;
                }
            } else {
                // Error en la carga del archivo
                header('Location: /admin/boletaspagos/cargar?estado=error_carga');
                exit;
            }
        }

        // Renderizar la vista con los datos necesarios
        $router->render('admin/boletaspagos/cargar', [
            'titulo' => 'Crear Boletas Pago CSV',
            'rol_usuario' => $rol_usuario
        ]);
    }

    public static function crear(Router $router)
    {
        session_start();
        // Validar que el usuario esté logueado y sea administrador
        if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
            header('Location: /login');
            return;
        }
        $alertas = [];
        $boletapago = new BoletasPago();
        $empresa_id = '';
        $empresa_nombre = '';
        $nombre_colaborador = '';
        $apellido_paterno = '';
        $apellido_materno = '';
        $cedula = '';
        $correo_electronico = '';
        $salario = '';

        $rol_usuario = $_SESSION['admin'];

        // Capturar el ID del colaborador desde la URL
        $colaborador_id = $_GET['id'] ?? null;

        // Verificar si se proporcionó un ID válido
        if ($colaborador_id) {
            // Obtener el colaborador desde la base de datos
            $colaborador = Colaboradores::find($colaborador_id);

            if ($colaborador) {
                // Obtener datos del colaborador
                $nombre_colaborador = $colaborador->nombre;
                $apellido_paterno = $colaborador->apellido_paterno;
                $apellido_materno = $colaborador->apellido_materno;
                $cedula = $colaborador->cedula;
                $correo_electronico = $colaborador->correo_electronico;
                $salario = $colaborador->salario;

                // Obtener el ID y nombre de la empresa asociada al colaborador
                $empresa_id = $colaborador->empresa_id;
                $empresa = Empresas::find($empresa_id);
                $empresa_nombre = $empresa->nombre ?? '';
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validar que el usuario esté logueado y sea administrador
            if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
                header('Location: /login');
                return;
            }

            $rol_usuario = $_SESSION['admin'];

            // Sincronizar y validar datos de la boleta de pago
            $boletapago->sincronizar($_POST);
            $alertas = $boletapago->validar();

            if (empty($alertas)) {
                try {
                    // Generar el PDF en memoria
                    $pdf = new PDF();
                    $carpetaDestino = __DIR__ . '/../public/uploads/boletasPago/';
                    $nombreArchivoPDF = $pdf->generarPDF([
                        'nombre_empresa' => $empresa_nombre,
                        'Fecha' => date('Y-m-d'),
                        'Nombre' => $nombre_colaborador,
                        'Apellido' => $apellido_paterno . ' ' . $apellido_materno,
                        'Cedula' => $cedula,
                        'Base' => $salario,
                        'Quincenal' => $boletapago->salario_quincenal, // Añadir el salario quincenal al PDF
                        'Comisiones' => $boletapago->comisiones,
                        'Incapacidad' => $boletapago->incapacidades,
                        'Feriados' => $boletapago->feriados,
                        'devengado' => $boletapago->total_devengado,
                        'Ccss' => $boletapago->ccss,
                        'Renta' => $boletapago->impuestos_renta,
                        'Odeducciones' => $boletapago->otras_deducciones,
                        'Embargo' => $boletapago->embargo,
                        'Deducciones' => $boletapago->total_deducciones,
                        'Quincena1' => $boletapago->primer_quincena,
                        'Quincena2' => $boletapago->segunda_quincena,
                        'Periodo' => $boletapago->periodo
                    ], $carpetaDestino);

                    // Asignar el nombre del archivo generado al objeto BoletasPago
                    $boletapago->archivo_pdf = 'uploads/boletasPago/' . basename($nombreArchivoPDF);

                    // Guardar la boleta de pago en la base de datos
                    $resultado = $boletapago->guardar();

                    if ($resultado) {
                        // Enviar el PDF por correo electrónico
                        $ruta_archivo = $boletapago->archivo_pdf ?? '';
                        $email = new Email($correo_electronico, $nombre_colaborador, $ruta_archivo);
                        $email->enviarConfirmacionBoleta();

                        // Redirigir después de guardar y enviar el correo
                        header('Location: /admin/boletaspagos?page=1&estado=exito');
                        exit;
                    } else {
                        header('Location: /admin/boletaspagos?page=1&estado=error_guardar');
                        exit;
                    }
                } catch (\Exception $e) {
                    // Manejo de errores específicos
                    if (strpos($e->getMessage(), 'No such file or directory') !== false) {
                        header('Location: /admin/boletaspagos?page=1&estado=error_abrir_archivo');
                    } elseif (strpos($e->getMessage(), 'Error generating PDF') !== false) {
                        header('Location: /admin/boletaspagos?page=1&estado=error_procesamiento');
                    } else {
                        header('Location: /admin/boletaspagos?page=1&estado=error_desconocido');
                    }
                    exit;
                }
            }
        }

        // Renderizar la vista con los datos necesarios
        $router->render('admin/boletaspagos/crear', [
            'titulo' => 'Registrar Boleta de Pago',
            'alertas' => $alertas,
            'boletapago' => $boletapago,
            'colaborador_id' => $colaborador_id,
            'empresa_id' => $empresa_id,
            'empresa_nombre' => $empresa_nombre,
            'nombre_colaborador' => $nombre_colaborador,
            'apellido_paterno' => $apellido_paterno,
            'apellido_materno' => $apellido_materno,
            'cedula' => $cedula,
            'correo_electronico' => $correo_electronico,
            'salario' => $salario,
            'rol_usuario' => $rol_usuario
        ]);
    }



    //------------------------------------------------------------------------------//
    //Colaboradores

    public static function indexColaborador(Router $router)
    {
        session_start();

        // Validar que el usuario esté logueado y sea administrador
        if (!$_SESSION || $_SESSION['admin'] === "1") {
            header('Location: /login');
            return;
        }

        $rol_usuario = $_SESSION['admin'];

        $colaborador = Colaboradores::find($_SESSION['id']);

        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if (!$pagina_actual || $pagina_actual < 1) {
            header('Location: /colaborador/boletapago?page=1');
        }

        $registros_por_paginas = 10;
        $total = BoletasPago::total();
        $paginacion = new Paginacion($pagina_actual, $registros_por_paginas, $total);
        $colaborador_id = $_SESSION['id'];

        if ($paginacion->total_paginas() < $pagina_actual) {
            header('Location: /colaborador/boletapago?page=1');
        }

        $boletaspagos = BoletasPago::paginarColaboradores($registros_por_paginas, $paginacion->offset(), $colaborador_id);

        // Extrae las llaves foraneas
        foreach ($boletaspagos as $boletapago) {
            $boletapago->colaborador = Colaboradores::find($boletapago->colaborador_id);
            $boletapago->empresa = Empresas::find($boletapago->empresa_id);
        }

        $router->render('colaborador/boletapago/index', [
            'titulo' => 'Mis boletas de pago',
            'boletaspagos' => $boletaspagos,
            'rol_usuario' => $rol_usuario,
            'paginacion' => $paginacion->paginacion(),
            'colaborador' => $colaborador
        ]);
    }
}
