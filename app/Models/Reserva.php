<?php
namespace App\Models;

use App\Models\ModeloBase;
use App\Utilities\Utilidades;

class Reserva extends ModeloBase {

    public function __construct(){
        parent::__construct();
    }
   
    public function indexreserva($search,$startOfPaging,$amountOfThePaging) {
        $db = new ModeloBase();
        if(empty($search)){
            $sql = "SELECT * FROM reservas ORDER BY FECHA DESC LIMIT $startOfPaging,$amountOfThePaging";
        }else{
            $sql = "SELECT * FROM reservas WHERE fecha = $search ORDER BY FECHA DESC LIMIT $startOfPaging,$amountOfThePaging";
        }
        return  $db->index($sql);
     
    }
    public function storereserva($datos){

        $db = new ModeloBase();
        $utilities = new Utilidades();
        $insert = $db->store('reservas', $datos);

        $utilities->handleMessage($insert, 'Reserva realizado con exito!');
        return $insert;
    }
    public function show($id){
        $db = new ModeloBase();

        $sql = "SELECT reservas.id,reservas.personas,reservas.fecha,reservas.hora, usuarios.nombre,usuarios.apellidos,usuarios.telefono,usuarios.email,usuarios.id as id_cliente
        FROM reservas
        left JOIN usuarios
        ON reservas.id_cliente = usuarios.id  Where reservas.id = $id ";

        return $db->show($sql);
      
    }
    public function editreserva($id){
        $db = new ModeloBase();
       return $db->edit('ofertas', $id);
      
    }
    public function destroyreserva($id){
      $db = new ModeloBase();
      $utilities = new Utilidades();
      $deleted = $db->destroy('ofertas', $id);

      $utilities->handleMessage($deleted, 'Reserva eliminado exitosamente!');
      return $deleted;
    }
   
    public function paginationreserva($search){

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
        $sql = "SELECT MAX(id) FROM reservas";
        return $db->show($sql);
    }
    public function getreservas2($id)
    {
        $db = new ModeloBase();

        $sql = "CALL obtener_reservas( $id );";

        return  $db->index($sql);
    }
   
 
}

?>