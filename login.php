<?php
session_start();

include("conexion.php");

// Obtener los datos ingresados por el usuario
$nombre = $_POST['email'];
$password = $_POST['password'];

// Consulta para verificar si existe un usuario con el nombre y contraseña ingresados
$consulta = "SELECT * FROM inquilinos WHERE nombre='$nombre' AND password='$password'";
$resultado = mysqli_query($conexion, $consulta) or die(mysqli_error());

// Verificar si se encontró un usuario con las credenciales ingresadas
if (mysqli_num_rows($resultado) == 1) {
    // Inicio de sesión exitoso, establecer la variable de sesión 'nombre'
    $_SESSION['nombre'] = $nombre;

    // Redireccionar a la página principal o realizar otras acciones necesarias
    header("Location: inicio.html?nombre=" . urlencode($nombre));
    exit();
} else {
    // Las credenciales ingresadas no son válidas
    echo "Nombre de usuario o contraseña incorrectos";
}

mysqli_close($conexion);
?>
