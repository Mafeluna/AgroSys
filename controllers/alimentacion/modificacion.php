
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>AgroSys | Alimentacion</title>
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
    include_once ("conexion.php"); 
    $id_alimentacion = $_POST['id_alimentacion'];
    $cantidad = $_POST['cantidad'];

    $sql = "CALL ActualizarAlimentacion('$id_alimentacion', '$cantidad');";

    if ($conn->query($sql) === TRUE) {
        $script = "
        Swal.fire({
            icon: 'success',
            title: 'Modificacion Exitosa',
            text: 'Los datos han sido actualizados exitosamente',
            confirmButtonText: 'Aceptar'
        }).then(function() {
            window.location.href = '../../views/alimentacion.php?section=alimentacion';
        });
        ";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
    ?>
    <script>
      <?php echo $script ?>
    </script>
  </body>
</html>