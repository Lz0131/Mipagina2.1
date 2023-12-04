<?php
    session_start();
    require_once '../models/libros.php';
    require_once '../models/carrito.php';
    require_once '../models/editorial.php';
    require_once '../models/categoria.php';
    require_once '../models/conexion.php';
    $msjModel = new MensajesLibro();
    $numModel = new MensajesModelCarrito();
    $nomEditorial = new MensajesEditorial();
    $nomCategoria = new MensajesCategoria();

    if(isset($_SESSION['id_usuario'])){
        $r ='
        <div class="addlibro container">
          <h3>Libros</h3><div id="resAJAX"></div>
            <form id="frmaddlibro" >
                <input type="hidden" id="hddId" name="hddId">
                <div class="form-group">
                    <label for="id_info_autor">Autor</label>
                    <select name="id_info_autor" id="id_info_autor" class="form-control">';
        $infoAutor = $msjModel->getNomInfo_Autor();
        foreach($infoAutor as $infoA){
            $r.= '<option value="'.$infoA['id_info_autor'].'">'.$infoA['nombre'].'</option>';
        }
               $r.='     
                    </select>
                </div>
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" class="form-control">
                </div>
                <div class="form-group">
                    <label for="fecha_publicacion">fecha</label>
                    <input type="date" id="fecha_publicacion" name="fecha_publicacion" class="form-control">
                </div>
                <div class="form-group">
                    <label for="num_capitulos">Numero de capitulos</label>
                    <input type="number" id="num_capitulos" name="num_capitulos" class="form-control">
                </div>
                <div class="form-group">
                    <label for="num_paginas">Numero de paginas</label>
                    <input type="number" id="num_paginas" name="num_paginas" class="form-control">
                </div>
                <div class="form-group">
                    <label for="resena">Reseña</label>
                    <textarea name="resena" id="resena" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="portada">Portada</label>
                    <input type="url" id="portada" name="portada" class="form-control">
                </div>
                <div class="form-group">
                    <label for="id_editorial">Editorial</label>
                    <select name="id_editorial" id="id_editorial" class="form-control">';
        $infoEditorial = $nomEditorial->getNomEditorial();
        foreach($infoEditorial as $infoE){
            $r.= '<option value="'.$infoE['id_editorial'].'">'.$infoE['editorial'].'</option>';
        }
        $r.='
                    </select>
                </div>
                <div class="form-group">
                    <label for="id_categoria">Categoria</label>
                    <select name="id_categoria" id="id_categoria" class="form-control">';
        $infoCategoria = $nomCategoria->getNomCategoria();
        foreach($infoCategoria as $infoC){
            $r.= '<option value="'.$infoC['id_categoria'].'">'.$infoC['categoria'].'</option>';
        }
        $r.='
                    </select>
                </div>
                <button type="button" onclick="insertar()" class="btn" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
            </form>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Portada</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Autor</th>
                        <th scope="col">Fecha de publicacion</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody id="tbLibros"></tbody>
            </table>
        </div>
        ';
        echo $r;
        exit;
    }else{

    }
?>