<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="Estilo.css">
    <title>Inicio Sesión</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <img src="img/logo.png" class="img-fluid" alt="Responsive image">
                <div class="text-center">
                    <h1>Bienvenido</h1>
                    <?php
                    session_start(); // Start the session
                    
                    if (isset($_SESSION['nombre'])) {
                        $nombre = $_SESSION['nombre'];
                        echo "<h2>$nombre</h2>";
                    } else {
                        // Redirect to login page if user is not logged in
                        header("Location: login.html");
                        exit();
                    }
                    ?>
                    <h3>Selecciona una opción</h3>
                    <br>
                    <h2>¿Tienes algún un inconveniente en tu cuenta?</h2>
                    <!-- <h3></h3>a href="mailto:admincexar@parkotesci.com">Contáctanos</a> -->
                    <br>
                    <p><a href="mailto:admincexar@parkotesci.com?subject=Ayuda para 
                    cuenta&body=Necesito ayuda para mi cuenta." class="btn btn-outline-light">Contáctanos</a></p>
                    <br>
                    <br>

                    <a href="logout.php" class="btn btn-danger">Cerrar sesión</a>
                    <br>

                </div>
            </div>

            <nav class="navbar fixed-bottom navbar-light bg-light style=" background-color: #e3f2fd;">

                <a class="navbar-brand active" href="inicio.php" onclick="changeTab(event, 'usuario')"">
              <i class=" fa-solid fa-house fa-2xl"></i>
                    Inicio
                </a>

                <a class="navbar-brand " href="usuario.php">
                    <i class="fa-solid fa-user fa-2xl"></i>
                    Usuario
                </a>

                <a class="navbar-brand" href="pruebamamalona.html" onclick="changeTab(event, 'qr')">
                    <i class="fa-solid fa-qrcode fa-2xl"></i>
                    QR
                </a>

            </nav>
            </style>
            <script>
                // Retrieve the username from the URL query parameters
                const urlParams = new URLSearchParams(window.location.search);
                const userName = urlParams.get('nombre');

                // Update the user name element with the retrieved username
                const userNameElement = document.getElementById('user-name');
                if (userNameElement) {
                    userNameElement.textContent = userName;
                }
            </script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
                crossorigin="anonymous"></script>
            <script src="https://kit.fontawesome.com/19a155dae3.js" crossorigin="anonymous"></script>


</body>

</html>