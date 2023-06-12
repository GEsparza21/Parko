<?php
$hostname='localhost';
$database='id19712343_parko';
$username='id19712343_admin';
$password='Huevos.1';

$conexion=new mysqli($hostname,$username,$password,$database);
if($conexion->connect_errno){
    echo "Lo sentimos, el sitio web está experimentando problemas";
} else {
    echo "Conexion exitosa";
}
?>