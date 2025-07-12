<?php
  session_start();
  if(empty($_SESSION)){
    header("Location: login.php");
  }

  include "../models/m_alimento.php";
  include "../models/m_especie.php"
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>AgroSys | Alimentos</title>
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
    <script src="js/validar-alimentos.js" defer></script>
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
            onclick="window.location.href='alimentos.php?section=alimentos'"
          >
            Volver
          </button>
        </header>
        <article class="w-full p-5">
            <?php
              $instancia = new alimento();
              $respuesta = $instancia->ConsultaEspecifica($_GET);
            ?>
          <!-- registro -->
          <section class="w-full h-full justify-center items-center flex flex-col" id="registerAnimal">
            <h2 class="text-3xl font-semibold">Modificar Alimento</h2>
            <form action="../controllers/alimento/modificacion.php" method="POST" class="w-1/2" enctype="multipart/form-data" id="form-foods">
            <div class="mb-5 hidden">
              <label
                for="id_alimento"
                class="mb-3 block text-base font-medium text-[#07074D]"
              >
                Id alimento:
              </label>
              <input
                type="number"
                name="id_alimento"
                id="id_alimento"
                class="w-full rounded-md border border-slate-300 bg-white py-3 px-6 text-base font-medium outline-none focus:border-lime-600 focus:shadow-md"
                required
                value="<?php echo $respuesta[0]['id_alimento'] ?>"
              />
            </div>
            <div class="mb-5">
              <label
                for="descripcion"
                class="mb-3 block text-base font-medium text-[#07074D]"
              >
                Nombre o Descripcion:
              </label>
              <input
                type="text"
                name="descripcion"
                id="descripcion"
                class="w-full rounded-md border border-slate-300 bg-white py-3 px-6 text-base font-medium outline-none focus:border-lime-600 focus:shadow-md"
                value="<?php echo $respuesta[0]['descripcion'] ?>"
              />
              <p id="mensaje-descripcion" class="text-base text-center font-medium mb-4"></p>
            </div>
            <div class="mb-5">
              <label
                for="cantidad"
                class="mb-3 block text-base font-medium text-[#07074D]"
              >
                Cantidad:
              </label>
              <input
                type="number"
                name="cantidad"
                id="cantidad"
                class="w-full rounded-md border border-slate-300 bg-white py-3 px-6 text-base font-medium outline-none focus:border-lime-600 focus:shadow-md"
                value="<?php echo $respuesta[0]['cantidad'] ?>"
                required
              />
            </div>
            <div class="mb-5">
              <label
                for="tipo_medida"
                class="mb-3 block text-base font-medium text-[#07074D]"
              >
                Tipo de medida:
              </label>
              <select
                name="tipo_medida"
                id="tipo_medida"
                class="w-full rounded-md border border-slate-300 bg-white py-3 px-6 text-base font-medium outline-none focus:border-lime-600 focus:shadow-md"
              >
                <option value="<?php echo $respuesta[0]['tipo_medida'] ?>" selected><?php echo $respuesta[0]['tipo_medida'] ?></option>
                <option value="1">Kilogramos</option>
                <option value="2">Litros</option>
            </select>
            <p id="mensaje-tipoMedida" class="text-base text-center font-medium mb-4"></p>
            </div>
            <div class="mb-5">
              <label
                for="especie"
                class="mb-3 block text-base font-medium text-[#07074D]"
              >
                Especie:
              </label>
              <select
                name="especie"
                id="especie"
                class="w-full rounded-md border border-slate-300 bg-white py-3 px-6 text-base font-medium outline-none focus:border-lime-600 focus:shadow-md"
              >
                <option value="<?php echo $respuesta[0]['id_especie'] ?>" selected><?php echo $respuesta[0]['especie'] ?></option>
                <?php 
                $instancia2 = new especie();
                $respuesta2 = $instancia2->consultaGeneral();
                foreach($respuesta2 as $especie){?>
                <option value="<?php echo $especie['id_especie'] ?>"><?php echo $especie['nombre'] ?></option>
                <?php } ?>
              </select>
              <p id="mensaje-especie" class="text-base text-center font-medium mb-4"></p>
            </div>
              <input type="hidden" name="id_animal" value="<?php ?>">
              <div class="w-full flex justify-center mt-5">
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