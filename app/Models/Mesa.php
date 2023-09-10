<?php
namespace App\Models;

use App\Models\ModeloBase;
use App\Utilities\Utilidades;

class Mesa extends ModeloBase {

    public function __construct(){
        parent::__construct();
    }
   
    public function indexMesa($search,$startOfPaging,$amountOfThePaging) {
        $db = new ModeloBase();
        if(empty($search)){
            $sql = "SELECT * FROM mesas ORDER BY FECHA DESC LIMIT $startOfPaging,$amountOfThePaging";
        }else{
            $sql = "SELECT * FROM mesas WHERE fecha = $search ORDER BY FECHA DESC LIMIT $startOfPaging,$amountOfThePaging";
        }
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

        $sql = "SELECT mesas.id,mesas.personas,mesas.fecha,mesas.hora, usuarios.nombre,usuarios.apellidos,usuarios.telefono,usuarios.email,usuarios.id as id_cliente
        FROM mesas
        left JOIN usuarios
        ON mesas.id_cliente = usuarios.id  Where mesas.id = $id ";

        return $db->show($sql);
      
    }
    public function editMesa($id){
        $db = new ModeloBase();
       return $db->edit('ofertas', $id);
      
    }
    public function destroyMesa($id){
      $db = new ModeloBase();
      $utilities = new Utilidades();
      $deleted = $db->destroy('ofertas', $id);

      $utilities->handleMessage($deleted, 'Mesa eliminado exitosamente!');
      return $deleted;
    }
   
    public function paginationMesa($search){

        $db = new ModeloBase();
        $sql = "SELECT COUNT(id) FROM ofertas";
        
        if(!empty($search)){
            $sql = "SELECT COUNT(titulo) FROM ofertas  WHERE titulo LIKE  '$search%' ";
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
    public function getMesas2($clientId)
    {
        $db = new ModeloBase();

        $sql = "SELECT id, id_cliente, personas, CONCAT('No. de Personas: ', personas) as title, CONCAT(fecha, 'T' ,hora) AS start FROM mesas WHERE mesas.id_cliente = $clientId";

        return  $db->index($sql);
    }
   
 
}

?>