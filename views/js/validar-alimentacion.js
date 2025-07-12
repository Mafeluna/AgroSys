const form = document.getElementById("form-alimentation");

form.addEventListener("submit", function (event) {
  //Campos
  const especie = document.getElementById("especie");
  const alimento = document.getElementById("alimento");
  const cantidad = document.getElementById("cantidad");

  //Mensajes
  const mEspecie = document.getElementById("mensaje-especie");
  const mAlimento = document.getElementById("mensaje-alimento");
  const mCantidad = document.getElementById("mensaje-cantidad");

  //Regex

  let hayError = false;

  //Validaciones individuales
  if (especie.value.trim() === "") {
    especie.classList.add("border-red-300");
    mEspecie.textContent = "¡Especie no válida!";
    mEspecie.classList.add("text-red-500");
    hayError = true;
  } else {
    especie.classList.remove("border-red-300");
    mEspecie.textContent = "";
    mEspecie.classList.remove("text-red-500");
  }

  if (alimento.value.trim() === "") {
    alimento.classList.add("border-red-300");
    mAlimento.textContent = "¡Alimento no válido!";
    mAlimento.classList.add("text-red-500");
    hayError = true;
  } else {
    alimento.classList.remove("border-red-300");
    mAlimento.textContent = "";
    mAlimento.classList.remove("text-red-500");
  }

  if (cantidad.value.trim() === "") {
    cantidad.classList.add("border-red-300");
    mCantidad.textContent = "¡Cantidad no válida!";
    mCantidad.classList.add("text-red-500");
    hayError = true;
  } else {
    cantidad.classList.remove("border-red-300");
    mCantidad.textContent = "";
    mCantidad.classList.remove("text-red-500");
  }

  if (hayError) {
    event.preventDefault();
  }
});
