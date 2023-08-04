<?php
require_once 'app/model/Carrito.php';
require_once 'app/utilidades/Request.php';
require_once 'app/utilidades/Utilidades.php';
require_once 'app/model/Articulo.php';

class CarritoController
{
    function __construct(){
        if(!isset($_SESSION)){ 
            session_start(); 
        }
        if (!isset($_SESSION['cliente'])) {
            header('Location: index.php?page=home');
        }
    }
    public function index()
    {
        #inicializando los valores
        $carrito = new Carrito;
        $articulo = new Articulo();
        $utilities = new Utilidades();

        $startOfPaging = 0;
        $amountOfThePaging = 12;
        $idUsuario = "";
        #asignando el inicio de de los articulos a paginar
        if (isset($_GET['p'])) $startOfPaging = $utilities->pagination($_GET['p'], $amountOfThePaging);
        #asignando la busqueda si existe
        if (isset($_GET['idUsuario'])) $idUsuario =  $_GET['idUsuario'];
        
        $section = $carrito->pagination($idUsuario);
        $carrito = $carrito->indexCarrito($idUsuario, $startOfPaging, $amountOfThePaging);
        
        foreach ($carrito as $key => $item) {
          $infoItem = $articulo->editarticulo($item['id_articulo']);
          $carrito[$key]['item'] = $infoItem;
        }

        require_once('./app/views/pages/carrito.php');
    }

    public function store()
    {
        $request = new Request();
        $cartModel = new Carrito();

        $idCliente = $_SESSION['cliente']['id'];

        $datos = array(
            'id_usuario' => $idCliente,
            'id_articulo' => $request->query('id'),
            'cantidad' => $request->input('cantidad'),
            'detalles' => $request->input('detalles'),
        );
        
        $cartModel->storeItem($datos);

        $_SESSION['cliente']['cartNum'] += 1;

        header('Location: index.php?page=menu');
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
        $id = $_GET['id'];

        $cart = new Carrito();
        if ($cart->destroyItem($id)) {
            $_SESSION['cliente']['cartNum'] -= 1;
            header('Location: index.php?page=carrito&idUsuario='.$_SESSION['cliente']['id']);
        } else {
            // echo "error";
        }
    }
}
