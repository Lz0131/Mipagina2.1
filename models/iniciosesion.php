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
            //$email = 'gamez.dulce.1dm@gmail.com';
            $query = "SELECT count(email)  from usuario WHERE email= :email";
            echo $query;
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $existe = $stmt->fetchColumn();
            return $existe;
        }
        public function verificarCuenta($email, $contrasena){
            
            $query = "SELECT COUNT(*) FROM usuario WHERE email = :email AND contrasena = :contrasena";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(":contrasena", $contrasena);
            $stmt->execute();
            $existe = $stmt->fetchColumn();
            return $existe;
        }

        public function obtenerIDUsuario($email, $contrasena){
            $query = "SELECT id_usuario FROM usuario WHERE email = :email AND contrasena = :contrasena";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(":contrasena", $contrasena);
            $stmt->execute();
            $existe = $stmt->fetchColumn();
            return $existe;
        }
    }
?>