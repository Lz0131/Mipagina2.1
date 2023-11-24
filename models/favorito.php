<?php
    class MensajesModel{
        private $id_libro;
        private $id_usuario;


        private $db;

        public function __construct(){
            $con = new Conexion();
            $this->db = $con->conectar();
        }
    

        public function getAllFavoritos($id_usuario){
            $query = "SELECT portada, nombre, l.id_libro, id_usuario
            FROM favorito f
            INNER JOIN libro l ON f.id_libro = l.id_libro
            WHERE f.id_usuario = :id_usuario 
            GROUP BY l.id_libro";
            $rs = $this->db->prepare($query);
            $rs -> bindParam(':id_usuario', $id_usuario);
            $rs->execute();
            return $rs;
        }
        public function getAllFavoritosnum($id_usuario, $id_libro){
            $query = "SELECT COUNT(*) FROM favorito WHERE id_libro = :id_libro AND id_usuario= :id_usuario";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id_usuario', $id_usuario);
            $stmt->bindParam(':id_libro', $id_libro);
            $stmt->execute();
            $existe = $stmt->fetchColumn();
            return $existe;
        }
        public function getAllTotalFavoritosnum($id_usuario){
            $query = "SELECT COUNT(*) FROM favorito WHERE id_usuario= :id_usuario";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id_usuario', $id_usuario);
            $stmt->execute();
            $existe = $stmt->fetchColumn();
            return $existe;
        }
        public function DeleteFavorito($id_usuario, $id_libro){
            $query = 'DELETE FROM favorito WHERE id_usuario = :id_usuario  AND id_libro= :id_libro';
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id_usuario', $id_usuario);
            $stmt->bindParam(':id_libro', $id_libro);
            $stmt->execute();
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