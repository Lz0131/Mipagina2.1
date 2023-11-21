<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <script src="https://www.google.com/recaptcha/api.js?render=6LfxkBYpAAAAAKw8osjFZVxMaCsnOWhGYNVo-xXg"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js">
    <script src="../assets/js/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="../assets/css/login.css"> <!--Direccion al css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />

<!--Fontawesome CDN-->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
    integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <script>
  function validarFormulario() {
    grecaptcha.ready(function () {
      grecaptcha.execute('6LfxkBYpAAAAAKw8osjFZVxMaCsnOWhGYNVo-xXg', { action: 'submit' }).then(function (token) {
        var correo = document.getElementById("txtemail").value;
        var password = document.getElementById("txtpassword").value;

        if (correo === "" || password === "") {
          alert("Todos los campos son obligatorios. Por favor, complete todos los campos.");
          return false;
        }

        verificar(token);
      });
    });
  }

  function verificar(token) {
    var formData = $('#frmInicioSesion').serialize();
    formData += '&token=' + token;

    $.ajax({
      type: "POST",
      url: "../controller/ctrInicioSesion.php",
      data: formData,
      success: function (data) {
        window.location.href = "../index.php";
      }
    });
  }

  function onSubmit(token) {
    document.getElementById("recaptchaResponse").value = token;
    document.getElementById("frmInicioSesion").submit();
  }
</script>

</head>
<!--Cuerpo-->
<body>
    <!--Barra de Navegacion Header-->
    <header id = "head">
    </header> 
    <!--Cuadro de inicio de sesion-->
    <div class="container">
        <div class="d-flex justify-content-center h-100">
            <div class="card">
                <div class="card-header">
                    <h3>Iniciar Sesión</h3>
                    <div class="d-flex justify-content-end social_icon">
                        <span><i class="fab fa-facebook-square"></i></span>
                        <span><i class="fab fa-google-plus-square"></i></span>
                        <span><i class="fab fa-twitter-square"></i></span>
                    </div>
                </div>
                <div class="card-body">
                    <form id = "frmInicioSesion"><div id="resAJAX"></div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" id="txtemail" name="txtemail" class="form-control" placeholder="correo">
                            
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" id="txtpassword" name="txtpassword" class="form-control" placeholder="contraseña">
                        </div>
                        <div class="row align-items-center remember">
                            <input type="checkbox">Recuerdame
                        </div>
                        <div class="form-group">
                            <button type="button" onclick="validarFormulario()" class="btn float-right login_btn" id="btnLogin">Iniciar sesión</button>
                            <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center links">
                        No tienes cuenta?<a href="./signup.php">Registrarse</a>
                    </div>
                    <div class="d-flex justify-content-center">
                        <a href="./recover_password.php">Olvidaste tu contraseña?</a>
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