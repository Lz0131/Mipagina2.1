<?php
    class MensajesModelGrafica{
        private $db;

        public function __construct(){
            $con = new Conexion();
            $this->db = $con->conectar();
        }

        public function getGrafica(){
            $query = "SELECT l.nombre, SUM(vd.cantidad) as total_cantidades 
            FROM venta_detalle vd 
            JOIN libro l ON l.id_libro = vd.id_libro 
            GROUP BY vd.id_libro";
        }
    }
?>