const form = document.getElementById("form-animals");

form.addEventListener("submit", function (event) {
  //Campos
  const codigo = document.getElementById("codigo");
  const especie = document.getElementById("especie");
  const peso = document.getElementById("peso");

  //Mensajes
  const mCodigo = document.getElementById("mensaje-codigo");
  const mEspecie = document.getElementById("mensaje-especie");
  const mPeso = document.getElementById("mensaje-peso");

  //Regex
  const regexPeso = /^(?!0+(\.0+)?$)\d{1,4}(\.\d{1,2})?$/;

  let hayError = false;

  //Validaciones individuales
  if (codigo.value.trim() === "") {
    codigo.classList.add("border-red-300");
    mCodigo.textContent = "¡Codigo no válido!";
    mCodigo.classList.add("text-red-500");
    hayError = true;
  } else {
    codigo.classList.remove("border-red-300");
    mCodigo.textContent = "";
    mCodigo.classList.remove("text-red-500");
  }

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

  if (
    !regexPeso.test(peso.value.trim()) ||
    peso.value.trim() === "" ||
    peso.value.trim() === "0,00"
  ) {
    peso.classList.add("border-red-300");
    mPeso.textContent = "¡Peso no válido!";
    mPeso.classList.add("text-red-500");
    hayError = true;
  } else {
    peso.classList.remove("border-red-300");
    mPeso.textContent = "";
    mPeso.classList.remove("text-red-500");
  }

  if (hayError) {
    event.preventDefault();
  }
});
