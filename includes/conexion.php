<?php
// Conexion a base de datos en Mysql
$mysqli = new mysqli("localhost", "db", "*Adatahd710*", "practica");
if(mysqli_connect_errno()){
    echo "Conexion Fallida";
    die();
}
?>