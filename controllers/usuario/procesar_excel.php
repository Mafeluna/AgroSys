<?php
require __DIR__ . '/../../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

$host = "localhost";
$user = "root";
$pass = "";
$db = "agrosysdb";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (isset($_FILES['archivo_excel']) && $_FILES['archivo_excel']['error'] === 0) {
    $archivo = $_FILES['archivo_excel']['tmp_name'];

    $documentoExcel = IOFactory::load($archivo);
    $hoja = $documentoExcel->getActiveSheet();
    $filas = $hoja->toArray();

    $insertados = 0;
    $omitidos = 0;

    for ($i = 1; $i < count($filas); $i++) {
        list($nombre, $apellido, $documento, $email, $clave, $rol, $telefono, $direccion, $fecha, $estado) = array_map('trim', $filas[$i]);

        if (
            empty($nombre) || empty($apellido) || empty($documento) || empty($email) ||
            empty($clave) || empty($rol) || empty($telefono) || empty($direccion) || empty($estado)
        ) {
            echo "Fila $i omitida: campos vacíos<br>";
            $omitidos++;
            continue;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Fila $i omitida: email inválido ($email)<br>";
            $omitidos++;
            continue;
        }

        if (!is_numeric($documento) || !is_numeric($telefono)) {
            echo "Fila $i omitida: documento o teléfono inválido<br>";
            $omitidos++;
            continue;
        }

        $check = $conn->prepare("SELECT id_usuario FROM Usuario WHERE documento = ?");
        $check->bind_param("i", $documento);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            echo "Fila $i omitida: documento ya registrado ($documento)<br>";
            $omitidos++;
            continue;
        }

        $sql = "INSERT INTO Usuario (nombre, apellido, documento, email, clave, rol, telefono, direccion, fecha_registro, estado)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssisssisss", $nombre, $apellido, $documento, $email, $clave, $rol, $telefono, $direccion, $fecha, $estado);

    }

   if ($insertados > 0 || $omitidos > 0) {
    echo "
    <!DOCTYPE html>
    <html lang='es'>
    <head>
      <meta charset='UTF-8'>
      <meta name='viewport' content='width=device-width, initial-scale=1.0'>
      <title>Importación Exitosa</title>
      <script src='https://cdn.tailwindcss.com'></script>
    </head>
    <body class='flex items-center justify-center min-h-screen bg-green-100'>

      <div class='bg-white p-10 rounded-xl shadow-xl text-center max-w-md'>
        <h1 class='text-2xl font-bold text-green-700 mb-4'>✅ Importación Exitosa</h1>
        <a href='/AgroSys/views/usuarios.php' class='bg-green-500 hover:bg-green-600 text-white font-semibold px-6 py-2 rounded-full transition'>
          Volver a usuarios
        </a>
      </div>

    </body>
    </html>
    ";
}

} else {
    echo "Error al subir el archivo.";
}

$conn->close();
?>


