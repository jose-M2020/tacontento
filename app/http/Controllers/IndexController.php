<?php
namespace App\Http\Controllers;

require_once 'app/config/config.php';

use App\Http\Controllers\OfertaController;
use App\Http\Controllers\ArticuloController;

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
    //     require_once('./app/views/pages/home.php');
    //     require_once('./app/views/components/footer.php');
    // }

    public function dashboard()
    {
        require_once('./app/views/admin/index.php');
    }
    
    public function home()
    {
        $articulo = new OfertaController;
        $articulos = $articulo->obtener();

        require_once('./app/views/pages/home.php');
    }
    public function menu()
    {
        $articulo = new ArticuloController;
        $articulos = $articulo->obtener();

        require_once('./app/views/pages/menu.php');
    }
    public function about()
    {
        require_once('./app/views/pages/about.php');
    }
    public function services()
    {
        require_once('./app/views/pages/services.php');
    }
}
?>