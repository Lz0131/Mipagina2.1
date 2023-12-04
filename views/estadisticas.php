<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Libros mas vendidos</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link rel="stylesheet" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js">
        <script src="../assets/js/jquery-3.7.1.min.js"></script>
        <link rel="stylesheet" href="../assets/css/carrito.css"> <!--Direccion al css-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    </head>
    <body>
        <!--Header-->
        <header id="head"></header>
        <main>
          <div id="calendario_rango">
          <label for="fecha_inicial">Fecha Inicial:</label>
          <input type="text" id="fecha_inicial" name="fecha_inicial">
          <label for="fecha_final">Fecha Final:</label>
          <input type="text" id="fecha_final" name="fecha_final">
          </div>
          <div>
            <button class="btn" type="button" onclick="obtenerFechas()">Dibujar gráfica</button>
          </div>
          <div id = "Grafica"></div>
        </main>
        
        <!--Contenido-->
        
        <!--Pie de Pagina-->
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
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <script>
    $(function() {
    $("#fecha_inicial, #fecha_final").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true,
        onSelect: function(selectedDate) {
            var option = this.id === "fecha_inicial" ? "minDate" : "maxDate",
                instance = $(this).data("datepicker"),
                date = $.datepicker.parseDate(
                    instance.settings.dateFormat || $.datepicker._defaults.dateFormat,
                    selectedDate,
                    instance.settings
                );
            $("#fecha_inicial, #fecha_final")
                .not(this)
                .datepicker("option", option, date);
        }
    });
});

function obtenerFechas() {
    var fechaInicial = $("#fecha_inicial").datepicker("getDate");
    var fechaFinal = $("#fecha_final").datepicker("getDate");

    // Convertir las fechas al formato yyyy-mm-dd
    var fechaInicialFormato = $.datepicker.formatDate("yy-mm-dd", fechaInicial);
    var fechaFinalFormato = $.datepicker.formatDate("yy-mm-dd", fechaFinal);

    if (fechaInicial && fechaFinal) {
        console.log("Fecha Inicial:", fechaInicialFormato);
        console.log("Fecha Final:", fechaFinalFormato);

        $.ajax({
            url: '../controller/ctrGrafica.php',
            type: 'POST',
            data: { fechaInicial: fechaInicialFormato, fechaFinal: fechaFinalFormato },
            dataType: 'json',
            success: function (data) {
                dibujargraficas(data);
            },
            error: function (error) {
                console.error('Error al procesar la petición AJAX', error);
            }
        });
    } else {
        console.log("Selecciona un rango de fechas válido.");
    }
}


  </script>
    </body>
</html>
<script> 
    $(document).ready(function(){
      verificar();
      h();
    })

    function dibujargraficas(data) {
    google.charts.load('current', { 'packages': ['corechart'] });
    google.charts.setOnLoadCallback(function () {
        var chartData = new google.visualization.DataTable();
        chartData.addColumn('string', 'libro');
        chartData.addColumn('number', 'total_ventas');

        for (var i = 0; i < data.length; i++) {
            chartData.addRow([data[i].nombre, parseInt(data[i].total_ventas)]);
        }

        var options = {
            chart: {
                title: 'Libros vendidos en el periodo de tiempo',
                subtitle: 'Libro',
            }
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('Grafica'));
        chart.draw(chartData, options);
    });
}

  function verificar(){
    jQuery.ajax({
        url: '../controller/ctrRol.php?opc=1',
        type: 'POST',
        dataType: 'json',
        data: jQuery(this).serialize(),
        beforeSend: function () {
            // Puedes realizar acciones antes de enviar la solicitud aquí
            //jQuery('.botonlg').val('validando...'); // Debes usar jQuery en lugar de $
        }
    })
    .done(function (respuesta) {
        if (respuesta.success) {
            //alert(respuesta.message)
        }else{
            alert(respuesta.message)
            window.location.href = "../index.php";
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
</script>