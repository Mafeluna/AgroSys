<?php
  session_start();
  if(empty($_SESSION)){
    header("Location: login.php");
  }

  include "../models/m_usuario.php";
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
          <div class="w-1/3 flex justify-between">
          <button
            id="btn-user"
            class="bg-green-500 duration-150 rounded-xl drop-shadow-lg group flex items-center border-2 border-b-4 border-blue-950 cursor-pointer p-3 font-semibold hover:bg-yellow-400x"
            onclick="mostrarSeccion('registerUser')"
          >
            <ion-icon name="add-outline"></ion-icon>
            Registrar Usuario
          </button>
          <button
            id="btn-user"
            class="bg-blue-300 duration-150 hover:!border-b-2 text-blue-950 rounded-xl drop-shadow-lg group flex items-center border-2 border-b-4 border-blue-950 cursor-pointer p-3 font-semibold hover:bg-yellow-400x"
            onclick="mostrarSeccion('consultaUser');window.location.href='usuarios.php?section=usuarios'"
          >
            Consultar Usuarios
          </button>
          <button
            id="btn-user"
            class="bg-red-300 duration-150 hover:!border-b-2 text-blue-950 rounded-xl drop-shadow-lg group flex items-center border-2 border-b-4 border-blue-950 cursor-pointer p-3 font-semibold hover:bg-yellow-400x"
            onclick="window.open('../controllers/usuario/generarpdf.php', '_blank')"
          >
            Generar PDF
          </button>
          </div>
        </header>
        <article class="w-full p-5">
          <section class="w-full activesection seccion flex-col justify-center items-center" id="consultaUser">
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
                  documento
                </th>
                <th
                  scope="col"
                  class="border-e border-neutral-800 px-3 py-2 uppercase text-lg"
                >
                  email
                </th>
                <th
                  scope="col"
                  class="border-e border-neutral-800 px-3 py-2 uppercase text-lg"
                >
                  rol
                </th>
                <th
                  scope="col"
                  class="border-e border-neutral-800 px-3 py-2 uppercase text-lg"
                >
                  telefono
                </th>
                <th
                  scope="col"
                  class="border-e border-neutral-800 px-3 py-2 uppercase text-lg"
                >
                  direccion
                </th>
                <th
                  scope="col"
                  class="border-e border-neutral-800 px-3 py-2 uppercase text-lg"
                >
                  fecha de registro
                </th>
                <th
                  scope="col"
                  class="border-e border-neutral-800 px-3 py-2 uppercase text-lg"
                >
                notificar
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
    $instancia = new usuario();
    if(isset($_POST['documento'])){
      $respuesta = $instancia->buscarPorDocumento($_POST['documento']);
    } else {
      $respuesta = $instancia->consultaGeneral();
    }
    foreach($respuesta as $valor){
  ?>
  <tr>
  <td class="whitespace-nowrap border-e border-neutral-800 px-6 py-4 text-lg font-medium"><?php echo $valor['id_usuario']?></td>
  <td class="whitespace-nowrap border-e border-neutral-800 px-6 py-4 text-lg font-medium">
    <?php echo $valor['nombre']." ".$valor['apellido'] ?>
  </td>
  <td class="whitespace-nowrap border-e border-neutral-800 px-6 py-4 text-lg font-medium">
    <?php echo $valor['documento']?>
  </td>
  <td class="whitespace-nowrap border-e border-neutral-800 px-6 py-4 text-lg font-medium">
    <?php echo $valor['email']?>
  </td>
  <td class="whitespace-nowrap border-e border-neutral-800 px-6 py-4 text-lg font-medium">
    <?php echo $valor['rol']?>
  </td>
  <td class="whitespace-nowrap border-e border-neutral-800 px-6 py-4 text-lg font-medium">
    <?php echo $valor['telefono']?>
  </td>
  <td class="whitespace-nowrap border-e border-neutral-800 px-6 py-4 text-lg font-medium">
    <?php echo $valor['direccion']?>
  </td>
  <td class="whitespace-nowrap border-e border-neutral-800 px-6 py-4 text-lg font-medium">
    <?php echo $valor['fecha_registro']?>
  </td>

  <td class="whitespace-nowrap border-e border-neutral-800 px-6 py-4 text-lg font-medium">
    <button onclick="toggleMensaje(this)" class="text-blue-700 text-2xl hover:text-blue-900">
      <ion-icon name="chatbox-ellipses-outline"></ion-icon>
    </button>
    <div class="mt-2 hidden">
    <form action="../controllers/usuario/correo_autom.php" method="POST"
    class="flex flex-col gap-2 mt-2">
        <input type="hidden" name="correo_destino" value="<?php echo $valor['email']; ?>">
        <textarea name="mensaje" rows="2" placeholder="Escribe tu mensaje..." class="w-full p-2 border border-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600"></textarea>
        <button type="submit" class="self-start px-4 py-1 bg-blue-700 hover:bg-blue-800 text-white rounded-lg text-sm font-semibold">
          Enviar
        </button>
      </form>
    </div>
  </td>

  <td class="whitespace-nowrap border-e border-neutral-800 px-6 py-4 text-lg font-medium">
    <a href="consultaModUser.php?section=usuarios&&id=<?php echo $valor['documento'] ?>" class="text-xl font-bold hover:text-yellow-500">
      <ion-icon name="create-outline"></ion-icon>
    </a>
  </td>

  <td class="whitespace-nowrap border-e border-neutral-800 px-6 py-4 text-lg font-medium">
    <a href="usuarios.php?section=usuarios&&id=<?php echo $valor['id_usuario'] ?>" class="text-xl font-bold hover:text-red-500">
      <ion-icon name="trash-outline"></ion-icon>
    </a>
  </td>
</tr>

  <?php } ?>
</tbody>

          </table>
        </section>
        <section class="w-full h-full justify-center items-center seccion flex-col" id="registerUser">
          <h2 class="text-3xl font-semibold">Registrar Usuario</h2>
          <form action="../controllers/usuario/registro.php" method="POST" class="w-1/2">
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
              />
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
              />
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
              />
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
              />
            </div>
            <div class="mb-5 relative">
              <label
                for="clave"
                class="mb-3 block text-base font-medium text-[#07074D]"
              >
                Contraseña:
              </label>
              <input
                type="password"
                name="clave"
                id="clave"
                class="w-full rounded-md border border-slate-300 bg-white py-3 px-6 text-base font-medium outline-none focus:border-lime-600 focus:shadow-md"
                required
              />
              <button type="button" onclick="togglePasswordVisibility()" class="absolute right-3 top-12 text-lime-600 text-2xl">
                <ion-icon id="eye-icon" name="eye"></ion-icon>
              </button>
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
                <option value="" selected>-</option>
                <option value="1">Administrador</option>
                <option value="2">Encargado Animales</option>
                <option value="3">Encargado produccion</option>
                <option value="4">Veterinario</option>
            </select>
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
              />
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
              />
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
              <h2 class="text-3xl font-semibold mb-4 text-center">¿Estas seguro de eliminar este usuario?</h2>
              <div class="flex justify-evenly">
              <button class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-75" onclick="window.location.href='usuarios.php?section=usuarios'">Cancelar</button>
              <form action="../controllers/usuario/eliminar.php" method="post">
                <input type="hidden" name="id_usuario" value="<?php echo $_GET['id'] ?>">
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
    <script>
function toggleMensaje(btn) {
  const contenedor = btn.closest('td').querySelector('div');
  contenedor.classList.toggle('hidden');
}
</script>

  </body>
</html>
