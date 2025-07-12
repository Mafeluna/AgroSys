
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
    include "../../models/m_alimentacion.php";
    $id_alimentacion = $_POST['id_alimentacion'];

    $instanciaConsulta = new alimentacion();
    $consulta = $instanciaConsulta->consultaEspecificaPorId($id_alimentacion);
    $unidadMedida = $consulta[0]["unidad_medida"];
    $cantidad = $_POST['cantidad'];
    $cantidadB = $cantidad;
    $cantidadAnterior = $consulta[0]["cantidad"];

    if($unidadMedida == "Miligramos"){
      $cantidadB = $cantidad*(1/1000000);
      $cantidadAnterior = $cantidadAnterior*(1/1000000);
    }
    elseif($unidadMedida == "Decigramos"){
      $cantidadB = $cantidad*(1/10000);
      $cantidadAnterior = $cantidadAnterior*(1/10000);
    }
    elseif($unidadMedida == "Gramos"){
      $cantidadB = $cantidad*(1/1000);
      $cantidadAnterior = $cantidadAnterior*(1/1000);
    }
    elseif($unidadMedida == "Mililitros"){
      $cantidadB = $cantidad*(1/1000);
      $cantidadAnterior = $cantidadAnterior*(1/1000);
    }
    elseif($unidadMedida == "Centilitros"){
      $cantidadB = $cantidad*(1/100);
      $cantidadAnterior = $cantidadAnterior*(1/100);
    }
    elseif($unidadMedida == "Galones"){
      $cantidadB = $cantidad*3.78541;
      $cantidadAnterior = $cantidadAnterior*3.785;
    }

    $sql = "CALL ActualizarAlimentacion('$id_alimentacion', '$cantidad',$cantidadB,$cantidadAnterior);";

    if ($conn->query($sql) === TRUE) {
        $script = "
        Swal.fire({
            icon: 'success',
            title: 'Modificacion Exitosa',
            text: 'Los datos han sido actualizados exitosamente{$cantidadB}',
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