<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>AgroSys | Finanzas</title>
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
      session_start();
      $tipo = $_POST['tipo'];
      $monto = $_POST['monto'];
      $descripcion = $_POST['descripcion'];
      $registrado_por = $_SESSION['id_usuario'];

      $sql="INSERT INTO Finanzas (tipo,monto,descripcion,registrado_por) 
      VALUES ('$tipo',$monto,'$descripcion',$registrado_por)";
      if ($conn->query($sql)=== true) {
        $script = "
        Swal.fire({
            icon: 'success',
            title: 'Registro Exitoso',
            text: 'fue registrado exitosamente',
            confirmButtonText: 'Aceptar'
        }).then(function() {
            window.location.href = '../../views/finanzas.php?section=finanzas';
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