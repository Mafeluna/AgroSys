const form = document.getElementById("form-foods");

form.addEventListener("submit", function (event) {
  //Campos
  const descripcion = document.getElementById("descripcion");
  const cantidad = document.getElementById("cantidad");
  const tipoMedida = document.getElementById("tipo_medida");
  const especie = document.getElementById("especie");

  //Mensajes
  const mDescripcion = document.getElementById("mensaje-descripcion");
  const mCantidad = document.getElementById("mensaje-cantidad");
  const mTipoMedida = document.getElementById("mensaje-tipoMedida");
  const mEspecie = document.getElementById("mensaje-especie");

  //Regex
  const regexDescripcion = /^[A-Za-zÁÉÍÓÚáéíóúÑñ0-9(),.\-°"'\s]{7,200}$/;
  const regexCantidad = /^(?!0+(?:\.0+)?$)\d{1,4}(\.\d{1,2})?$/;

  let hayError = false;

  //Validaciones individuales
  if (
    !regexDescripcion.test(descripcion.value.trim()) ||
    descripcion.value.trim() === ""
  ) {
    descripcion.classList.add("border-red-300");
    mDescripcion.textContent = "¡Descripción no válido!";
    mDescripcion.classList.add("text-red-500");
    hayError = true;
  } else {
    descripcion.classList.remove("border-red-300");
    mDescripcion.textContent = "";
    mDescripcion.classList.remove("text-red-500");
  }

  // Validaciones individuales
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

  // Validaciones individuales
  if (tipoMedida.value.trim() === "") {
    tipoMedida.classList.add("border-red-300");
    mTipoMedida.textContent = "¡Tipo de Medida no válido!";
    mTipoMedida.classList.add("text-red-500");
    hayError = true;
  } else {
    tipoMedida.classList.remove("border-red-300");
    mTipoMedida.textContent = "";
    mTipoMedida.classList.remove("text-red-500");
  }

  // Validaciones individuales
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

  if (hayError) {
    event.preventDefault();
  }
});
