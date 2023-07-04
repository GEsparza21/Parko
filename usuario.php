<?php
session_start();
error_log("Starting session...");
if (isset($_SESSION['nombre'])) {
    $nombre = $_SESSION['nombre'];
    $id = $_SESSION['ID'];
    $apellidoPaterno = isset($_SESSION['ApellidoPa']) ? $_SESSION['ApellidoPa'] : "";
    $apellidoMaterno = isset($_SESSION['ApellidoMa']) ? $_SESSION['ApellidoMa'] : "";
    $piso = isset($_SESSION['Piso']) ? $_SESSION['Piso'] : "";
    $numeroApartamento = isset($_SESSION['Apartamento']) ? $_SESSION['Apartamento'] : "";
    $telefono = isset($_SESSION['Telefono']) ? $_SESSION['Telefono'] : "";
    $cajonEstacionamiento = isset($_SESSION['Cajon']) ? $_SESSION['Cajon'] : "";
    error_log("Session variables retrieved");
} else {
    error_log("Session variables not found");
    header("Location: index.html");
    exit();
}

include "conexion.php";
// Verificar si el formulario se envió
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos enviados desde el formulario
    $id = $_SESSION['ID'];
    $nombre = $_POST['nombre'];
    $apellidoPaterno = $_POST['apellidoPaterno'];
    $apellidoMaterno = $_POST['apellidoMaterno'];
    $piso = $_POST['piso'];
    $numeroApartamento = $_POST['Apartamento'];
    $telefono = $_POST['telefono'];
    $cajonEstacionamiento = $_POST['cajonEstacionamiento'];

    // Actualizar los datos en la tabla inquilinos
    $actualizarConsulta = "UPDATE inquilinos SET nombre='$nombre', apellidoPaterno='$apellidoPaterno', apellidoMaterno='$apellidoMaterno', piso='$piso', noApartamento='$numeroApartamento', telefono='$telefono', cajonEstacionamiento='$cajonEstacionamiento' WHERE idInquilinos='$id'";
    $resultadoActualizar = mysqli_query($conexion, $actualizarConsulta) or die(mysqli_error($conexion));

    // Verificar si la actualización se realizó correctamente
    if ($resultadoActualizar) {
        error_log("Los datos se actualizaron correctamente en la base de datos.");
        // Actualizar las variables de sesión con los nuevos datos
        $_SESSION['nombre'] = $nombre;
        $_SESSION['ApellidoPa'] = $apellidoPaterno;
        $_SESSION['ApellidoMa'] = $apellidoMaterno;
        $_SESSION['Piso'] = $piso;
        $_SESSION['Apartamento'] = $numeroApartamento;
        $_SESSION['Telefono'] = $telefono;
        $_SESSION['Cajon'] = $cajonEstacionamiento;
        header("Location: inicio.php");
        exit();

    } else {
        error_log("Ocurrió un error al actualizar los datos en la base de datos.");
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="Estilo.css">
    <title>Perfil</title>
</head>

<body>
    <div class="container" style="min-height: calc(100vh - 70px); overflow-y: auto;">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="text-center">
                    <h1>Perfil</h1>
                    <br>
                    <form method="POST" action="">
                        <div class="mb-3">
                            <h2>Nombre:</h2>
                            <input type="text" id="Nombre" name="nombre" class="form-control"
                                value="<?php echo $nombre; ?>" <?php if (!empty($nombre)) {
                                       echo 'disabled';
                                   } ?> pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+" title="Solo se permiten letras y espacios">
                        </div>
                        <div class="mb-3">
                            <h2>Apellido Paterno:</h2>
                            <input type="text" id="ApellidoPa" name="apellidoPaterno" class="form-control"
                                value="<?php echo $apellidoPaterno; ?>" <?php if (!empty($apellidoPaterno)) {
                                       echo 'disabled';
                                   } ?> pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+"
                                title="Solo se permiten letras y espacios">
                        </div>
                        <div class="mb-3">
                            <h2>Apellido Materno:</h2>
                            <input type="text" id="ApellidoMa" name="apellidoMaterno" class="form-control"
                                value="<?php echo $apellidoMaterno; ?>" <?php if (!empty($apellidoMaterno)) {
                                       echo 'disabled';
                                   } ?> pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+"
                                title="Solo se permiten letras y espacios">
                        </div>
                        <div class="mb-3">
                            <h2>Placas:</h2>
                            <input type="text" id="Piso" name="piso" class="form-control" value="<?php echo $piso; ?>"
                                <?php if (!empty($piso)) {
                                    echo 'disabled';
                                } ?> pattern="[A-Z]{3}[0-9]{4}"
                                title="Las placas deben tener el formato ABC1234" maxlength="7">
                        </div>
                        <div class="mb-3">
                            <h2>Número de apartamento:</h2>
                            <input type="number" id="Apartamento" name="Apartamento" class="form-control"
                                value="<?php echo $numeroApartamento; ?>" pattern="[0-9]+"
                                title="Solo se permiten números" maxlength="3" disabled>
                        </div>
                        <div class="mb-3">
                            <h2>Teléfono:</h2>
                            <input type="number" id="Telefono" name="telefono" class="form-control"
                                value="<?php echo $telefono; ?>" <?php if (!empty($telefono)) {
                                       echo 'disabled';
                                   } ?> pattern="[0-9]+" title="Solo se permiten números" maxlength="10">
                        </div>
                        <div class="mb-3">
                            <h2>Número de cajón:</h2>
                            <input type="number" id="Cajon" name="cajonEstacionamiento" class="form-control"
                                value="<?php echo $cajonEstacionamiento; ?>" pattern="[0-9]+"
                                title="Solo se permiten números" maxlength="3" disabled>
                        </div>

                        <br>
                        <br>
                        <button id="btnsave" class="btn btn-primary" disabled>Guardar</button>
                    </form>
                    <br>
                    <button id="btnedit" class="btn btn-primary" onclick="habilitar()">Editar</button>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar fixed-bottom navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="inicio.php">
                <i class="fas fa-house fa-2x"></i>
                Inicio
            </a>
            <a class="navbar-brand active" href="usuario.php">
                <i class="fas fa-user fa-2x"></i>
                Usuario
            </a>
            <a class="navbar-brand" href="pruebamamalona.html">
                <i class="fas fa-qrcode fa-2x"></i>
                QR
            </a>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/19a155dae3.js" crossorigin="anonymous"></script>
    <script src="desactivar.js"></script>
    <script>
        function habilitar() {
            document.getElementById("Nombre").disabled = false;
            document.getElementById("ApellidoPa").disabled = false;
            document.getElementById("ApellidoMa").disabled = false;
            document.getElementById("Piso").disabled = false;
            document.getElementById("Apartamento").disabled = false;
            document.getElementById("Telefono").disabled = false;
            document.getElementById("Cajon").disabled = false;
            document.getElementById("btnsave").disabled = false;
        }
    </script>
</body>

</html>