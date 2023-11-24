<?php
    session_start();
    
    require_once '../models/conexion.php';
    require_once '../models/usuario.php';
    require_once '../models/favorito.php';
    include_once '../assets/adodb5/adodb.inc.php';

    $msjFav = new MensajesModel();

    $id_usuario = $_SESSION['id_usuario'];
    $r = '';
    $favoritos = $msjFav->getAllFavoritos($id_usuario);
    foreach($favoritos as $favorito){
        $portada = "";
        if (isset($favorito['portada'])) {
            $url_imagen = htmlspecialchars($favorito['portada'], ENT_QUOTES, 'UTF-8');
            $portada.='<div class="centrar-imagen">';
            $portada.= '<img src="' . $url_imagen . '" alt="' . $url_imagen . '" width="300" height="450">';
            $portada.= '</div>';
        } else {
            $portada.='La URL de la imagen no está disponible.';
        }
        $r .= '
                <tr>
                    <th id="txtidf" name="txtidf" scope="row">'.$favorito['id_libro'].'</th>
                    <td>'.$portada.'</td>
                    <td><h1>'.$favorito['nombre'].'</h1></td>
                    <td>
                        <form action="../controller/ctrfavorito.php?id_libro='.$favorito['id_libro'].' " method="post">
                            <button  type="submit" class="btn" style=\'font-size:24px\'><i class="fa fa-times-circle" aria-hidden="true"></i></button>
                        </form>
                    </td>
                <td>
                    <button  type= "submit" onclick= "./infoLib.php?opc='.$favorito['id_libro'].'" class="btn" style=\'font-size:24px\'><i class="fa fa-book" aria-hidden="true"></i></button>
                </td>
                </tr>';
        echo $r;
    }

?>