<?php
  class Usuario {
    private $id_usuario;
    private $nombre;
    private $apellido;
    private $documento;
    private $email;
    private $clave;
    private $rol;
    private $telefono;
    private $direccion;
    private $fecha_registro;

    public function login($datos){
      $this->documento = $datos['documento'];
      $this->clave = $datos['clave'];

      include "conexion.php";
      $login = $conexion->prepare("CALL AccesoAlSistema(?,?)");
      $login->bindParam(1,$this->documento);
      $login->bindParam(2,$this->clave);
      $login->execute();

      $tabla = $login->fetchAll(PDO::FETCH_ASSOC);
      return $tabla;
    }

    public function registrar($datos){
      $this->nombre = $datos['nombre'];
      $this->apellido = $datos['apellido'];
      $this->documento = $datos['documento'];
      $this->email = $datos['email'];
      $this->clave = $datos['clave'];
      $this->rol = $datos['rol'];
      $this->telefono = $datos['telefono'];
      $this->direccion = $datos['direccion'];

    include "conexion.php";
      $registro = $conexion->prepare("CALL RegistrarUsuario(?,?,?,?,?,?,?,?)");
      $registro->bindParam(1, $this->nombre);
      $registro->bindParam(2, $this->apellido);
      $registro->bindParam(3, $this->documento);
      $registro->bindParam(4, $this->email);
      $registro->bindParam(5, $this->clave);
      $registro->bindParam(6, $this->rol);
      $registro->bindParam(7, $this->telefono);
      $registro->bindParam(8, $this->direccion);
      $registro->execute();

      return 1;
    }

    public function consultaGeneral(){
      include "conexion.php";

      $consulta = $conexion->prepare("CALL ConsultaGeneralUsuario()");
      $consulta->execute();

      $tabla = $consulta->fetchAll(PDO::FETCH_ASSOC);
      return $tabla;
    }

    public function buscarPorDocumento($documento){
      $this->documento = $documento;

      include "conexion.php";
      $consulta = $conexion->prepare("CALL ConsultarUsuarioPorDocumento(?)");
      $consulta->bindParam(1, $this->documento);
      $consulta->execute();
      $tabla = $consulta->fetchAll(PDO::FETCH_ASSOC);

      return $tabla;
    }

    public function modificarDatos($datos){
      $this->id_usuario = $datos['id_usuario'];
      $this->nombre = $datos['nombre'];
      $this->apellido = $datos['apellido'];
      $this->documento = $datos['documento'];
      $this->email = $datos['email'];
      $this->rol = $datos['rol'];
      $this->telefono = $datos['telefono'];
      $this->direccion = $datos['direccion'];
      
      include "conexion.php";
      $actualizar = $conexion->prepare("CALL ModificarUsuario(?,?,?,?,?,?,?,?)");
      $actualizar->bindParam(1, $this->id_usuario);
      $actualizar->bindParam(2, $this->nombre);
      $actualizar->bindParam(3, $this->apellido);
      $actualizar->bindParam(4, $this->documento);
      $actualizar->bindParam(5, $this->email);
      $actualizar->bindParam(6, $this->rol);
      $actualizar->bindParam(7, $this->telefono);
      $actualizar->bindParam(8, $this->direccion);
      $actualizar->execute();

      return 1;
    }

    public function eliminarUsuario($datos){
      $this->id_usuario = $datos['id_usuario'];

      include "conexion.php";
      $eliminar = $conexion->prepare("CALL EliminarUsuario(?)");
      $eliminar->bindParam(1,$this->id_usuario);
      $eliminar->execute();

      return 1;
    }
  }

?>