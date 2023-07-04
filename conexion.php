<?php
$hostname = 'srv473.hstgr.io';
$database = 'u263256283_parkoapp';
$username = 'u263256283_admin';
$password = 'Parko3005';

$conexion = new mysqli($hostname, $username, $password, $database);
if ($conexion->connect_errno) {
	echo "Lo sentimos, el sitio web está experimentando problemas";
} else {
	//echo "Conexion exitosa";
}
?>