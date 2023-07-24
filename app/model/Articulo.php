<?php
require_once 'ModeloBase.php';
require_once 'app/utilidades/Utilidades.php';

class Articulo extends ModeloBase {

    public function __construct(){
        parent::__construct();
    }
   
    public function indexarticulo($search,$startOfPaging,$amountOfThePaging) {
        $db = new ModeloBase();
        if(empty($search)){
            $sql = "SELECT * FROM articulos LIMIT $startOfPaging,$amountOfThePaging";
        }else{
            $sql = "SELECT * FROM articulos WHERE nombre LIKE  '$search%' LIMIT $startOfPaging,$amountOfThePaging";
        }
        return  $db->index($sql);
     
    }
    public function storearticulo($datos){

        $db = new ModeloBase();
        $utilities = new Utilidades();
        $insert = $db->store('articulos', $datos);

        $utilities->handleMessage($insert, 'Platillo creado con éxito!');
        return $insert;
    }
    public function show($id){
        $db = new ModeloBase();
        $sql = "select * from articulos where id = $id";
        return $db->show($sql);
      
    }
    public function editarticulo($id){
        $db = new ModeloBase();
       return $db->edit('articulos', $id);
      
    }
    public function destroyarticulo($id){
      $db = new ModeloBase();
      $utilities = new Utilidades();
      $deleted = $db->destroy('articulos', $id);
        
      $utilities->handleMessage($deleted, 'Platillo eliminado exitosamente!');
      return $deleted;
    }
    public function updatearticulo($datos){
        $db = new ModeloBase();
        $utilities = new Utilidades();
        $sql = "UPDATE articulos SET nombre=:nombre, descripcion=:descripcion, precio=:precio, tipo=:tipo,img=:img WHERE id=:id;";
        $updated = $db->update($sql,$datos);
        
        $utilities->handleMessage($updated, 'Platillo actualizado exitosamente!');
        return $updated;
    }
    public function paginationarticulo($search){

        $db = new ModeloBase();
        $sql = "SELECT COUNT(id) FROM articulos";
        
        if(!empty($search)){
            $sql = "SELECT COUNT(nombre) FROM articulos  WHERE nombre LIKE  '$search%' ";
        }
        $number_of_rows = $db->pagination($sql);
        $section = ceil($number_of_rows / 8);
        
        return $section;
         
    }
    public function  obtener() {
        $db = new ModeloBase();
        
            $sql = "SELECT * FROM articulos";
        
        return  $db->index($sql);
     
    }
 
}

?>