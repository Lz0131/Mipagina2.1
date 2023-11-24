<?php
require_once '../models/portadalib.php';
require_once '../models/carrito.php';
require_once '../models/conexion.php';
include_once '../assets/adodb5/adodb.inc.php';
$id_libro = $_GET['id_libro'];

$msjLibro = new MensajesModel();
$libro = $msjLibro->getAllMensajes($id_libro);
$autor = $msjLibro->getAllAutor($id_libro);
$info_autor = $msjLibro->getAllinfo_Autor($id_libro);
$portada = "";
if (isset($libro['portada'])) {
    $url_imagen = htmlspecialchars($libro['portada'], ENT_QUOTES, 'UTF-8');
    $portada.= '<div class="centrar-imagen">';
    $portada.= '<img src="' . $url_imagen . '" alt="' . $url_imagen . ' width="300" height="450">';
    $portada.= '</div>';
} else {
    $portada.= 'La URL de la imagen no está disponible.';
}
$r = '
<h1 id="txtTitulo" name="txtTitulo">'.$msjLibro->getAllMensajes['nombre'].'</h1>
'.$portada.'
<div class="container-favorito" style="text-align: center;">
    <form action=../controller/ctrfavorito.php?id_libro='.$libro['id_libro'].' method="post">
        <button  type="submit" class="btn"><i class="fa fa-heart" aria-hidden="true" style="color: black;">Favorito</i></button>
    </form>
</div>
<div class="container-carrito">
    <form action=../controller/carrito.php?id_libro='.$libro['id_libro'].' method="post">
        <label for="txtCantidad">Cantidad</label>
        <input type="number" id="txtCantidad" name="txtCantidad" />
        <button  type="submit" class="btn"><i class="fa fa-cart-plus" aria-hidden="true">Carrito</i></button>
    </form>
</div>
<div class="container-carrito">
    <form action=../controller/carrito.php?id_libro='.$libro['id_libro']. ' method="post">
        <label for="txtCantidad">Cantidad</label>
        <input type="number" id="txtCantidad" name="txtCantidad" />
        <button  type="submit" class="btn"><i class="fa fa-cart-plus" aria-hidden="true">Carrito</i></button>
    </form>
</div>
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <!-- panel 1 -->
            <div class="panel panel-default">
                <!--wrap panel heading in span to trigger image change as well as collapse -->
                <span class="side-tab" data-target="#tab1" data-toggle="tab" role="tab" aria-expanded="false">
                    <div class="panel-heading" role="tab" id="headingOne" data-toggle="collapse"
                        data-parent="#accordion" href="#collapseOne" aria-expanded="true"
                        aria-controls="collapseOne">
                        <h4 class="panel-title">Informacion General</h4>
                    </div>
                </span>

                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel"
                    aria-labelledby="headingOne">
                    <div class="panel-body">
                        <!-- Tab content goes here -->
                        <br>
                        Titulo:'.$libro['nombre'].'  <br>
                        Autor:'.$autor['nombre'].' '.$autor['apellido_p'].' '.$autor['apellido_m'].' <br>
                        Informacion del autor:'.$info_autor['info_autor'].' <br>
                        Idioma Original: Koreano <br>
                        Estatus: Completada <br>
                        Generos: Apocalipsis, Acción, Aventura, Drama
                    </div>
                </div>
            </div>
            <!-- panel 2 -->
            <div class="panel panel-default">
                <!--wrap panel heading in span to trigger image change as well as collapse -->
                <span class="side-tab" data-target="#tab2" data-toggle="tab" role="tab" aria-expanded="false">
                    <div class="panel-heading" role="tab" id="headingOne" data-toggle="collapse"
                        data-parent="#accordion" href="#collapseOne" aria-expanded="true"
                        aria-controls="collapseOne">
                        <h4 class="panel-title">Sinopsis</h4>
                    </div>
                </span>
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel"
                    aria-labelledby="headingOne">
                    <div class="panel-body">
                        '.$libro['resena'].'
                    </div>
                </div>
            </div>
        </div>
';
echo $r;
?>