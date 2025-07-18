<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>AgroSys | Animales</title>
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
    include "../../models/m_animal.php";
    $instancia = new animal();
    $respuesta = $instancia->modificarDatos($_POST); 
    $consulta = $instancia->ConsultaEspecifica($_POST);
    $script = "";
    if($respuesta == 1){
      $script = "
      Swal.fire({
          icon: 'success',
          title: 'Modificacion Exitosa',
          text: 'Los datos de {$consulta[0]['nombre']} fueron actualizados exitosamente',
          confirmButtonText: 'Aceptar'
      }).then(function() {
          window.location.href = '../../views/animales.php?section=animales';
      });
      ";
    }
    ?>
    <script>
      <?php echo $script ?>
    </script>
  </body>
</html>
