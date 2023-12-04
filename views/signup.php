<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js">
    <script src="../assets/js/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="../assets/css/signup.css"> <!--Direccion al css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />

<!--Fontawesome CDN-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
    integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

  <script>
    function validarFormulario() {
        // Obtener los valores de los campos
        var nombre = document.getElementById("nombre").value;
        var ape_paterno = document.getElementById("apellido_p").value;
        var ape_materno = document.getElementById("apellido_m").value;
        var correo = document.getElementById("email").value;
        var password = document.getElementById("contrasena").value;
        var numero_casa = document.getElementById("numero_casa").value;
        var caracteristicas = document.getElementById("caracteristicas").value;
        var latitud = document.getElementById("latitud").value;
        var longitud = document.getElementById("longitud").value;
        alert(longitud);
        // Verificar que todos los campos estén llenos
        if (nombre === "" || ape_paterno === "" || ape_materno === "" || correo === "" || password === "" || calle === "" || numero_casa === "" || caracteristicas === "" || latitud === "" || longitud === "") {
            alert("Todos los campos son obligatorios. Por favor, complete todos los campos.");
            return false; // Evita que se llame a la función insertar()
        }
        // Si todos los campos están llenos, llamar a la función insertar()
        insertar();
    }

    function insertar(){
      var formData = $('#frmRegistro').serialize();
        $.ajax({
            type: "POST",
            url: "../controller/ctrRegistro.php",
            data: formData,
            success: function(data){
              $('#resAJAX').html(data);
              window.location.href = '../index.php';
            }
        });
    }
    function mostrarAlerta() {
            alert("La cuenta ya existe");
        }
  </script>
  </head>
<!--Cuerpo-->
<body>
    <!--Barra de Navegacion Header-->
    <header id = "head">
    </header> 
    <!--Cuadro de Registro-->
    <div class="container">
        <div class="d-flex justify-content-center h-100">
            <div class="card">
                <div class="card-header">
                    <h3>Registrarse</h3>
                    <div class="d-flex justify-content-end social_icon">
                        <span><i class="fab fa-facebook-square"></i></span>
                        <span><i class="fab fa-google-plus-square"></i></span>
                        <span><i class="fab fa-twitter-square"></i></span>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post"  id = "frmRegistro"><div id="resAJAX"></div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre">
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" id="apellido_p" name="apellido_p" class="form-control" placeholder="Apellido paterno">
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" id="apellido_m" name="apellido_m" class="form-control" placeholder="Apellido materno">
                        </div>
                        <div class= "form-group">
                          <div class="input-group form-group">
                              <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fas fa-globe"></i></span>
                              </div>
                              <select class="form-control" name="id_ciudad" id="id_ciudad">
                                <option value="1">Leon</option>
                                <option value="2">Guanajuato</option>
                                <option value="3">Irapuato</option>
                                <option value="4">Celaya</option>
                                
                              </select>
                          </div>
                        </div>
                        <div class="input-group form-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                          </div>
                          <input type="text" id="calle" name="calle" class="form-control" placeholder="Calle">
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-home"></i></span>
                            </div>
                            <input type="text" id="num_casa" name="num_casa" class="form-control" placeholder="Número de casa">
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-info-circle"></i></span>
                            </div>
                            <input type="text" id="caracteristicas" name="caracteristicas" class="form-control" placeholder="Características">
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-map-marker"></i></span>
                            </div>
                            <input type="number" id="latitud" name="latitud" class="form-control" placeholder="Latitud" step="any">
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-map-marker"></i></span>
                            </div>
                            <input type="number" id="longitud" name="longitud" class="form-control" placeholder="Longitud" step="any">
                        </div>
                        
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="text" id="email" name="email" class="form-control" placeholder="Correo">
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" id="contrasena" name="contrasena" class="form-control" placeholder="Contraseña">
                        </div>
                        <div class="form-group">
                            <div class="g-recaptcha" data-sitekey="6LfXi_8oAAAAAGeCsTaetGmZa-52MYSjUG9Y7km2"></div>
                            <button type="submit" class="btn float-right login_btn">Registrarse</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center links">
                        Tienes cuenta?<a href="./login.php">Inciar Sesión</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
      <script src="../js/registro.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>
<script>
$(document).ready(function(){
    $.ajax({
      type: "POST",
      url: "../controller/ctrHeader.php?pag=6",
      data: { pag: '6' },
      success: function(data) {
        $('#head').html(data); // Corregido aquí
      },
      error: function(error) {
        console.error('Error al cargar el encabezado', error);
      }
    })
  });
</script>