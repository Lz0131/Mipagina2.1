<?php
    class MensajesModel{
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

        private $db;

        public function __construct(){
            $con = new Conexion();
            $this->db = $con->conectar();
        }
    

        public function getAllMensajes(){
            $query = "SELECT * FROM libro where id_libro = 1";
            $rs = $this->db->Execute($query);
            // print_r($rs->getRows());
            return $rs;
        }    
        public function getAllAutor(){
            $query = "SELECT u.nombre, u.apellido_p, u.apellido_m, u.email
            FROM libro l
            JOIN info_autor ia ON l.id_info_autor = ia.id_info_autor
            JOIN usuario u ON ia.id_usuario = u.id_usuario
            WHERE l.id_libro = 1;
            ";
            $rs = $this->db->Execute($query);
            // print_r($rs->getRows());
            return $rs;
        }    
        public function getAllinfo_Autor(){
            $query = "SELECT ia.info_autor
            FROM info_autor ia
            JOIN libro l ON ia.id_info_autor = l.id_info_autor
            WHERE l.id_libro = 1;
            ";
            $rs = $this->db->Execute($query);
            // print_r($rs->getRows());
            return $rs;
        }  
        public function UpdateCarrito($id_usuario, $id_libro, $cantidad){
            $table = 'carrito';
            $query = "UPDATE carrito 
            SET cantidad = $cantidad 
            WHERE id_usuario = $id_usuario AND id_libro = $id_libro
            ";
            $rs = $this->db->Execute($query);
            // print_r($rs->getRows());
        }
        public function DeleteCarrito($id_usuario, $id_libro){
            $table = 'carrito';
            $query = "DELETE FROM carrito 
            WHERE id_usuario = $id_usuario AND id_libro = $id_libro
            ";
            $rs = $this->db->Execute($query);
            // print_r($rs->getRows());
        }
        public function InsertCarrito($id_usuario, $id_libro, $cantidad){
            $table = 'carrito';
            $query = "INSERT INTO carrito (id_usuario, id_libro, cantidad) 
            VALUES ($id_usuario, $id_libro, $cantidad)
            ";
            $rs = $this->db->Execute($query);
            // print_r($rs->getRows());
        }
    }
?>