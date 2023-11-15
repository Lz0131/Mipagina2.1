<?php
 class Conexion{
    private $DBType ='mysqli';
    private $DBServer = 'localhost';
    private $DBUser = 'root';
    private $DBPass = '';
    private $DBName = 'milibfav';
 

   public function _construct (){}

   public function conectar(){
        $con = ADONewConnection($this->DBType);
        $con->debug = false;
        $con->connect($this->DBServer,$this->DBUser,$this->DBPass,$this->DBName);
        return $con;
   }
}
?>