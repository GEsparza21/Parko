<?php
session_start();
include("conexion.php");

// Obtener los datos ingresados por el usuario
$nombre = $_POST['email'];
$password = $_POST['password'];

// Consulta para obtener el usuario con el nombre ingresado
$consulta = "SELECT * FROM inquilinos WHERE idInquilinos='$nombre'";
$resultado = mysqli_query($conexion, $consulta) or die(mysqli_error());

// Verificar si se encontró un usuario con el nombre ingresado
if (mysqli_num_rows($resultado) == 1) {
    $row = mysqli_fetch_assoc($resultado);
    $hashedPassword = $row['password'];

    // Verificar la contraseña ingresada utilizando password_verify()
    if (password_verify($password, $hashedPassword)) {
        // Contraseña correcta, establecer las variables de sesión con los datos del usuario
        $_SESSION['ID'] = $row['idInquilinos'];
        $_SESSION['nombre'] = $row['nombre'];
        $_SESSION['ApellidoPa'] = $row['apellidoPaterno'];
        $_SESSION['ApellidoMa'] = $row['apellidoMaterno'];
        $_SESSION['Piso'] = $row['piso'];
        $_SESSION['Apartamento'] = $row['noApartamento'];
        $_SESSION['Telefono'] = $row['telefono'];
        $_SESSION['Cajon'] = $row['cajonEstacionamiento'];

        // Redireccionar a la página principal o realizar otras acciones necesarias
        header("Location: inicio.php");
        exit();
    }
}

// Las credenciales ingresadas no son válidas
echo "<script>alert('Nombre de usuario o contraseña incorrectos'); window.location.href='index.html';</script>";

mysqli_close($conexion);
?>