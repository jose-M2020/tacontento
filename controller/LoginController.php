<?php
require_once 'model/Usuario.php';
require_once 'utilidades/Utilidades.php';

class LoginController
{
    function __construct(){
        if(!isset($_SESSION)){ 
            session_start(); 
        }  
    }

    public function login()
    {
      require_once('views/auth/index.php');
    }
    
    public function loginAcceso()
    {
        $user = new Usuario();
        $respuesta = $user->login($_POST['email'], $_POST['password']);
        $utilities = new Utilidades();

        if ($respuesta) {
            if ($respuesta['admin'] == 1) {
                $_SESSION['usuario'] = $respuesta;
                header('Location: index.php?page=dashboard');
                die();
            } else if($respuesta['admin'] == 2){
                $_SESSION['cliente'] = $respuesta;
                header('Location: index.php?page=index');
            }else {
                $utilities->setMessage('error', 'Credenciales incorrectas. Inténtalo de nuevo.');
                header('Location: index.php?page=login');
            }
        } else {
            $utilities->setMessage('error', 'Credenciales incorrectas. Inténtalo de nuevo.');
            header('Location: index.php?page=login');
        }
    }
}
