jQuery(document).on('submit', '#frmInicioSesion', function (event) {
    event.preventDefault(); 
    jQuery.ajax({
        url: '../controller/ctrInicioSesion.php',
        type: 'POST',
        dataType: 'json',
        data: jQuery(this).serialize(),
        beforeSend: function () {
            // Puedes realizar acciones antes de enviar la solicitud aquí
            jQuery('.botonlg').val('validando...'); // Debes usar jQuery en lugar de $
        }
    })
    .fail(function (resp) {
        console.log(resp.responseText);
    })
    .always(function () {
        console.log("complete");
        window.location.href = "../index.php";
    });
});