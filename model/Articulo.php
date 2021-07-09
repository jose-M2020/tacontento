<?php
require_once 'ModeloBase.php';

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
        $insert = $db->store('articulos', $datos);
        if ($insert) $_SESSION['mensaje-articulo'] = 'Registro exitoso';
        
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
        
       return $db->destroy('articulos', $id);
      
    }
    public function updatearticulo($datos){
        $db = new ModeloBase();
        $sql = "UPDATE articulos SET nombre=:nombre, descripcion=:descripcion, precio=:precio, tipo=:tipo,img=:img WHERE id=:id;";

        return $db->update($sql,$datos);
        
        
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