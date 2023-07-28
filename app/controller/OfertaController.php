<?php
require_once 'app/model/Oferta.php';
require_once 'app/utilidades/Utilidades.php';
require_once 'app/utilidades/InputSanitizer.php';

class OfertaController
{
    function __construct(){
        if(!isset($_SESSION)){ 
            session_start(); 
        }
    }
    public function index()
    {
        if(!isset($_SESSION['usuario'])){
          
            header('Location: index.php?page=home');
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


        require_once('./app/views/admin/index.php');
    }
    public function show()
    { }
    public function create()
    {
        if(!isset($_SESSION['usuario'])){
            header('Location: index.php?page=home');
        }
       
       
        require_once('./app/views/admin/create.php');
    }

    public function store()
    {        
        if(empty($_POST) && $_SERVER['REQUEST_METHOD'] !== 'POST') exit;
        if(!isset($_SESSION['usuario'])){
            header('Location: index.php?page=home');
        }
        
        $inputSanitizer = new InputSanitizer();
        $file = new Utilidades();
        $_POST = $inputSanitizer->sanitize($_POST);
        
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
            header('Location: index.php?page=createoferta');
        } else {
            header('Location: index.php?page=createoferta');
        }
    }


    public function edit()
    {
        if(!isset($_SESSION['usuario'])){
            header('Location: index.php?page=home');
        }
        $id = $_GET['id'];
        $oferta = new Oferta();
        $oferta = $oferta->editoferta($id);
        require_once('./app/views/admin/edit.php');
    }

    public function update()
    {
        if(!isset($_SESSION['usuario'])){
            header('Location: index.php?page=home');
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
    {
        if(!isset($_SESSION['usuario'])){
            header('Location: index.php?page=home');
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

    public function obtener()
    {  
        $oferta = new Oferta;
        return $oferta = $oferta->obtener();
    }
}
