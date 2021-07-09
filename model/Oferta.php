<?php
require_once 'ModeloBase.php';

class Oferta extends ModeloBase {

    public function __construct(){
        parent::__construct();
    }
   
    public function indexoferta($search,$startOfPaging,$amountOfThePaging) {
        $db = new ModeloBase();
        if(empty($search)){
            $sql = "SELECT * FROM ofertas LIMIT $startOfPaging,$amountOfThePaging";
        }else{
            $sql = "SELECT * FROM ofertas WHERE titulo LIKE  '$search%' LIMIT $startOfPaging,$amountOfThePaging";
        }
        return  $db->index($sql);
     
    }
    public function storeoferta($datos){

        $db = new ModeloBase();
        $insert = $db->store('ofertas', $datos);
        if ($insert) $_SESSION['mensaje-oferta'] = 'Registro exitoso';
        
    }
    public function show($id){
        $db = new ModeloBase();
        $sql = "select * from ofertas where id = $id";
        return $db->show($sql);
      
    }
    public function editoferta($id){
        $db = new ModeloBase();
       return $db->edit('ofertas', $id);
      
    }
    public function destroyoferta($id){
        $db = new ModeloBase();
        
       return $db->destroy('ofertas', $id);
      
    }
    public function updateoferta($datos){
        $db = new ModeloBase();
        $sql = "UPDATE ofertas SET titulo=:titulo, descripcion=:descripcion, img=:img WHERE id=:id;";

        return $db->update($sql,$datos);
        
        
    }
    public function paginationoferta($search){

        $db = new ModeloBase();
        $sql = "SELECT COUNT(id) FROM ofertas";
        
        if(!empty($search)){
            $sql = "SELECT COUNT(titulo) FROM ofertas  WHERE titulo LIKE  '$search%' ";
        }
        $number_of_rows = $db->pagination($sql);
        $section = ceil($number_of_rows / 8);
        
        return $section;
         
    }
    public function  obtener() {
        $db = new ModeloBase();
        
            $sql = "SELECT * FROM ofertas";
        
        return  $db->index($sql);
     
    }
 
}

?>