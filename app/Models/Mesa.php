<?php
namespace App\Models;

use App\Models\ModeloBase;
use App\Utilities\Utilidades;

class Mesa extends ModeloBase {

    public function __construct(){
        parent::__construct();
    }
   
    public function indexMesa($search, $startOfPaging, $amountOfThePaging) {
        $db = new ModeloBase();
        $sql = "SELECT * FROM mesas LIMIT $startOfPaging,$amountOfThePaging";
        return  $db->index($sql);  
    }

    public function storeMesa($datos){

        $db = new ModeloBase();
        $utilities = new Utilidades();
        $insert = $db->store('mesas', $datos);

        $utilities->handleMessage($insert, 'Mesa creado con exito!');
        return $insert;
    }

    public function show($id){
        $db = new ModeloBase();

        $sql = "SELECT * WHERE id = $id ";

        return $db->show($sql);
      
    }

    public function editMesa($id){
        $db = new ModeloBase();
       return $db->edit('mesas', $id);
      
    }

    public function updateMesa($datos){
        $db = new ModeloBase();
        $utilities = new Utilidades();
        $sql = "UPDATE mesas SET nombre=:nombre, capacidad=:capacidad, notas=:notas, status=:status WHERE id=:id;";
        $updated = $db->update($sql,$datos);

        $utilities->handleMessage($updated, 'Mesa actualizado exitosamente!');
        return $updated;
    }

    public function destroyMesa($id){
      $db = new ModeloBase();
      $utilities = new Utilidades();
      $deleted = $db->destroy('mesas', $id);

      $utilities->handleMessage($deleted, 'Mesa eliminado exitosamente!');
      return $deleted;
    }
   
    public function paginationMesa($search){

        $db = new ModeloBase();
        $sql = "SELECT COUNT(id) FROM mesas";
        
        if(!empty($search)){
            $sql = "SELECT COUNT(nombre) FROM mesas  WHERE nombre LIKE  '$search%' ";
        }
        $number_of_rows = $db->pagination($sql);
        $section = ceil($number_of_rows / 8);
        
        return $section;
         
    }
    public function obtenerid()
    {
        $db = new ModeloBase();
        $sql = "SELECT MAX(id) FROM mesas";
        return $db->show($sql);
    }
 
}

?>