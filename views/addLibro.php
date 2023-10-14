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
    <link rel="stylesheet" src="https://code.jquery.com/jquery-3.3.1.slim.min.js">
    <link rel="stylesheet" href="../assets/css/infoLib.css"> <!--Direccion al css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    
<!--Fontawesome CDN-->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
    integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">


</head>
<!--Cuerpo-->
<body>
    <!--Barra de Navegacion Header-->
    <header>
        <nav class="navbar navbar-icon-top navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="../index.php"><img height="100" src="" alt=""> <img src="../assets/img/logo1.png" alt="" width="80" height="60"> </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="../index.php">
                            <i class="fa fa-home"></i>
                            Inicio
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./siguiendo.php">
                          <i class="fa fa-book">
                            <span class="badge badge-danger">11</span>
                          </i>
                          Historial
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./favorito.php">
                          <i class="fa fa-heart">
                            <span class="badge badge-danger">11</span>
                          </i>
                          Favoritos
                        </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="./favorito.php">
                        <i class="fa fa-shopping-cart" aria-hidden="true">
                          <span class="badge badge-danger"><?php echo $mensajes2->fields[0] ?></span>
                        </i>
                        Carrito
                      </a>
                    </li>
                    <li class="nav-item dropdown">
                      <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fa fa-user-circle" aria-hidden="true"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                          <a class="dropdown-item" href="./login.php">Iniciar Sesión</a> <!--Esta se deberia ocultar cuando se inicie sesión-->
                          <a class="dropdown-item" href="./signup.php">Registrarse</a> <!--esta debe de estar visible asta que se inicie sesion-->
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item disabled" href="#">Salir</a> <!--esta debe de estar oculta asta que se inicie sesion-->
                      </div>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Buscador">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                </form>
            </div>
        </nav>
    </header> 
    <!--Cuadro de informacion del libro-->
    <main>
        <div class="addlibro container">
            <form id="frmaddlibro" method = "post">
                <input type="hidden" id="hddId" name="hddId">
                <div class="form-group">
                    <label for="SelectAutor">Autor</label>
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
                    <label for="datefecha">fecha</label>
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
                    <textarea name="txtRerena" id="txtResena" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="imgPortada"></label>
                    <input type="file" id="imgPortada" name="imgPortada" accept="image/*" class="form-control">
                </div>
                <div class="form-group">
                    <label for="Selecteditorial">Editorial</label>
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
                <div class="form-group">
                    <label for="SelectEstatus">Categoria</label>
                    <select name="selectEstatus" id="selectEstatus" class="form-control">
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
            </form>
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