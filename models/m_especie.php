<?php
  class especie{
    private $id_especie;
    private $nombre;
    private $cantidad;

    public function registrar($datos){
      $this->nombre = $datos['nombre'];

      //registro
      include "conexion.php";
      $registro = $conexion->prepare("CALL RegistrarEspecie(?)");
      $registro->bindParam(1,$this->nombre);
      $registro->execute();

      return 1;
    }

    public function consultaGeneral(){
      include "conexion.php";
      $consultaG = $conexion->prepare("CALL ConsultaGeneralEspecie()");
      $consultaG->execute();

      $tabla = $consultaG->fetchAll(PDO::FETCH_ASSOC);
      return $tabla;
    }

    public function consultaEspecifica($dato){
      $this->id_especie = $dato['id_especie'];

      include "conexion.php";
      $consulta = $conexion->prepare("CALL ConsultaEspecificaEspecie(?)");
      $consulta->bindParam(1,$this->id_especie);
      $consulta->execute();

      $tabla = $consulta->fetchAll(PDO::FETCH_ASSOC);
      return $tabla;
    }

    public function modificar($datos){
      $this->id_especie = $datos['id_especie'];
      $this->nombre = $datos['nombre'];

      include "conexion.php";
      $modificar = $conexion->prepare("CALL ModificarEspecie(?,?)");
      $modificar->bindParam(1,$this->id_especie);
      $modificar->bindParam(2,$this->nombre);
      $modificar->execute();

      return 1;
    }

    public function eliminar($id){
      $this->id_especie = $id;

      include "conexion.php";
      $eliminar = $conexion->prepare("CALL EliminarEspecie(?)");
      $eliminar->bindParam(1,$this->id_especie);
      $eliminar->execute();

      return 1;
    }
  }
?>