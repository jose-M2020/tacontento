<?php
namespace App\Http\Controllers;

require_once 'app/config/config.php';

use Core\Http\Request;
use App\Models\Usuario;
use App\Models\Carrito;
use App\Utilities\Utilidades;

class AuthController
{
    function __construct(){
        if(!isset($_SESSION)){ 
            session_start(); 
        }  
    }

    public function auth()
    {
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
            if ($respuesta['role'] == 'admin') {
                $_SESSION['usuario'] = $respuesta;
                header('Location: '. BASE_URL .'/ofertas');
                die();
            } else if($respuesta['role'] == 'client'){
                $cart = new Carrito();
                $respuesta['cartNum'] = $cart->count($respuesta['id']) ?? 0;
                $_SESSION['usuario'] = $respuesta;
                header('Location: '. BASE_URL .'/');
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
            header('Location: '. BASE_URL .'/auth?section=register');
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
            'role' => "2",
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
      session_destroy();
      header('Location: '. BASE_URL .'/');
    }
}
