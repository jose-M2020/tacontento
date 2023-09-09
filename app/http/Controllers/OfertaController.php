<?php
namespace App\Http\Controllers;

require_once 'app/config/config.php';

use Core\Http\Request;
use App\Models\Oferta;
use App\Utilities\Utilidades;

class OfertaController
{
    protected $sanitizedInput;

    function __construct(){
        if(!isset($_SESSION)){ 
            session_start(); 
        }
    }

    public function index()
    {
        #inicializando los valores
        $oferta = new Oferta;
        $utilities = new Utilidades();
        $startOfPaging = 0;
        $amountOfThePaging = 8;
        $search = "";
        #asignando el inicio de de los articulos a paginar
        if (isset($_GET['p'])) $startOfPaging = $utilities->pagination($_GET['p'], $amountOfThePaging);
        #asignando la busqueda si existe
        if (isset($_GET['search'])) $search =  $_GET['search'];

        $section = $oferta->paginationoferta($search);
        $ofertas = $oferta->indexoferta($search, $startOfPaging, $amountOfThePaging);

        $utilities->view('admin.oferta.index', [
          'ofertas' =>$ofertas,
          'section' => $section,
          'search' =>$search
        ]);
    }
    public function show()
    { }
    public function create()
    {
      $utilities = new Utilidades();
      $utilities->view('admin.oferta.create');
    }

    public function store()
    {        
        if(empty($_POST) && $_SERVER['REQUEST_METHOD'] !== 'POST') exit;
        
        $request = new Request();
        $file = new Utilidades();
        
        $img = $file->uploadFile('storage','img');
        $datos = array(
            'titulo' => $request->input('titulo'),
            'descripcion' => $request->input('descripcion'),
            'img' => $img,
        );
        #var_dump($datos);
        $createarticulo = new Oferta();
        $createarticulo->storeoferta($datos);
        header('Location: '. BASE_URL .'/ofertas');
    }


    public function edit($params)
    {
      $oferta = new Oferta();
      $utilities = new Utilidades();
      $oferta = $oferta->editoferta($params['oferta']);

      $utilities->view('admin.oferta.edit', ['oferta' => $oferta]);
    }

    public function update($params)
    {
        $request = new Request();
        $art = new Oferta();
        $file = new Utilidades();

        $art = $art->editoferta($params['oferta']);
        $img = $file->uploadFile('storage','img');
        
        if(empty($img)) $img = $art['img'];
        
        $datos = array(
            'id' => $params['oferta'],
            'titulo' => $request->input('titulo'),
            'descripcion' => $request->input('descripcion'),
            'img' => $img,
        );

        $oferta = new Oferta;
        $oferta = $oferta-> updateoferta($datos);

        if ($oferta) {
            header('Location: '. BASE_URL .'/ofertas');
        } else {
            echo $oferta;
        }
    }

    public function destroy($params)
    {
        $oferta = new Oferta();
        if ($oferta->destroyoferta($params['oferta'])) {
            header('Location: '. BASE_URL .'/ofertas');  
          
        } else {
         echo "error";
        }
    }

    public function obtener()
    {  
        $oferta = new Oferta;
        return $oferta = $oferta->obtener();
    }
}
