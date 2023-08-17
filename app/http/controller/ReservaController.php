<?php
require_once 'app/model/Reserva.php';
require_once 'app/utilidades/Request.php';
require_once 'app/utilidades/Utilidades.php';
require_once 'app/config.php';

class ReservaController
{
    function __construct(){
       
    }
    public function index()
    {
        session_start();
        if(!isset($_SESSION['usuario'])){
          
            header('Location: '. BASE_URL .'/home');
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


        require_once('./app/views/reservas/index.php');
    }
    public function show()
    { 
        $id = $_GET['id'];

        $reserva = new Reserva();
        $reserva = $reserva->show($id);

        require_once 'app/views/reservas/show.php';
    }
    public function create()
    {  session_start();
        if(!isset($_SESSION['cliente'])){
            header('Location: '. BASE_URL .'/home');
        }
        require_once('./app/views/reservas/create.php');
    }

    public function store()
    {  
        session_start();
        if(!isset($_SESSION['cliente'])){
            header('Location: '. BASE_URL .'/home');
        }
        
        $request = new Request();
        $fecha = new  DateTime($request->input('fecha'));
        $hora = new  DateTime($request->input('hora'));

        $datos = array(
            'id_cliente' => $request->input('id_cliente'),
            'personas' => $request->input('personas'),
            'fecha' => $fecha->format('Y-m-d'),
            'hora' =>$hora->format('H:m:s'),
        );

        $create = new Reserva();
        $create->storereserva($datos);

        $lastid = $create->obtenerid();
        require_once 'app/views/pages/message_reserva.php';           
    }
    public function imprimir()
    {
        $id = $_GET['id'];

        $reserva = new Reserva();
        $p = $reserva->show($id);

        require_once 'app/views/reservas/ticket.php';
    }

    public function edit()
    {  session_start();
        if(!isset($_SESSION['usuario'])){
            header('Location: '. BASE_URL .'/home');
        }
        $id = $_GET['id'];
        $oferta = new Oferta();
        $oferta = $oferta->editoferta($id);
        require_once('./app/views/admin/edit.php');
    }

    public function update()
    {  
        session_start();
        if(!isset($_SESSION['usuario'])){
            header('Location: '. BASE_URL .'/home');
        }

        $request = new Request();
        $art = new Oferta();
        $file = new Utilidades();
        
        $art = $art->editoferta($request->input('id'));
        $img = $file->uploadFile('storage','img');
        if(empty($img)) $img = $art['img'];
        
        $datos = array(
            'id' => $request->input('id'),
            'titulo' => $request->input('titulo'),
            'descripcion' => $request->input('descripcion'),
            'img' => $img,
        );

        $oferta = new Oferta;
        $oferta = $oferta-> updateoferta($datos);

        if ($oferta) {
            unset ($_SESSION['mensaje']);
            header('Location: '. BASE_URL .'/dashboard');
        } else {
            echo $oferta;
        }
    }

    public function destroy()
    {  session_start();
        if(!isset($_SESSION['usuario'])){
            header('Location: '. BASE_URL .'/home');
        }
        if (isset($_POST['eliminar'])) {
            $id = $_GET['id'];

            $oferta = new Oferta();
            if ($oferta->destroyoferta($id)) {
                header('Location: '. BASE_URL .'/dashboard');  
              
            } else {
             echo "error";
            }
        }
    }

  
    public function obtener2(){
        if (!isset($_SESSION['cliente'])) {
            header('Location: '. BASE_URL .'/home');
        }else{
            $id_cliente = $_SESSION['cliente']['id'];
            $compras = new Reserva();
            return $compras = $compras->getreservas2($id_cliente);
            
        }
    }
}
