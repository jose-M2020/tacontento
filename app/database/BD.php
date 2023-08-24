<?php
namespace App\Database;

use PDO;
use PDOException;

class DB {
    private static $hostname = 'localhost';
    private static $gestor = 'mysql';
    private static $database = 'tacontento-oficial';
    private static $db_user = 'root';
    private static $db_password = '';
    private static $db_charset = 'utf8';
    private  $conexion;


    public function conexion (){
        try {
            $dsn = self::$gestor.":host=".self::$hostname.";dbname=".self::$database;
            $pdo = new PDO($dsn,self::$db_user,self::$db_password);
            $pdo->exec("SET CHARACTER SET ".self::$db_charset);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
				return $pdo;
        } catch (PDOException $e) {
            exit("Error:".$e->getMessage());
        }
    }

    public function desconectar(){
        $this->conexion = null;
    }


}


?>



