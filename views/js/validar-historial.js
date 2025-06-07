const form = document.getElementById("form-history");

form.addEventListener("submit", function (event) {
  //Campos
  const animal = document.getElementById("animal");
  const descripcion = document.getElementById("descripcion");
  const tratamiento = document.getElementById("tratamiento");

  //Mensajes
  const mAnimal = document.getElementById("mensaje-animal");
  const mDescripcion = document.getElementById("mensaje-descripcion");
  const mTratamiento = document.getElementById("mensaje-tratamiento");

  //Regex
  const regexDescripcion = /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ.,:;()\-¿?!¡"'\s]{3,100}$/;

  let hayError = false;

  //Validaciones individuales
  if (animal.value.trim() === "") {
    animal.classList.add("border-red-300");
    mAnimal.textContent = "¡Animal no válido!";
    mAnimal.classList.add("text-red-500");
    hayError = true;
  } else {
    animal.classList.remove("border-red-300");
    mAnimal.textContent = "";
    mAnimal.classList.remove("text-red-500");
  }

  if (
    !regexDescripcion.test(descripcion.value.trim()) ||
    descripcion.value.trim() === ""
  ) {
    descripcion.classList.add("border-red-300");
    mDescripcion.textContent = "¡Descripción no válida!";
    mDescripcion.classList.add("text-red-500");
    hayError = true;
  } else {
    descripcion.classList.remove("border-red-300");
    mDescripcion.textContent = "";
    mDescripcion.classList.remove("text-red-500");
  }

  if (
    !regexDescripcion.test(tratamiento.value.trim()) ||
    tratamiento.value.trim() === ""
  ) {
    tratamiento.classList.add("border-red-300");
    mTratamiento.textContent = "¡Tratamiento no válido!";
    mTratamiento.classList.add("text-red-500");
    hayError = true;
  } else {
    tratamiento.classList.remove("border-red-300");
    mTratamiento.textContent = "";
    mTratamiento.classList.remove("text-red-500");
  }

  if (hayError) {
    event.preventDefault();
  }
});
