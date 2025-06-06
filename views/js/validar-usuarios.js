const form = document.getElementById("form-users");

form.addEventListener("submit", function (event) {
  // Campos
  const nombre = document.getElementById("nombre");
  const apellido = document.getElementById("apellido");
  const documento = document.getElementById("documento");
  const correo = document.getElementById("email");
  const clave = document.getElementById("clave");
  const rol = document.getElementById("rol");
  const telefono = document.getElementById("telefono");
  const direccion = document.getElementById("direccion");

  // Mensajes
  const mNombre = document.getElementById("mensaje-nombre");
  const mApellido = document.getElementById("mensaje-apellido");
  const mDocumento = document.getElementById("mensaje-documento");
  const mCorreo = document.getElementById("mensaje-correo");
  const mClave = document.getElementById("mensaje-clave");
  const mRol = document.getElementById("mensaje-rol");
  const mTelefono = document.getElementById("mensaje-telefono");
  const mDireccion = document.getElementById("mensaje-direccion");

  // Regex
  const regexNombre = /^[A-ZÁÉÍÓÚÑ][a-záéíóúñ]+(?:\s[A-ZÁÉÍÓÚÑ][a-záéíóúñ]+)*$/;
  const regexApellido =
    /^[A-ZÁÉÍÓÚÑ][a-záéíóúñ]+(?:\s[A-ZÁÉÍÓÚÑ][a-záéíóúñ]+)?$/;
  const regexDocumento = /^\d{6,10}$/;
  const regexCorreo = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
  const regexClave = /^.{6,}$/;
  const regexTelefono = /^3\d{9}$/;
  const regexDireccion = /^[a-zA-Z0-9\s\.,#\-ºªáéíóúÁÉÍÓÚñÑ]+$/;

  let hayError = false;

  // Validaciones individuales
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

  if (
    !regexApellido.test(apellido.value.trim()) ||
    apellido.value.trim() === ""
  ) {
    apellido.classList.add("border-red-300");
    mApellido.textContent = "¡Apellido no válido!";
    mApellido.classList.add("text-red-500");
    hayError = true;
  } else {
    apellido.classList.remove("border-red-300");
    mApellido.textContent = "";
    mApellido.classList.remove("text-red-500");
  }

  if (
    !regexDocumento.test(documento.value.trim()) ||
    documento.value.trim() === ""
  ) {
    documento.classList.add("border-red-300");
    mDocumento.textContent = "¡Documento no válido!";
    mDocumento.classList.add("text-red-500");
    hayError = true;
  } else {
    documento.classList.remove("border-red-300");
    mDocumento.textContent = "";
    mDocumento.classList.remove("text-red-500");
  }

  if (!regexCorreo.test(correo.value.trim()) || correo.value.trim() === "") {
    correo.classList.add("border-red-300");
    mCorreo.textContent = "¡Correo no válido!";
    mCorreo.classList.add("text-red-500");
    hayError = true;
  } else {
    correo.classList.remove("border-red-300");
    mCorreo.textContent = "";
    mCorreo.classList.remove("text-red-500");
  }

  if (!regexClave.test(clave.value.trim()) || clave.value.trim() === "") {
    clave.classList.add("border-red-300");
    mClave.textContent = "¡Clave no válida!";
    mClave.classList.add("text-red-500");
    hayError = true;
  } else {
    clave.classList.remove("border-red-300");
    mClave.textContent = "";
    mClave.classList.remove("text-red-500");
  }

  if (rol.value.trim() === "") {
    rol.classList.add("border-red-300");
    mRol.textContent = "¡Rol no válido!";
    mRol.classList.add("text-red-500");
    hayError = true;
  } else {
    rol.classList.remove("border-red-300");
    mRol.textContent = "";
    mRol.classList.remove("text-red-500");
  }

  if (
    !regexTelefono.test(telefono.value.trim()) ||
    telefono.value.trim() === ""
  ) {
    telefono.classList.add("border-red-300");
    mTelefono.textContent = "¡Teléfono no válido!";
    mTelefono.classList.add("text-red-500");
    hayError = true;
  } else {
    telefono.classList.remove("border-red-300");
    mTelefono.textContent = "";
    mTelefono.classList.remove("text-red-500");
  }

  if (
    !regexDireccion.test(direccion.value.trim()) ||
    direccion.value.trim() === ""
  ) {
    direccion.classList.add("border-red-300");
    mDireccion.textContent = "¡Dirección no válida!";
    mDireccion.classList.add("text-red-500");
    hayError = true;
  } else {
    direccion.classList.remove("border-red-300");
    mDireccion.textContent = "";
    mDireccion.classList.remove("text-red-500");
  }

  if (hayError) {
    event.preventDefault();
  }
});
