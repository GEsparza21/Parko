<?php
$servername='localhost';
$database='u263256283_parkoapp';
$username='u263256283_admin';
$password='Parko3005';

// Establecer conexión con la base de datos
$conexion = new mysqli($servername, $username, $password, $database);

// Verificar si se pudo establecer la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Configurar la zona horaria en GMT-6 (Ciudad de México)
date_default_timezone_set('America/Mexico_City');
$hora_actual = gmdate('Y-m-d H:i:s', time() - (6 * 3600));

// Obtener el UID del usuario desde la solicitud HTTP
$uid = $_POST['uid'];

// Consultar la tabla de usuarios para verificar si el UID existe
$sql = "SELECT * FROM inquilinos WHERE idInquilinos = '$uid'";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {

    // Obtener los datos del usuario placas
    $sql = "SELECT * FROM autos WHERE idInquilinos = '$uid'";
    $resultado_autos = $conexion->query($sql);

    if ($resultado_autos->num_rows > 0) {
    $fila_usuario = $resultado_autos->fetch_assoc();
    $placas_usuario = $fila_usuario['placa'];  // Obtener placa
    } else{
        echo "Placa no encontrada.";
        $placas_usuario = "xxxxx";
    }


    // El usuario es válido, verificar el último evento registrado en la tabla de registro
    $sql = "SELECT evento FROM registros WHERE idInquilinos = '$uid' ORDER BY fecha_hora DESC LIMIT 1";
    $resultado_registro = $conexion->query($sql);

    if ($resultado_registro->num_rows > 0) {
        $fila_registro = $resultado_registro->fetch_assoc();
        $ultimoEvento = $fila_registro['evento'];

        if ($ultimoEvento == "Entrada") {
            // Insertar un nuevo registro de salida
            $sql = "INSERT INTO registros (idInquilinos, fecha_hora, placa, evento) VALUES ('$uid', '$hora_actual','$placas_usuario', 'Salida')";
            $conexion->query($sql);
            echo "El usuario es válido. Se ha insertado un nuevo registro de Salida.";
        } else {
            // Insertar un nuevo registro de entrada
            $sql = "INSERT INTO registros (idInquilinos, fecha_hora, placa, evento) VALUES ('$uid', '$hora_actual','$placas_usuario', 'Entrada')";
            $conexion->query($sql);
            echo "El usuario es válido. Se ha insertado un nuevo registro de Entrada.";
        }
    } else {
        // No hay eventos registrados, insertar un nuevo registro de entrada
        $sql = "INSERT INTO registros (idInquilinos, fecha_hora, placa, evento) VALUES ('$uid', '$hora_actual','$placas_usuario', 'Entrada')";
        $conexion->query($sql);
        echo "El usuario es válido. Se ha insertado un nuevo registro de Entrada.";
    }
} else {
    // El usuario no es válido
    echo "El usuario no es válido.";
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>