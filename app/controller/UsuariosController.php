<?php
require_once 'app/model/Usuario.php';
require_once 'app/utilidades/Request.php';
require_once 'app/utilidades/Utilidades.php';

class UsuariosController
{
    function __construct(){
        if(!isset($_SESSION)){ 
            session_start(); 
        }  
    }
    public function index()
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: index.php?page=home');
        }
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


        require_once('./app/views/usuarios/index.php');
    }
    public function show()
    { }
    public function create()
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: index.php?page=home');
        }
        require_once('./app/views/usuarios/create.php');
    }

    public function store()
    {
        $request = new Request();
        $userModel = new Usuario();
        $utilities = new Utilidades();
        $emailExist = $userModel->checkEmailExists($request->input('email'));

        if ($emailExist) {
            $utilities->setMessage('error', 'El correo ya se encuentra registrado.');
            header('Location: index.php?page=createusuario');
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
        header('Location: index.php?page=createusuario');



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


    public function edit()
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: index.php?page=home');
        }
        $id = $_GET['id'];
        $user = new Usuario();
        $user = $user->edituser($id);

        
        require_once('./app/views/usuarios/edit.php');
    }

    public function update()
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: index.php?page=home');
        }

        $request = new Request();
        $user = new Usuario;
        $utilities = new Utilidades();

        // TODO: Validate email in update request
        // $emailExist = $user->checkEmailExists($request->input('email'));

        // if ($emailExist) {
        //     $utilities->setMessage('error', 'El correo ya se encuentra registrado.');
        //     header('Location: index.php?page=createusuario');
        //     return;
        // }

        $datos = array(
            'id'   =>  $request->input('id'),
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
            header('Location: index.php?page=usuario');
        } else {
            echo $user;
        }
    }

    public function destroy()
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: index.php?page=home');
        }
        if (isset($_POST['eliminar'])) {
            $id = $_GET['id'];

            $user = new Usuario();
            if ($user->destroyuser($id)) {
                header('Location: index.php?page=usuario');
            } else {
             echo "error";
            }
        }
    }
}
