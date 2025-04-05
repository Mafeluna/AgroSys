<?php
  include "../../models/m_usuario.php";
  $instancia = new usuario();
  $respuesta = $instancia->login($_POST);

  if(empty($respuesta)){
    header("Location: ../../views/login.php?error=true");
  } else{
    session_start();
    $_SESSION['id_usuario'] = $respuesta[0]['id_usuario'];
    $_SESSION['nombre'] = $respuesta[0]['nombre'];
    $_SESSION['rol'] = $respuesta[0]['rol'];
    header("Location: ../../views/inicio.php?section=inicio");
  }
?>