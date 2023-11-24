<?php
    class MensajesModelCarrito{
        private $id_libro;
        private $id_usuario;


        private $db;

        public function __construct(){
            $con = new Conexion();
            $this->db = $con->conectar();
        }
    

        public function getAllCarrito($id_usuario){
            $query = "SELECT 
            libro.portada, 
            libro.nombre, 
            carrito.cantidad, 
            libro.id_libro, 
            (carrito.cantidad * (SELECT tipo_libro.precio FROM tipo_libro WHERE tipo_libro.id_libro = libro.id_libro AND tipo_libro.id_tipo = 1)) AS subtotal
            FROM carrito
            INNER JOIN libro ON libro.id_libro = carrito.id_libro
            WHERE carrito.id_usuario = :id_usuario";
            $rs = $this->db->prepare($query);
            $rs -> bindParam(':id_usuario', $id_usuario);
            $rs->execute();
            return $rs;
        }
        public function getSubTotal($id_usuario){
            $query = "SELECT COALESCE(SUM(subtotal), 0) AS total_carrito
            FROM (
                SELECT 
                    (carrito.cantidad * (SELECT tipo_libro.precio FROM tipo_libro WHERE tipo_libro.id_libro = libro.id_libro AND tipo_libro.id_tipo = 1)) AS subtotal
                FROM carrito
                INNER JOIN libro ON libro.id_libro = carrito.id_libro
                WHERE carrito.id_usuario = :id_usuario
            ) AS subtotales";
            $rs = $this->db->prepare($query);
            $rs->bindParam(':id_usuario', $id_usuario, PDO::PARAM_STR);
            $rs->execute();
            $subtotal = $rs->fetchColumn();
            //echo $subtotal['total_carrito'];
            return $subtotal;
        }

        public function getAllCarritonum($id_usuario){
            $query = "SELECT COUNT(*) FROM carrito WHERE id_usuario= :id_usuario";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_STR);
            $stmt->execute();
            $existe = $stmt->fetchColumn();
            return $existe;
        }
        public function getAllTotalFavoritosnum($id_libro){
            $query = "SELECT COUNT(*) FROM favorito WHERE AND id_usuario= $:id_usuario";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_STR);
            $stmt->execute();
            $existe = $stmt->fetchColumn();
            return $existe;
        }
        public function DeleteCarrito($id_usuario){
            $table = 'carrito';
            $query = 'DELETE FROM carrito WHERE id_usuario =:id_usuario';
            $this->db->Execute($query);
        }
        public function InsertFavorito($id_usuario, $id_libro){
            $table = 'favorito';
            $record = array();
            $record['id_usuario'] = $id_usuario;
            $record['id_libro'] = $id_libro;
            $this->db->autoExecute($table,$record,'INSERT');
        }

        public function Updateplus($id_libro){
            $query = 'UPDATE carrito
            SET cantidad = cantidad + 1
            WHERE id_usuario = 1 AND id_libro ='. $id_libro;
            $this->db->Execute($query);
        }

        public function Updateminus($id_libro){
            $query = 'UPDATE carrito
            SET cantidad = cantidad - 1
            WHERE id_usuario = 1 AND cantidad >=2 AND id_libro ='. $id_libro;
            $this->db->Execute($query);
        }
    }
?>