<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="../assets/js/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="../assets/css/carrito.css"> <!--Direccion al css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <script
        src="https://www.paypal.com/sdk/js?client-id=AVjULdeLKQFjuZoDsgYmHJO0fUbeAfBbtcdzK2C5V3OQIohAgpGf0Me0RLHvvugvHyHNXubF4d0GlsKD&currency=MXN">
    </script>
  <!--Fontawesome CDN-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
    integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>
<!--Cuerpo-->
<body>
  <!--Barra de Navegacion Header-->
  <header  id = "head"></header> 
  <!--Cuadro de favoritos-->
  <main>
    <div class="carrito container">
      <h1>Carrito</h1>
      <div id = "divCarrito"></div>
      <div class="container-carrito">
</div>
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
  var total;
  var id;
$(document).ready(function(){
    h();
    carrito();
    
  })
  function carrito(){
    $.ajax({
      type: "POST",
      url: "../controller/ctrAllCarrito.php",
      data: {},
      success: function(data) {
        $('#divCarrito').html(data);
        valida();
      },
      error: function(error) {
        console.error('Error al cargar el encabezado', error);
      }
    })
  }
  function h(){
    $.ajax({
      type: "POST",
      url: "../controller/ctrHeader.php?pag=3",
      data: { pag: '3' },
      success: function(data) {
        $('#head').html(data);
      },
      error: function(error) {
        console.error('Error al cargar el encabezado', error);
      }
    })
  }  
  function valida(){
    var Campototal =document.getElementById("total");
    //alert(Campototal);
    total = Campototal.value;
    //alert(total);
    if(total !== 0 ){
      //alert(total);
      //alert("diferente de 0");
      cargaPaypal();
    }else{
      alert("No hay libros en el carrito");
    }

  }

  function cargaPaypal(){
    paypal.Buttons({
        style: {
            color: 'blue',
            shape: 'pill',
            label: 'pay'
        },
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: total.toString() // Make sure to use a string for the value
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            actions.order.capture().then(function(details) {
                // Extract values from the details object
                var purchaseUnit = details.purchase_units[0];
                var amount = purchaseUnit.amount.value;
                var currencyCode = purchaseUnit.amount.currency_code;
                var estado = details.status;
                id = details.id;
                // Log or use the extracted values
                console.log(details);
                console.log("Amount:", amount);
                console.log("Currency Code:", currencyCode);
                console.log("estado:", estado);
                console.log("id", id);
                venta(id);

            });
        },
        // Payment canceled
        onCancel: function(data) {
            alert('Payment canceled');
            console.log(data);
        }
    }).render('#paypal-button-container');
  }  
function venta(id) {
  window.location.href = "./venta.php?id=" + id;
}   
</script>