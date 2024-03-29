<?php
namespace App\Http\Controllers;

require_once 'app/config/config.php';

use App\Models\Usuario;
use Core\Http\Request;
use App\Utilities\Utilidades;

class UsuariosController
{
    function __construct(){
        if(!isset($_SESSION)){ 
            session_start(); 
        }  
    }
    public function index()
    {
        #inicializando los valores
        $users = new Usuario;
        $utilities = new Utilidades();
        $startOfPaging = 0;
        $amountOfThePaging = 8;
        $search = "";
        #asignando el inicio de de los articulos a paginar
        if (isset($_GET['p'])) $startOfPaging = $utilities->pagination($_GET['p'], $amountOfThePaging);
        #asignando la busqueda si existe
        if (isset($_GET['search'])) $search =  $_GET['search'];

        $section = $users->paginationuser($search);
        $users = $users->indexuser($search, $startOfPaging, $amountOfThePaging);

        $utilities->view('admin.usuario.index', [
          'users' =>$users,
          'section' => $section,
          'search' =>$search
        ]);
    }
    public function show()
    { }
    public function create()
    {
      $utilities = new Utilidades();
      $utilities->view('admin.usuario.create');
    }

    public function store()
    {
        $request = new Request();
        $userModel = new Usuario();
        $utilities = new Utilidades();
        $emailExist = $userModel->checkEmailExists($request->input('email'));

        if ($emailExist) {
            $utilities->setMessage('error', 'El correo ya se encuentra registrado.');
            header('Location: '. BASE_URL .'/usuarios/create');
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
        header('Location: '. BASE_URL .'/usuarios/create');



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


    public function edit($params)
    {
        $idUsuario = $params['usuario'];
        $user = new Usuario();
        $utilities = new Utilidades();
        $user = $user->edituser($idUsuario);

        $utilities->view('admin.usuario.edit', ['user' => $user]);
    }

    public function update($params)
    {
        $request = new Request();
        $user = new Usuario;
        $utilities = new Utilidades();

        // TODO: Validate email in update request
        // $emailExist = $user->checkEmailExists($request->input('email'));

        // if ($emailExist) {
        //     $utilities->setMessage('error', 'El correo ya se encuentra registrado.');
        //     header('Location: '. BASE_URL .'/createusuario');
        //     return;
        // }

        $datos = array(
            'id'   =>  $params['usuario'],
            'nombre' => $request->input('nombre'),
            'apellidos' => $request->input('apellidos'),
            'direccion' => $request->input('direccion'),
            'email' => $request->input('email'),
            'edad' => $request->input('edad'),
            'telefono' => $request->input('telefono'),
            'password' => $request->input('password'),

        );

        
        $user = $user->updateuser($datos);

        if ($user) {
            header('Location: '. BASE_URL .'/usuarios');
        } else {
            echo $user;
        }
    }

    public function destroy($params)
    {
        if (isset($_POST['eliminar'])) {
            $idUsuario = $params['usuario'];

            $user = new Usuario();
            if ($user->destroyuser($idUsuario)) {
                header('Location: '. BASE_URL .'/usuarios');
            } else {
             echo "error";
            }
        }
    }
}
