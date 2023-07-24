<?php
require_once 'model/Usuario.php';
require_once 'utilidades/Utilidades.php';


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
            header('Location: home.php');
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


        require_once('./views/usuarios/index.php');
    }
    public function show()
    { }
    public function create()
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: home.php');
        }
        require_once('./views/usuarios/create.php');
    }

    public function store()
    {
        $userModel = new Usuario();
        $utilities = new Utilidades();
        $emailExist = $userModel->checkEmailExists($_POST['email']);

        if ($emailExist) {
            $utilities->setMessage('error', 'El correo ya se encuentra registrado.');
            header('Location: index.php?page=createusuario');
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
            header('Location: home.php');
        }
        $id = $_GET['id'];
        $user = new Usuario();
        $user = $user->edituser($id);

        
        require_once('./views/usuarios/edit.php');
    }

    public function update()
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: home.php');
        }

        if (isset($_POST['editar'])) {

            $datos = array(
                'id'   =>  $_GET['id'],
                'nombre' => $_POST['nombre'],
                'apellidos' => $_POST['apellidos'],
                'direccion' => $_POST['direccion'],
                'email' => $_POST['email'],
                'edad' => $_POST['edad'],
                'telefono' => $_POST['telefono'],
                'password' => $_POST['password'],

            );
        }
        $user = new Usuario;
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
            header('Location: home.php');
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
