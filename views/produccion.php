<?php
  session_start();
  if(empty($_SESSION)){
    header("Location: login.php");
  }

  include "../models/m_especie.php";
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
    <script src="js/validar-produccion.js" defer></script>
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
          <button
            id="btn-user"
            class="bg-red-300 duration-150 hover:!border-b-2 text-blue-950 rounded-xl drop-shadow-lg group flex items-center border-2 border-b-4 border-blue-950 cursor-pointer p-3 font-semibold hover:bg-yellow-400x"
            onclick="window.open('../controllers/produccion/generarpdf.php', '_blank')"
          >
            Generar PDF
          </button>
          <button
            id="btn-user"
            class="bg-green-300 duration-150 hover:!border-b-2 text-blue-950 rounded-xl drop-shadow-lg group flex items-center border-2 border-b-4 border-blue-950 cursor-pointer p-3 font-semibold hover:bg-yellow-400x"
            onclick="window.open('../controllers/produccion/excel.php', '_blank')"
          >
            Generar Excel
          </button>
          <div class="w-2/3">
          <form action="" class="flex gap-10" method="post">
            <input
              name = "id"
              type="number"
              placeholder="Buscar por Id..."
              class="w-3/4 pl-10 pr-4 py-2 rounded-2xl shadow-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
            />
            <button class="bg-blue-300 duration-150 hover:!border-b-2 text-blue-950 rounded-xl drop-shadow-lg group flex items-center border-2 border-b-4 border-blue-950 cursor-pointer p-3 font-semibold hover:bg-yellow-400x">
              <ion-icon name="search-outline"></ion-icon>
            </button>
          </form>
          </div>
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
                  Unidad de medida
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
                  Especie
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
                if(isset($_POST["id"])){
                  $respuesta = $instancia->consultaEspecifica($_POST);
                }
                else{
                $respuesta = $instancia->consultaGeneral();
                }
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
                <?php echo $valor['unidad_medida']?>
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
            <form action="../controllers/produccion/registro.php" method="POST" class="w-1/2" enctype="multipart/form-data" id="form-production">
              <div class="mb-5">
                <label
                  for="tipoProduccion"
                  class="mb-3 block text-base font-medium text-[#07074D]"
                >
                  Tipo de produccion:
                </label>
                <input
                  type="text"
                  name="tipo_produccion"
                  id="tipoProduccion"
                  class="w-full rounded-md border border-slate-300 bg-white py-3 px-6 text-base font-medium outline-none focus:border-lime-600 focus:shadow-md"
                />
                <p id="mensaje-tipoProduccion" class="text-base text-center font-medium mb-4"></p>
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
                for="tipoMedida"
                class="mb-3 block text-base font-medium text-[#07074D]"
              >
                Tipo de medida:
              </label>
              <select
                name="tipo_medida"
                id="tipoMedida"
                class="w-full rounded-md border border-slate-300 bg-white py-3 px-6 text-base font-medium outline-none focus:border-lime-600 focus:shadow-md"
              >
                <option value="" selected>-</option>
                <option value="1">Kilogramos</option>
                <option value="2">Litros</option>
                <option value="3">Unidades</option>
                <option value="4">Porciones</option>
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
                <option value="">-</option>
                <?php 
                  $instanciaAnimal = new especie();
                  $respuestaAnimal = $instanciaAnimal->consultaGeneral();
                  foreach($respuestaAnimal as $valor){
                ?>
                <option value="<?php echo $valor['id_especie']?>"><?php echo $valor['nombre']?></option>
                <?php
                  }
                ?>
              </select>
              <p id="mensaje-especie" class="text-base text-center font-medium mb-4"></p>
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
