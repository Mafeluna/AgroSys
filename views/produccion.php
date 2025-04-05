<?php
  session_start();
  if(empty($_SESSION)){
    header("Location: login.php");
  }

  include "../models/m_animal.php";
  include "../models/m_produccion.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>AgroSys | Produccion</title>
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
            class="bg-green-500 duration-150 rounded-xl drop-shadow-lg group flex items-center border-2 border-b-4 border-blue-950 cursor-pointer p-3 font-semibold hover:bg-yellow-400x"
            onclick="mostrarSeccion('registerProduccion')"
          >
            <ion-icon name="add-outline"></ion-icon>
            Registrar Produccion
          </button>
          <button
            id="btn-user"
            class="bg-blue-300 duration-150 hover:!border-b-2 text-blue-950 rounded-xl drop-shadow-lg group flex items-center border-2 border-b-4 border-blue-950 cursor-pointer p-3 font-semibold hover:bg-yellow-400x"
            onclick="mostrarSeccion('consultaProduccion')"
          >
            Consultar Produccion
          </button>
        </header>
        <article class="w-full p-5">
          <!-- consulta -->
          <section class="w-full activesection seccion justify-center gap-10 items-center flex-wrap" id="consultaProduccion">
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
                  Tipo de produccion
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
                  fecha
                </th>
                <th
                  scope="col"
                  class="border-e border-neutral-800 px-3 py-2 uppercase text-lg"
                >
                  animal
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
                $instancia = new produccion();
                $respuesta = $instancia->consultaGeneral();
                foreach($respuesta as $valor){
              ?>
              <tr>
              <td class="whitespace-nowrap border-e border-neutral-800 px-6 py-4 text-lg font-medium"><?php echo $valor['id_produccion']?></td>
              </td>
              <td class="whitespace-nowrap border-e border-neutral-800 px-6 py-4 text-lg font-medium">
                <?php echo $valor['tipo_produccion']?>
              </td>
              <td class="whitespace-nowrap border-e border-neutral-800 px-6 py-4 text-lg font-medium">
                <?php echo $valor['cantidad']?>
              </td>
              <td class="whitespace-nowrap border-e border-neutral-800 px-6 py-4 text-lg font-medium">
                <?php echo $valor['fecha']?>
              </td>
              <td class="whitespace-nowrap border-e border-neutral-800 px-6 py-4 text-lg font-medium">
                <?php echo $valor['nombre']?>
              </td>
              <td class="whitespace-nowrap border-e border-neutral-800 px-6 py-4 text-lg font-medium">
                <a href="consultaModProduccion.php?section=produccion&&id=<?php echo $valor['id_produccion']; ?>" class="text-xl font-bold hover:text-yellow-500">
                  <ion-icon name="create-outline"></ion-icon>
                </a>
              </td>
              <td class="whitespace-nowrap border-e border-neutral-800 px-6 py-4 text-lg font-medium">
                <a href="produccion.php?section=produccion&&id=<?php echo $valor['id_produccion'] ?>" class="text-xl font-bold hover:text-red-500">
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
          <!-- registro -->
          <section class="w-full h-full justify-center items-center seccion flex-col" id="registerProduccion">
            <h2 class="text-3xl font-semibold">Registrar Produccion</h2>
            <form action="../controllers/produccion/registro.php" method="POST" class="w-1/2" enctype="multipart/form-data">
              <div class="mb-5">
                <label
                  for="tipo_produccion"
                  class="mb-3 block text-base font-medium text-[#07074D]"
                >
                  Tipo de produccion:
                </label>
                <input
                  type="text"
                  name="tipo_produccion"
                  id="tipo_produccion"
                  class="w-full rounded-md border border-slate-300 bg-white py-3 px-6 text-base font-medium outline-none focus:border-lime-600 focus:shadow-md"
                  required
                />
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
                  required
                />
              </div>

              <div class="mb-5">
                <label
                  for="animal"
                  class="mb-3 block text-base font-medium text-[#07074D]"
                >
                  Animal:
                </label>
                <select
                  name="animal"
                  id="animal"
                  class="w-full rounded-md border border-slate-300 bg-white py-3 px-6 text-base font-medium outline-none focus:border-lime-600 focus:shadow-md"
                  required
                >
                <option value="">-</option>
                <?php 
                  $instanciaAnimal = new animal();
                  $respuestaAnimal = $instanciaAnimal->consultaGeneral();
                  foreach($respuestaAnimal as $valor){
                ?>
                <option value="<?php echo $valor['id_animal']?>"><?php echo $valor['nombre']?></option>
                <?php
                  }
                ?>
              </select>
              </div>

              <div class="w-full flex justify-center mt-5">
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
              <h2 class="text-3xl font-semibold mb-4 text-center">¿Estas seguro de eliminar esta produccion?</h2>
              <div class="flex justify-evenly">
              <button class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-75" onclick="window.location.href='produccion.php?section=produccion'">Cancelar</button>
              <form action="../controllers/produccion/eliminar.php" method="post">
                <input type="hidden" name="id_produccion" value="<?php echo $_GET['id'] ?>">
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
