<?php
  session_start();
  if(empty($_SESSION)){
    header("Location: login.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>AgroSys | Inicio</title>
    <link rel="shortcut icon" href="../images/logo.jpg" type="image/x-icon" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script
      type="module"
      src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"
    ></script>
    <script
      nomodule
      src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"
    ></script>
    <link
      rel="shortcut icon"
      href="/interfaces/IMG/logo.Jpg"
      type="image/x-icon"
    />
  </head>
  <body>
    <!-- Header -->
    <?php
    include "header.php";
    ?>
    <!-- ./Header -->

   
    <main class="flex w-full">
       <!-- Sidebar -->
      <?php include "menu.php";?>
      <!-- section -->
      <section class="w-full overflow-y-auto" style="height: 90vh">
        <header class="w-full p-10 h-1/6">
          <h2
            class="text-4xl font-semibold bg-yellow-200 p-3 rounded-3xl text-center"
          >
            ¡Bienvenido/a! <?php echo $_SESSION['nombre']; ?>
          </h2>
        </header>
        <article
          class="flex flex-wrap justify-center items-center p-10 h-5/6 gap-2"
        >
          <img src="../images/imagenInicio.jpeg" alt="Imagen Granja" class="h-full rounded-xl">
        </article>
      </section>
    </main>
    <?php
      include "footer.php";
    ?>
  </body>
</html>
