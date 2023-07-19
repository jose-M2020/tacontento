<?php
require_once 'model/Usuario.php';
class LoginController
{
    public function login()
    {
        // require_once('./views/auth/index.php');
        header('Location: views/auth/');
    }
    
    public function loginAcceso()
    {

        session_start();
        $user = new Usuario();
        $respuesta = $user->login($_POST['email'], $_POST['password']);

        if ($respuesta) {
            if ($respuesta['admin'] == 1) {
                session_start();
                $_SESSION['usuario'] = $respuesta;
                header('Location: index.php?page=dashboard');
                die();
            } else if($respuesta['admin'] == 2){
                $_SESSION['cliente'] = $respuesta;
                header('Location: index.php?page=index');
            }else {
                header('Location: index.php?page=login');
                echo "Location: index.php?page=login";
                die();
            }
        } else {
            header('Location: index.php?page=login');
            echo "Usuario y/o contraseña incorrectos";
        }
    }
}
