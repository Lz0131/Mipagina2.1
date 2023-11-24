<?php
    class models_usuario{
        private $id_usuario;
        private $nombre;
        private $id_rol;

        private $db;

        public function __construct(){
            $con = new Conexion();
            $this->db = $con->conectar();
        }

        public function getRol($id_usuario){
            $query = $this->db->prepare("SELECT id_rol FROM rol_usuario WHERE id_usuario = :id_usuario");
            $query-> bindParam(":id_usuario", $id_usuario);
            $query-> execute();
            $res = $query -> fetch(PDO::FETCH_ASSOC);
            return $res['id_rol'];
        }
    }
?>