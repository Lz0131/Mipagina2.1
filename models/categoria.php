<?php
    class MensajesCategoria{
        private $id_libro;
        private $id_usuario;


        private $db;

        public function __construct(){
            $con = new Conexion();
            $this->db = $con->conectar();
        }

        public function getNomCategoria() {
            $query = "SELECT categoria, id_categoria FROM categoria";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
        
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
    }
?>