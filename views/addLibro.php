<?php
    require_once '../models/libros.php';
    require_once '../models/carrito.php';
    require_once '../models/editorial.php';
    require_once '../models/categoria.php';
    require_once '../models/conexion.php';
    include_once '../assets/adodb5/adodb.inc.php';
    $id_usuario = 1;
    $msjModel = new MensajesLibro();
    $numModel = new MensajesModelCarrito();
    $nomEditorial = new MensajesEditorial();
    $nomCategoria = new MensajesCategoria();
    $mensajes4 = $nomCategoria->getNomCategoria();
    $mensajes3 = $nomEditorial->getNomEditorial();
    $mensajes2 = $numModel->getAllCarritonum($id_usuario);
    $mensajes = $msjModel-> getNomInfo_Autor();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InfoLib</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js">
    <script src="../assets/js/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="../assets/css/infoLib.css"> <!--Direccion al css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!--Fontawesome CDN-->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
    integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

<script>
    function editar(idMjs, nombre,  fecha, num_capitulos, num_paginas, resena){
        document.getElementById('hddId').value = idMjs;
        document.getElementById('txtNombre').value = nombre;
        document.getElementById('dateFecha').value = fecha;
        document.getElementById('numCapitulos').value = num_capitulos;
        document.getElementById('numPaginas').value = num_paginas;
        document.getElementById('txtResena').value = resena;
    }

    function insertar(){
        var formData = $('#frmaddlibro').serialize();
        $.ajax({
            type: "POST",
            url: "../controller/ctrLibro.php?opc=1",
            data: formData,
            success: function(data){
                $('#tbLibros').html(data);
            }
        })
    }
    function eliminar(id) {
      $.post({
        type: "POST",        
        url: "../controller/ctrLibro.php?opc=3",
        data: {idMsj:id},
        success: function (data) {
          $('#resAJAX').html(data);
        },
      })
    }
</script>
</head>
<!--Cuerpo-->
<body>
    <!--Barra de Navegacion Header-->
    <header id = "head">
    </header> 
    <!--Cuadro de informacion del libro-->
    <main>
        <div class="addlibro container">
        <h3>Libros</h3><div id="resAJAX"></div>
            <form id="frmaddlibro" >
                <input type="hidden" id="hddId" name="hddId">
                <div class="form-group">
                    <label for="selectAutor">Autor</label>
                    <select name="selectAutor" id="selectAutor" class="form-control">
                    <?php
                        while(!$mensajes->EOF){
                    ?>
                    <option value="<?php echo $mensajes->fields[1] ?>"><?php echo $mensajes->fields[0] ?></option>
                    <?php 
                            $mensajes->moveNext();
                        }
                    ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="txtNombre">Nombre</label>
                    <input type="text" id="txtNombre" name="txtNombre" class="form-control">
                </div>
                <div class="form-group">
                    <label for="dateFecha">fecha</label>
                    <input type="date" id="dateFecha" name="dateFecha" class="form-control">
                </div>
                <div class="form-group">
                    <label for="numCapitulos">Numero de capitulos</label>
                    <input type="number" id="numCapitulos" name="numCapitulos" class="form-control">
                </div>
                <div class="form-group">
                    <label for="numPaginas">Numero de paginas</label>
                    <input type="number" id="numPaginas" name="numPaginas" class="form-control">
                </div>
                <div class="form-group">
                    <label for="txtResena">Reseña</label>
                    <textarea name="txtResena" id="txtResena" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="imgPortada">Portada</label>
                    <input type="url" id="imgPortada" name="imgPortada" class="form-control">
                </div>
                <div class="form-group">
                    <label for="selectEditorial">Editorial</label>
                    <select name="selectEditorial" id="selectEditorial" class="form-control">
                    <?php
                        while(!$mensajes3->EOF){
                    ?>
                    <option value="<?php echo $mensajes3->fields[1] ?>"><?php echo $mensajes3->fields[0] ?></option>
                    <?php 
                            $mensajes3->moveNext();
                        }
                    ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="selectCategoria">Categoria</label>
                    <select name="selectCategoria" id="selectCategoria" class="form-control">
                    <?php
                        while(!$mensajes4->EOF){
                    ?>
                    <option value="<?php echo $mensajes4->fields[1] ?>"><?php echo $mensajes4->fields[0] ?></option>
                    <?php 
                            $mensajes4->moveNext();
                        }
                    ?>
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
    </main>
    <!--Pie de Pagina Footer--> 
    <footer class="section footer-classic context-dark bg-image" style="background:black;">
        <div class="containe">
          <div class="row row-30">
            <div class="col-md-4 col-xl-5">
              <div class="pr-xl-4"><a class="brand" href="../index.html"><img class="brand-logo-light" src="../assets/img/logo1.png" alt="" width="100" height="80" srcset="../assets/img/logo1.png 2x"></a>
                <p>Explora mundos infinitos, ¡lee con nosotros en cada página!</p>
                <!-- Rights-->
                <p class="rights"><span>©  </span><span class="copyright-year">2023</span><span> </span><span>Waves</span><span>. </span><span>Derechos reservados.</span></p>
              </div>
            </div>
            <div class="col-md-4">
              <h5>Contactos</h5>
              <dl class="contact-list">
                <dt>Dirección:</dt>
                <dd>Antonio García Cubas</dd>
                <dd>Pte #600 esq. Av. Tecnológico</dd>
                <dd>Celaya, Gto. México</dd>
              </dl>
              <dl class="contact-list">
                <dt>email:</dt>
                <dd><a href="mailto:#">milibrofav@gmail.com</a></dd>
              </dl>
              <dl class="contact-list">
                <dt>Telefono:</dt>
                <dd><a href="tel:#">4611837450</a> <span>or</span> <a href="tel:#">4611234567</a>
                </dd>
              </dl>
            </div>
            <div class="col-md-4 col-xl-3">
              <h5>Links</h5>
              <ul class="nav-list">
                <li><a href="./info.html">Acerca de</a></li>
                <li><a href="#">Proyectos</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="./contactus.html">Contactos</a></li>
                <li><a href="#">Precios</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="row no-gutters social-container">
          <div class="col"><a class="social-inner" href="#"><span class="icon mdi mdi-facebook"></span><span>Facebook</span></a></div>
          <div class="col"><a class="social-inner" href="#"><span class="icon mdi mdi-instagram"></span><span>instagram</span></a></div>
          <div class="col"><a class="social-inner" href="#"><span class="icon mdi mdi-twitter"></span><span>twitter</span></a></div>
          <div class="col"><a class="social-inner" href="#"><span class="icon mdi mdi-youtube-play"></span><span>google</span></a></div>
        </div>
      </footer>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>
<script>
  $( document ).ready(function() {
    $.ajax({
        type: "POST", 
        data:{},       
        url: "../controller/ctrLibro.php?opc=4",
        success: function (data) {
          $('#tbLibros').html(data);
        }
      })
  });
  $(document).ready(function(){
    $.ajax({
      type: "POST",
      url: "../controller/ctrHeader.php?pag=7",
      data: { pag: '7' },
      success: function(data) {
        $('#head').html(data); // Corregido aquí
      },
      error: function(error) {
        console.error('Error al cargar el encabezado', error);
      }
    })
  });
</script>