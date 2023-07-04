<?php
session_start();
if (isset($_SESSION['ID'])) {
    $id = $_SESSION['ID'];
} else {
    header("Location: index.html");
    exit();
}

// Archivo de conexión a la base de datos
require 'conexion.php';

// Obtén el valor de la cadena enviada por la solicitud
$cadena = $_POST['cadena'];

// Consulta SQL para eliminar el registro del código QR
$query = "DELETE FROM visitantes WHERE codigo_acceso = '$cadena'";

// Ejecuta la consulta para eliminar el registro de la base de datos
$resultado = mysqli_query($conexion, $query);

// Verifica si la eliminación fue exitosa
if ($resultado) {
    // La eliminación se realizó correctamente
    http_response_code(200); // Responde con un código de estado 200 (éxito)
} else {
    // Ocurrió un error al eliminar el registro de la base de datos
    http_response_code(500); // Responde con un código de estado 500 (error del servidor)
}
?>
