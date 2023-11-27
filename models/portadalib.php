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
        private $cantidad;

        private $db;

        public function __construct(){
            $con = new Conexion();
            $this->db = $con->conectar();
        }
    

        public function getAllMensajes($id_libro){
            $query = "SELECT * FROM libro where id_libro = :id_libro";
            $rs = $this->db->prepare($query);
            $rs -> bindParam(':id_libro', $id_libro);
            $rs->execute();
            return $rs;
        }  
        public function getAllCarritonum($id_usuario, $id_libro){
            $query = "SELECT COUNT(*) FROM carrito WHERE id_usuario = :id_usuario AND id_libro = :id_libro";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id_usuario', $id_usuario);
            $stmt->bindParam(':id_libro', $id_libro);
            $stmt->execute();
            $existe = $stmt->fetchColumn();
            return $existe;
        }  
        public function getAllAutor($id_libro){
            $query = "SELECT u.nombre, u.apellido_p, u.apellido_m, u.email
            FROM libro l
            JOIN info_autor ia ON l.id_info_autor = ia.id_info_autor
            JOIN usuario u ON ia.id_usuario = u.id_usuario
            WHERE l.id_libro = :id_libro;
            ";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id_libro', $id_libro);
            $stmt->execute();
            $existe = $stmt->fetch(PDO::FETCH_ASSOC);
            return $existe;
        }    
        public function getAllinfo_Autor($id_libro){
            $query = "SELECT ia.info_autor
            FROM info_autor ia
            JOIN libro l ON ia.id_info_autor = l.id_info_autor
            WHERE l.id_libro = :id_libro;
            ";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id_libro', $id_libro);
            $stmt->execute();
            $existe = $stmt->fetch(PDO::FETCH_ASSOC);
            return $existe;
        }  
        public function UpdateCarrito($id_usuario, $id_libro, $cantidad){
            $query = "UPDATE carrito SET cantidad = :cantidad WHERE id_libro= :id_libro AND id_usuario= :id_usuario";
            $rs = $this->db->prepare($query);
            $rs->bindParam(":id_usuario", $id_usuario);
            $rs->bindParam(":id_libro", $id_libro);
            $rs->bindParam(":cantidad", $cantidad);
            $rs->execute();
        }
        public function DeleteCarrito($id_usuario, $id_libro){
            $query = "DELETE FROM carrito WHERE id_usuario =:id_usuario AND id_libro=:id_libro";
            $rs = $this->db->prepare($query);
            $rs->bindParam(":id_usuario", $id_usuario);
            $rs->bindParam(":id_libro", $id_libro);
            $rs->execute();
        }
        public function InsertCarrito($id_usuario, $id_libro, $cantidad){
            $query = "INSERT INTO carrito(id_usuario, id_libro, cantidad)
            VALUES (:id_usuario, :id_libro, :cantidad)";
            $rs = $this->db->prepare($query);
            $rs->bindParam(":id_usuario", $id_usuario);
            $rs->bindParam(":id_libro", $id_libro);
            $rs->bindParam(":cantidad", $cantidad);
            $rs->execute();
        }
    }
?>