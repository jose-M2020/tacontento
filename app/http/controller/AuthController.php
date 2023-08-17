<?php
require_once 'app/model/Usuario.php';
require_once 'app/model/Carrito.php';
require_once 'app/utilidades/Request.php';
require_once 'app/utilidades/Utilidades.php';
require_once 'app/config.php';

class AuthController
{
    function __construct(){
        if(!isset($_SESSION)){ 
            session_start(); 
        }  
    }

    public function auth()
    {
      print_r($_GET);
      require_once('./app/views/auth/index.php');
    }
    
    public function login()
    {
        $request = new Request();
        $user = new Usuario();
        $utilities = new Utilidades();

        $respuesta = $user->login(
          $request->input('email'),
          $request->input('password')
        );

        if ($respuesta) {
            if ($respuesta['admin'] == 1) {
                $_SESSION['usuario'] = $respuesta;
                header('Location: '. BASE_URL .'/dashboard');
                die();
            } else if($respuesta['admin'] == 2){
                $cart = new Carrito();
                $respuesta['cartNum'] = $cart->count($respuesta['id']) ?? 0;
                $_SESSION['cliente'] = $respuesta;
                header('Location: '. BASE_URL .'/home');
            }else {
                $utilities->setMessage('error', 'Credenciales incorrectas. Inténtalo de nuevo.');
                header('Location: '. BASE_URL .'/auth');
            }
        } else {
            $utilities->setMessage('error', 'Credenciales incorrectas. Inténtalo de nuevo.');
            header('Location: '. BASE_URL .'/auth');
        }
    }

    public function register()
    {
        $request = new Request();
        $userModel = new Usuario();
        $utilities = new Utilidades();
        
        $emailExist = $userModel->checkEmailExists($request->input('email'));

        if ($emailExist) {
            $utilities->setMessage('error', 'El correo ya se encuentra registrado.');
            header('Location: '. BASE_URL .'/auth&section=register');
            return;
        }

        $datos = array(
            'nombre' => $request->input('nombre'),
            'apellidos' => $request->input('apellidos'),
            'direccion' => $request->input('direccion'),
            'email' => $request->input('email'),
            'edad' => $request->input('edad'),
            'telefono' => $request->input('telefono'),
            'password' => $request->input('password'),
            'admin' => "2",
        );

        $userModel->storeuser($datos);
        require_once('./app/views/auth/index.php');

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

    public function logout()
    {
        if (isset($_SESSION['usuario']) || isset($_SESSION['cliente'] )) {
            session_destroy();
            header('Location: '. BASE_URL .'/home');
        } else {
            header('Location: '. BASE_URL .'/home');
        }
    }
}
