<?php
require_once 'ModeloBase.php';
require_once 'app/utilidades/Utilidades.php';

class Carrito extends ModeloBase {

    public function __construct(){
        parent::__construct();
    }

    public function indexCarrito($idUsuario,$startOfPaging,$amountOfThePaging) {
        $db = new ModeloBase();
        $sql = "SELECT * FROM carrito WHERE id_usuario = $idUsuario LIMIT $startOfPaging,$amountOfThePaging";
        return  $db->index($sql);
     
    }
    
    public function storeItem($datos){

        $db = new ModeloBase();
        $utilities = new Utilidades();
        $insert = $db->store('carrito', $datos);
        
        $utilities->handleMessage($insert, 'Platillo agregado al carrito!');
        return $insert;
    }

    // public function update($datos){
    //     $db = new ModeloBase();
    //     $utilities = new Utilidades();
    //     $sql = "UPDATE usuarios SET nombre=:nombre, apellidos=:apellidos, direccion=:direccion, email=:email,edad=:edad,telefono=:telefono, password=:password WHERE id=:id;";
    //     $updated = $db->update($sql,$datos);
        
    //     $utilities->handleMessage($updated, 'Usuario actualizado exitosamente!');
    //     return $updated;
    // }

    public function destroyItem($id){
        $db = new ModeloBase();
        $utilities = new Utilidades();
        $deleted = $db->destroy('carrito', $id);
            
        $utilities->handleMessage($deleted, 'Platillo eliminado del carrito!');
        return $deleted;
    }

    public function pagination($idUsuario){

        $db = new ModeloBase();
        $sql = "SELECT COUNT(id) FROM carrito  WHERE id_usuario = $idUsuario ";
        $number_of_rows = $db->pagination($sql);
        $section = ceil($number_of_rows / 8);
        
        return $section;
         
    }

    public function count($idUsuario){

        $db = new ModeloBase();
        $sql = "SELECT COUNT(id) FROM carrito  WHERE id_usuario = $idUsuario ";
        $number_of_rows = $db->pagination($sql);        
        return $number_of_rows;
         
    }
}

?>