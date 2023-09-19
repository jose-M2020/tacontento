<?php
namespace App\Models;

use App\Database\DB;
use App\Utilities\Utilidades;
use PDOException;
use Exception;

class ModeloBase extends DB {

    public function __construct() {

    }
 
    public function store($table, $datos) {     
        $conexion = parent::conexion();
        $utilities = new Utilidades();

        try { 
          $keys = array_keys($datos);
          $sql = "INSERT INTO $table (".implode(", ", $keys).") \n";
          $sql .= "VALUES ( :".implode(", :",$keys).")";

          $insert = $conexion->prepare($sql)->execute($datos);
          $lastInsertId = $conexion->lastInsertId();

          return !$insert ? false : [
            'id' =>  $lastInsertId
          ];
        
        } catch (PDOException $e) {
          $utilities->setMessage('error', 'Ocurrió un error al procesar su solicitud. Por favor, inténtelo de nuevo más tarde.');
        } catch (Exception $e) {
           
        }
    }

    public function storeMultiple($table, $data) {     
        $conexion = parent::conexion();
        $utilities = new Utilidades();
        
        try { 
          $fields = array_keys($data[0]);
        
          $placeholders = implode(', ', array_map(function ($field) {
            return ":$field";
          }, $fields));

          $sql = "INSERT INTO $table (".implode(", ", $fields).") \n";
          $sql .= "VALUES ($placeholders)";

          $stmt = $conexion->prepare($sql);

          foreach ($data as $item) {
            $stmt->execute($item);
          }

          return $stmt;

        } catch (PDOException $e) {
          $utilities->setMessage('error', 'Ocurrió un error al procesar su solicitud. Por favor, inténtelo de nuevo más tarde.' . $e);
        } catch (Exception $e) {
           
        }
    }

    public function login($email, $password) {
        $conexion = parent::conexion();
        $utilities = new Utilidades();

        try {
            $query = "SELECT * FROM usuarios WHERE email = '".$email. "' AND password = '".$password . "'";
            $pdo = $conexion->query($query)->fetch();
            if($pdo){
                return $pdo;
            }else{
                return false;
            }
        } catch (PDOException $e){
            $utilities->setMessage('error', 'Ocurrió un error al procesar su solicitud. Por favor, inténtelo de nuevo más tarde.');
        }
    }
    public function show($sql) {
        $conexion = parent::conexion();   
        $utilities = new Utilidades();

        try {
            return  $conexion->query($sql)->fetch();
        
        } catch (PDOException $e){
            $utilities->setMessage('error', 'Ocurrió un error al procesar su solicitud. Por favor, inténtelo de nuevo más tarde.' . $e);
        }
    }

    public function edit($table, $id) {
        $conexion = parent::conexion();   
        $utilities = new Utilidades();

        try {
            $query = " SELECT * FROM  $table WHERE id = $id  ";
            return  $conexion->query($query)->fetch();
        
        } catch (PDOException $e){
            $utilities->setMessage('error', 'Ocurrió un error al procesar su solicitud. Por favor, inténtelo de nuevo más tarde.');
        }
    }

    public function index($query) {
        $conexion = parent::conexion();
        $utilities = new Utilidades();

        try {
            $consulta = $conexion->query($query)->fetchAll();
            return $consulta ?? [];
            
        } catch (PDOException $e){
            $utilities->setMessage('error', 'Ocurrió un error al procesar su solicitud. Por favor, inténtelo de nuevo más tarde.');
        }
    }

    public function query($query) {
        $conexion = parent::conexion();
        $utilities = new Utilidades();

        try {
            $consulta = $conexion->query($query)->fetch();
            return $consulta ?? null;
            
        } catch (PDOException $e){
            $utilities->setMessage('error', 'Ocurrió un error al procesar su solicitud. Por favor, inténtelo de nuevo más tarde.');
        }
    }

    public function destroy($table, $id, $field = 'id'){
        $conexion = parent::conexion();
        $utilities = new Utilidades();

        try {
            $query = "DELETE  FROM  $table WHERE $field = $id  ";
            return  $conexion->query($query)->execute();
        
        } catch (PDOException $e){
            $utilities->setMessage('error', 'Ocurrió un error al procesar su solicitud. Por favor, inténtelo de nuevo más tarde.');
        }
    }

    public function update($sql,$datos){
        $conexion = parent::conexion();
        $utilities = new Utilidades();

        try {

            $pdo = $conexion->prepare($sql)->execute($datos);
            if($pdo){
                return $pdo;
            }else{
                false;
            }
            
        } catch (PDOException $e) {
            $utilities->setMessage('error', 'Ocurrió un error al procesar su solicitud. Por favor, inténtelo de nuevo más tarde.');
        } catch (Exception $e) {
            
        }
    }
    public function recordExists($table, $conditions){
        $conexion = parent::conexion();
        $utilities = new Utilidades();

        if (empty($conditions)) {
            throw new Exception("Invalid conditions. Expecting a non-empty array or an array of arrays.");
        }

        if (!is_array(reset($conditions))) {
            // If $conditions is not an array of arrays, convert it into one
            $conditions = [$conditions];
        }
        
        $validOperators = ['=', '<', '>', '<=', '>=', '<>'];
        $sql = "SELECT COUNT(*) as count FROM $table WHERE ";
        $params = [];

        foreach ($conditions as $condition) {
            if (count($condition) !== 3) {
                throw new Exception("Invalid condition. Each condition must be an array with three elements.");
            }

            list($column, $comparison, $value) = $condition;
            if (!in_array($comparison, $validOperators)) {
                throw new Exception("Invalid comparison operator: $comparison");
            }

            $sql .= "$column $comparison :$column AND ";
            $params[":$column"] = $value;
        }

        $sql = rtrim($sql, " AND ");

        try {
            $pdo = $conexion->prepare($sql); 
            $pdo->execute($params); 
            $result = $pdo->fetch();
        
            return $result['count'] > 0;

        } catch (PDOException $e) {
            $utilities->setMessage('error', $e);
        } catch (Exception $e) {
            
        }
    }
    public function pagination($sql){
        $conexion = parent::conexion();
        $utilities = new Utilidades();

        try {

            $pdo = $conexion->prepare($sql); 
            $pdo->execute(); 
            $number_of_rows = $pdo->fetchColumn();
        
            if($number_of_rows){
                return $number_of_rows;
            }else{
                false;
            }
            
            } catch (PDOException $e) {
                $utilities->setMessage('error', 'Ocurrió un error al procesar su solicitud. Por favor, inténtelo de nuevo más tarde.');
            } catch (Exception $e) {
             
        }

    }

}
