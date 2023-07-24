<?php
require_once 'model/Usuario.php';
require_once 'utilidades/Utilidades.php';

class AuthController
{
    function __construct(){
        if(!isset($_SESSION)){ 
            session_start(); 
        }  
    }

    public function auth()
    {
      require_once('views/auth/index.php');
    }
    
    public function login()
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
                header('Location: index.php?page=auth');
            }
        } else {
            $utilities->setMessage('error', 'Credenciales incorrectas. Inténtalo de nuevo.');
            header('Location: index.php?page=auth');
        }
    }

    public function register()
    {
        $userModel = new Usuario();
        $utilities = new Utilidades();
        $emailExist = $userModel->checkEmailExists($_POST['email']);

        if ($emailExist) {
            $utilities->setMessage('error', 'El correo ya se encuentra registrado.');
            header('Location: index.php?page=auth&section=register');
            return;
        }

        $datos = array(
            'nombre' => $_POST['nombre'],
            'apellidos' => $_POST['apellidos'],
            'direccion' => $_POST['direccion'],
            'email' => $_POST['email'],
            'edad' => $_POST['edad'],
            'telefono' => $_POST['telefono'],
            'password' => $_POST['password'],
            'admin' => "2",
        );

        $userModel->storeuser($datos);
        require_once('./views/auth/index.php');

        #if( !empty($_POST['password']) && strlen($_POST['password']) >= 7 )  $datos['password'] = md5($_POST['password']);
        #refactor this
        #$validate = new Request(); 
        #$errores = $validate->validateuser($datos);



        /*if(empty($errores)){
            $user = new Usuario();
            $user->storeuser($datos);
            
            session_destroy();
        }else{
           $_SESSION['errores'] = $errores;
           session_destroy();
           
        }
        */
    }
}
