<?php
  session_start();
  if(empty($_SESSION)){
    header("Location: login.php");
  }

  include "../models/m_finanzas.php";
  $instancia = new finanza();
  $resumenFinanciero = $instancia->getResumenFinanciero();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>AgroSys | Finanzas</title>
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
    <script src="js/validar-finanzas.js" defer></script>
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
            onclick="mostrarSeccion('registerFinanzas')"
          >
            <ion-icon name="add-outline"></ion-icon>
            Registrar Finanzas
          </button>
          <button
            id="btn-user"
            class="bg-blue-300 duration-150 hover:!border-b-2 text-blue-950 rounded-xl drop-shadow-lg group flex items-center border-2 border-b-4 border-blue-950 cursor-pointer p-3 font-semibold hover:bg-yellow-400x"
            onclick="mostrarSeccion('consultaFinanzas')"
          >
            Consultar Finanzas
          </button>
          <button
            id="btn-user"
            class="bg-red-300 duration-150 hover:!border-b-2 text-blue-950 rounded-xl drop-shadow-lg group flex items-center border-2 border-b-4 border-blue-950 cursor-pointer p-3 font-semibold hover:bg-yellow-400x"
            onclick="window.open('../controllers/finanza/generarpdf.php', '_blank')"
          >
            Generar PDF
          </button>
          <button
            id="btn-user"
            class="bg-green-300 duration-150 hover:!border-b-2 text-blue-950 rounded-xl drop-shadow-lg group flex items-center border-2 border-b-4 border-blue-950 cursor-pointer p-3 font-semibold hover:bg-yellow-400x"
            onclick="window.open('../controllers/finanza/excel.php', '_blank')"
          >
            Generar Excel
          </button>
          <div class="w-2/3">
          <form action="" class="flex gap-10" method="post">
            <input
              name = "id"
              type="id"
              placeholder="Buscar por Id..."
              class="w-3/4 pl-10 pr-4 py-2 rounded-2xl shadow-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
            />
            <button class="bg-blue-300 duration-150 hover:!border-b-2 text-blue-950 rounded-xl drop-shadow-lg group flex items-center border-2 border-b-4 border-blue-950 cursor-pointer p-3 font-semibold hover:bg-yellow-400x">
              <ion-icon name="search-outline"></ion-icon>
            </button>
          </form>
          </div>
          <!-- Aqui pon el otro boton -->
        </header>
        <article class="w-full p-5">
          <!-- consulta -->
          <section class="w-full activesection seccion flex-col justify-center gap-10 items-center flex-wrap" id="consultaFinanzas">
            <h2
                class="font-sans text-3xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900 text-center uppercase"
              >
                Resumen Financiero
            </h2>
            <div class="flex w-full justify-evenly">
              <div
              class="bg-white flex flex-col text-gray-700 shadow-md border border-black rounded-xl w-96"
              >
                <div class="p-6">
                  <h5 class="font-sans text-2xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900 text-center">
                    <ion-icon class="text-green-500" name="arrow-up-outline"></ion-icon>
                  </h5>
                  <h5
                    class="mb-2 font-sans text-2xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900 text-center"
                  >
                    Total Ingresos: $<?php echo number_format($resumenFinanciero[0]["total_ingresos"], 2, ',', '.')?>
                  </h5>
                </div>
              </div>
              <div
              class="bg-white flex flex-col text-gray-700 shadow-md rounded-xl border border-black w-96"
              >
                <div class="pt-6 pb-6">
                  <h5 class="font-sans text-2xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900 text-center">
                    <ion-icon class="text-red-500" name="arrow-down-outline"></ion-icon>
                  </h5>
                  <h5
                    class="mb-2 font-sans text-2xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900 text-center"
                  >
                    Total Egresos: $<?php echo number_format($resumenFinanciero[0]["total_egresos"], 2, ',', '.')?>
                  </h5>
                </div>
              </div>
              <div
              class="bg-white flex flex-col text-gray-700 shadow-md border border-black rounded-xl w-96"
              >
                <div class="p-6">
                  <h5 class="font-sans text-2xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900 text-center">
                    <ion-icon class="text-blue-500" name="bar-chart-outline"></ion-icon>
                  </h5>
                  <h5
                    class="mb-2 font-sans text-2xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900 text-center"
                  >
                    Balance: $<?php echo number_format($resumenFinanciero[0]["balance"], 2, ',', '.')?>
                  </h5>
                </div>
              </div>
            </div>
            <h2
                class="font-sans text-3xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900 text-center uppercase"
              >
                Transacciones
            </h2>
            <table
            class="max-w-96 border border-neutral-800 text-center text-sm font-light text-surface bg-red-500"
          >
            <thead class="border-b border-neutral-800 font-medium bg-blue-300">
              <tr>
                <th
                  scope="col"
                  class="border-e border-neutral-800 px-3 py-2 text-lg uppercase"
                >
                  Id transaccion
                </th>
                <th
                  scope="col"
                  class="border-e border-neutral-800 px-3 py-2 uppercase text-lg"
                >
                  Tipo
                <th
                  scope="col"
                  class="border-e border-neutral-800 px-3 py-2 uppercase text-lg"
                >
                  monto
                </th>
                <th
                  scope="col"
                  class="border-e border-neutral-800 px-3 py-2 uppercase text-lg"
                >
                  descripcion
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
                  Registrada por
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

                if(isset($_POST["id"])){
                  $respuesta = $instancia->consultaEspecifica($_POST);
                }
                else{
                  $respuesta = $instancia->consultaGeneral();
                }

                foreach($respuesta as $valor){
              ?>
              <tr>
              <td class="whitespace-nowrap border-e border-neutral-800 px-6 py-4 text-lg font-medium"><?php echo $valor['id_transaccion']?></td>
              </td>
              <td class="whitespace-nowrap border-e border-neutral-800 px-6 py-4 text-lg font-medium">
                <?php echo $valor['tipo']?>
              </td>
              <td class="whitespace-nowrap border-e border-neutral-800 px-6 py-4 text-lg font-medium">
                <?php echo $valor['monto']?>
              </td>
              <td class="whitespace-nowrap border-e border-neutral-800 px-6 py-4 text-lg font-medium">
                <?php echo $valor['descripcion']?>
              </td>
              <td class="whitespace-nowrap border-e border-neutral-800 px-6 py-4 text-lg font-medium">
                <?php echo $valor['fecha']?>
              </td>
              <td class="whitespace-nowrap border-e border-neutral-800 px-6 py-4 text-lg font-medium">
                <?php echo $valor['nombre']?>
              </td>
              <td class="whitespace-nowrap border-e border-neutral-800 px-6 py-4 text-lg font-medium">
                <a href="consultaModFinanzas.php?section=finanzas&&id=<?php echo $valor['id_transaccion']; ?>" class="text-xl font-bold hover:text-yellow-500">
                  <ion-icon name="create-outline"></ion-icon>
                </a>
              </td>
              <td class="whitespace-nowrap border-e border-neutral-800 px-6 py-4 text-lg font-medium">
                <a href="finanzas.php?section=finanzas&&id=<?php echo $valor['id_transaccion'] ?>" class="text-xl font-bold hover:text-red-500">
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
          <section class="w-full h-full justify-center items-center seccion flex-col" id="registerFinanzas">
            <h2 class="text-3xl font-semibold">Registrar Finanzas</h2>
            <form action="../controllers/finanza/registro.php" method="POST" class="w-1/2" enctype="multipart/form-data" id="form-finance">
             
            <div class="mb-5">
                <label
                  for="tipo"
                  class="mb-3 block text-base font-medium text-[#07074D]"
                >
                  Tipo de transaccion:
                </label>
                <select
                  name="tipo"
                  id="tipo"
                  class="w-full rounded-md border border-slate-300 bg-white py-3 px-6 text-base font-medium outline-none focus:border-lime-600 focus:shadow-md"
                >
                <option value="">-</option>
                <option value="1">Ingreso</option>
                <option value="2">Egreso</option>
              </select>
              <p id="mensaje-tipo" class="text-base text-center font-medium mb-4"></p>
              </div>

            <div class="mb-5">
                <label
                  for="monto"
                  class="mb-3 block text-base font-medium text-[#07074D]"
                >
                  Monto:
                </label>
                <input
                  type="number"
                  name="monto"
                  id="monto"
                  class="w-full rounded-md border border-slate-300 bg-white py-3 px-6 text-base font-medium outline-none focus:border-lime-600 focus:shadow-md"
                />
                <p id="mensaje-monto" class="text-base text-center font-medium mb-4"></p>
              </div>

              <div class="mb-5">
                <label
                  for="descripcion"
                  class="mb-3 block text-base font-medium text-[#07074D]"
                >
                  descripcion:
                </label>
                <input
                  type="text"
                  name="descripcion"
                  id="descripcion"
                  class="w-full rounded-md border border-slate-300 bg-white py-3 px-6 text-base font-medium outline-none focus:border-lime-600 focus:shadow-md"
                />
                <p id="mensaje-descripcion" class="text-base text-center font-medium mb-4"></p>
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
              <h2 class="text-3xl font-semibold mb-4 text-center">¿Estas seguro de eliminar esta transaccion?</h2>
              <div class="flex justify-evenly">
              <button class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-75" onclick="window.location.href='finanzas.php?section=finanzas'">Cancelar</button>
              <form action="../controllers/finanza/eliminar.php" method="post">
                <input type="hidden" name="id_transaccion" value="<?php echo $_GET['id'] ?>">
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
