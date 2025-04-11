<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>AgroSys | Inicio de Sesión</title>
    <link rel="shortcut icon" href="../images/logo.jpg" type="image/x-icon">
    <!-- link tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js">
    </script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script defer src="./ojo.js"></script>
  </head>
  <body class="flex justify-center items-center h-screen w-full bg-lime-200 p-3">
    <section class="p-12 bg-white mx-auto rounded-3xl md:w-1/4 border border-2 border-gray-400 shadow-md shadow-gray-300 w-full">
			<div class="mb-7">
        <div class="flex justify-center">
          <img src="../images/logo.jpg" alt="Logo AgroSys" class="w-1/2">
        </div>
				<h2 class="font-semibold text-3xl text-gray-800 text-center">Inicio de Sesión </h2>
			</div>
			<form action="../controllers/usuario/login.php" method="post">
				<div class="space-y-6">
					<input class=" w-full text-sm  px-4 py-3 bg-gray-200 focus:bg-gray-100 border  border-gray-200 rounded-lg focus:outline-none focus:border-lime-500" type="number" placeholder="Número de Documento" required name="documento">
          <div class="relative">
            <input placeholder="Contraseña" type="password" id="clave" class="text-sm px-4 py-3 rounded-lg w-full bg-gray-200 focus:bg-gray-100 border border-gray-200 focus:outline-none focus:border-lime-500" required name="clave">
            <button type="button" onclick="togglePasswordVisibility()" class="absolute right-3 top-2 text-lime-600 text-2xl">
              <ion-icon id="eye-icon" name="eye"></ion-icon>
            </button>
          </div>
          <?php
            if(isset($_GET['error']) && $_GET['error'] == true){
          ?>
            <p class="font-semibold text-lg text-red-500 text-center">Usuario o Contraseña Incorrecto</p>
          <?php
            }
          ?>
					<div>
						<button class="w-full flex justify-center bg-lime-600  hover:bg-lime-700 text-white p-3  rounded-lg tracking-wide font-semibold  cursor-pointer transition ease-in duration-500">
              Ingresar
            </button>
					</div>
			</form>
    </section>

  </body>
</html>
<script>
  history.pushState(null, null, location.href);
  window.onpopstate = function () {
    history.go(1);
  };
</script>