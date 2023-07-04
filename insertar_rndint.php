<?php
// Archivo de conexión a la base de datos
require 'conexion.php';

// Obtén el valor de rndInt enviado por la solicitud
$rndInt = $_POST['rndInt'];

// Realiza la inserción en la base de datos
$query = "INSERT INTO visitantes (idInquilinos) VALUES ('$rndInt')";
$resultado = mysqli_query($conexion, $query);

// Verifica si la inserción fue exitosa
if ($resultado) {
  // La inserción se realizó correctamente
  http_response_code(200); // Responde con un código de estado 200 (éxito)
} else {
  // Ocurrió un error al insertar en la base de datos
  http_response_code(500); // Responde con un código de estado 500 (error del servidor)
}
?>
