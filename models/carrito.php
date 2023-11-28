<?php
    class MensajesModelCarrito{
        private $id_libro;
        private $id_usuario;


        private $db;

        public function __construct(){
            $con = new Conexion();
            $this->db = $con->conectar();
        }
        
        public function Crearventa($id_usuario, $id_metodo_pago, $fecha ){
            $query = "INSERT INTO venta(id_usuario, id_metodo_pago, fecha) VALUES (:id_usuario, :id_metodo_pago, :fecha)";
            $rs = $this->db->prepare($query);
            $rs->bindParam(":id_usuario", $id_usuario);
            $rs->bindParam(":id_metodo_pago", $id_metodo_pago);
            $rs->bindParam(":fecha", $fecha);
            $rs->execute();
            $id_venta = $this->db->lastInsertId();
            return $id_venta;
        }

        public function getCarrito($id_usuario){
            $query = "SELECT c.id_libro as id_libro, t.precio as precio, c.cantidad as cantidad, (c.cantidad * t.precio ) as sub_total
            FROM carrito c
            INNER JOIN libro l ON l.id_libro = c.id_libro 
            INNER JOIN tipo_libro t ON t.id_libro = l.id_libro 
            WHERE c.id_usuario = :id_usuario AND t.id_tipo = 1";
            $rs = $this->db->prepare($query);
            $rs -> bindParam(':id_usuario', $id_usuario);
            $rs->execute();
            return $rs;
        }

        public function CrearVenta_detalle($id_venta, $id_libro, $cantidad, $precio, $sub_total){
            $query = "INSERT INTO venta_detalle(id_venta, id_libro, cantidad, precio, sub_total)
            VALUES (:id_venta, :id_libro, :cantidad,:precio, :sub_total)";
            $rs = $this->db->prepare($query);
            $rs->bindParam(":id_venta", $id_venta);
            $rs->bindParam(":id_libro", $id_libro);
            $rs->bindParam(":cantidad", $cantidad);
            $rs->bindParam(":precio", $precio);
            $rs->bindParam(":sub_total", $sub_total);
            $rs->execute();
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
            $query = "SELECT COUNT(*) AS num FROM carrito WHERE id_usuario= :id_usuario";
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

        public function getCorreo($id_usuario){
            $query = "SELECT email FROM usuario WHERE id_usuario = :id_usuario";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_STR);
            $stmt->execute();
            $existe = $stmt->fetchColumn();
            return $existe;
        }

        public function DeleteAllCarrito($id_usuario){
            $table = 'carrito';
            $query = 'DELETE FROM carrito WHERE id_usuario =:id_usuario';
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_STR);
            $stmt->execute();
            //echo 'correcto';
            //return $stmt;
        }
        public function DeleteProducCarrito($id_usuario){
            $table = 'carrito';
            $query = 'DELETE FROM carrito WHERE id_usuario =:id_usuario';
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_STR);
            $stmt->execute();
        }

        public function Updateplus($id_usuario, $id_libro){
            $query = 'UPDATE carrito
                      SET cantidad = cantidad + 1
                      WHERE id_usuario = :id_usuario AND id_libro = :id_libro';
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_STR);
            $stmt->bindParam(':id_libro', $id_libro, PDO::PARAM_STR);
            $stmt->execute();
        }
        

        public function Updateminus($id_usuario, $id_libro){
            $query = 'UPDATE carrito
                      SET cantidad = cantidad - 1
                      WHERE id_usuario = :id_usuario AND cantidad >= 2 AND id_libro = :id_libro';
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_STR);
            $stmt->bindParam(':id_libro', $id_libro, PDO::PARAM_STR);
            $stmt->execute();
        }
        
    }
?>