<?php
require_once 'model/Oferta.php';
require_once 'utilidades/Utilidades.php';

class OfertaController
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
        $oferta = $oferta->indexoferta($search, $startOfPaging, $amountOfThePaging);


        require_once('./views/admin/index.php');
    }
    public function show()
    { }
    public function create()
    {  session_start();
        if(!isset($_SESSION['usuario'])){
            header('Location: home.php');
        }
       
       
        require_once('./views/admin/create.php');
    }

    public function store()
    {  
        session_start();

        if(empty($_POST) && $_SERVER['REQUEST_METHOD'] !== 'POST') exit;
        if(!isset($_SESSION['usuario'])){
            header('Location: home.php');
        }

        $file = new Utilidades();
        if (isset($_POST['registrar'])) {
            $img = $file->uploadFile('storage','img');
            $datos = array(
                'titulo' => $_POST['titulo'],
                'descripcion' => $_POST['descripcion'],
                'img' => $img,
            );
            #var_dump($datos);
            $createarticulo = new Oferta();
            $createarticulo->storeoferta($datos);
            require_once('./views/admin/create.php');
        } else {
            require_once('./views/admin/create.php');
        }
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
    {  
        session_start();
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

    public function obtener(){
      
        $oferta = new Oferta;
        return $oferta = $oferta->obtener();
    }
}
