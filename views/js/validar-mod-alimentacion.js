const form = document.getElementById("form-mod-alimentation");

form.addEventListener("submit", function (event) {
  //Campos
  const cantidad = document.getElementById("cantidad");

  //Mensajes
  const mCantidad = document.getElementById("mensaje-cantidad");

  //Regex
  const regexCantidad = /^(?!0+(?:\.0+)?$)\d{1,4}(\.\d{1,2})?$/;

  let hayError = false;

  //Validaciones individuales
  if (
    !regexCantidad.test(cantidad.value.trim()) ||
    cantidad.value.trim() === ""
  ) {
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
