<?php

class IndexController
{
    function __construct()
    {
        if(!isset($_SESSION)){ 
            session_start(); 
        }  
    }

    public function index()
    {

        require_once('./views/header.php');
        require_once('home.php');
        require_once('./views/footer.php');
    }

    public function dashboard()
    {
        if( isset($_SESSION['usuario'])) {
            require_once('views/admin/index.php');
        } else{
            header('Location: home.php');
        }
    }
    public function carrito()
    {
         header('Location: carrito.php');
    }
    public function home()
    {
        header('Location: home.php');
    }
    public function about()
    {
        header('Location: 05_contact.php');
    }
    public function services()
    {
        header('Location: 02_about_us.php');
    }
    public function logout()
    {
        if (isset($_SESSION['usuario']) || isset($_SESSION['cliente'] )) {
            session_destroy();
            header('Location: home.php');
        } else {
            header('Location: home.php');
        }
    }
}
