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
            $query = "SELECT libro.portada, libro.nombre, carrito.cantidad, libro.id_libro, carrito.cantidad * libro
            FROM carrito
            INNER JOIN libro ON carrito.id_libro = libro.id_libro
            WHERE carrito.id_usuario = $id_usuario;";
            $rs = $this->db->Execute($query);
            return $rs;
        }

        public function getAllCarritonum($id_usuario){
            $query = "SELECT COUNT(*) FROM carrito WHERE id_usuario= $id_usuario";
            $rs = $this->db->Execute($query);
            return $rs;
        }
        public function getAllTotalFavoritosnum($id_libro){
            $query = "SELECT COUNT(*) FROM favorito WHERE AND id_usuario= $id_usuario";
            $rs = $this->db->Execute($query);
            return $rs;
        }
        public function DeleteFavorito($id_usuario, $id_libro){
            $table = 'favorito';
            $query = 'DELETE FROM favorito WHERE id_usuario ='. $id_usuario.'  AND id_libro='.$id_libro;
            $this->db->Execute($query);
            
        }
        public function InsertFavorito($id_usuario, $id_libro){
            $table = 'favorito';
            $record = array();
            $record['id_usuario'] = $id_usuario;
            $record['id_libro'] = $id_libro;
            $this->db->autoExecute($table,$record,'INSERT');
        }
    }
?>