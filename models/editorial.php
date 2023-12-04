<?php
    class MensajesEditorial{
        private $id_libro;
        private $id_usuario;


        private $db;

        public function __construct(){
            $con = new Conexion();
            $this->db = $con->conectar();
        }

        public function getNomEditorial() {
            $query = "SELECT editorial, id_editorial FROM editorial";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
        
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
    }
?>