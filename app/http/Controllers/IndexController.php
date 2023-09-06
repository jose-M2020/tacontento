<?php
namespace App\Http\Controllers;

require_once 'app/config/config.php';

use App\Http\Controllers\OfertaController;
use App\Http\Controllers\ArticuloController;
use App\Utilities\Utilidades;

class IndexController
{
    function __construct()
    {
        if(!isset($_SESSION)){ 
            session_start();
        }  
    }

    // public function index()
    // {

    //     require_once('./app/views/components/header.php');
    //     require_once('./app/views/pages/.php');
    //     require_once('./app/views/components/footer.php');
    // }

    public function dashboard()
    {
        require_once('./app/views/admin/index.php');
    }
    
    public function home()
    {
        $articulo = new OfertaController;
        $utilities = new Utilidades;
        $articulos = $articulo->obtener();

        $utilities->view('pages.home', ['articulos' =>$articulos]);
    }
    public function menu()
    {
        $articulo = new ArticuloController;
        $utilities = new Utilidades;
        $articulos = $articulo->obtener();

        $utilities->view('pages.menu', ['articulos' =>$articulos]);
    }
    public function about()
    {
        $utilities = new Utilidades;
        $utilities->view('pages.about');
    }
    public function services()
    {
        $utilities = new Utilidades;
        $utilities->view('pages.services');
    }
}
?>