<?php
require_once 'ModeloBase.php';
require_once 'utilidades/Utilidades.php';

class Usuario extends ModeloBase {

    public function __construct(){
        parent::__construct();
    }
   
    public function login($email, $password) {
        $db = new ModeloBase();
        return $db->login($email,$password);
       
    }
    
    public function storeuser($datos){

        $db = new ModeloBase();
        $utilities = new Utilidades();
        $insert = $db->store('usuarios', $datos);
                
        $utilities->handleMessage($insert, 'Usuario creado con éxito!');
        return $insert;
    }


    public function indexuser($search,$startOfPaging,$amountOfThePaging) {
        $db = new ModeloBase();
        if(empty($search)){
            $sql = "SELECT * FROM usuarios LIMIT $startOfPaging,$amountOfThePaging";
        }else{
            $sql = "SELECT * FROM usuarios WHERE nombre LIKE  '$search%' LIMIT $startOfPaging,$amountOfThePaging";
        }
        return  $db->index($sql);
     
    }

    public function edituser($id){
        $db = new ModeloBase();

       return $db->edit('usuarios', $id);
      
    }
    public function destroyuser($id){
      $db = new ModeloBase();
      $utilities = new Utilidades();
      $deleted = $db->destroy('usuarios', $id);
       
      $utilities->handleMessage($deleted, 'Usuario eliminado exitosamente!');
      return $deleted;
    }
    public function updateuser($datos){
        $db = new ModeloBase();
        $utilities = new Utilidades();
        $sql = "UPDATE usuarios SET nombre=:nombre, apellidos=:apellidos, direccion=:direccion, email=:email,edad=:edad,telefono=:telefono, password=:password WHERE id=:id;";
        $updated = $db->update($sql,$datos);
        
        $utilities->handleMessage($updated, 'Usuario actualizado exitosamente!');
        return $updated;
    }
    public function paginationuser($search){

        $db = new ModeloBase();
        $sql = "SELECT COUNT(id) FROM usuarios";
        
        if(!empty($search)){
            $sql = "SELECT COUNT(nombre) FROM usuarios  WHERE nombre LIKE  '$search%' ";
        }
        $number_of_rows = $db->pagination($sql);
        $section = ceil($number_of_rows / 8);
        
        return $section;
         
    }
    public function checkEmailExists($email)
    {
        $db = new ModeloBase();
        $result = $db->recordExists('usuarios', ['email', '=', $email]);

        return $result;

    }
}

?>