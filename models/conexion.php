<?php
 class Conexion{
    private $DBType ='mysqli';
    private $DBServer = 'localhost';
    private $DBUser = 'root';
    private $DBPass = '';
    private $DBName = 'milibfav';
 

   public function _construct (){}

   public function conectar(){
        //$con = ADONewConnection($this->DBType);
        //$con->debug = true;
        //$con->connect($this->DBServer,$this->DBUser,$this->DBPass,$this->DBName);
        //return $con;
        try {
         $conn = new PDO("mysql:host={$this->DBServer};dbname={$this->DBName}", $this->DBUser, $this->DBPass);
         $conn -> debug = true;
         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         return $conn;
     } catch (PDOException $e) {
         die("Error de conexión: " . $e->getMessage());
     }

   }
}
?>