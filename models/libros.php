<?php
    class MensajesLibro{
        private $id_novela;
        private $id_info_autor;
        private $nombre;
        private $fecha_publicacion;
        private $num_capitulos;
        private $num_paginas;
        private $resena;
        private $num_gusta;
        private $visualizaciones;
        private $portada;
        private $id_editorial;
        private $id_estatus;
        private $cantidad;
        private $id_categoria;

        private $db;

        public function __construct(){
            $con = new Conexion();
            $this->db = $con->conectar();
        }
    

        public function getNomInfo_Autor() {
            $query = "SELECT usuario.nombre, info_autor.id_info_autor 
                      FROM info_autor
                      JOIN usuario ON usuario.id_usuario = info_autor.id_usuario";
            
            $stmt = $this->db->prepare($query);
            $stmt->execute();
        
            // Obtener resultados como un array asociativo
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            return $result;
        }
        

        public function getAllLibro() {
            $query = "SELECT l.id_libro as id_libro, l.portada as portada,  l.nombre as lnombre, u.nombre as unombre, l.fecha_publicacion as fecha, l.num_capitulos as numcap, l.num_paginas as numpag, l.resena as resena, e.editorial as editorial, es.estatus as estatus
                      FROM libro l
                      JOIN info_autor ia ON l.id_info_autor = ia.id_info_autor
                      JOIN usuario u ON ia.id_usuario = u.id_usuario
                      JOIN editorial e ON e.id_editorial = l.id_editorial
                      JOIN estatus es ON es.id_estatus = l.id_estatus";
        
            $stmt = $this->db->prepare($query);
            $stmt->execute();
        
            // Obtener resultados como un array asociativo
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            return $result;
        }
         
         
        public function getAllAutor($id_libro) {
            $query = "SELECT u.nombre, u.apellido_p, u.apellido_m, u.email
                      FROM libro l
                      JOIN info_autor ia ON l.id_info_autor = ia.id_info_autor
                      JOIN usuario u ON ia.id_usuario = u.id_usuario
                      WHERE l.id_libro = :id_libro";
        
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id_libro', $id_libro, PDO::PARAM_INT);
            $stmt->execute();
        
            // Obtener resultados como un array asociativo
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            return $result;
        }
        
        public function DeleteLibro($id_libro) {
            $query = "DELETE FROM libro WHERE id_libro = :id_libro";
        
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id_libro', $id_libro, PDO::PARAM_INT);
            $stmt->execute();
        }

        public function InsertLibro($id_info_autor, $nombre, $fecha_publicacion, $num_capitulos, $num_paginas, $resena, $portada, $id_editorial) {
            $query = 'INSERT INTO libro (id_info_autor, nombre, fecha_publicacion, num_capitulos, num_paginas, resena, portada, id_editorial, id_estatus) 
                      VALUES (:id_info_autor, :nombre, :fecha_publicacion, :num_capitulos, :num_paginas, :resena, :portada, :id_editorial, 1)';
            
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id_info_autor', $id_info_autor, PDO::PARAM_INT);
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':fecha_publicacion', $fecha_publicacion, PDO::PARAM_STR);
            $stmt->bindParam(':num_capitulos', $num_capitulos, PDO::PARAM_INT);
            $stmt->bindParam(':num_paginas', $num_paginas, PDO::PARAM_INT);
            $stmt->bindParam(':resena', $resena, PDO::PARAM_STR);
            $stmt->bindParam(':portada', $portada, PDO::PARAM_STR);
            $stmt->bindParam(':id_editorial', $id_editorial, PDO::PARAM_INT);
            $stmt->execute();
        }        
        
        public function updateLibro($id_libro, $id_info_autor, $nombre, $fecha_publicacion, $num_capitulos, $num_paginas, $resena, $portada, $id_editorial, $id_categoria) {
            $query = 'UPDATE libro 
                      SET id_info_autor = :id_info_autor,
                          nombre = :nombre,
                          fecha_publicacion = :fecha_publicacion,
                          num_capitulos = :num_capitulos,
                          num_paginas = :num_paginas,
                          resena = :resena,
                          portada = :portada,
                          id_editorial = :id_editorial,
                          id_categoria = :id_categoria 
                      WHERE id_libro = :id_libro';
        
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id_info_autor', $id_info_autor, PDO::PARAM_INT);
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':fecha_publicacion', $fecha_publicacion, PDO::PARAM_STR);
            $stmt->bindParam(':num_capitulos', $num_capitulos, PDO::PARAM_INT);
            $stmt->bindParam(':num_paginas', $num_paginas, PDO::PARAM_INT);
            $stmt->bindParam(':resena', $resena, PDO::PARAM_STR);
            $stmt->bindParam(':portada', $portada, PDO::PARAM_STR);
            $stmt->bindParam(':id_editorial', $id_editorial, PDO::PARAM_INT);
            $stmt->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);
            $stmt->bindParam(':id_libro', $id_libro, PDO::PARAM_INT);
        
            $stmt->execute();
        
            // Actualizar la tabla de categoría_libro si es necesario
            $queryCategoria = 'UPDATE categoria_libro 
                               SET id_categoria = :id_categoria
                               WHERE id_libro = :id_libro';
        
            $stmtCategoria = $this->db->prepare($queryCategoria);
            $stmtCategoria->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);
            $stmtCategoria->bindParam(':id_libro', $id_libro, PDO::PARAM_INT);
            $stmtCategoria->execute();
        }
        

        public function buscaLibro($id_info_autor, $nombre){
            $query = $this->db->prepare("SELECT id_libro FROM libro WHERE id_info_autor = $id_info_autor AND nombre = $nombre");
            $existe = $query->fetchColumn();
            return $existe;
        }

        public function crearLibroYCategoria($id_info_autor, $nombre, $fecha_publicacion, $num_capitulos, $num_paginas, $resena, $portada, $id_editorial, $id_categoria){
            $this->db->beginTransaction();
            try {
                $this->InsertLibro($id_info_autor, $nombre, $fecha_publicacion, $num_capitulos, $num_paginas, $resena, $portada, $id_editorial, $id_categoria); //creamos el usuario
                $id_libro = $this->trerCorreo($email); //solicitamos el correo
                $id_rol = 1;
                $this->crearRol($id_usuario, $id_rol); //creamos el usuario
                echo '4';
                $this->db->commit(); //fin de la transaccion
                echo '5';
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