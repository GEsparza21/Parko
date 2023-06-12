<?php

$host="localhost";
$user="id19712343_admin";
$pass="Huevos.1";

$db="id19712343_parko";

$conexion=mysqli_connect($host, $user, $pass, $db);

if(!$conexion){
	echo"Conexion Fallida";
}

?>