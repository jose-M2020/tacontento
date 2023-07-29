<?php
require_once 'app/model/Pedido.php';
require_once 'app/model/Articulo.php';
require_once 'app/utilidades/Request.php';
require_once 'app/utilidades/Utilidades.php';


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
            header('Location: index.php?page=home');
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


        require_once('./app/views/pedidos/index.php');
    }
    public function venta()
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: index.php?page=home');
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


        require_once('./app/views/pedidos/ventas.php');
    }

    public function create()
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: index.php?page=home');
        }
        require_once('./app/views/articulos/create.php');
    }
    public function pay()
    {
        $request = new Request();

        $datos = array(
            'descripcion' => $request->input('descripcion'),
            'cantidad' => $request->input('cantidad'),
            'total' => $request->input('total'),
            'id_cliente' => $request->input('id_cliente'),
        );

        require_once('./app/views/pedidos/pay.php');
    }

    public function store()
    {
        $request = new Request();
        
        $fecha = new  DateTime('now');
        // $quitarespacio = str_replace(",", " ", $_POST['descripcion']);

        $datos = array(
            'descripcion' =>  $request->input('descripcion'),
            'fecha' => $fecha->format('Y-m-d'),
            'total' => $request->input('total'),
            'cantidad' => $request->input('cantidad'),
            'id_cliente' => $request->input('id_cliente'),
            'status' => 1,
        );

        $create = new Pedido();
        $create->storepedido($datos);
        unset($_SESSION['add_carro']);
        $lastid = $create->obtenerid();
        require_once 'app/views/pages/message.php';
    }


    public function edit()
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: index.php?page=home');
        }
        $id = $_GET['id'];
        $articulo = new Articulo();
        $articulo = $articulo->editarticulo($id);

        require_once('./app/views/articulos/edit.php');
    }

    public function update()
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: index.php?page=home');
        }

        $request = new Request();
        $datos = [
            'id' => $request->input('id'),
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

        require_once 'app/views/pedidos/ticket.php';
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

        require_once 'app/views/pedidos/show.php';
    }


    public function addcarrito()
    {
        if (!isset($_SESSION['cliente'])) {
            header('Location: index.php?page=auth');
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
                        header('Location: index.php?page=carrito');
                    } else {
                        echo '<script>alert("El Producto ya existe!");</script>';
                        require_once 'app/views/pages/home.php';
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
                    header('Location: index.php?page=carrito');
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
                        header('Location: index.php?page=carrito');
                    }
                }
            }
        } else {
            header('Location: index.php?page=carrito');
        }
    }
    public function compras(){
        if (!isset($_SESSION['cliente'])) {
            header('Location: index.php?page=home');
        }else{
            $id_cliente = $_SESSION['cliente']['id'];
            $compras = new Pedido();
            $compras = $compras->getcompras($id_cliente);
            require_once 'app/views/pages/compras.php';
        }
    }
}
