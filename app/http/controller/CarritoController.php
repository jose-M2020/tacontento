<?php
namespace App\Http\Controllers;

require_once 'app/config/config.php';

use App\Models\Carrito;
use App\Models\Articulo;
use App\Models\Usuario;
use App\Utilities\Request;
use App\Utilities\Utilidades;

class CarritoController
{
    function __construct(){
        if(!isset($_SESSION)){ 
            session_start(); 
        }
        if (!isset($_SESSION['cliente'])) {
            header('Location: '. BASE_URL .'/home');
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

        header('Location: '. BASE_URL .'/menu');
    }

    public function update()
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: '. BASE_URL .'/home');
        }

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
            header('Location: '. BASE_URL .'/usuario');
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
            header('Location: '. BASE_URL .'/carrito&idUsuario='.$_SESSION['cliente']['id']);
        } else {
            // echo "error";
        }
    }
}
