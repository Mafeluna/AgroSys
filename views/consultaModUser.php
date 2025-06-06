<?php
  session_start();
  if(empty($_SESSION)){
    header("Location: login.php");
  }

  include "../models/m_usuario.php";
  $instancia = new usuario();
  $respuesta = $instancia->buscarPorDocumento($_GET['id']);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>AgroSys | Usuarios</title>
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
    <link rel="stylesheet" href="styles.css">
    <script src="./mostrarSeccion.js" defer></script>
    <script src="ojo.js"></script>
    <script src="js/validar-mod-usuarios.js" defer></script>
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
        <header class="flex p-5 gap-5">
          <button
            id="btn-user"
            class="bg-blue-300 duration-150 hover:!border-b-2 text-blue-950 rounded-xl drop-shadow-lg group flex items-center border-2 border-b-4 border-blue-950 cursor-pointer p-3 font-semibold hover:bg-yellow-400x"
            onclick="window.location.href='usuarios.php?section=usuarios'"
          >
            Volver
          </button>
        </header>
        <article class="w-full p-5">
        <section class="w-full h-full justify-center items-center flex flex-col" id="registerUser">
          <h2 class="text-3xl font-semibold">Modificar Usuario</h2>
          <form action="../controllers/usuario/modificacion.php" method="POST" class="w-1/2" id="form-users-mod">
            <div class="mb-5">
              <label
                for="nombre"
                class="mb-3 block text-base font-medium text-[#07074D]"
              >
                Nombre:
              </label>
              <input
                type="text"
                name="nombre"
                id="nombre"
                class="w-full rounded-md border border-slate-300 bg-white py-3 px-6 text-base font-medium outline-none focus:border-lime-600 focus:shadow-md"
                required
                value = "<?php echo $respuesta[0]['nombre'] ?>"
              />
              <p id="mensaje-nombre" class="text-base text-center font-medium mb-4"></p>
            </div>
            <div class="mb-5">
              <label
                for="apellido"
                class="mb-3 block text-base font-medium text-[#07074D]"
              >
                Apellido:
              </label>
              <input
                type="text"
                name="apellido"
                id="apellido"
                class="w-full rounded-md border border-slate-300 bg-white py-3 px-6 text-base font-medium outline-none focus:border-lime-600 focus:shadow-md"
                required
                value = "<?php echo $respuesta[0]['apellido'] ?>"
              />
              <p id="mensaje-apellido" class="text-base text-center font-medium mb-4"></p>
            </div>
            <div class="mb-5">
              <label
                for="documento"
                class="mb-3 block text-base font-medium text-[#07074D]"
              >
                Documento:
              </label>
              <input
                type="number"
                name="documento"
                id="documento"
                class="w-full rounded-md border border-slate-300 bg-white py-3 px-6 text-base font-medium outline-none focus:border-lime-600 focus:shadow-md"
                required
                value = "<?php echo $respuesta[0]['documento'] ?>"
              />
              <p id="mensaje-documento" class="text-base text-center font-medium mb-4"></p>
            </div>
            <div class="mb-5">
              <label
                for="email"
                class="mb-3 block text-base font-medium text-[#07074D]"
              >
                Correo Electronico:
              </label>
              <input
                type="email"
                name="email"
                id="email"
                class="w-full rounded-md border border-slate-300 bg-white py-3 px-6 text-base font-medium outline-none focus:border-lime-600 focus:shadow-md"
                required
                value = "<?php echo $respuesta[0]['email'] ?>"
              />
              <p id="mensaje-correo" class="text-base text-center font-medium mb-4"></p>
            </div>
            <div class="mb-5">
              <label
                for="rol"
                class="mb-3 block text-base font-medium text-[#07074D]"
              >
                Rol o cargo:
              </label>
              <select
                name="rol"
                id="rol"
                class="w-full rounded-md border border-slate-300 bg-white py-3 px-6 text-base font-medium outline-none focus:border-lime-600 focus:shadow-md"
                required
              >
                <option value = "<?php echo $respuesta[0]['rol'] ?>"selected><?php echo $respuesta[0]['rol'] ?></option>
                <option value="1">Administrador</option>
                <option value="2">Encargado Animales</option>
                <option value="3">Encargado produccion</option>
                <option value="4">Veterinario</option>
            </select>
            <p id="mensaje-rol" class="text-base text-center font-medium mb-4"></p>
            </div>
            <div class="mb-5">
              <label
                for="telefono"
                class="mb-3 block text-base font-medium text-[#07074D]"
              >
                Telefono:
              </label>
              <input
                type="number"
                name="telefono"
                id="telefono"
                class="w-full rounded-md border border-slate-300 bg-white py-3 px-6 text-base font-medium outline-none focus:border-lime-600 focus:shadow-md"
                required
                value = "<?php echo $respuesta[0]['telefono'] ?>"
              />
              <p id="mensaje-telefono" class="text-base text-center font-medium mb-4"></p>
            </div>
            <div class="mb-5">
              <label
                for="direccion"
                class="mb-3 block text-base font-medium text-[#07074D]"
              >
                Dirección:
              </label>
              <input
                type="text"
                name="direccion"
                id="direccion"
                class="w-full rounded-md border border-slate-300 bg-white py-3 px-6 text-base font-medium outline-none focus:border-lime-600 focus:shadow-md"
                required
                value = "<?php echo $respuesta[0]['direccion'] ?>"
              />
              <p id="mensaje-direccion" class="text-base text-center font-medium mb-4"></p>
            </div>
            <input type="hidden" name="id_usuario" readonly value = "<?php echo $respuesta[0]['id_usuario'] ?>">
            <div class="w-full flex justify-center">
              <button
                class="hover:shadow-form rounded-md bg-lime-500 py-3 px-8 text-base font-semibold text-white outline-none"
              >
                Modificar
              </button>
            </div>
          </form>
        </section>
        </article>
      </section>
    </main>
    <?php
      include "footer.php";
    ?>
  </body>
</html>
