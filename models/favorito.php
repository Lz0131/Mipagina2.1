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
            $query = "SELECT libro.portada, libro.nombre
            FROM favorito
            INNER JOIN libro ON favorito.id_libro = libro.id_libro
            WHERE favorito.id_usuario = $id_usuario";
            $rs = $this->db->Execute($query);
            return $rs;
        }
        public function getAllFavoritosnum($id_usuario, $id_libro){
            $query = "SELECT COUNT(*) FROM favorito WHERE id_libro = $id_libro AND id_usuario= $id_usuario";
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