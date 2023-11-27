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

        public function crearUsuario($nombre, $apellido_p, $apellido_m, $email, $contrasena, $id_direccion){
            $query = 'INSERT INTO usuario(nombre, apellido_p, apellido_m, email, contrasena, id_direccion)
          VALUES (:nombre, :apellido_p, :apellido_m, :email, :contrasena, :id_direccion)';
            $rs = $this->db->prepare($query);
            $rs->bindParam(":nombre", $nombre);
            $rs->bindParam(":apellido_p", $apellido_p);
            $rs->bindParam(":apellido_m", $apellido_m);
            $rs->bindParam(":email", $email);
            $rs->bindParam(":contrasena", $contrasena);
            $rs->bindParam(":id_direccion", $id_direccion);
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
        public function crearDireccion($calle, $num_casa, $caracteristicas, $id_ciudad, $latitud, $longitud){
            try {
                // Utilizar la conexión a la base de datos de la clase (asumiendo que $this->db es tu conexión PDO)
                $query = "INSERT INTO direccion (calle, num_casa, caracteristicas, id_ciudad, latitud, longitud)
                          VALUES (:calle, :num_casa, :caracteristicas, :id_ciudad, :latitud, :longitud)";
        
                $statement = $this->db->prepare($query);
        
                // Vincular los parámetros
                $statement->bindParam(':calle', $calle);
                $statement->bindParam(':num_casa', $num_casa);
                $statement->bindParam(':caracteristicas', $caracteristicas);
                $statement->bindParam(':id_ciudad', $id_ciudad);
                $statement->bindParam(':latitud', $latitud);
                $statement->bindParam(':longitud', $longitud);
        
                // Ejecutar la consulta
                $statement->execute();
                
                $id_direccion = $this->db->lastInsertId();
                return $id_direccion;
            } catch (PDOException $e) {
                // Manejar errores de PDO (puedes personalizar esto según tus necesidades)
                echo "Error al ejecutar la consulta: " . $e->getMessage();
                return false; // La inserción falló
            }
        }
        
        public function traerDireccion($calle, $num_casa, $caracteristicas, $id_ciudad, $latitud, $longitud){
            try {
                // Utilizar la conexión a la base de datos de la clase (asumiendo que $this->db es tu conexión PDO)
                $query = "SELECT id_direccion FROM direccion WHERE calle = :calle AND num_casa = :num_casa AND caracteristicas = :caracteristicas AND id_ciudad = :id_ciudad AND latitud = :latitud AND longitud = :longitud";
        
                $statement = $this->db->prepare($query);
        
                // Vincular los parámetros
                $statement->bindParam(':calle', $calle);
                $statement->bindParam(':num_casa', $num_casa);
                $statement->bindParam(':caracteristicas', $caracteristicas);
                $statement->bindParam(':id_ciudad', $id_ciudad);
                $statement->bindParam(':latitud', $latitud);
                $statement->bindParam(':longitud', $longitud);
        
                // Ejecutar la consulta
                $statement->execute();
        
                $result = $statement->fetch(PDO::FETCH_ASSOC);
                return $result['id_direccion'];

            } catch (PDOException $e) {
                // Manejar errores de PDO (puedes personalizar esto según tus necesidades)
                echo "Error al ejecutar la consulta: " . $e->getMessage();
                return false; // La inserción falló
            }
        }

        public function crearUsuarioYRol($nombre, $apellido_p, $apellido_m, $email, $contrasena, $calle, $num_casa, $caracteristicas, $id_ciudad, $latitud, $longitud){
            $this->db->beginTransaction();
            try {
                $contrasena = md5($contrasena);
                $id_direccion = $this->crearDireccion($calle, $num_casa, $caracteristicas, $id_ciudad, $latitud, $longitud);
                //$id_direccion = $this->traerDireccion($calle, $num_casa, $caracteristicas, $id_ciudad, $latitud, $longitud);
                $this->crearUsuario($nombre, $apellido_p, $apellido_m, $email, $contrasena, $id_direccion); //creamos el usuario
                $id_usuario = $this->trerCorreo($email); //solicitamos el correo
                $id_rol = 1;
                $this->crearRol($id_usuario, $id_rol); //creamos el usuario

                //$this->crearDireccion($calle, $num_casa, $caracteristicas, $id_ciudad, $latitud, $longitud);
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