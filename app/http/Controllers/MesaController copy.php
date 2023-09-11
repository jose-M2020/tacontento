<?php
namespace App\Http\Controllers;

require_once 'app/config/config.php';

use DateTime;

use App\Models\Mesa;
use Core\Http\Request;
use App\Utilities\Utilidades;

class ReservaController
{
    function __construct(){
       
    }

    public function index()
    {
        #inicializando los valores
        $mesaModel = new Mesa;
        $utilities = new Utilidades();
        $startOfPaging = 0;
        $amountOfThePaging = 8;
        $search = "";

        #asignando el inicio de de los articulos a paginar
        if (isset($_GET['p'])) $startOfPaging = $utilities->pagination($_GET['p'], $amountOfThePaging);
        #asignando la busqueda si existe
        if (isset($_GET['search'])) $search =  $_GET['search'];

        $section = $mesaModel->paginationMesa($search);
        $reservaData = $mesaModel->indexMesa($search, $startOfPaging, $amountOfThePaging);

        $utilities->view('admin.mesa.index', [
          'mesas' => $reservaData,
          'section' => $section,
          'search' =>$search,
        ]);
    }

    public function show($params)
    { 
        $mesaId = $params['mesa'];

        $mesaModel = new Mesa();
        $utilities = new Utilidades();
        $mesaData = $mesaModel->show($mesaId);

        $utilities->view('admin.mesa.show', ['mesa' => $mesaData]);
    }

    public function create()
    {   
        $utilities = new Utilidades;
        $utilities->view('admin.mesa.create');
    }

    public function store()
    {   
        $request = new Request();
        $utilities = new Utilidades();

        $datos = array(
            'nombre' => $request->input('nombre'),
            'capacidad' => $request->input('capacidad'),
        );

        $create = new Mesa();
        $create->storeMesa($datos);

        $lastid = $create->obtenerid();
        $utilities->view('admin.mesa.index', ['lastid' => $lastid]);
    }

    public function edit($params)
    {
        $id = $_GET['id'];
        $oferta = new Oferta();
        $oferta = $oferta->editoferta($id);
        require_once('./app/views/admin/edit.php');
    }

    public function update($params)
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

    public function destroy($params)
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
}
