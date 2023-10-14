<?php
    class MensajesEditorial{
        private $id_libro;
        private $id_usuario;


        private $db;

        public function __construct(){
            $con = new Conexion();
            $this->db = $con->conectar();
        }

        public function getNomEditorial(){
            $query = "SELECT editorial.editorial, editorial.id_editorial FROM editorial;";
            $rs = $this->db->Execute($query);
            return $rs;
        }
    }
?>