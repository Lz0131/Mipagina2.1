<?php
session_start();

// Cierra la sesión
session_destroy();

// Redirige al usuario a la página de inicio de sesión u otra página deseada
header("Location: ../index.php");
exit;
?>