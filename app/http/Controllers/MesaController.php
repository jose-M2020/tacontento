<?php
namespace App\Http\Controllers;

require_once 'app/config/config.php';

use App\Models\Mesa;
use Core\Http\Request;
use App\Utilities\Utilidades;

class MesaController
{
    function __construct(){
       
    }

    public function index()
    {
        #inicializando los valores
        $mesaModel = new Mesa;
        $utilities = new Utilidades();
        $startOfPaging = 0;
        $amountOfThePaging = 12;
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

        $datos = array(
            'nombre' => $request->input('nombre'),
            'capacidad' => $request->input('capacidad'),
            'notas' => $request->input('notas'),
        );

        $ofertaModel = new Mesa();
        $ofertaModel->storeMesa($datos);

        header('Location: '. BASE_URL .'/mesas');
    }

    public function edit($params)
    {
        $mesaId = $params['mesa'];
        $mesaModel = new Mesa();
        $utilities = new Utilidades;
        $mesa = $mesaModel->editMesa($mesaId);
        $utilities->view('admin.mesa.edit', ['mesa' => $mesa]);
    }

    public function update($params)
    {
        $mesaId = $params['mesa'];
        $mesaModel = new Mesa();
        $request = new Request();

        $datos = array(
            'id' => $mesaId,
            'nombre' => $request->input('nombre'),
            'capacidad' => $request->input('capacidad'),
            // 'status' => $request->input('status'),
            'notas' => $request->input('notas'),
        );

        $mesaUpdated = $mesaModel->updateMesa($datos);

        if ($mesaUpdated) {
            unset ($_SESSION['mensaje']);
            header('Location: '. BASE_URL .'/mesas');
        } else {
            echo $mesaUpdated;
        }
    }

    public function destroy($params)
    {
        $mesaId = $params['mesa'];
        $mesaModel = new Mesa();

        if ($mesaModel->destroyMesa($mesaId)) {
          header('Location: '. BASE_URL .'/mesas');
          return;
        }

        echo 'error';
    }
}
