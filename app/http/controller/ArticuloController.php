<?php
namespace App\Http\Controllers;

require_once 'app/config/config.php';

use App\Models\Articulo;
use App\Utilities\Request;
use App\Utilities\Utilidades;

class ArticuloController
{
    function __construct(){
        if(!isset($_SESSION)){ 
            session_start(); 
        }  
        
    }

    public function index()
    {
        if(!isset($_SESSION['usuario'])){
            header('Location: '. BASE_URL .'/home');
        }
        #inicializando los valores
        $articulo = new Articulo;
        $utilities = new Utilidades();
        $startOfPaging = 0;
        $amountOfThePaging = 8;
        $search = "";
        #asignando el inicio de de los articulos a paginar
        if (isset($_GET['p'])) $startOfPaging = $utilities->pagination($_GET['p'], $amountOfThePaging);
        #asignando la busqueda si existe
        if (isset($_GET['search'])) $search =  $_GET['search'];

        $section = $articulo->paginationarticulo($search);
        $articulo = $articulo->indexarticulo($search, $startOfPaging, $amountOfThePaging);
 

        require_once('./app/views/articulos/index.php');
    }
    public function show()
    { }
    public function create()
    {
        if(!isset($_SESSION['usuario'])){
            header('Location: '. BASE_URL .'/home');
        }
        require_once('./app/views/articulos/create.php');
    }

    public function store()
    {
    
        if(!isset($_SESSION['usuario'])){
            header('Location: '. BASE_URL .'/home');
        }

        $request = new Request();
        $file = new Utilidades();

    
        $img = $file->uploadFile('storage','img');

        $datos = array(
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),
            'precio' => $request->input('precio'),
            'tipo' => $request->input('tipo'),
            'img' => $img,
        );

        $createarticulo = new Articulo();
        $createarticulo->storearticulo($datos);
        header('Location: '. BASE_URL .'/createarticulo');
    }

    public function edit()
    {
        if(!isset($_SESSION['usuario'])){
            header('Location: '. BASE_URL .'/home');
        }
        $id = $_GET['id'];
        $articulo = new Articulo();
        $articulo = $articulo->editarticulo($id);


        require_once('./app/views/articulos/edit.php');
    }
    public function update()
    {
        if(!isset($_SESSION['usuario'])){
            header('Location: '. BASE_URL .'/home');
        }

        $request = new Request();
        $art = new Articulo();
        $file = new Utilidades();
        
        $art = $art->editarticulo($request->input('id'));
        $img = $file->uploadFile('storage','img');

        if(empty($img)) $img = $art['img'];
        
        $datos = array(
            'id' => $request->input('id'),
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),
            'precio' => $request->input('precio'),
            'tipo' => $request->input('tipo'),
            'img' => $img,
        );

        $articulo = new Articulo;
        $articulo = $articulo-> updatearticulo($datos);

        if ($articulo) {
            header('Location: '. BASE_URL .'/articulo');
        } else {
            echo $articulo;
        }
    }

    public function destroy()
    {
        if(!isset($_SESSION['usuario'])){
            header('Location: '. BASE_URL .'/home');
        }
        if (isset($_POST['eliminar'])) {
            $id = $_GET['id'];

            $articulo = new Articulo();
            if ($articulo->destroyarticulo($id)) {
                header('Location: '. BASE_URL .'/articulo');
            } else {
             echo "error";
            }
        }
    }

    public function obtener(){

        $articulo = new Articulo;
        return $articulo = $articulo->obtener();
    }
}
