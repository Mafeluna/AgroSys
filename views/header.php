    <header
      class="w-full flex items-center justify-between text-white z-10 bg-lime-600 px-10"
      style="height: 10vh"
    >
      <div
        class="flex items-center justify-start md:justify-center w-14 md:w-64 h-14 bg-lime-600 dark:bg-gray-800 border-none"
      >
        <img
          class="w-20 h-20 md:w-10 md:h-10 mr-2 rounded-md overflow-hidden"
          src="../images/logo.jpg"
        />
        <h1 class="text-3xl">AGROSYS</h1>
      </div>
      <div>
        <p class="text-lg text-center font-semibold uppercase flex items-center justify-evenly">
          <ion-icon name="person-circle-outline" class="text-2xl"></ion-icon>
          <?php echo $_SESSION['nombre'];?>
        </p>
        <p class="text-lg text-center font-semibold">(<?php echo $_SESSION['rol'];?>)</p>
      </div>
    </header>