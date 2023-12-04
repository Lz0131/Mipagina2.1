jQuery(document).on('submit', '#frmRegistro', function (event) {
    event.preventDefault();

    // Verificar el captcha antes de continuar
    var response = grecaptcha.getResponse();

    if (!response) {
        response = 'completa el captcha';
        // El captcha no se completó
        alert('Por favor, complete el captcha.');
        jQuery('#error').html(response);
        jQuery('#error').slideDown('slow');
        setTimeout(function () {
            jQuery('#error').slideUp('slow');
        }, 3000);
        return;
    }
    var nombre = document.getElementById("nombre").value;
    var ape_paterno = document.getElementById("apellido_p").value;
    var ape_materno = document.getElementById("apellido_m").value;
    var correo = document.getElementById("email").value;
    var password = document.getElementById("contrasena").value;
    var numero_casa = document.getElementById("num_casa").value;
    var caracteristicas = document.getElementById("caracteristicas").value;
    var latitud = document.getElementById("latitud").value;
    var longitud = document.getElementById("longitud").value;
    var selectElement = document.getElementById("id_ciudad");
    var selectedValue = selectElement.value;
    //alert(selectedValue);
    //alert(latitud);
    //alert(longitud);
    // Verificar que todos los campos estén llenos
    if (nombre === "" || ape_paterno === "" || ape_materno === "" || correo === "" || password === "" || calle === "" || numero_casa === "" || caracteristicas === "" || latitud === "" || longitud === "") {
        alert("Todos los campos son obligatorios. Por favor, complete todos los campos.");
        return false; // Evita que se llame a la función insertar()
    }else{
        // Continúa con el envío del formulario si el captcha se completó
    jQuery.ajax({
        url: '../controller/ctrRegistro.php',
        type: 'POST',
        dataType: 'json',
        data: jQuery(this).serialize(),
        beforeSend: function () {
            // jQuery('.botonlg').val('Validando...');
        }
    })
        .done(function (respuesta) {
            if (respuesta.success) {
                alert("Registro exitoso");
                window.location.href = '../index.php'

            } else {
                alert('correo duplicado');
            }
        })

        .fail(function (resp) {
            alert(resp.responseText);
            console.log(resp.responseText);
        })
        .always(function () {
            console.log('Complete');

        });
    }
    
});