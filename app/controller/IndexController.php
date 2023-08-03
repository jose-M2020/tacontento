<?php

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
        if( isset($_SESSION['usuario'])) {
            require_once('./app/views/admin/index.php');
        } else{
            header('Location: index.php?page=home');
        }
    }
    
    public function home()
    {
        require_once('./app/views/pages/home.php');
    }
    public function menu()
    {
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
    public function logout()
    {
        if (isset($_SESSION['usuario']) || isset($_SESSION['cliente'] )) {
            session_destroy();
            header('Location: index.php?page=home');
        } else {
            header('Location: index.php?page=home');
        }
    }
}
