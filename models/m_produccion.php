<?php
  class produccion{
    private $id_produccion;
    private $tipo_produccion;
    private $cantidad;
    private $fecha;
    private $animal;

    public function consultaGeneral(){
      include "conexion.php";
      $consulta = $conexion->prepare("CALL ConsultaGeneralProduccion()");
      $consulta->execute();

      $tabla = $consulta->fetchAll(PDO::FETCH_ASSOC);
      return $tabla;
    }

    public function consultaEspecifica($id){
      $this->id_produccion = $id['id'];

      include "conexion.php";
      $consulta = $conexion->prepare("CALL ConsultarProduccionPorID(?)");
      $consulta->bindParam(1,$this->id_produccion);
      $consulta->execute();

      $tabla = $consulta->fetchAll(PDO::FETCH_ASSOC);
      return $tabla;
    }
  }
?>