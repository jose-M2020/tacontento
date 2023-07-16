<?php
require_once 'model/Pedido.php';
require_once 'model/Articulo.php';
require_once 'utilidades/Utilidades.php';


class PedidoController
{
    function __construct()
    {
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
        $pedido = new Pedido;
        $utilities = new Utilidades();
        $startOfPaging = 0;
        $amountOfThePaging = 5;
        $search = "";
        $status = 1;
        #asignando el inicio de de los articulos a paginar
        if (isset($_GET['p'])) $startOfPaging = $utilities->pagination($_GET['p'], $amountOfThePaging);
        #asignando la busqueda si existe
        if (isset($_GET['search'])) $search =  $_GET['search'];

        $section = $pedido->paginationpedido($search);
        $pedido = $pedido->indexpedido($status, $search, $startOfPaging, $amountOfThePaging);


        require_once('./views/pedidos/index.php');
    }
    public function venta()
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: home.php');
        }
        #inicializando los valores
        $pedido = new Pedido;
        $utilities = new Utilidades();
        $startOfPaging = 0;
        $amountOfThePaging = 8;
        $search = "";
        $status = 2;
        #asignando el inicio de de los articulos a paginar
        if (isset($_GET['p'])) $startOfPaging = $utilities->pagination($_GET['p'], $amountOfThePaging);
        #asignando la busqueda si existe
        if (isset($_GET['search'])) $search = str_replace('-', '', $_GET['search']);;

        $section = $pedido->paginationventa($search);
        $pedido = $pedido->indexpedido($status, $search, $startOfPaging, $amountOfThePaging);


        require_once('./views/pedidos/ventas.php');
    }

    public function create()
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: home.php');
        }
        require_once('./views/articulos/create.php');
    }
    public function pay()
    {
        $datos = array(
            'descripcion' => $_POST['descripcion'],
            'cantidad' => $_POST['cantidad'],
            'total' => $_POST['total'],
            'id_cliente' => $_POST['id_cliente'],
        );

        require_once('./views/pedidos/pay.php');
    }

    public function store()
    {
        if (isset($_POST['registrar'])) {
            $fecha = new  DateTime('now');
            $quitarespacio = str_replace(",", " ", $_POST['descripcion']);
            $datos = array(
                'descripcion' =>  $_POST['descripcion'],
                'fecha' => $fecha->format('Y-m-d'),
                'total' => $_POST['total'],
                'cantidad' => $_POST['cantidad'],
                'id_cliente' => $_POST['id_cliente'],
                'status' => 1,
            );

            $create = new Pedido();
            $create->storepedido($datos);
            unset($_SESSION['add_carro']);
            $lastid = $create->obtenerid();
            require_once 'Message.php';
           
        } else  if (isset($_POST['cancelar'])) {
            header('Location: carrito.php');
        }
    }


    public function edit()
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: home.php');
        }
        $id = $_GET['id'];
        $articulo = new Articulo();
        $articulo = $articulo->editarpedido($id);


        require_once('./views/articulos/edit.php');
    }

    public function update()
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: home.php');
        }
        $id = $_GET['id'];
        $datos = [
            'id' => $id,
            'status' => 2
        ];
        $pedido = new Pedido;
        $pedido = $pedido->updatepedido($datos);

        if ($pedido) {
            header('Location: index.php?page=pedido');
        }
    }
    public function imprimir_cliente($id)
    {

        $pedido = new Pedido();
        $p = $pedido->ticket($id);

        $array = explode(",", $p['descripcion']);
        $dd = array_pop($array);
        $articulos = [];
        for ($i = 0; $i < count($array); $i++) {
            $art = $pedido->getarticulos($array[$i]);
            $articulos[$i] = $art;
        }

        $cantidad = explode(",", $p['cantidad']);
        $dd = array_pop($cantidad);
        $limite = count($array);

      
    }
    public function imprimir()
    {
        $id = $_GET['id'];

        $pedido = new Pedido();
        $p = $pedido->ticket($id);

        $array = explode(",", $p['descripcion']);
        $dd = array_pop($array);
        $articulos = [];
        for ($i = 0; $i < count($array); $i++) {
            $art = $pedido->getarticulos($array[$i]);
            $articulos[$i] = $art;
        }

        $cantidad = explode(",", $p['cantidad']);
        $dd = array_pop($cantidad);
        $limite = count($array);

        require_once 'views/pedidos/ticket.php';
    }
    public function show()
    {
        $id = $_GET['id'];

        $pedido = new Pedido();
        $p = $pedido->ticket($id);

        $array = explode(",", $p['descripcion']);
        $dd = array_pop($array);
        $articulos = [];
        for ($i = 0; $i < count($array); $i++) {
            $art = $pedido->getarticulos($array[$i]);
            $articulos[$i] = $art;
        }

        $cantidad = explode(",", $p['cantidad']);
        $dd = array_pop($cantidad);
        $limite = count($array);

        require_once 'views/pedidos/show.php';
    }


    public function addcarrito()
    {
        if (!isset($_SESSION['cliente'])) {
            header('Location: views/auth/login.php');
        } else {
            $id = $_GET['id'];
            $cantidad = $_POST['cant'];
            $id_cliente = $_SESSION['cliente']['id'];
            $articulo = new Articulo();
            $articulo = $articulo->editarticulo($id);
            $total = $cantidad * $articulo['precio'];

            if (isset($_POST['agregar'])) {
                if (isset($_SESSION['add_carro'])) {
                    $item_array_id_cart = array_column($_SESSION['add_carro'], 'id');
                    if (!in_array($_GET['id'], $item_array_id_cart)) {

                        $count = count($_SESSION['add_carro']);
                        $item_array = array(
                            'id'        => $_GET['id'],
                            'descripcion'    => $articulo['nombre'],
                            'precio'    => $articulo['precio'],
                            'cantidad'  =>  $cantidad,
                            'total'  =>  $total,
                            'id_cliente'  =>  $id_cliente,
                        );

                        $_SESSION['add_carro'][$count] = $item_array;
                        header('Location: carrito.php');
                    } else {
                        echo '<script>alert("El Producto ya existe!");</script>';
                        require_once 'home.php';
                    }
                } else {
                    $item_array = array(
                        'id'        => $_GET['id'],
                        'descripcion'    => $articulo['nombre'],
                        'precio'    => $articulo['precio'],
                        'cantidad'  =>  $cantidad,
                        'total'  =>  $total,
                        'id_cliente'  =>  $id_cliente,
                    );

                    $_SESSION['add_carro'][0] = $item_array;
                    header('Location: carrito.php');
                }
            }
        }
    }
    public function deletecarrito()
    {

        if (isset($_POST['delete'])) {
            if ($_POST['delete'] == 'delete') {
                foreach ($_SESSION['add_carro'] as $key => $value) {
                    if ($value['id'] == $_GET['id']) {
                        unset($_SESSION['add_carro'][$key]);
                        header('Location: carrito.php');
                    }
                }
            }
        } else {
            header('Location: carrito.php');
        }
    }
    public function compras(){
        if (!isset($_SESSION['cliente'])) {
            header('Location: home.php');
        }else{
            $id_cliente = $_SESSION['cliente']['id'];
            $compras = new Pedido();
            $compras = $compras->getcompras($id_cliente);
            require_once 'compras.php';
        }
    }
}
