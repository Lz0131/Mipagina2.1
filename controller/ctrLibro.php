<?php
require_once '../models/libros.php';
require_once '../models/conexion.php';
include_once '../assets/adodb5/adodb.inc.php';

 // Supongamos que el ID del usuario es 1

 
if( isset($_GET['opc']) ){
    $msjModel = new MensajesLibro();
    $id_info_autor = $_POST['selectAutor'];
    $nombre = $_POST['txtNombre'];
    $fecha_publicacion = $_POST['dateFecha'];
    $num_paginas = $_POST['numPaginas'];
    $num_capitulos = $_POST['numCapitulos'];
    $resena = $_POST['txtResena'];
    $portada = $_POST['imgPortada'];
    $id_editorial = $_POST['selectEditorial'];
    $id_categoria = $_POST['selectCategoria'];
    switch($_GET['opc']){
        case 1: // INSERT TO DB
            if(!empty($_POST['hddId']) ){
                $id_libro = $_POST['hddId'];
                $msjModel->updateLibro($id_libro, $id_info_autor, $nombre, $fecha_publicacion, $num_capitulos, $num_paginas, $resena, $portada, $id_editorial, $id_categoria);
            }else
                $msjModel->InsertLibro($id_info_autor, $nombre, $fecha_publicacion, $num_capitulos, $num_paginas, $resena, $portada, $id_editorial, $id_categoria);
            break;
        case 2: // UPDATE TO BD
            $msjModel->updateLibro($id_libro, $id_info_autor, $nombre, $fecha_publicacion, $num_capitulos, $num_paginas, $resena, $portada, $id_editorial, $id_categoria);
            break;
        case 3: // DELETE TO DB
            $id_libro = $_POST['idMsj'];
            $msjModel->DeleteLibro($id_libro);
            //echo 'Mensaje AJAX';
            break;
        case 4: // SELECT TO DB
            echo getLibro($msjModel);
    }
}
    function getLibro($msjModel){
        $response = '';
        $mensajes5 = $msjModel->getAllLibro();
        while(!$mensajes5->EOF){
            if (isset($mensajes5->fields[0])) {
                $img = '';
                $url_imagen = htmlspecialchars($mensajes5->fields[1], ENT_QUOTES, 'UTF-8');
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
                <td><h1>'.$mensajes5->fields[2].'</h1></td>
                <td><h1>'.$mensajes5->fields[3].'</h1></td>
                <td><h1>'.$mensajes5->fields[4].'</h1></td>
                <td>
                    <input type="button" value="Editar" onclick= "editar('.$mensajes5->fields[0].',\''.$mensajes5->fields[2].'\','.$mensajes5->fields[4].','.$mensajes5->fields[5].','.$mensajes5->fields[6].',\''.$mensajes5->fields[7].'\')" href="#" class="btn btn-success">
                </td>
                <td>
                    <input type="button" class="btn btn-danger" value="Eliminar" onclick="eliminar('.$mensajes5->fields[0].')">
                </td>
                <td>
                    <a href ="./infoLib.php?opc='.$mensajes5->fields[0].'">
                        <button  type="submit" class="btn"><i class="fa fa-share-square-o" aria-hidden="true">Visitar</i></button>
                    </a>
                </td>
            </tr>';
            $mensajes5->moveNext();
        }
        return $response;
    }
?>
