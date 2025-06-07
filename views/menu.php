      <nav
        class="flex flex-col top-14 w-14 left-0 hover:w-64 md:w-64 bg-lime-600 text-white transition-all duration-300 border-none sidebar"
        style="height: 90vh"
      >
        <div
          class="overflow-y-auto overflow-x-hidden flex flex-col justify-between flex-grow"
        >
          <ul class="flex flex-col py-4 space-y-1">
            <li>
              <a
                href="inicio.php?section=inicio"
                class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-white hover:text-lime-600 border-l-4 border-green-500 hover:border-green-500 pr-6 <?php if(isset($_GET['section']) && $_GET['section']== "inicio") echo "bg-white text-lime-600" ?>"
              >
                <span class="inline-flex justify-center items-center ml-4">
                  <ion-icon name="home-outline"></ion-icon>
                </span>
                <span class="ml-2 text-lg tracking-wide truncate"
                  >Inicio</span
                >
              </a>
            </li>
            <li></li>
            <li class="px-5 hidden md:block">
              <div class="flex flex-row items-center h-8">
                <div
                  class="text-sm tracking-wide text-white uppercase font-bold"
                >
                  Modulos
                </div>
              </div>
            </li>
              <?php
                if($_SESSION['rol']== "Administrador"){
              ?>
            <li>
              <a
                href="usuarios.php?section=usuarios"
                class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-white hover:text-lime-600 border-l-4 border-green-500 hover:border-green-500 pr-6<?php if(isset($_GET['section']) && $_GET['section']== "usuarios") echo " text-lime-600 bg-white" ?>"
              >
                <span class="inline-flex justify-center items-center ml-4">
                  <ion-icon name="person-outline"></ion-icon>
                </span>
                <span class="ml-2 text-lg tracking-wide truncate"
                  >Usuarios</span
                >
              </a>
            </li>
             <?php } ?>
              <li>
              <a
                href="especie.php?section=especies"
                class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-white hover:text-lime-600 border-l-4 border-green-500 hover:border-green-500 pr-6<?php if(isset($_GET['section']) && $_GET['section']== "especies") echo " text-lime-600 bg-white" ?>"
              >
                <span class="inline-flex justify-center items-center ml-4">
                  <ion-icon name="bug-outline"></ion-icon>
                </span>
                <span class="ml-2 text-lg tracking-wide truncate"
                  >Especie</span
                >
              </a>
            </li>
            <li>
              <a
                href="animales.php?section=animales"
                class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-white hover:text-lime-600 border-l-4 border-green-500 hover:border-green-500 pr-6<?php if(isset($_GET['section']) && $_GET['section']== "animales") echo " text-lime-600 bg-white" ?>"
              >
                <span class="inline-flex justify-center items-center ml-4">
                  <ion-icon name="paw-outline"></ion-icon>
                </span>
                <span class="ml-2 text-lg tracking-wide truncate"
                  >Animales</span
                >
              </a>
            </li>
            <li>
              <a
              <?php if($_SESSION['rol']=="Administrador"  ||  $_SESSION['rol']=="Encargado Animales" || $_SESSION['rol']=="Administrador Operario") {?>
                href="alimentos.php?section=alimentos"
                class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-white hover:text-lime-600 border-l-4 border-green-500 hover:border-green-500 pr-6<?php if(isset($_GET['section']) && $_GET['section']== "alimentos") echo " text-lime-600 bg-white" ?>"
              >
                <span class="inline-flex justify-center items-center ml-4">
                  <ion-icon name="logo-apple"></ion-icon>
                </span>
                <span class="ml-2 text-lg tracking-wide truncate">
                  Alimentos
                </span>
              </a>
            </li>
            <?php } ?>
            <?php if($_SESSION['rol']=="Administrador"  ||  $_SESSION['rol']=="Encargado Animales" || $_SESSION['rol']=="Administrador Operario"){ ?>
            <li>
              <a
                href="alimentacion.php?section=alimentacion"
                class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-white hover:text-lime-600 border-l-4 border-green-500 hover:border-green-500 pr-6<?php if(isset($_GET['section']) && $_GET['section']== "alimentacion") echo " text-lime-600 bg-white" ?>"
              >
                <span class="inline-flex justify-center items-center ml-4">
                  <ion-icon name="restaurant-outline"></ion-icon>
                </span>
                <span class="ml-2 text-lg tracking-wide truncate"
                  >Alimentación</span
                >
              </a>
            </li>
            <?php } ?>
            <?php if($_SESSION['rol']=="Administrador" || $_SESSION['rol']=="Encargado de Producción" || $_SESSION['rol']=="Administrador Operario"){ ?>
            <li>
              <a
                href="produccion.php?section=produccion"
                class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-white hover:text-lime-600 border-l-4 border-green-500 hover:border-green-500 pr-6<?php if(isset($_GET['section']) && $_GET['section']== "produccion") echo " text-lime-600 bg-white" ?>"
              >
                <span class="inline-flex justify-center items-center ml-4">
                  <ion-icon name="stats-chart-outline"></ion-icon>
                </span>
                <span class="ml-2 text-lg tracking-wide truncate"
                  >Producción</span
                >
              </a>
            </li>
            <?php } ?>
            <?php if($_SESSION['rol']== "Administrador" || $_SESSION['rol']=="Administrador Operario"){ ?>
            <li>
              <a
                href="finanzas.php?section=finanzas"
                class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-white hover:text-lime-600 border-l-4 border-green-500 hover:border-green-500 pr-6<?php if(isset($_GET['section']) && $_GET['section']== "finanzas") echo " text-lime-600 bg-white" ?>"
              >
                <span class="inline-flex justify-center items-center ml-4">
                  <ion-icon name="logo-usd"></ion-icon>
                </span>
                <span class="ml-2 text-lg tracking-wide truncate"
                  >Finanzas</span
                >
              </a>
            </li>
            <?php } ?>
            <?php if($_SESSION['rol']=="Administrador" || $_SESSION['rol']=="Veterinario" || $_SESSION['rol']=="Administrador Operario"){ ?>
            <li>
              <a
                href="historialmedico.php?section=historial_medico"
                class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-white hover:text-lime-600 border-l-4 border-green-500 hover:border-green-500 pr-6<?php if(isset($_GET['section']) && $_GET['section']== "historial_medico") echo " text-lime-600 bg-white" ?>"
              >
                <span class="inline-flex justify-center items-center ml-4">
                  <ion-icon name="medkit-outline"></ion-icon>
                </span>
                <span class="ml-2 text-lg tracking-wide truncate"
                  >Historial Medico</span
                >
              </a>
            </li>
            <?php } ?>
          </ul>
          <a
            href="../controllers/usuario/logout.php"
            class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-white dark:hover:bg-gray-600 text-white-600 hover:text-lime-800 border-l-4 border-transparent hover:border-green-500 dark:hover:border-gray-800 pr-6"
          >
            <span class="inline-flex justify-center items-center ml-4">
              <ion-icon name="log-out-outline" class="text-3xl"></ion-icon>
            </span>
            <span class="text-lg tracking-wide truncate">Salir </span>
          </a>
        </div>
      </nav>