<?php
namespace App\Http\Controllers;

require_once 'app/config/config.php';

use DateTime;

use App\Models\Reserva;
use App\Models\Oferta;
use Core\Http\Request;
use App\Utilities\Utilidades;

class ReservaController
{
    function __construct(){
       
    }
    public function index()
    {
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

        $utilities->view('admin.reserva.index', [
          'reserva' =>$reserva,
          'section' => $section,
          'search' =>$search,
        ]);
    }
    public function show($params)
    { 
        $idReserva = $params['reserva'];

        $reserva = new Reserva();
        $utilities = new Utilidades();
        $reserva = $reserva->show($idReserva);

        $utilities->view('admin.reserva.show', ['reserva' =>$reserva]);
    }
    public function create()
    {   
        $utilities = new Utilidades;
        $utilities->view('reservas.create');
    }
    
    public function getAllByClient()
    {   
        $utilities = new Utilidades;
        $reservas = $this->obtener2();
        // echo '<pre>';
        // print_r($reservas);
        // echo '</pre>';
        // $reservas['start'] = $reservas['fecha'];
        $reservas = json_encode($reservas);

        $utilities->view('reservas.index', ['reservas' => $reservas]);
    }

    public function store()
    {   
        $request = new Request();
        $utilities = new Utilidades();
        $fecha = new  DateTime($request->input('fecha'));
        $hora = new  DateTime($request->input('hora'));

        $datos = array(
            'id_cliente' => $request->input('id_cliente'),
            'personas' => $request->input('personas'),
            'fecha' => $fecha->format('Y-m-d'),
            'hora' =>$hora->format('H:m:s'),
            'notas_especiales' =>$request->input('notas_especiales'),
        );

        $create = new Reserva();
        $create->storereserva($datos);

        $lastid = $create->obtenerid();
        $utilities->view('reservas.message', ['lastid' => $lastid]);
    }
    public function imprimir()
    {
        $id = $_GET['id'];

        $reserva = new Reserva();
        $p = $reserva->show($id);

        require_once 'app/views/reservas/ticket.php';
    }

    public function edit()
    {
        $id = $_GET['id'];
        $oferta = new Oferta();
        $oferta = $oferta->editoferta($id);
        require_once('./app/views/admin/edit.php');
    }

    public function update()
    {
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
    {
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

  
    public function obtener2()
    {
        $id_cliente = $_SESSION['usuario']['id'];
        $compras = new Reserva();
        return $compras = $compras->getreservas2($id_cliente);
    }
}
