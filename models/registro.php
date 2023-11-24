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
        /*
        public function verificar($email){
            //$query = "SELECT COUNT(*) FROM usuario WHERE email ='$email'";
            //$rs = $this->db->GetOne($query);
            //return $rs;
            // Validación del correo electrónico (puedes mejorar esto según tus necesidades)
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // Manejar el error: correo electrónico no válido
                return 0;
            }

            // Consulta SQL para contar usuarios con el correo electrónico proporcionado
            $query = "SELECT COUNT(*) FROM usuario WHERE email = '$email'";
            
            // Ejecución de la consulta y obtención del resultado
            $existeCompra = $this->db->GetOne($query);

            // Retorno del resultado
            return $existeCompra;
        }*/
        
        public function verificar($email){
            //$email = 'gamez.dulce.1dm@gmail.com';
            $query = "SELECT count(*)  from usuario WHERE email=:email";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $existe = $stmt->fetchColumn();
            return $existe;
        }
        

        public function trerCorreo($email){
            $query = $this->db->prepare("SELECT id_usuario FROM usuario WHERE email = :email");
            $query->bindParam(":email", $email);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result['id_usuario'];
        }

        public function crearUsuario($nombre, $apellido_p, $apellido_m, $email, $contrasena){
            $query = 'INSERT INTO usuario(nombre, apellido_p, apellido_m, email, contrasena)
          VALUES (:nombre, :apellido_p, :apellido_m, :email, :contrasena)';
            $rs = $this->db->prepare($query);
            $rs->bindParam(":nombre", $nombre);
            $rs->bindParam(":apellido_p", $apellido_p);
            $rs->bindParam(":apellido_m", $apellido_m);
            $rs->bindParam(":email", $email);
            $rs->bindParam(":contrasena", $contrasena);
            $rs->execute();

        }

        public function crearRol($id_usuario, $id_rol){
            $query = "INSERT INTO rol_usuario (id_usuario, id_rol) VALUES
                                         (:id_usuario, :id_rol)";
            $rs = $this->db->prepare($query);
            $rs->bindParam(":id_usuario", $id_usuario);
            $rs->bindParam(":id_rol", $id_rol);
            $rs->execute();
        }

        public function crearUsuarioYRol($nombre, $apellido_p, $apellido_m, $email, $contrasena){
            $this->db->beginTransaction();
            try {
                $contrasena = md5($contrasena);
                $this->crearUsuario($nombre, $apellido_p, $apellido_m, $email, $contrasena); //creamos el usuario
                $id_usuario = $this->trerCorreo($email); //solicitamos el correo
                $id_rol = 1;
                $this->crearRol($id_usuario, $id_rol); //creamos el usuario
                //echo '4';
                $this->db->commit(); //fin de la transaccion
                //echo '5';
            } catch (PDOException $e) {
                $this->db->rollBack();
                $response = array(
                    'success' => false,
                    'message' => 'Error: Transacción fallida ' . $e->getMessage()
                );
    
                header('Content-Type: application/json');
                echo json_encode($response);
            }
        }
    }
?>