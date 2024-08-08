<?php

namespace Controllers;

use Classes\Email;
use Datamatrix;
use DateTime;
use Model\Colaboradores;
use MVC\Router;

class AuthController
{
    public static function login(Router $router)
    {
        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Colaboradores($_POST);
            $alertas = $usuario->validarLogin();
            if (empty($alertas)) {
                // Verificar quel el usuario exista
                $usuario = Colaboradores::where('correo_electronico', $usuario->correo_electronico);
                if (!$usuario || !$usuario->confirmado) {
                    Colaboradores::setAlerta('error', 'El Usuario No Existe o no esta confirmado');
                } else {
                    // El Usuario existe
                    if (password_verify($_POST['contrasena'], $usuario->contrasena)) {

                        // Iniciar la sesión
                        session_start();
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre;
                        $_SESSION['apellido_paterno'] = $usuario->apellido_paterno;
                        $_SESSION['correo_electronico'] = $usuario->correo_electronico;
                        $_SESSION['admin'] = $usuario->admin ?? null;
                        $_SESSION['puesto'] = $usuario->puesto;
                        $_SESSION['fecha_ingreso'] = $usuario->fecha_ingreso;
                        $_SESSION['foto'] = $usuario->foto;
                        $_SESSION['dias_utilizados'] = $usuario->dias_utilizados;

                        $colaborador = Colaboradores::find($_SESSION['id']);

                        if (session_start() === true) {
                            //Redireccionamiento
                            if ($_SESSION['admin'] === "1") {
                                header('Location: /admin/dashboard');
                            } else {

                                //crea variable con la fecha de ingreso de cada colaborador y la fecha actual
                                $fecha_actual = date('y-m-d');
                                $fecha_ingreso = $_SESSION['fecha_ingreso'];

                                $date1 = new \DateTime($fecha_ingreso);
                                $date2 = new \DateTime($fecha_actual);

                                $interval = $date1->diff($date2);

                                $months = $interval->y * 12 + $interval->m;

                                $colaborador->meses_trabajados = $months;

                                $resultado = $colaborador->guardar();

                                header('Location: /colaborador/dashboard');
                            }
                        }
                    } else {
                        Colaboradores::setAlerta('error', 'Contrasena Incorrecto');
                    }
                }
            }
        }

        $alertas = Colaboradores::getAlertas();

        // Render a la vista 
        $router->render('auth/login', [
            'titulo' => 'Iniciar Sesión',
            'alertas' => $alertas
        ]);
    }

    public static function logout()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            $_SESSION = [];
            header('Location: /login');
        }
    }

    public static function olvide(Router $router)
    {
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Colaboradores($_POST);
            $alertas = $usuario->validarCorreo();

            if (empty($alertas)) {
                // Buscar el usuario
                $usuario = Colaboradores::where('correo_electronico', $usuario->correo_electronico);

                if ($usuario && $usuario->confirmado) {

                    // Generar un nuevo token
                    $usuario->crearToken();
                    unset($usuario->contrasena2);

                    // Actualizar el usuario
                    $usuario->guardar();

                    // Enviar el email
                    $email = new Email($usuario->correo_electronico, $usuario->nombre, $usuario->token);
                    $email->enviarInstrucciones();

                    // Imprimir la alerta
                    // Usuario::setAlerta('exito', 'Hemos enviado las instrucciones a tu email');
                    $alertas['exito'][] = 'Hemos enviado las instrucciones a tu email';
                } else {
                    // Usuario::setAlerta('error', 'El Usuario no existe o no esta confirmado');
                    $alertas['error'][] = 'El Usuario no existe o no esta confirmado';
                }
            }
        }

        // Muestra la vista
        $router->render('auth/olvide', [
            'titulo' => 'Olvide mi Password',
            'alertas' => $alertas
        ]);
    }

    public static function reestablecer(Router $router)
    {
        $token = s($_GET['token']);
        $token_valido = true;
        if (!$token) header('Location: /');
        // Identificar el usuario con este token
        $usuario = Colaboradores::where('token', $token);
        if (empty($usuario)) {
            Colaboradores::setAlerta('error', 'Token No Válido, intenta de nuevo');
            $token_valido = false;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Añadir el nuevo password
            $usuario->sincronizar($_POST);

            // Validar el password
            $alertas = $usuario->validarContrasena();

            if (empty($alertas)) {
                // Hashear el nuevo password
                $usuario->hashContrasena();

                // Eliminar el Token
                $usuario->token = null;

                // Guardar el usuario en la BD
                $resultado = $usuario->guardar();

                // Redireccionar
                if ($resultado) {
                    header('Location: /login');
                }
            }
        }

        $alertas = Colaboradores::getAlertas();

        // Muestra la vista
        $router->render('auth/reestablecer', [
            'titulo' => 'Reestablecer Password',
            'alertas' => $alertas,
            'token_valido' => $token_valido
        ]);
    }

    // public static function mensaje(Router $router)
    // {

    //     $router->render('auth/mensaje', [
    //         'titulo' => 'Cuenta Creada Exitosamente'
    //     ]);
    // }

    public static function confirmar(Router $router)
    {
        $token = s($_GET['token']);

        if (!$token) header('Location: /');

        // Encontrar al usuario con este token
        $usuario = Colaboradores::where('token', $token);

        if (empty($usuario)) {
            // No se encontró un usuario con ese token
            Colaboradores::setAlerta('error', 'Token No Válido... Tu cuenta no fue confirmada correctamente');
        } else {
            // Confirmar la cuenta
            $usuario->confirmado = 1;
            $usuario->token = '';
            unset($usuario->password2);

            // Guardar en la BD
            $usuario->guardar();

            Colaboradores::setAlerta('exito', 'Cuenta Comprobada Correctamente');
        }



        $router->render('auth/confirmar', [
            'titulo' => 'Confirma tu cuenta Grupo CCM',
            'alertas' => Colaboradores::getAlertas()
        ]);
    }
}
