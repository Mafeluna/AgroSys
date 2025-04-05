<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>AgroSys | Especies</title>
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
    include "../../models/m_especie.php";
    session_start();
    $instancia = new especie();
    //$image = file_get_contents($_FILES["foto"]["tmp_name"]);
    $respuesta = $instancia->registrar($_POST); 
    $script = "";
    if($respuesta == 1){
      $script = "
      Swal.fire({
          icon: 'success',
          title: 'Registro Exitoso',
          text: '{$_POST['nombre']} fue registrado/a exitosamente',
          confirmButtonText: 'Aceptar'
      }).then(function() {
          window.location.href = '../../views/especie.php?section=especies';
      });
      ";
    }
    ?>
    <script>
      <?php echo $script ?>
    </script>
  </body>
</html>
