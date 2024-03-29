<?php
namespace App\Http\Controllers;

require_once 'app/config/config.php';

use App\Models\Carrito;
use App\Models\Articulo;
use App\Models\Usuario;
use Core\Http\Request;
use App\Utilities\Utilidades;

class CarritoController
{
    function __construct(){
        if(!isset($_SESSION)){ 
            session_start(); 
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
        $idUsuario = $_SESSION['usuario']['id'];
        
        #asignando el inicio de de los articulos a paginar
        if (isset($_GET['p'])) $startOfPaging = $utilities->pagination($_GET['p'], $amountOfThePaging);
        
        $section = $carrito->pagination($idUsuario);
        $carrito = $carrito->indexCarrito($idUsuario, $startOfPaging, $amountOfThePaging);
        
        foreach ($carrito as $key => $item) {
          $infoItem = $articulo->editarticulo($item['id_articulo']);
          $carrito[$key]['item'] = $infoItem;
        }

        $utilities->view('pages.carrito', [
          'carrito' =>$carrito,
          'section' =>$section
        ]);
    }

    public function store($params)
    {
        $request = new Request();
        $cartModel = new Carrito();

        $idCliente = $_SESSION['usuario']['id'];
        
        $datos = array(
            'id_usuario' => $idCliente,
            'id_articulo' => $params['itemId'],
            'cantidad' => $request->input('cantidad'),
            'detalles' => $request->input('detalles'),
        );
        
        $cartModel->storeItem($datos);

        $_SESSION['usuario']['cartNum'] += 1;

        header('Location: '. BASE_URL .'/menu');
    }

    public function update()
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

    public function destroy($params)
    {
        $id = $params['itemId'];

        $cart = new Carrito();
        if ($cart->destroyItem($id)) {
            $_SESSION['usuario']['cartNum'] -= 1;
            header('Location: '. BASE_URL .'/carrito');
        } else {
            // echo "error";
        }
    }
}
