<?php
  session_start();
  if(empty($_SESSION)){
    header("Location: login.php");
  }

  header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
  header("Cache-Control: post-check=0, pre-check=0", false);
  header("Pragma: no-cache");

  include "../models/m_alimento.php";
  include "../models/m_especie.php";
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
    <link
      rel="shortcut icon"
      href="/interfaces/IMG/logo.Jpg"
      type="image/x-icon"
    />
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
            class="bg-green-500 duration-150 rounded-xl drop-shadow-lg group flex items-center border-2 border-b-4 border-blue-950 cursor-pointer p-3 font-semibold"
            onclick="mostrarSeccion('registerAlimentos')"
          >
            <ion-icon name="add-outline"></ion-icon>
            Registrar Alimento
          </button>
          <button
            id="btn-user"
            class="bg-blue-300 duration-150 hover:!border-b-2 text-blue-950 rounded-xl drop-shadow-lg group flex items-center border-2 border-b-4 border-blue-950 cursor-pointer p-3 font-semibold"
            onclick="mostrarSeccion('consultaAlimentos');window.location.href='alimentos.php?section=alimentos'"
          >
            Consultar Alimentos
          </button>
          <button
            id="btn-user"
            class="bg-red-300 duration-150 hover:!border-b-2 text-blue-950 rounded-xl drop-shadow-lg group flex items-center border-2 border-b-4 border-blue-950 cursor-pointer p-3 font-semibold"
            onclick="window.open('../controllers/alimento/generarpdf.php', '_blank')"
          >
            Generar PDF
          </button>
          <button
            id="btn-user"
            class="bg-green-300 duration-150 hover:!border-b-2 text-blue-950 rounded-xl drop-shadow-lg group flex items-center border-2 border-b-4 border-blue-950 cursor-pointer p-3 font-semibold"
            onclick="window.open('../controllers/alimento/excel.php', '_blank')"
          >
            Generar Excel
          </button>
          <div class="w-5/6 flex items-center pl-5">
        </header>
        <article class="w-full p-5">
          <section class="w-full activesection seccion flex-col justify-center items-center" id="consultaAlimentos">
          <table
            class="max-w-96 border border-neutral-800 text-center text-sm font-light text-surface bg-red-500"
          >
            <thead class="border-b border-neutral-800 font-medium bg-blue-300">
              <tr>
                <th
                  scope="col"
                  class="border-e border-neutral-800 px-3 py-2 text-lg uppercase"
                >
                  Id
                </th>
                <th
                  scope="col"
                  class="border-e border-neutral-800 px-3 py-2 uppercase text-lg"
                >
                  nombre
                <th
                  scope="col"
                  class="border-e border-neutral-800 px-3 py-2 uppercase text-lg"
                >
                  cantidad
                </th>
                <th
                  scope="col"
                  class="border-e border-neutral-800 px-3 py-2 uppercase text-lg"
                >
                  unidad medida
                </th>
                <th
                  scope="col"
                  class="border-e border-neutral-800 px-3 py-2 uppercase text-lg"
                >
                  especie
                </th>
                <th
                  scope="col"
                  class="border-e border-neutral-800 px-3 py-2 uppercase text-lg"
                >
                  editar
                </th>
                <th
                  scope="col"
                  class="border-e border-neutral-800 px-3 py-2 uppercase text-lg"
                >
                  eliminar
                </th>
              </tr>
            </thead>
            <tbody class="bg-emerald-100">
              <?php 
                $instancia = new alimento();
                if(isset($_POST['documento'])){
                  $respuesta = $instancia->consultaEspecifica($_POST['documento']);
                } else{
                $respuesta = $instancia->consultaGeneral();}
                foreach($respuesta as $valor){
              ?>
              <tr>
              <td class="whitespace-nowrap border-e border-neutral-800 px-6 py-4 text-lg font-medium"><?php echo $valor['id_alimento']?></td>
              </td>
              <td class="whitespace-nowrap border-e border-neutral-800 px-6 py-4 text-lg font-medium">
                <?php echo $valor['descripcion']?>
              </td>
              <td class="whitespace-nowrap border-e border-neutral-800 px-6 py-4 text-lg font-medium">
                <?php echo $valor['cantidad']?>
              </td>
              <td class="whitespace-nowrap border-e border-neutral-800 px-6 py-4 text-lg font-medium">
                <?php echo $valor['tipo_medida']?>
              </td>
              <td class="whitespace-nowrap border-e border-neutral-800 px-6 py-4 text-lg font-medium">
                <?php echo $valor['especie']?>
              </td>       
              <td class="whitespace-nowrap border-e border-neutral-800 px-6 py-4 text-lg font-medium">
                <a href="consultaModAlimento.php?section=alimentos&&id=<?php echo $valor['id_alimento']; ?>" class="text-xl font-bold hover:text-yellow-500">
                  <ion-icon name="create-outline"></ion-icon>
                </a>
              </td>
              <td class="whitespace-nowrap border-e border-neutral-800 px-6 py-4 text-lg font-medium">
                <a href="alimentos.php?section=alimentos&&id=<?php echo $valor['id_alimento'] ?>" class="text-xl font-bold hover:text-red-500">
                  <ion-icon name="trash-outline"></ion-icon>
                </a>
              </td>
              </tr>
              <?php
                }
              ?>
            </tbody>
          </table>
        </section>
        <?php
          $instancia2 = new especie();
          $respuesta2 = $instancia2->consultaGeneral();
        ?>
        <section class="w-full h-full justify-center items-center seccion flex-col" id="registerAlimentos">
          <h2 class="text-3xl font-semibold">Registrar Alimento</h2>
          <form action="../controllers/alimento/registro.php" method="POST" class="w-1/2" id="form-foods">
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
              />
              <p id="mensaje-cantidad" class="text-base text-center font-medium mb-4"></p>
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
                <option value="" selected>-</option>
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
                <option value="" selected>-</option>
                <?php foreach($respuesta2 as $especie){?>
                <option value="<?php echo $especie['id_especie'] ?>"><?php echo $especie['nombre'] ?></option>
                <?php } ?>
            </select>
            <p id="mensaje-especie" class="text-base text-center font-medium mb-4"></p>
            </div>
            <div class="w-full flex justify-center">
              <button
                class="hover:shadow-form rounded-md bg-lime-500 py-3 px-8 text-base font-semibold text-white outline-none"
              >
                Registrar
              </button>
            </div>
          </form>
        </section>
        </article>
        <?php if(isset($_GET['id'])){ ?>
        <div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
          <div class="bg-white p-8 rounded-lg shadow-lg max-w-sm w-full">
              <h2 class="text-3xl font-semibold mb-4 text-center">¿Estas seguro de eliminar este alimento?</h2>
              <div class="flex justify-evenly">
              <button class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-75" onclick="window.location.href='alimentos.php?section=alimentos'">Cancelar</button>
              <form action="../controllers/alimento/eliminar.php" method="post">
                <input type="hidden" name="id_alimento" value="<?php echo $_GET['id'] ?>">
                <button class="px-4 py-2 bg-red-500 text-white font-semibold rounded-lg shadow-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-75">Eliminar</button>
              </form>
              </div>
          </div>
        </div>
        <?php } ?>
      </section>
    </main>
    <?php
      include "footer.php";
    ?>
  </body>
</html>
