<?php
    class models_registro{
        
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

        public function verificar($email){
            $query = "SELECT COUNT(*) FROM usuario WHERE email ='$email'";
            $rs = $this->db->GetOne($query);
            return $rs;
        }

        public function insertUsuario(){
            $nombre = '\''.$_POST['txtnombre'].'\'';
            $apellido_p = '\''.$_POST['txtape_p'].'\'';
            $apellido_m = '\''.$_POST['txtape_m'].'\'';
            $email = '\''.$_POST['txtcorreo'].'\'';
            $contrasena = '\''.$_POST['txtpassword'].'\'';
            $query = 'INSERT INTO 
            usuario(nombre, apellido_p, apellido_m, email, contrasena)
            VALUES ('.$nombre.','.$apellido_p.','.$apellido_m.','.$email.','.$contrasena.')';
            $this->db->Execute($query);
        }
    }
?>