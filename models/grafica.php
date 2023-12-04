<?php
    class MensajesModelGrafica{
        private $db;

        public function __construct(){
            $con = new Conexion();
            $this->db = $con->conectar();
        }

        public function getGrafica($fechaInicial, $fechaFinal){
            $query = "SELECT
            l.nombre AS nombre,
            SUM(vd.cantidad) AS total_ventas
        FROM
            venta_detalle vd
        JOIN
            venta v ON vd.id_venta = v.id_venta
        JOIN
            libro l ON vd.id_libro = l.id_libro
        WHERE
            v.fecha BETWEEN :fechaInicial AND :fechaFinal
        GROUP BY
            l.nombre;
        ";

            $stmt = $this->db->prepare($query);

            // Bind de los parámetros
            $stmt->bindParam(':fechaInicial', $fechaInicial, PDO::PARAM_STR);
            $stmt->bindParam(':fechaFinal', $fechaFinal, PDO::PARAM_STR);

            // Ejecutar la consulta
            $stmt->execute();

            // Obtener los resultados
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $resultados;
        }

    }
    
?>