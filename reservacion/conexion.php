<?php
$conectar= new mysqli("localhost","root","","tacontento");
if($conectar->connect_error){
    die("error de conexión".$conectar-> connect_error);
}else{
    
}

?>