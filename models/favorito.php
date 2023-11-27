<?php
    class MensajesModel{
        private $id_libro;
        private $id_usuario;


        private $db;

        public function __construct(){
            $con = new Conexion();
            $this->db = $con->conectar();
        }
    

        public function getAllFavoritos($id_usuario) {
            $query = "SELECT l.portada, l.nombre, l.id_libro, f.id_usuario
                      FROM libro l
                      INNER JOIN (
                        SELECT id_libro, MAX(id_usuario) AS id_usuario
                        FROM favorito
                        WHERE id_usuario = :id_usuario
                        GROUP BY id_libro
                      ) f ON l.id_libro = f.id_libro
                      WHERE f.id_usuario = :id_usuario";
                      
            $rs = $this->db->prepare($query);
            $rs->bindParam(':id_usuario', $id_usuario, PDO::PARAM_STR);
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
        public function InsertFavorito($id_usuario, $id_libro) {
            $table = 'favorito';
            $query = "INSERT INTO $table (id_usuario, id_libro) VALUES (:id_usuario, :id_libro)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_STR);
            $stmt->bindParam(':id_libro', $id_libro, PDO::PARAM_STR);
            $stmt->execute();
        }
        
    }
?>