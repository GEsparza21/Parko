<?php
session_start(); // Inicia la sesión

// Elimina todas las variables de sesión
session_unset();

// Destruye la sesión
session_destroy();

// Redirecciona al usuario a la página de inicio de sesión
header("Location: index.html");
exit();
?>