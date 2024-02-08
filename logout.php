<?php
session_start();

// Destruir la sesión
session_destroy();

// Redirigir al usuario a la página de inicio
header("Location: inicio_sesion.php");

?>