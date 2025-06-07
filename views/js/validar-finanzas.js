const form = document.getElementById("form-finance");

form.addEventListener("submit", function (event) {
  //Campos
  const tipo = document.getElementById("tipo");
  const monto = document.getElementById("monto");
  const descripcion = document.getElementById("descripcion");

  //Mensajes
  const mTipo = document.getElementById("mensaje-tipo");
  const mMonto = document.getElementById("mensaje-monto");
  const mDescripcion = document.getElementById("mensaje-descripcion");

  //Regex
  const regexMonto = /^\d+(\.\d{1,2})?$/;
  const regexDescripcion = /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ.,:;()\-¿?!¡"'\s]{3,100}$/;

  let hayError = false;

  //Validaciones individuales
  if (tipo.value.trim() === "") {
    tipo.classList.add("border-red-300");
    mTipo.textContent = "¡Tipo no válido!";
    mTipo.classList.add("text-red-500");
    hayError = true;
  } else {
    tipo.classList.remove("border-red-300");
    mTipo.textContent = "";
    mTipo.classList.remove("text-red-500");
  }

  if (!regexMonto.test(monto.value.trim()) || monto.value.trim() === "") {
    monto.classList.add("border-red-300");
    mMonto.textContent = "¡Monto no válido!";
    mMonto.classList.add("text-red-500");
    hayError = true;
  } else {
    monto.classList.remove("border-red-300");
    mMonto.textContent = "";
    mMonto.classList.remove("text-red-500");
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

  if (hayError) {
    event.preventDefault();
  }
});
