<?php
namespace App\Http\Controllers;

require_once 'app/config/config.php';

use Core\Http\Request;
use App\Models\Articulo;
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
 
        $utilities->view('admin.menu.index', [
          'articulo' =>$articulo,
          'section' => $section,
          'search' =>$search,
        ]);
    }
    public function show()
    { }
    public function create()
    {
      $utilities = new Utilidades();
      $utilities->view('admin.menu.create');
    }

    public function store()
    {
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
        header('Location: '. BASE_URL .'/platillos');
    }

    public function edit($params)
    {
        $id = $params['platillo'];
        $articulo = new Articulo();
        $utilities = new Utilidades();
        $articulo = $articulo->editarticulo($id);

        $utilities->view('admin.menu.edit', ['articulo' =>$articulo]);
    }
    public function update($params)
    {
        $request = new Request();
        $art = new Articulo();
        $file = new Utilidades();
        
        $art = $art->editarticulo($params['platillo']);
        $img = $file->uploadFile('storage','img');

        if(empty($img)) $img = $art['img'];
        
        $datos = array(
            'id' => $params['platillo'],
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),
            'precio' => $request->input('precio'),
            'tipo' => $request->input('tipo'),
            'img' => $img,
        );

        $articulo = new Articulo;
        $articulo = $articulo-> updatearticulo($datos);

        if ($articulo) {
            header('Location: '. BASE_URL .'/platillos');
        } else {
            echo $articulo;
        }
    }

    public function destroy($params)
    {
        if (isset($_POST['eliminar'])) {
            $id = $params['platillo'];

            $articulo = new Articulo();
            if ($articulo->destroyarticulo($id)) {
                header('Location: '. BASE_URL .'/platillos');
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
