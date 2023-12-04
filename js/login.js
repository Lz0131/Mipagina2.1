jQuery(document).on('submit', '#frmInicioSesion', function (event) {
    
    event.preventDefault(); 
    jQuery.ajax({
        url: '../controller/ctrInicioSesion.php',
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
            alert(respuesta.message)
            window.location.href = "../index.php";
        }else{
            alert(respuesta.message)
        }
    })
    .fail(function (respuesta) {
        alert(respuesta.responseText);
        console.log(respuesta.responseText);
    })

});