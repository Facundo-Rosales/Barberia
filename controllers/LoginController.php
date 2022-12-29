<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController
{
    public static function login(Router $router)
    {

        $alertas = [];
       
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);

            $alertas =  $auth->validarLogin();

            if (empty($alertas)) {
                //    comprobar que exista el usuario
                $usuario = Usuario::where('email', $auth->email);

                if ($usuario) {
                    // verificae el parword
                    if ($usuario->comprobarPasswordVerificado($auth->password));
                    // autenticar usuario
                    $_SESSION['id'] = $usuario->id;
                    $_SESSION['nombre'] = $usuario->nombre . " " .
                    $usuario->apellido;
                    $_SESSION['email'] = $usuario->email;
                    $_SESSION['login'] = true;

                    // redireccionar
                    if ($usuario->admin === "1") {
                        $_SESSION['admin'] = $usuario->admin ?? null;

                        header('Location: admin');
                    } else {
                        header('Location: cita');
                    }
                } else {
                    Usuario::setAlerta('error', 'Usuario no encontrado');
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/login', [
            'alertas' => $alertas
        ]);
    }

    public static function logout()
    {
        session_start();
        

        if (session_start()) {
            $_SESSION = [];
            header('Location: http://localhost:3000/public/');
        }
    }

    public static function olvide(Router $router)
    {

        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            $alertas = $auth->validarEmail();

            if (empty($alertas)) {
                $usuario = Usuario::where('email', $auth->email);

                if ($usuario && $usuario->confirmado === "1") {
                    // genera un token
                    $usuario->crearToken();
                    $usuario->guardar();
                    //  todo: evisar el email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarInstrucciones();

                    // elerta de ususarios
                    Usuario::setAlerta('exito', 'Revisa tu Correo y sigue las instrucciones ');
                } else {
                    Usuario::setAlerta('error', 'El usuario no existe o no esta confirmado');
                }
            }
        }
        $alertas = Usuario::getAlertas();
        $router->render('auth/olvide-password', [
            'alertas' => $alertas
        ]);
    }

    public static function recuperar(Router $router)
    {
        $alertas = [];
        $error = false;

        $token = s($_GET['token']);

        // buscra USUARIO POR ITOKEN
        $usuario = Usuario::where('token', $token);

        if (empty($usuario)) {
            Usuario::setAlerta('error', 'Token no válido');
            $error = true;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // leer en nuevo password y guardarlo
            $password = new Usuario($_POST);
            $alertas = $password->validarPassword();

            if (empty($alertas)) {
                $usuario->password = null;
                // 
                $usuario->password = $password->password;
                $usuario->hashPassword();
                $usuario->token = null;

                $resultado = $usuario->guardar();
                if ($resultado) {
                    header('Location: login');
                }
            }
        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/recuperar-password', [
            'alertas' => $alertas,
            'error' => $error

        ]);
    }

    public static function crear(Router $router)
    {

        $usuario = new Usuario;
        // alertas
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            // revisar si las alertas estan vacias
            if (empty($alertas)) {
                // verificar que el usuario no este registrado
                $resultado = $usuario->existeUsuario();

                if ($resultado->num_rows) {
                    $alertas = Usuario::getAlertas();
                } else {
                    // hasear password
                    $usuario->hashPassword();

                    // generar token unico
                    $usuario->crearToken();

                    // enviar el email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarConfirmacion();

                    // crear el usuario
                    $resultado = $usuario->guardar();

                    // debuguear($usuario);
                    if ($resultado) {
                        header('Location: mensaje');
                    }
                }
            }
        }

        $router->render('auth/crear-cuenta', [
            'usuario' => $usuario,
            'alertas' => $alertas


        ]);
    }

    public static function mensaje(Router $router)
    {
        $router->render('auth/mensaje');
    }

    public static function confirmar(Router $router)
    {
        $alertas = [];

        $token = s($_GET['token']);

        $usuario = Usuario::where('token', $token);

        if (empty($usuario)) {
            // mostrar mensaje de error
            Usuario::setAlerta('error', 'Token no Valido');
        } else {
            // modificar a ususario confirmar
            $usuario->confirmado = '1';
            $usuario->token = '';
            $usuario->guardar();

            Usuario::setAlerta('exito', 'Cuenta Confirmada Corresctamente');
        }

        // obtener alertas
        $alertas = Usuario::getAlertas();
        // rendederixar la vista
        $router->render('auth/confirmar-cuenta', [
            'alertas' => $alertas

        ]);
    }
}
