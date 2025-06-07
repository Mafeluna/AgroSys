const form = document.getElementById("form-production");

form.addEventListener("submit",function(event){
    //Campos
    const tipoProduccion = document.getElementById("tipoProduccion");
    const cantidad = document.getElementById("cantidad"); 
    const tipoMedida = document.getElementById("tipoMedida"); 
    const especie = document.getElementById("especie");  
    
    //Mensajes
    const mTipoProduccion = document.getElementById("mensaje-tipoProduccion");
    const mCantidad = document.getElementById("mensaje-cantidad");
    const mTipoMedida = document.getElementById("mensaje-tipoMedida");
    const mEspecie = document.getElementById("mensaje-especie");

    //Regex
    const regexTipoProduccion = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{3,50}$/;
    const regexCantidad = /^(?!0+(?:\.0+)?$)\d{1,4}(\.\d{1,2})?$/;

    let hayError = false;
    
    //Validaciones Individuales
    if (!regexTipoProduccion.test(tipoProduccion.value.trim()) || tipoProduccion.value.trim() === "") {
    tipoProduccion.classList.add("border-red-300");
    mTipoProduccion.textContent = "¡Tipo de Producción no válido!";
    mTipoProduccion.classList.add("text-red-500");
    hayError = true;
  } else {
    tipoProduccion.classList.remove("border-red-300");
    mTipoProduccion.textContent = "";
    mTipoProduccion.classList.remove("text-red-500");
  }

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

  if(hayError){
    event.preventDefault();
  }
});