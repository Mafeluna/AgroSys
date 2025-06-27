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
    function formatearNumero($num) {
      return str_pad($num, 4, "0", STR_PAD_LEFT);
  }


    include "../../models/m_animal.php";
    include "../../models/m_especie.php";
    session_start();
    $instancia = new animal();
    var_dump($_POST);

    $especie = new especie();
    $answer = $especie->consultaEspecifica($_POST["especie"]);

    $nombre = strtoupper(substr($answer[0]["nombre"], 0, 2));
    $conteo = formatearNumero($instancia->contarPorEspecie($_POST["especie"])+1);
    
    $codigo = $nombre."-".$conteo;


    $respuesta = $instancia->registrar($_POST,$codigo,$_SESSION['id_usuario']); 
    $script = "";
    if($respuesta == 1){
      $script = "
      Swal.fire({
          icon: 'success',
          title: 'Registro Exitoso',
          text: '{$codigo} fue registrado/a exitosamente',
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
