<?php
    class MensajesCategoria{
        private $id_libro;
        private $id_usuario;


        private $db;

        public function __construct(){
            $con = new Conexion();
            $this->db = $con->conectar();
        }

        public function getNomCategoria(){
            $query = "SELECT categoria.categoria, categoria.id_categoria FROM categoria;";
            $rs = $this->db->Execute($query);
            return $rs;
        }
    }
?>