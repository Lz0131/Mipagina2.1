<?php
require_once '../models/libros.php';
require_once '../models/conexion.php';

 // Supongamos que el ID del usuario es 1

 
if( isset($_GET['opc']) ){
    $msjModel = new MensajesLibro();
    switch($_GET['opc']){
        case 1: // INSERT TO DB
            if(!empty($_POST['hddId']) ){
                $id_libro = $_POST['hddId'];
                $id_info_autor = $_POST['id_info_autor'];
                $nombre = $_POST['nombre'];
                $fecha_publicacion = $_POST['fecha_publicacion'];
                $num_paginas = $_POST['num_paginas'];
                $num_capitulos = $_POST['num_capitulos'];
                $resena = $_POST['resena'];
                $portada = $_POST['portada'];
                $id_editorial = $_POST['id_editorial'];
                $id_categoria = $_POST['id_categoria'];
                $msjModel->updateLibro($id_libro, $id_info_autor, $nombre, $fecha_publicacion, $num_capitulos, $num_paginas, $resena, $portada, $id_editorial, $id_categoria);
                header("Location: " . $_SERVER["HTTP_REFERER"]);
            }else
                $id_info_autor = $_POST['id_info_autor'];
                $nombre = $_POST['nombre'];
                $fecha_publicacion = $_POST['fecha_publicacion'];
                $num_paginas = $_POST['num_paginas'];
                $num_capitulos = $_POST['num_capitulos'];
                $resena = $_POST['resena'];
                $portada = $_POST['portada'];
                $id_editorial = $_POST['id_editorial'];
                $id_categoria = $_POST['id_categoria'];
                $msjModel->InsertLibro($id_info_autor, $nombre, $fecha_publicacion, $num_capitulos, $num_paginas, $resena, $portada, $id_editorial, $id_categoria);
                header("Location: " . $_SERVER["HTTP_REFERER"]);
            break;
        case 2: // UPDATE TO BD
            $id_info_autor = $_POST['id_info_autor'];
            $nombre = $_POST['nombre'];
            $fecha_publicacion = $_POST['fecha_publicacion'];
            $num_paginas = $_POST['num_paginas'];
            $num_capitulos = $_POST['num_capitulos'];
            $resena = $_POST['resena'];
            $portada = $_POST['portada'];
            $id_editorial = $_POST['id_editorial'];
            $id_categoria = $_POST['id_categoria'];
            $msjModel->updateLibro($id_libro, $id_info_autor, $nombre, $fecha_publicacion, $num_capitulos, $num_paginas, $resena, $portada, $id_editorial, $id_categoria);
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            break;
        case 3: // DELETE TO DB
            $id_libro = $_POST['idMsj'];
            $msjModel->DeleteLibro($id_libro);
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            //echo 'Mensaje AJAX';
            break;
        case 4: // SELECT TO DB
            echo getLibro($msjModel);
    }
}
    function getLibro($msjModel){
        $response = '';
        $mensajes5 = $msjModel->getAllLibro();
        foreach($mensajes5 as $l){
            if (isset($l['portada'])) {
                $img = '';
                $url_imagen = htmlspecialchars($l['portada'], ENT_QUOTES, 'UTF-8');
                $img .= '<div class="centrar-imagen">';
                $img .= '<img src="' . $url_imagen . '" alt="' . $url_imagen . ' width="300" height="450"">';
                $img .= '</div>';
            } else {
                $img .= 'La URL de la imagen no está disponible.';
            }
            $response .= '
            <tr>
                <th scope="row">1</th>
                <td>'.$img.'</td>
                <td><h1>'.$l['lnombre'].'</h1></td>
                <td><h1>'.$l['unombre'].'</h1></td>
                <td><h1>'.$l['fecha'].'</h1></td>
                <td>
                    <input type="button" value="Editar" onclick= "editar('.$l['id_libro'].',\''.$l['lnombre'].'\','.$l['fecha'].','.$l['numcap'].','.$l['numpag'].',\''.$l['resena'].'\')" href="#" class="btn btn-success">
                </td>
                <td>
                    <input type="button" class="btn btn-danger" value="Eliminar" onclick="eliminar('.$l['id_libro'].')">
                </td>
                <td>
                    <a href ="./infoLib.php?opc='.$l['id_libro'].'">
                        <button  type="submit" class="btn"><i class="fa fa-share-square-o" aria-hidden="true">Visitar</i></button>
                    </a>
                </td>
            </tr>';
        }
        return $response;
    }
?>
