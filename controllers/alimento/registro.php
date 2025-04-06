<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>AgroSys | Alimentos</title>
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
  include_once "conexion.php";
  $descripcion = $_POST['descripcion'];
  $cantidad = $_POST['cantidad'];
  $especie = $_POST['especie'];
  $tipo = $_POST['tipo_medida'];

  $sql="INSERT INTO Alimento (descripcion, cantidad,especie,tipo_medida) VALUES ('$descripcion',$cantidad,$especie,'$tipo')";
  if ($conn->query($sql)=== true) {
    $script = "
    Swal.fire({
        icon: 'success',
        title: 'Registro Exitoso',
        text: 'fue registrado exitosamente',
        confirmButtonText: 'Aceptar'
    }).then(function() {
        window.location.href = '../../views/alimentos.php?section=alimentos';
    });
    ";
  } else {
      echo "Error: ". $sql . "<br>" . $conn->error;
  }
  $conn->close();
?>
    <script>
      <?php echo $script ?>
    </script>
  </body>
</html>
