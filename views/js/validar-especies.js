const form = document.getElementById("form-species");

form.addEventListener("submit", function (event) {
  //Campos
  const nombre = document.getElementById("nombre");

  //Mensajes
  const mNombre = document.getElementById("mensaje-nombre");

  //Regex
  const regexNombre = /^[A-ZÁÉÍÓÚÑ][a-záéíóúñ]+(?:\s[A-ZÁÉÍÓÚÑ][a-záéíóúñ]+)*$/;

  let hayError = false;

  //Validaciones individuales
  if (!regexNombre.test(nombre.value.trim()) || nombre.value.trim() === "") {
    nombre.classList.add("border-red-300");
    mNombre.textContent = "¡Nombre no válido!";
    mNombre.classList.add("text-red-500");
    hayError = true;
  } else {
    nombre.classList.remove("border-red-300");
    mNombre.textContent = "";
    mNombre.classList.remove("text-red-500");
  }

  if (hayError) {
    event.preventDefault();
  }
});
