<?php
    require_once './models/carrito.php';
    require_once './models/conexion.php';
    include_once './assets/adodb5/adodb.inc.php';
    $numModel = new MensajesModelCarrito();
    $id_usuario = 1;
    $mensajes2 = $numModel->getAllCarritonum($id_usuario);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link rel="stylesheet" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js">
  <link rel="stylesheet" src="https://code.jquery.com/jquery-3.3.1.slim.min.js">
  <link rel="stylesheet" href="./assets/css/styles.css"> <!--Direccion al css-->
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
            <a class="navbar-brand" href="./index.php"><img height="100" src="" alt=""> <img src="./assets/img/logo1.png" alt="" width="80" height="60"> </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="./index.php">
                            <i class="fa fa-home"></i>
                            Inicio
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./views/favorito.php">
                          <i class="fa fa-book">
                            <span class="badge badge-danger">11</span>
                          </i>
                          Historial
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./views/favorito.php">
                          <i class="fa fa-heart">
                            <span class="badge badge-danger">11</span>
                          </i>
                          Favoritos
                        </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="./views/carrito.php">
                        <i class="fa fa-shopping-cart" aria-hidden="true">
                          <span class="badge badge-danger"><?php echo $mensajes2->fields[0] ?></span>
                        </i>
                        Carrito
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="./views/addLibro.php">
                        <i class="fa fa-shopping-cart" aria-hidden="true">
                        </i>
                        Add Libros
                      </a>
                    </li>
                    <li class="nav-item dropdown">
                      <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        
                          <i class="fa fa-user-circle" aria-hidden="true"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                          <a class="dropdown-item" href="./views/login.php">Iniciar Sesión</a> <!--Esta se deberia ocultar cuando se inicie sesión-->
                          <a class="dropdown-item" href="./signup.html">Registrarse</a> <!--esta debe de estar visible asta que se inicie sesion-->
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
    <!--Carrusel-->
    <div class="banner">
        <!-- Carrusel de Novelas-->
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img width="1920" height="883" src="./assets/img/ReturnMH.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img width="1920" height="883" src="./assets/img/ORV.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img width="1920" height="883" src="./assets/img/TCF.jpeg" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-target="#carouselExampleIndicators"
                data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-target="#carouselExampleIndicators"
                data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </button>
        </div>
    </div>
    <!--carrusel 2-->
    <div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel">
      <div class="carousel-inner">
          <div class="carousel-item active">
              <div class="mask flex-center">
                  <div class="container">
                      <div class="row align-items-center">
                          <div class="col-md-7 col-12 order-md-1 order-2">
                              <h4>OVR <br>
                                  Lector Omnisciente</h4>
                              <p>¿Qué arias si la novela que estas leyendo se vuelve realidad?<br>
                                  ¿Comó sobrevirias en un mundo en ruinas?</p>
                              <a href="./views/infoLib.php?opc=1">Ver información</a>
                          </div>
                          <div class="col-md-5 col-12 order-md-2 order-1"><img width="300" height="450" src="./assets/img/portadalo.jpg"
                                  class="mx-auto" alt="slide"></div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="carousel-item">
              <div class="mask flex-center">
                  <div class="container">
                      <div class="row align-items-center">
                          <div class="col-md-7 col-12 order-md-1 order-2">
                              <h4>TCF <br>
                                  La basura de la familia del conde</h4>
                              <p>¿Qué harias si despertaras como un personaje basura? <br>
                                  ¿Como sobrevivirias sin involucrarte?</p>
                                  <a href="./views/infoLib.php?opc=2">Ver información</a>
                          </div>
                          <div class="col-md-5 col-12 order-md-2 order-1"><img width="300" height="450" src="./assets/img/portadatcf.webp"
                                  class="mx-auto" alt="slide"></div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="carousel-item">
              <div class="mask flex-center">
                  <div class="container">
                      <div class="row align-items-center">
                          <div class="col-md-7 col-12 order-md-1 order-2">
                              <h4>RMH <br>
                                  El Retorno del Monte Hua</h4>
                              <p>¿Que harias si despertaras y ves que tu hogar que una vez existio ahora no existe?
                                  <br>
                                  Todo por lo que luchaste, no valio la pena y es tu responsabilidad</p>
                                  <a href="./views/infoLib.php?opc=3">Ver información</a>
                          </div>
                          <div class="col-md-5 col-12 order-md-2 order-1"><img width="300" height="450" src="./assets/img/portadarh.jpg"
                                  class="mx-auto" alt="slide"></div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev"> <span
              class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a>
      <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next"> <span
              class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a>
  </div>
    <!--Pie de Pagina Footer--> 
    <footer class="section footer-classic context-dark bg-image" style="background:black;">
        <div class="containe">
          <div class="row row-30">
            <div class="col-md-4 col-xl-5">
              <div class="pr-xl-4"><a class="brand" href="./index.html"><img class="brand-logo-light" src="./assets/img/logo1.png" alt="" width="100" height="80" srcset="./assets/img/logo1.png 2x"></a>
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