<?php
    require_once '../models/grafica.php';
    require_once '../models/conexion.php';

    $grafica = new MensajesModelGrafica();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fechaInicial = $_POST['fechaInicial'];
        $fechaFinal = $_POST['fechaFinal'];
        $g = $grafica->getGrafica($fechaInicial,$fechaFinal);

        $jsonResponse = json_encode($g);
        header('Content-Type: application/json');
        echo $jsonResponse;
    }
    
?>