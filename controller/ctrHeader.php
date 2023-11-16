<?php
    session_start();
    
    require_once '../models/conexion.php';
    require_once '../models/usuario.php';
    include_once '../assets/adodb5/adodb.inc.php';
    echo '0';
    $msjRol = new models_usuario();
    echo '1';
    if(isset($_SESSION['id_usuario'])){
        echo '2';
        $id_usuario = $_SESSION['id_usuario'];
        echo '3';
        echo $id_usuario;
        echo $msjRol->getRol($id_usuario);
        //Rol usuario
        if($msjRol->getRol($id_usuario) == 1){
            echo '4';
            if(isset($_GET['pag'])){
                echo '5';
                echo $_GET['pag'];
                switch($_GET['pag']){
                    
                    case 1: //Pagina Index.php
                        $dirIndex = './index.php';
                        $dirFavorito = './views/favorito.php';
                        $dirCarrito = './views/carrito.php';
                        $dirMiscompras = './views/miscompras.php';
                        $dirMisLibros = './views/libros.php';
                        $dirPerfil = './views/perfil.php';
                        $dirCerrarsession = './controller/logout.php';
                        hea1($dirIndex, $dirFavorito, $dirCarrito, $dirMiscompras, $dirMisLibros, $dirPerfil, $dirCerrarsession);
                        break;
                    case 2: //Pagina Favoritos
                        $dirIndex = '../index.php';
                        $dirFavorito = '#';
                        $dirCarrito = './carrito.php';
                        $dirMiscompras = './miscompras.php';
                        $dirMisLibros = './libros.php';
                        $dirPerfil = './perfil.php';
                        $dirCerrarsession = '../controller/logout.php';
                        hea1($dirIndex, $dirFavorito, $dirCarrito, $dirMiscompras, $dirMisLibros, $dirPerfil, $dirCerrarsession);
                        break;
                    case 3: //Pagina Carrito
                        $dirIndex = '../index.php';
                        $dirFavorito = './favorito.php';
                        $dirCarrito = '#';
                        $dirMiscompras = './miscompras.php';
                        $dirMisLibros = './libros.php';
                        $dirPerfil = './perfil.php';
                        $dirCerrarsession = '../controller/logout.php';
                        hea1($dirIndex, $dirFavorito, $dirCarrito, $dirMiscompras, $dirMisLibros, $dirPerfil, $dirCerrarsession);
                        break;
                    case 4: //Pagina MisCompras
                        $dirIndex = '../index.php';
                        $dirFavorito = './favorito.php';
                        $dirCarrito = './carrito.php';
                        $dirMiscompras = '#';
                        $dirMisLibros = './libros.php';
                        $dirPerfil = './perfil.php';
                        $dirCerrarsession = '../controller/logout.php';
                        hea1($dirIndex, $dirFavorito, $dirCarrito, $dirMiscompras, $dirMisLibros, $dirPerfil, $dirCerrarsession);
                        break;
                    case 5: //Pagina MisLibros
                        $dirIndex = '../index.php';
                        $dirFavorito = './favorito.php';
                        $dirCarrito = './carrito.php';
                        $dirMiscompras = './miscompras.php';
                        $dirMisLibros = '#';
                        $dirPerfil = './perfil.php';
                        $dirCerrarsession = '../controller/logout.php';
                        hea1($dirIndex, $dirFavorito, $dirCarrito, $dirMiscompras, $dirMisLibros, $dirPerfil, $dirCerrarsession);
                        break;
                    case 6:
                        $dirIndex = './index.php';
                        $dirFavorito = './views/favorito.php';
                        $dirCarrito = './views/carrito.php';
                        $dirMiscompras = './views/miscompras.php';
                        $dirMisLibros = './views/libros.php';
                        $dirPerfil = './views/perfil.php';
                        $dirCerrarsession = './controller/logout.php';
                        hea1($dirIndex, $dirFavorito, $dirCarrito, $dirMiscompras, $dirMisLibros, $dirPerfil, $dirCerrarsession);
                        break;
                    default:
                        echo 'entra a default';    
                        heaDefault();
                }
            }
        //Rol Escritor
        }else if($msjRol->getRol($id_usuario) == 2){
            if(isset($_GET['pag'])){
                echo '5';
                switch($_GET['pag']){
                    case 1:
                        echo 'entra usuario normal';
                        hea2();
                        break;
                    case 2: 
                        echo 'entra usuario escritor';
                        hea2();
                        break;
                    default:
                        echo 'entra a default';    
                        heaDefault();
                }
            }
        //Rol Administrador
        }else if($msjRol->getRol($id_usuario) == 3){
            if(isset($_GET['pag'])){
                echo '5';
                switch($_GET['pag']){
                    case 1:
                        echo 'entra usuario normal';
                        hea1();
                        break;
                    case 2: 
                        echo 'entra usuario escritor';
                        hea2();
                        break;
                    default:
                        echo 'entra a default';    
                        heaDefault();
                }
            }
        }
    }else{
        echo 'Sin inicio de sesion';
        heaDefault();
    }
    function hea1($dirIndex, $dirFavorito, $dirCarrito, $dirMiscompras, $dirMisLibros, $dirPerfil, $dirCerrarsession){
        $h1 = '
        <nav class="navbar navbar-icon-top navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="'.$dirIndex.'"><img height="100" src="" alt=""> <img src="./assets/img/logo1.png" alt="" width="80" height="60"> </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="'.$dirIndex.'">
                            <i class="fa fa-home"></i>
                            Inicio
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="'.$dirFavorito.'">
                            <i class="fa fa-book">
                            <span class="badge badge-danger">11</span>
                            </i>
                            Historial
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="'.$dirFavorito.'">
                            <i class="fa fa-heart">
                            <span class="badge badge-danger">11</span>
                            </i>
                            Favoritos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="'.$dirCarrito.'">
                        <i class="fa fa-shopping-cart" aria-hidden="true">
                            <span class="badge badge-danger">11</span>
                        </i>
                        Carrito
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="'.$dirMiscompras.'">
                        <i class="fa fa-bookmark" aria-hidden="true">
                            <span class="badge badge-danger">11</span>
                        </i>
                        Mis compras
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="'.$dirMisLibros.'">
                        <i class="fa fa-bookmark" aria-hidden="true">
                            <span class="badge badge-danger">11</span>
                        </i>
                        Libros
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        
                            <i class="fa fa-user-circle" aria-hidden="true"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                            <a class="dropdown-item" href="'.$dirPerfil.'">Perfil</a> <!--Esta se deberia ocultar cuando se inicie sesión-->
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="'.$dirCerrarsession.'">Salir</a> <!--esta debe de estar oculta asta que se inicie sesion-->
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
        </nav>';
        echo $h1;
        return $h1;
    }

    function hea2(){
        $h2 = '
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
                        <a class="nav-link disabled" href="./views/favorito.php">
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
                            <span class="badge badge-danger">11</span>
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
                    <li class="nav-item">
                        <a class="nav-link" href="./views/carrito.php">
                        <i class="fa fa-bookmark" aria-hidden="true">
                            <span class="badge badge-danger">11</span>
                        </i>
                        Mis compras
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./views/carrito.php">
                        <i class="fa fa-bookmark" aria-hidden="true">
                            <span class="badge badge-danger">11</span>
                        </i>
                        Libros
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./views/carrito.php">
                        <i class="fa fa-bookmark" aria-hidden="true">
                            <span class="badge badge-danger">11</span>
                        </i>
                        Mis Libros
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        
                            <i class="fa fa-user-circle" aria-hidden="true"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                            <a class="dropdown-item" href="./views/login.php">Iniciar Sesión</a> <!--Esta se deberia ocultar cuando se inicie sesión-->
                            <a class="dropdown-item" href="./signup.php">Registrarse</a> <!--esta debe de estar visible asta que se inicie sesion-->
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="./controller/logout.php">Salir</a> <!--esta debe de estar oculta asta que se inicie sesion-->
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
        </nav>';
        echo $h2;
        return $h2;
    }
    function heaDefault(){
        $hDefault = '
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
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        
                            <i class="fa fa-user-circle" aria-hidden="true"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                            <a class="dropdown-item" href="./views/login.php">Iniciar Sesión</a> <!--Esta se deberia ocultar cuando se inicie sesión-->
                            <a class="dropdown-item" href="./signup.php">Registrarse</a> <!--esta debe de estar visible asta que se inicie sesion-->
                            <div class="dropdown-divider"></div>
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
        </nav>';
        echo $hDefault;
        return $hDefault;
    }
?>