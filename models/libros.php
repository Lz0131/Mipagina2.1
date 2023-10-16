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

        private $db;

        public function __construct(){
            $con = new Conexion();
            $this->db = $con->conectar();
        }
    

        public function getNomInfo_Autor(){
            $query = "SELECT usuario.nombre, usuario.id_usuario 
            FROM info_autor
            JOIN usuario on info_autor.id_usuario = usuario.id_usuario;
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
            echo $id_libro;
            $query =  'DELETE FROM libro WHERE id_libro='.$id_libro;
            echo $query;
            $this->db->Execute($query);
        }
        public function InsertLibro(){
            $table = 'libro';
            $record = array ();
            $record ['id_info_autor'] = $_POST['selectAutor'];
            $record ['nombre'] = $_POST['txtNombre'];
            $record ['fecha_publicacion'] = $_POST['dateFecha'];
            $record ['num_capitulos'] = $_POST['numCapitulos'];
            $record ['num_paginas'] = $_POST['numPaginas'];
            $record ['resena'] = $_POST['txtResena'];
            $record ['portada'] = $_POST['imgPortada'];
            $record ['id_editorial'] = $_POST['selectEditorial'];
            $record ['id_estatus'] = $_POST['selectEstatus'];
            $this->db->autoExecute($table,$record,'INSERT');
        }
        public function updateLibro(){
            $table = 'libro';
            $record = array ();
            $record ['id_info_autor'] = $_POST['SelectAutor'];
            $record ['nombre'] = $_POST['txtNombre'];
            $record ['fecha_publicacion'] = $_POST['dateFecha'];
            $record ['num_capitulos'] = $_POST['numCapitulos'];
            $record ['num_paginas'] = $_POST['numPaginas'];
            $record ['resena'] = $_POST['txtResena'];
            $record ['portada'] = $_POST['imgPortada'];
            $this->db->autoExecute($table,$record,'UPDATE', 'idMensaje = '.'\''.$_POST['hddId'].'\'');
        }
    }
?>