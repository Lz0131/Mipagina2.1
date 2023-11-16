<?php
    require_once '../models/favorito.php';
    require_once '../models/carrito.php';
    require_once '../models/conexion.php';
    include_once '../assets/adodb5/adodb.inc.php';
    $msjModel = new MensajesModel();
    $id_usuario = 1;
    $mensajes = $msjModel->getAllFavoritos($id_usuario);
    $numModel = new MensajesModelCarrito();
    $mensajes2 = $numModel->getAllCarritonum($id_usuario);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favoritos</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js">
    <link rel="stylesheet" src="https://code.jquery.com/jquery-3.3.1.slim.min.js">
    <link rel="stylesheet" href="../assets/css/infoLib.css"> <!--Direccion al css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    
<!--Fontawesome CDN-->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
    integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous" />
    <script>
      function header() {
        $.ajax({
          type: "POST",
          url: "../controller/ctrHeader.php?pag=2",
          data: { pag: '2' },
          success: function(data) {
            $('#head').html(data); // Corregido aquí
          },
          error: function(error) {
            console.error('Error al cargar el encabezado', error);
          }
        });
      }
    </script>
</head>
<!--Cuerpo-->
<body>
    <!--Barra de Navegacion Header-->
    <header id = "head">
    </header> 
    <!--Cuadro de favoritos-->
    <main>
        <div class="favoritos container">
            <h1>Favoritos</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Portada</th>
                        <th scope="col">Titulo</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <form id="frmFavorito" method="post">
                <tbody>
                    <?php
                        while(!$mensajes->EOF){
                    ?>
                    <tr>
                        <th id="txtidf" name="txtidf" scope="row"><?php $mensajes->fields[2] ?></th>
                        <td>
                            <?php
                                if (isset($mensajes->fields[0])) {
                                    $url_imagen = htmlspecialchars($mensajes->fields[0], ENT_QUOTES, 'UTF-8');
                                    echo '<div class="centrar-imagen">';
                                    echo '<img src="' . $url_imagen . '" alt="' . $url_imagen . '" width="300" height="450"">';
                                    echo '</div>';
                                } else {
                                    echo 'La URL de la imagen no está disponible.';
                                }
                            ?>
                        </td>
                        <td><h1><?php echo $mensajes->fields[1]?></h1></td>
                        <td> 
                          <form action="<?php echo '../controller/ctrfavorito.php?id='.$mensajes->fields[3].' ' ?>" method="post">
                            <button  type="submit" class="btn" style='font-size:24px'><i class="fa fa-times-circle" aria-hidden="true"></i></button>
                          </form>
                        </td>
                        <td><button  type="submit" onclick= "" class="btn" style='font-size:24px'><i class="fa fa-book" aria-hidden="true"></i></button></td>
                    </tr>
                    <?php
                        $mensajes->moveNext();
                    }
                    ?>
                </tbody>
              </form>
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
</body>
</html>

<script>
$(document).ready(function(){
    $.ajax({
      type: "POST",
      url: "../controller/ctrHeader.php?pag=1",
      data: { pag: '1' },
      success: function(data) {
        $('#hea').html(data); // Corregido aquí
      },
      error: function(error) {
        console.error('Error al cargar el encabezado', error);
      }
    })
  });
</script>