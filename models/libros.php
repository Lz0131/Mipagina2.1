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
    

        public function getNomInfo_Autor(){
            $query = "SELECT usuario.nombre, info_autor.id_info_autor 
            FROM info_autor
            JOIN usuario on usuario.id_usuario = info_autor.id_usuario;
            ";
            $rs = $this->db->Execute($query);
            return $rs;
        }

        public function getAllLibro(){
            $query = "SELECT l.id_libro, l.portada,  l.nombre, u.nombre, l.fecha_publicacion, l.num_capitulos, l.num_paginas, l.resena, e.editorial, es.estatus
            FROM libro l
            JOIN info_autor ia ON l.id_info_autor = ia.id_info_autor
            JOIN usuario u ON ia.id_usuario = u.id_usuario
            JOIN editorial e ON e.id_editorial = l.id_editorial
            JOIN estatus es ON es.id_estatus = l.id_estatus";
            $rs = $this->db->Execute($query);
            // print_r($rs->getRows());
            return $rs;
        }  
         
        public function getAllAutor($id_libro){
            $query = "SELECT u.nombre, u.apellido_p, u.apellido_m, u.email
            FROM libro l
            JOIN info_autor ia ON l.id_info_autor = ia.id_info_autor
            JOIN usuario u ON ia.id_usuario = u.id_usuario
            WHERE l.id_libro = $id_libro;
            ";
            $rs = $this->db->Execute($query);
            // print_r($rs->getRows());
            return $rs;
        }    
        public function getAllinfo_Autor($id_libro){
            $query = "SELECT ia.info_autor
            FROM info_autor ia
            JOIN libro l ON ia.id_info_autor = l.id_info_autor
            WHERE l.id_libro = $id_libro;
            ";
            $rs = $this->db->Execute($query);
            return $rs;
        }
        public function DeleteLibro($id_libro){
            //echo $id_libro;
            $query =  "DELETE FROM libro WHERE id_libro=$id_libro";
            //echo $query;
            $this->db->execute($query);
        }
        public function InsertLibro(){
            $table = 'libro';
            $id_info_autor = $_POST['selectAutor'];
            $nombre = $_POST['txtNombre'];
            $fecha_publicacion = $_POST['dateFecha'];
            $num_paginas = $_POST['numPaginas'];
            $num_capitulos = $_POST['numCapitulos'];
            $resena = $_POST['txtResena'];
            $portada = $_POST['imgPortada'];
            $id_editorial = $_POST['selectEditorial'];
            $id_categoria = $_POST['selectCategoria'];
            $query = 'INSERT INTO `libro`
            (id_info_autor, nombre, fecha_publicacion, num_capitulos, num_paginas, resena, portada, id_editorial, id_estatus) 
            VALUES ('.$id_info_autor.',\''.$nombre.'\',\''.$fecha_publicacion.'\','.$num_capitulos.','.$num_paginas.',\''.$resena.'\',\''.$portada.'\','.$id_editorial.', '.$id_categoria.')';
           $this->db->Execute($query);
        }
        public function updateLibro($id_libro, $id_info_autor, $nombre, $fecha_publicacion, $num_capitulos, $num_paginas, $resena, $portada, $id_editorial, $id_categoria){
            $query = 'UPDATE libro 
            SET id_info_autor ='.$id_info_autor.',
            nombre = \''.$nombre.'\',
            fecha_publicacion = \''.$fecha_publicacion.'\',
            num_capitulos = '.$num_capitulos.',
            num_paginas = '.$num_paginas.',
            resena = \''.$resena.'\',
            portada = \''.$portada.'\',
            id_editorial ='.$id_editorial.',
            id_categoria ='.$id_categoria.' 
             WHERE id_libro = '.$id_libro;
            $this->db->Execute($query);
            $queryCategoria = 'UPDATE categoria_libro 
            SET id_categoria ='.$id_categoria.
            ' WHERE id_libro='.$id_libro;
            $this->db->Execute($queryCategoria);
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