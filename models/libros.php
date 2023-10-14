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
            $query = "SELECT usuario.nombre 
            FROM info_autor
            JOIN usuario on info_autor.id_usuario = usuario.id_usuario;
            ";
            $rs = $this->db->Execute($query);
            return $rs;
        }

        public function getAllLibro(){
            $query = "SELECT * FROM libro";
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
        public function DeleteLibro( $id_libro){
            $query = 'DELETE FROM libro WHERE id_libro='.$id_libro;
            $this->db->Execute($query);
            
        }
        public function InsertLibro($id_usuario, $id_libro, $cantidad){
            $table = 'carrito';
            $record = array();
            $record['id_info_autor'] = $id_info_autor;
            $record['nombre'] = $nombre;

            $record['cantidad'] = $_POST['txtCantidad'];
            $this->db->autoExecute($table,$record,'INSERT');
        }
    }
?>