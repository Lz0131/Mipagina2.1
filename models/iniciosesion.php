<?php
    class models_InicioSesion{
        
        private $id_usuario;
        private $nombre;
        private $apellido_p;
        private $apellido_m;
        private $email;
        private $contrasena;
        private $id_direccion;
        
        private $db;

        public function __construct(){
            $con = new Conexion();
            $this->db = $con->conectar();
        }
        public function verificarEmail($email){
            $query = "SELECT COUNT(*) FROM usuario WHERE email ='$email'";
            $rs = $this->db->GetOne($query);
            return $rs;
        }
        public function verificarCuenta($email, $contrasena){
            $query = "SELECT COUNT(*) FROM usuario WHERE email ='$email' AND contrasena ='$contrasena'";
            $rs = $this->db->GetOne($query);
            return $rs;
        }

        public function obtenerIDUsuario($email, $contrasena){
            $query = "SELECT id_usuario FROM usuario WHERE email = '$email' AND contrasena = '$contrasena'";
            $rs = $this -> db -> GetOne($query);
            return $rs;
        }
    }
?>