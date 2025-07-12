<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');
require_once '../../models/m_alimento.php'; // Ajusta la ruta a tu modelo real

if (isset($_POST['id_alimento'])) {
    $id = $_POST['id_alimento'];
    $instancia = new alimento();
    $alimento = $instancia->buscarPorId($id); // Crea este método en el modelo

    echo json_encode([
        'unidad_base' => $alimento[0]['tipo_medida']
    ]);
}
?>
