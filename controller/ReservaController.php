<?php
require_once 'model/Reserva.php';
require_once 'utilidades/Utilidades.php';

class ReservaController
{
    function __construct(){
       
    }
    public function index()
    {
        session_start();
        if(!isset($_SESSION['usuario'])){
          
            header('Location: home.php');
        }
        #inicializando los valores
        $reserva = new Reserva;
        $utilities = new Utilidades();
        $startOfPaging = 0;
        $amountOfThePaging = 8;
        $search = "";
        #asignando el inicio de de los articulos a paginar
        if (isset($_GET['p'])) $startOfPaging = $utilities->pagination($_GET['p'], $amountOfThePaging);
        #asignando la busqueda si existe
        if (isset($_GET['search'])) $search =  $_GET['search'];

        $section = $reserva->paginationreserva($search);
        $reserva = $reserva->indexreserva($search, $startOfPaging, $amountOfThePaging);


        require_once('./views/reservas/index.php');
    }
    public function show()
    { 
        $id = $_GET['id'];

        $reserva = new Reserva();
        $reserva = $reserva->show($id);

        require_once 'views/reservas/show.php';
    }
    public function create()
    {  session_start();
        if(!isset($_SESSION['cliente'])){
            header('Location: home.php');
        }
        require_once('./views/reservas/create.php');
    }

    public function store()
    {  session_start();
        if(!isset($_SESSION['cliente'])){
            header('Location: home.php');
        }
        $fecha = new  DateTime($_POST['fecha']);
        $hora = new  DateTime($_POST['hora']);
        if (isset($_POST['registrar'])) {
            $datos = array(
                'id_cliente' => $_POST['id_cliente'],
                'personas' => $_POST['personas'],
                'fecha' => $fecha->format('Y-m-d'),
                'hora' =>$hora->format('H:m:s'),
            );

            $create = new Reserva();
            $create->storereserva($datos);

            $lastid = $create->obtenerid();
            require_once 'Message_reserva.php';
           
        } else {
           
        }
    }
 public function imprimir()
    {
        $id = $_GET['id'];

        $reserva = new Reserva();
        $p = $reserva->show($id);

        require_once 'views/reservas/ticket.php';
    }

    public function edit()
    {  session_start();
        if(!isset($_SESSION['usuario'])){
            header('Location: home.php');
        }
        $id = $_GET['id'];
        $oferta = new Oferta();
        $oferta = $oferta->editoferta($id);
        require_once('./views/admin/edit.php');
    }

    public function update()
    {  session_start();
        if(!isset($_SESSION['usuario'])){
            header('Location: home.php');
        }
        $id = $_GET['id'];
        $art = new Oferta();
        $art = $art->editoferta($id);

        if (isset($_POST['editar'])) {
            $file = new Utilidades();
            $img = $file->uploadFile('storage','img');
            if(empty($img)) $img = $art['img'];
            $datos = array(
                'id' => $_GET['id'],
                'titulo' => $_POST['titulo'],
                'descripcion' => $_POST['descripcion'],
                'img' => $img,
            );
        }
        $oferta = new Oferta;
        $oferta = $oferta-> updateoferta($datos);

        if ($oferta) {
            unset ($_SESSION['mensaje']);
            header('Location: index.php?page=dashboard');
        } else {
            echo $oferta;
        }
    }

    public function destroy()
    {  session_start();
        if(!isset($_SESSION['usuario'])){
            header('Location: home.php');
        }
        if (isset($_POST['eliminar'])) {
            $id = $_GET['id'];

            $oferta = new Oferta();
            if ($oferta->destroyoferta($id)) {
                header('Location: index.php?page=dashboard');  
              
            } else {
             echo "error";
            }
        }
    }

  
    public function obtener2(){
        if (!isset($_SESSION['cliente'])) {
            header('Location: home.php');
        }else{
            $id_cliente = $_SESSION['cliente']['id'];
            $compras = new Reserva();
            return $compras = $compras->getreservas2($id_cliente);
            
        }
    }
}
