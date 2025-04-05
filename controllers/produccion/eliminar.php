<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>AgroSys | Produccion</title>
    <link rel="shortcut icon" href="../../images/logo.jpg" type="image/x-icon" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script
      type="module"
      src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"
    ></script>
    <script
      nomodule
      src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"
    ></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  </head>
  <body class="w-full h-screen flex items-center justify-center">
  <?php
  include_once("conexion.php");

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $id_produccion = $_POST['id_produccion'];

      $stmt = $conn->prepare("UPDATE Produccion SET estado=2 WHERE id_produccion = ?");
      $stmt->bind_param("i", $id_produccion); 
      $stmt->execute();

      if ($stmt->errno){
          echo "Error: " . $stmt->error;
      } else {
        $script = "
        Swal.fire({
            icon: 'success',
            title: 'Eliminacion Exitosa',
            text: 'fue eliminado exitosamente',
            confirmButtonText: 'Aceptar'
        }).then(function() {
            window.location.href = '../../views/produccion.php?section=produccion';
        });
        ";
      }

      $stmt->close();
  }

  $conn->close();
?>

    <script>
      <?php echo $script ?>
    </script>
  </body>
</html>