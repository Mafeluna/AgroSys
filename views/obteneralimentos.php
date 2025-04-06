<?php
include_once "../models/conexion.php";

if (isset($_GET['especie'])) {
    $especie = $_GET['especie'];
    
    $sql = "SELECT id_alimento, descripcion FROM Alimento WHERE especie = $especie AND estado = 'Activo'";
    $result = $conexion->query($sql);

    $alimentos = array();
    while ($row = $result->fetchAll(PDO::FETCH_ASSOC)) {
        $alimentos[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($alimentos);
}
?>
