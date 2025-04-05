<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "AgrosysDB";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error)
{
    die("No se logró la conexión".$conn->connect_error);
}
else
{
    echo "<script>console.log('Conectado a la base de datos')</script>";
}
?>