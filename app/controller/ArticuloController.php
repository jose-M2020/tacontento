<?php
require_once 'app/model/Articulo.php';
require_once 'app/utilidades/Utilidades.php';


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
            header('Location: index.php?page=home');
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
            header('Location: index.php?page=home');
        }
        require_once('./app/views/articulos/create.php');
    }

    public function store()
    {
    
        if(!isset($_SESSION['usuario'])){
            header('Location: index.php?page=home');
        }
        $file = new Utilidades();
        if (isset($_POST['registrar'])) {
    
            $img = $file->uploadFile('storage','img');

            $datos = array(
                'nombre' => $_POST['nombre'],
                'descripcion' => $_POST['descripcion'],
                'precio' => $_POST['precio'],
                'tipo' => $_POST['tipo'],
                'img' => $img,
            );
            #var_dump($datos);
            $createarticulo = new Articulo();
            $createarticulo->storearticulo($datos);
            header('Location: index.php?page=createarticulo');
        } else {
            require_once('./app/views/usuarios/create.php');
        }
    }


    public function edit()
    {
        if(!isset($_SESSION['usuario'])){
            header('Location: index.php?page=home');
        }
        $id = $_GET['id'];
        $articulo = new Articulo();
        $articulo = $articulo->editarticulo($id);


        require_once('./app/views/articulos/edit.php');
    }

    public function update()
    {
        if(!isset($_SESSION['usuario'])){
            header('Location: index.php?page=home');
        }
        $id = $_GET['id'];
        $art = new Articulo();
        $art = $art->editarticulo($id);

        if (isset($_POST['editar'])) {
            $file = new Utilidades();
            $img = $file->uploadFile('storage','img');
            if(empty($img)) $img = $art['img'];
            $datos = array(
                'id' => $_GET['id'],
                'nombre' => $_POST['nombre'],
                'descripcion' => $_POST['descripcion'],
                'precio' => $_POST['precio'],
                'tipo' => $_POST['tipo'],
                'img' => $img,
            );
        }
        $articulo = new Articulo;
        $articulo = $articulo-> updatearticulo($datos);

        if ($articulo) {
            header('Location: index.php?page=articulo');
        } else {
            echo $articulo;
        }

    }

    public function destroy()
    {
        if(!isset($_SESSION['usuario'])){
            header('Location: index.php?page=home');
        }
        if (isset($_POST['eliminar'])) {
            $id = $_GET['id'];

            $articulo = new Articulo();
            if ($articulo->destroyarticulo($id)) {
                header('Location: index.php?page=articulo');
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
