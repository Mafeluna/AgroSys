function mostrarSeccion(seccionId) {
  const secciones = document.querySelectorAll(".seccion");
  secciones.forEach((seccion) => {
    seccion.classList.remove("activesection");
  });

  const seccionMostrar = document.getElementById(seccionId);
  seccionMostrar.classList.add("activesection");
}
