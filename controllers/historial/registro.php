<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>AgroSys | Historial Medico</title>
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

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $animal=$_POST["animal"];
            $descripcion= $_POST["descripcion"];
            $tratamiento = $_POST["tratamiento"];


            $sql = "INSERT INTO historial_clinico
            (animal, descripcion, tratamiento) VALUES 
            ('$animal','$descripcion','$tratamiento');";

            if ($conn->query($sql) === true) {
                $script = "
                    Swal.fire({
                        icon: 'success',
                        title: 'Registro Exitoso',
                        text: 'fue registrado exitosamente',
                        confirmButtonText: 'Aceptar'
                    }).then(function() {
                        window.location.href = '../../views/historialmedico.php?section=historial_medico';
                    });
                    ";
            } else {
                echo "Error, no se ejecutó la sentencia: " . $conn->error;
            }
        }
        
    $conn->close();
    ?>
    <script>
      <?php echo $script ?>
    </script>
  </body>
</html>


