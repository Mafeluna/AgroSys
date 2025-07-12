<?php
  session_start();
  if(empty($_SESSION)){
    header("Location: login.php");
  }

  include "../models/m_animal.php";
  include "../models/m_especie.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>AgroSys | Animales</title>
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
    <script src="js/validar-animales.js" defer></script>
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
            onclick="mostrarSeccion('registerAnimal')"
          >
            <ion-icon name="add-outline"></ion-icon>
            Registrar Animal
          </button>
          <button
            id="btn-user"
            class="bg-green-300 duration-150 rounded-xl drop-shadow-lg group flex items-center border-2 border-b-4 border-blue-950 cursor-pointer p-3 font-semibold hover:bg-yellow-400x"
            onclick="window.open('../controllers/animal/excel.php', '_blank')"
          >
            Generar Excel
          </button>
          <?php
            $instancia3 = new especie();
            $especies = $instancia3->consultaGeneral();
            foreach($especies as $especie){
          ?>
          <button
            id="btn-user"
            class="bg-blue-300 duration-150 hover:!border-b-2 text-blue-950 rounded-xl drop-shadow-lg group flex items-center border-2 border-b-4 border-blue-950 cursor-pointer p-3 font-semibold hover:bg-yellow-400x"
            onclick="mostrarSeccion('consulta<?php echo $especie['nombre']?>')"
          >
            Consultar <?php echo $especie['nombre']."s"?>
          </button>
          <?php } ?>
        </header>
        <article class="w-full p-5">
          <?php foreach($especies as $especie){ ?>
          <!-- consulta -->
          <section class="w-full <?php if ($especie['id_especie'] == 1){?>activesection<?php } ?> seccion justify-center gap-10 items-center flex-wrap flex-col" id="consulta<?php echo $especie['nombre'] ?>">
            <h1 class="uppercase text-3xl text-center"><?php echo $especie['nombre'] ?>s</h1>
            <form action="" class="flex gap-10 w-1/3" method="post">
              <input
                name = "codigo"
                type="text"
                placeholder="Buscar por codigo..."
                class="w-3/4 pl-10 pr-4 py-2 rounded-2xl shadow-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
              />
              <button class="bg-blue-300 duration-150 hover:!border-b-2 text-blue-950 rounded-xl drop-shadow-lg group flex items-center border-2 border-b-4 border-blue-950 cursor-pointer p-3 font-semibold hover:bg-yellow-400x">
              <ion-icon name="search-outline"></ion-icon>
              </button>
            </form>
            <form action="../controllers/animal/generar_pdf_animales.php" method="GET">
              <input type="hidden" name="especie" value="<?php echo $especie['nombre'] ?>">
              <button class="bg-red-300 duration-150 hover:!border-b-2 text-blue-950 rounded-xl drop-shadow-lg group flex items-center border-2 border-b-4 border-blue-950 cursor-pointer p-3 font-semibold" type="submit">Generar PDF <?php echo $especie['nombre']."s" ?></button>
            </form>
            <div class="flex justify-center gap-10 items-center flex-wrap">
            <?php
              $instancia = new animal();
              if(isset($_POST["codigo"])){
                $respuesta = $instancia->consultaPorEspecieEspecifica($especie['nombre'],$_POST["codigo"]);
              }
              else{
                $respuesta = $instancia->consultaPorEspecie($especie['nombre']);
              }
              foreach($respuesta as $valor){
              //$imagenA = base64_encode($valor['foto']);
            ?>
            
              <div
            class="bg-white flex flex-col mt-6 text-gray-700 shadow-md bg-clip-border rounded-xl w-96"
          >
            <div class="p-6">
              <h5
                class="mb-2 font-sans text-2xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900 text-center"
              >
                <?php echo $valor['nombre'] ?>
              </h5>
              <p
                class="block font-sans text-base antialiased font-light leading-relaxed text-inherit"
              >
                <b>Id: </b> <?php echo $valor['id_animal'] ?>
              </p>
              <p
                class="block font-sans text-base antialiased font-light leading-relaxed text-inherit"
              >
                <b>Código: </b> <?php echo $valor['nombre'] ?>
              </p>
              <p
                class="block font-sans text-base antialiased font-light leading-relaxed text-inherit"
              >
                <b>Especie: </b> <?php echo $valor['especie'] ?>
              </p>
              <p
                class="block font-sans text-base antialiased font-light leading-relaxed text-inherit"
              >
                <b>Peso: </b> <?php echo $valor['peso']." KG" ?>
              </p>
              <p
                class="block font-sans text-base antialiased font-light leading-relaxed text-inherit"
              >
                <b>Fecha de Ingreso: </b> <?php echo $valor['fecha_ingreso']?>
              </p>
              <p
                class="block font-sans text-base antialiased font-light leading-relaxed text-inherit"
              >
                <b>Registrado por: </b> <?php echo $valor['nombre_user']." ".$valor['apellido_user'] ?>
              </p>
            </div>
            <div class="p-6 pt-0 flex justify-end gap-5">
              <a href="consultaModAnimal.php?section=animales&&id_animal=<?php echo $valor['id_animal']; ?>" class="text-2xl text-yellow-500">
                <ion-icon name="create-outline"></ion-icon>                
              </a>
              <a href="animales.php?section=animales&&id=<?php echo $valor['id_animal'] ?>&&especie=<?php echo $valor['id_especie'] ?>">
                <ion-icon name="trash-outline" class="text-2xl text-red-500"></ion-icon>
              </a>
            </div>
          </div>
            <?php
              }
            ?>
          </div>


          </section>
          <?php
          }
            $instancia2 = new especie();
            $respuesta2 = $instancia2->consultaGeneral();
          ?>
          <!-- registro -->
          <section class="w-full h-full justify-center items-center seccion flex-col" id="registerAnimal">
            <h2 class="text-3xl font-semibold">Registrar Animal</h2>
            <form action="../controllers/animal/registro.php" method="POST" class="w-1/2" enctype="multipart/form-data" id="form-animals">
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
                  required
                >
                  <option value="" selected>-</option>
                  <?php
                    foreach($respuesta2 as $especie){
                  ?>
                    <option value="<?php echo $especie['id_especie'] ?>"><?php echo $especie['nombre'] ?></option>
                  <?php
                    }
                  ?>
              </select>
              <p id="mensaje-especie" class="text-base text-center font-medium mb-4"></p>
              </div>
              <div class="mb-5">
                <label
                  for="peso"
                  class="mb-3 block text-base font-medium text-[#07074D]"
                >
                  Peso(Kg):
                </label>
                <input
                  type="number"
                  name="peso"
                  id="peso"
                  class="w-full rounded-md border border-slate-300 bg-white py-3 px-6 text-base font-medium outline-none focus:border-lime-600 focus:shadow-md"
                  required
                />
                <p id="mensaje-peso" class="text-base text-center font-medium mb-4"></p>
              </div>
              <!-- <p class="mb-3 block text-base font-medium text-[#07074D]">Foto:</p>
              <div class="image-container flex justify-center items-center rounded-md border border-slate-300 w-full focus:outline-none focus:border-blue-400">
                <label>
                    <img class="profile-image object-cover" src="../images/siluetaAnimal.jpg" alt="Imagen de animal" id="preview-image" style="width:30%;position:relative;left:35%">
                    <div class="camera-icon">
                        <ion-icon name="camera"></ion-icon>
                    </div>
                    <input type="file" class="hidden" id="file-input" name="foto" id="fotoP" accept="image/*" onchange="mostrarImagenPreview(event)">
                </label>
              </div> -->
              <!-- <script>
                  function mostrarImagenPreview(event) {
                      const input = event.target;
                      const reader = new FileReader();

                      reader.onload = function () {
                          const preview = document.getElementById('preview-image');
                          preview.src = reader.result;
                      };

                      if (input.files && input.files[0]) {
                          reader.readAsDataURL(input.files[0]);
                      }
                  }
              </script> -->
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
        <!-- modal eliminar -->
        <?php if(isset($_GET['id'])){ ?>
        <div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
          <div class="bg-white p-8 rounded-lg shadow-lg max-w-sm w-full">
              <h2 class="text-3xl font-semibold mb-4 text-center">¿Estas seguro de eliminar este animal?</h2>
              <div class="flex justify-evenly">
              <button class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-75" onclick="window.location.href='animales.php?section=animales'">Cancelar</button>
              <form action="../controllers/animal/eliminar.php" method="post">
                <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
                <input type="hidden" name="especie" value="<?php echo $_GET['especie'] ?>">
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
