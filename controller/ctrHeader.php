<?php
    session_start();
    
    require_once '../models/conexion.php';
    require_once '../models/usuario.php';
    require_once '../models/favorito.php';
    include_once '../assets/adodb5/adodb.inc.php';
    //echo '0';
    $msjRol = new models_usuario();
    $msjFav = new MensajesModel();

    //echo '1';
    if(isset($_SESSION['id_usuario'])){
        //echo '2';
        $id_usuario = $_SESSION['id_usuario'];
        $numFav = $msjFav->getAllTotalFavoritosnum($id_usuario);
        //echo 'num fav '.$numFav;
        //echo 'id usuario'.$id_usuario;
        //echo 'rol '. $msjRol->getRol($id_usuario);
        //Rol usuario
        if($msjRol->getRol($id_usuario) == 1){
            //echo '4';
            if(isset($_GET['pag'])){
                //echo '5';
                //echo $_GET['pag'];
                //echo $msjFav->getAllTotalFavoritosnum($id_usuario);
                switch($_GET['pag']){
                    case 0: //Pagina de InfoLibros
                        $logo = '../assets/img/logo1.png';
                        $dirIndex = '../index.php';
                        $dirFavorito = './favorito.php';
                        $dirCarrito = './carrito.php';
                        $dirMiscompras = './miscompras.php';
                        $dirMisLibros = './libros.php';
                        $dirPerfil = './perfil.php';
                        $dirCerrarsession = '../controller/logout.php';
                        hea1($logo, $dirIndex, $dirFavorito, $dirCarrito, $dirMiscompras, $dirMisLibros, $dirPerfil, $dirCerrarsession, $numFav);
                        break;
                    case 1: //Pagina Index.php
                        $logo = './assets/img/logo1.png';
                        $dirIndex = './index.php';
                        $dirFavorito = './views/favorito.php';
                        $dirCarrito = './views/carrito.php';
                        $dirMiscompras = './views/miscompras.php';
                        $dirMisLibros = './views/libros.php';
                        $dirPerfil = './views/perfil.php';
                        $dirCerrarsession = './controller/logout.php';
                        hea1($logo, $dirIndex, $dirFavorito, $dirCarrito, $dirMiscompras, $dirMisLibros, $dirPerfil, $dirCerrarsession, $numFav);
                        break;
                    case 2: //Pagina Favoritos
                        $logo = '../assets/img/logo1.png';
                        $dirIndex = '../index.php';
                        $dirFavorito = '#';
                        $dirCarrito = './carrito.php';
                        $dirMiscompras = './miscompras.php';
                        $dirMisLibros = './libros.php';
                        $dirPerfil = './perfil.php';
                        $dirCerrarsession = '../controller/logout.php';
                        hea1($logo, $dirIndex, $dirFavorito, $dirCarrito, $dirMiscompras, $dirMisLibros, $dirPerfil, $dirCerrarsession, $numFav);
                        break;
                    case 3: //Pagina Carrito
                        $logo = '../assets/img/logo1.png';
                        $dirIndex = '../index.php';
                        $dirFavorito = './favorito.php';
                        $dirCarrito = '#';
                        $dirMiscompras = './miscompras.php';
                        $dirMisLibros = './libros.php';
                        $dirPerfil = './perfil.php';
                        $dirCerrarsession = '../controller/logout.php';
                        hea1($logo, $dirIndex, $dirFavorito, $dirCarrito, $dirMiscompras, $dirMisLibros, $dirPerfil, $dirCerrarsession, $numFav);
                        break;
                    case 4: //Pagina MisCompras
                        $logo = '../assets/img/logo1.png';
                        $dirIndex = '../index.php';
                        $dirFavorito = './favorito.php';
                        $dirCarrito = './carrito.php';
                        $dirMiscompras = '#';
                        $dirMisLibros = './libros.php';
                        $dirPerfil = './perfil.php';
                        $dirCerrarsession = '../controller/logout.php';
                        hea1($logo, $dirIndex, $dirFavorito, $dirCarrito, $dirMiscompras, $dirMisLibros, $dirPerfil, $dirCerrarsession, $numFav);
                        break;
                    case 5: //Pagina MisLibros
                        $logo = '../assets/img/logo1.png';
                        $dirIndex = '../index.php';
                        $dirFavorito = './favorito.php';
                        $dirCarrito = './carrito.php';
                        $dirMiscompras = './miscompras.php';
                        $dirMisLibros = '#';
                        $dirPerfil = './perfil.php';
                        $dirCerrarsession = '../controller/logout.php';
                        hea1($logo, $dirIndex, $dirFavorito, $dirCarrito, $dirMiscompras, $dirMisLibros, $dirPerfil, $dirCerrarsession, $numFav);
                        break;
                    case 6: // Perfil
                        $logo = '../assets/img/logo1.png';
                        $dirIndex = './index.php';
                        $dirFavorito = './views/favorito.php';
                        $dirCarrito = './views/carrito.php';
                        $dirMiscompras = './views/miscompras.php';
                        $dirMisLibros = './views/libros.php';
                        $dirPerfil = './views/perfil.php';
                        $dirCerrarsession = './controller/logout.php';
                        hea1($logo, $dirIndex, $dirFavorito, $dirCarrito, $dirMiscompras, $dirMisLibros, $dirPerfil, $dirCerrarsession, $numFav);
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
                    case 0: //Pagina InfoLibros
                        $logo = '../assets/img/logo1.png';
                        $dirIndex = '../index.php';
                        $dirFavorito = './favorito.php';
                        $dirCarrito = './carrito.php';
                        $dirMiscompras = './miscompras.php';
                        $dirMisLibros = './libros.php';
                        $dirPerfil = './perfil.php';
                        $dirCerrarsession = '../controller/logout.php';
                        $dirAddLibro = './views/addLibro.php';
                        hea2($logo, $dirIndex, $dirFavorito, $dirCarrito, $dirMiscompras, $dirMisLibros, $dirPerfil, $dirCerrarsession, $dirAddLibro, $numFav);
                        break;
                    case 1: //Pagina Index.php
                        $logo = './assets/img/logo1.png';
                        $dirIndex = './index.php';
                        $dirFavorito = './views/favorito.php';
                        $dirCarrito = './views/carrito.php';
                        $dirMiscompras = './views/miscompras.php';
                        $dirMisLibros = './views/libros.php';
                        $dirPerfil = './views/perfil.php';
                        $dirCerrarsession = './controller/logout.php';
                        $dirAddLibro = './views/addLibro.php';
                        hea2($logo, $dirIndex, $dirFavorito, $dirCarrito, $dirMiscompras, $dirMisLibros, $dirPerfil, $dirCerrarsession, $dirAddLibro , $numFav);
                        break;
                    case 2: //Pagina Favoritos
                        $logo = '../assets/img/logo1.png';
                        $dirIndex = '../index.php';
                        $dirFavorito = '#';
                        $dirCarrito = './carrito.php';
                        $dirMiscompras = './miscompras.php';
                        $dirMisLibros = './libros.php';
                        $dirPerfil = './perfil.php';
                        $dirCerrarsession = '../controller/logout.php';
                        $dirAddLibro = './views/addLibro.php';
                        hea2($logo, $dirIndex, $dirFavorito, $dirCarrito, $dirMiscompras, $dirMisLibros, $dirPerfil, $dirCerrarsession, $dirAddLibro, $numFav);
                        break;
                    case 3: //Pagina Carrito
                        $logo = '../assets/img/logo1.png';
                        $dirIndex = '../index.php';
                        $dirFavorito = './favorito.php';
                        $dirCarrito = '#';
                        $dirMiscompras = './miscompras.php';
                        $dirMisLibros = './libros.php';
                        $dirPerfil = './perfil.php';
                        $dirCerrarsession = '../controller/logout.php';
                        $dirAddLibro = './views/addLibro.php';
                        hea2($logo, $dirIndex, $dirFavorito, $dirCarrito, $dirMiscompras, $dirMisLibros, $dirPerfil, $dirCerrarsession, $dirAddLibro, $numFav);
                        break;
                    case 4: //Pagina MisCompras
                        $logo = '../assets/img/logo1.png';
                        $dirIndex = '../index.php';
                        $dirFavorito = './favorito.php';
                        $dirCarrito = './carrito.php';
                        $dirMiscompras = '#';
                        $dirMisLibros = './libros.php';
                        $dirPerfil = './perfil.php';
                        $dirCerrarsession = '../controller/logout.php';
                        $dirAddLibro = './views/addLibro.php';
                        hea2($logo, $dirIndex, $dirFavorito, $dirCarrito, $dirMiscompras, $dirMisLibros, $dirPerfil, $dirCerrarsession, $dirAddLibro, $numFav);
                        break;
                    case 5: // Biblioteca de los libros comprados
                        $logo = '../assets/img/logo1.png';
                        $dirIndex = '../index.php';
                        $dirFavorito = './favorito.php';
                        $dirCarrito = './carrito.php';
                        $dirMiscompras = './miscompras.php';
                        $dirMisLibros = '#';
                        $dirPerfil = './perfil.php';
                        $dirCerrarsession = '../controller/logout.php';
                        $dirAddLibro = './addLibro.php';
                        hea2($logo, $dirIndex, $dirFavorito, $dirCarrito, $dirMiscompras, $dirMisLibros, $dirPerfil, $dirCerrarsession, $dirAddLibro, $numFav);
                        break;
                    case 6: // Perfil
                        $logo = '../assets/img/logo1.png';
                        $dirIndex = './index.php';
                        $dirFavorito = './favorito.php';
                        $dirCarrito = './carrito.php';
                        $dirMiscompras = './miscompras.php';
                        $dirMisLibros = './libros.php';
                        $dirPerfil = '#';
                        $dirCerrarsession = './controller/logout.php';
                        $dirAddLibro = './addLibro.php';
                        hea2($logo, $dirIndex, $dirFavorito, $dirCarrito, $dirMiscompras, $dirMisLibros, $dirPerfil, $dirCerrarsession, $dirAddLibro, $numFav);
                        break;
                    case 7: // Añadir un libro
                        $logo = '../assets/img/logo1.png';
                        $dirIndex = './index.php';
                        $dirFavorito = './favorito.php';
                        $dirCarrito = './carrito.php';
                        $dirMiscompras = './miscompras.php';
                        $dirMisLibros = './libros.php';
                        $dirPerfil = './perfil.php';
                        $dirCerrarsession = './controller/logout.php';
                        $dirAddLibro = '#';
                        hea2($logo, $dirIndex, $dirFavorito, $dirCarrito, $dirMiscompras, $dirMisLibros, $dirPerfil, $dirCerrarsession, $dirAddLibro, $numFav);
                        break;
                    default:
                        echo 'entra a default';    
                        heaDefault();
                }
            }
        //Rol Administrador
        }else if($msjRol->getRol($id_usuario) == 3){
            if(isset($_GET['pag'])){
                //echo '5';
                switch($_GET['pag']){
                    case 0: //Pagina Favoritos
                        $logo = '../assets/img/logo1.png';
                        $dirIndex = '../index.php';
                        $dirFavorito = './favorito.php';
                        $dirCarrito = './carrito.php';
                        $dirMiscompras = './miscompras.php';
                        $dirMisLibros = './libros.php';
                        $dirPerfil = './perfil.php';
                        $dirCerrarsession = '../controller/logout.php';
                        $dirComentarios = './comentarios.php';
                        hea3($logo, $dirIndex, $dirFavorito, $dirCarrito, $dirMiscompras, $dirMisLibros, $dirPerfil, $dirCerrarsession, $dirComentarios, $numFav);
                        break;
                    case 1: //Pagina Index.php
                        $logo = './assets/img/logo1.png';
                        $dirIndex = './index.php';
                        $dirFavorito = './views/favorito.php';
                        $dirCarrito = './views/carrito.php';
                        $dirMiscompras = './views/miscompras.php';
                        $dirMisLibros = './views/libros.php';
                        $dirPerfil = './views/perfil.php';
                        $dirCerrarsession = './controller/logout.php';
                        $dirComentarios = './comentarios.php';
                        hea3($logo, $dirIndex, $dirFavorito, $dirCarrito, $dirMiscompras, $dirMisLibros, $dirPerfil, $dirCerrarsession, $dirComentarios, $numFav);
                        break;
                    case 2: //Pagina Favoritos
                        $logo = '../assets/img/logo1.png';
                        $dirIndex = '../index.php';
                        $dirFavorito = '#';
                        $dirCarrito = './carrito.php';
                        $dirMiscompras = './miscompras.php';
                        $dirMisLibros = './libros.php';
                        $dirPerfil = './perfil.php';
                        $dirCerrarsession = '../controller/logout.php';
                        $dirComentarios = './comentarios.php';
                        hea3($logo, $dirIndex, $dirFavorito, $dirCarrito, $dirMiscompras, $dirMisLibros, $dirPerfil, $dirCerrarsession, $dirComentarios, $numFav);
                        break;
                    case 3: //Pagina Carrito
                        $logo = '../assets/img/logo1.png';
                        $dirIndex = '../index.php';
                        $dirFavorito = './favorito.php';
                        $dirCarrito = '#';
                        $dirMiscompras = './miscompras.php';
                        $dirMisLibros = './libros.php';
                        $dirPerfil = './perfil.php';
                        $dirCerrarsession = '../controller/logout.php';
                        $dirComentarios = './comentarios.php';
                        hea3($logo, $dirIndex, $dirFavorito, $dirCarrito, $dirMiscompras, $dirMisLibros, $dirPerfil, $dirCerrarsession, $dirComentarios, $numFav);
                        break;
                    case 4: //Pagina MisCompras
                        $logo = '../assets/img/logo1.png';
                        $dirIndex = '../index.php';
                        $dirFavorito = './favorito.php';
                        $dirCarrito = './carrito.php';
                        $dirMiscompras = '#';
                        $dirMisLibros = './libros.php';
                        $dirPerfil = './perfil.php';
                        $dirCerrarsession = '../controller/logout.php';
                        $dirComentarios = './comentarios.php';
                        hea3($logo, $dirIndex, $dirFavorito, $dirCarrito, $dirMiscompras, $dirMisLibros, $dirPerfil, $dirCerrarsession, $dirComentarios, $numFav);
                        break;
                    case 5: //Pagina MisLibros
                        $logo = '../assets/img/logo1.png';
                        $dirIndex = '../index.php';
                        $dirFavorito = './favorito.php';
                        $dirCarrito = './carrito.php';
                        $dirMiscompras = './miscompras.php';
                        $dirMisLibros = '#';
                        $dirPerfil = './perfil.php';
                        $dirCerrarsession = '../controller/logout.php';
                        $dirComentarios = './comentarios.php';
                        hea3($logo, $dirIndex, $dirFavorito, $dirCarrito, $dirMiscompras, $dirMisLibros, $dirPerfil, $dirCerrarsession, $dirComentarios, $numFav);
                        break;
                    case 6: // Perfil
                        $logo = '../assets/img/logo1.png';
                        $dirIndex = './index.php';
                        $dirFavorito = './favorito.php';
                        $dirCarrito = './carrito.php';
                        $dirMiscompras = './miscompras.php';
                        $dirMisLibros = './libros.php';
                        $dirPerfil = '#';
                        $dirCerrarsession = './controller/logout.php';
                        $dirComentarios = './comentarios.php';
                        hea3($logo, $dirIndex, $dirFavorito, $dirCarrito, $dirMiscompras, $dirMisLibros, $dirPerfil, $dirCerrarsession, $dirComentarios, $numFav);
                        break;
                    case 7: // Ver los comentarios dejados
                        $logo = '../assets/img/logo1.png';
                        $dirIndex = './index.php';
                        $dirFavorito = './favorito.php';
                        $dirCarrito = './carrito.php';
                        $dirMiscompras = './miscompras.php';
                        $dirMisLibros = './libros.php';
                        $dirPerfil = './perfil.php';
                        $dirCerrarsession = './controller/logout.php';
                        $dirComentarios = '#';
                        hea3($logo, $dirIndex, $dirFavorito, $dirCarrito, $dirMiscompras, $dirMisLibros, $dirPerfil, $dirCerrarsession, $dirComentarios, $numFav);
                        break;
                    default:
                        echo 'entra a default';    
                        heaDefault();
                }
            }
        }
    }else{
        if(isset($_GET['pag'])){
            //echo '5';
            switch($_GET['pag']){
                case 1 :
                    heaDefault1();
                    break;
                case 6:
                    heaDefault2();
                    break;
            }
        }
    }
    function hea1($logo, $dirIndex, $dirFavorito, $dirCarrito, $dirMiscompras, $dirMisLibros, $dirPerfil, $dirCerrarsession, $numFav){
        $h1 = '
        <nav class="navbar navbar-icon-top navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="'.$dirIndex.'"><img height="100" src="" alt=""> <img src="'.$logo.'" alt="" width="80" height="60"> </a>
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
                            <span class="badge badge-danger">'.$numFav.'</span>
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
                        Biblioteca
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

    function hea2($logo, $dirIndex, $dirFavorito, $dirCarrito, $dirMiscompras, $dirMisLibros, $dirPerfil, $dirCerrarsession, $dirAddLibro, $numFav){
        $h2 = '
        <nav class="navbar navbar-icon-top navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="'.$dirIndex.'"><img height="100" src="" alt=""> <img src="'.$logo.'" alt="" width="80" height="60"> </a>
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
                            <span class="badge badge-danger">'.$numFav.'</span>
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
                        Biblioteca
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="'.$dirAddLibro.'">
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
                            <a class="dropdown-item" href="'.$dirPerfil.'">Perfil</a> <!--Perfil-->
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
        echo $h2;
        return $h2;
    }
    function heaDefault1(){
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

    function heaDefault2(){
        $hDefault2 = '
        <nav class="navbar navbar-icon-top navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="../index.php"><img height="100" src="" alt=""> <img src="../assets/img/logo1.png" alt="" width="80" height="60"> </a>
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
                            <a class="dropdown-item" href="./login.php">Iniciar Sesión</a> <!--Esta se deberia ocultar cuando se inicie sesión-->
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
        echo $hDefault2;
        return $hDefault2;
    }

    function hea3($logo, $dirIndex, $dirFavorito, $dirCarrito, $dirMiscompras, $dirMisLibros, $dirPerfil, $dirCerrarsession, $dirComentarios, $numFav){
        $h1 = '
        <nav class="navbar navbar-icon-top navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="'.$dirIndex.'"><img height="100" src="" alt=""> <img src="'.$logo.'" alt="" width="80" height="60"> </a>
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
                            <span class="badge badge-danger">'.$numFav.'</span>
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
                        Biblioteca
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="'.$dirComentarios.'">
                        <i class="fa fa-bookmark" aria-hidden="true">
                            <span class="badge badge-danger">11</span>
                        </i>
                        Ver comentarios
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
?>