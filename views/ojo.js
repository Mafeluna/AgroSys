function togglePasswordVisibility() {
  const passwordInput = document.getElementById("clave");
  const eyeIcon = document.getElementById("eye-icon");
  if (passwordInput.type === "password") {
    passwordInput.type = "text";
    eyeIcon.name = "eye-off";
  } else {
    passwordInput.type = "password";
    eyeIcon.name = "eye";
  }
}
