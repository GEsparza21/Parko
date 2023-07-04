<?php
include('conexion.php');

// Obtener los datos ingresados por el usuario
$ID = $_POST['Id'];
$nombre = $_POST['nombre'];
$apellidoPaterno = $_POST['apellido_paterno'];
$apellidoMaterno = $_POST['apellido_materno'];
$piso = $_POST['piso'];
$numeroApartamento = $_POST['numero_apartamento'];
$telefono = $_POST['telefono'];
$cajonEstacionamiento = $_POST['cajon_estacionamiento'];
$password = $_POST['password'];

// Encriptar el password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Consulta para verificar si ya existe un usuario con el mismo cajón de estacionamiento o ID
$consultaExistencia = "SELECT * FROM inquilinos WHERE idInquilinos = ? OR piso = ?";
$statementExistencia = mysqli_prepare($conexion, $consultaExistencia);
mysqli_stmt_bind_param($statementExistencia, "ss", $ID, $piso);
mysqli_stmt_execute($statementExistencia);
$resultadoExistencia = mysqli_stmt_get_result($statementExistencia);

if ($resultadoExistencia) {
    // La consulta se ejecutó correctamente, verificar el número de filas
    if (mysqli_num_rows($resultadoExistencia) > 0) {
        // Ya existe un usuario con el mismo cajón de estacionamiento o ID, mostrar un mensaje de error
        echo "<script>alert('Error al registrar. Inténtalo nuevamente.'); window.location.href='registro.html';</script>";
    } else {
        // No existe un usuario con el mismo cajón de estacionamiento o ID, proceder con la inserción
        // Consulta para insertar los datos en la tabla de inquilinos
        $consulta = "INSERT INTO inquilinos (idInquilinos, nombre, apellidoPaterno, apellidoMaterno, piso, noApartamento, telefono, cajonEstacionamiento, password) 
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $statement = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($statement, "sssssssss", $ID, $nombre, $apellidoPaterno, $apellidoMaterno, $piso, $numeroApartamento, $telefono, $cajonEstacionamiento, $hashedPassword);

        if (mysqli_stmt_execute($statement)) {
            // Inserción exitosa, redireccionar a la página de inicio o realizar otras acciones necesarias
            echo "<script>alert('Registro exitoso. Redireccionando...');window.location.href='index.html';</script>";
            exit();
        } else {
            // Error al insertar los datos
            echo "<script>alert('Error al registrar. Inténtalo nuevamente.'); window.location.href='index.html';</script>";
        }
    }
} else {
    // Error al ejecutar la consulta
    echo "Error: " . mysqli_error($conexion);
}

mysqli_stmt_close($statementExistencia);
mysqli_stmt_close($statement);
mysqli_close($conexion);
?>