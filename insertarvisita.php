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

// Obtén el valor de rndInt enviado por la solicitud
//$id = $_POST['id'];
$cadena = $_POST['cadena'];
$nombre = $_POST['nombre'];
$tipoVehiculo = $_POST['tipoVehiculo'];
$tipoVisita = $_POST['tipoVisita'];
$tiempo = $_POST['tiempoExpiracion'];
$placas = $_POST['placas'];

// Validar el nombre
if (empty($nombre)) {
    http_response_code(400); // Bad Request
    exit();
}

// Obtener la cantidad actual de inserciones del usuario
$queryCount = "SELECT COUNT(*) AS total FROM visitantes WHERE idInquilino = '$id'";
$resultCount = mysqli_query($conexion, $queryCount);
$rowCount = mysqli_fetch_assoc($resultCount);
$totalInserts = $rowCount['total'];

// Verificar si se ha alcanzado el límite de inserciones (5)
if ($totalInserts >= 5) {
    // Eliminar las inserciones antiguas del usuario
    //alert de que se encontraron 5 registros
    echo "<script>alert('Se encontraron 5 registros, se eliminaron los registros antiguos, se eliminarán para insertar uno nuevo');</script>";
    $eliminarQuery = "DELETE FROM visitantes WHERE idInquilino = '$id'";
    mysqli_query($conexion, $eliminarQuery);
}

// Insertar el nuevo registro
$query = "INSERT INTO visitantes (codigo_acceso, idInquilino, nombre_completo,placas, tipo_vehiculo, tipo_visita, fecha_expiracion) VALUES ('$cadena', '$id', '$nombre','$placas', '$tipoVehiculo', '$tipoVisita', '$tiempo')";

// Realiza la inserción en la base de datos
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

