<?php

class Utilidades {

    public function pagination($page,$cant){
        if($page == 1 or $page == 0){
            $inicio = 0;
        }else{
            $inicio = $page*$cant-$cant;
        }   
        return $inicio;
    } 
    #recurso tomado de https://manuais.iessanclemente.net/index.php/Almacenamiento_de_im%C3%A1genes_en_bases_de_datos_con_PHP
    function uploadFile($directorio_destino, $nombre_fichero){
        
        $tmp_name = $_FILES[$nombre_fichero]['tmp_name'];
        //si hemos enviado un directorio que existe realmente y hemos subido el archivo  
        if (is_dir($directorio_destino) && is_uploaded_file($tmp_name))
        {
            $img_file = $_FILES[$nombre_fichero]['name'];
            $img_type = $_FILES[$nombre_fichero]['type'];
            // Si se trata de una imagen   
            if (((strpos($img_type, "gif") || strpos($img_type, "jpeg") || strpos($img_type,        "jpg")) || strpos($img_type, "png")))
            {
                //¿Tenemos permisos para subir la imágen?
                
                if (move_uploaded_file($tmp_name, $directorio_destino . '/' . $img_file))
                {
                    return $img_file;
                }
            }
        }
        //Si llegamos hasta aquí es que algo ha fallado
        return "";
        }
}