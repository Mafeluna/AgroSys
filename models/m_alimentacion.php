<?php
  class alimentacion{
    private $id_alimentacion;

    public function consultaGeneral(){
      include "conexion.php";
      $consulta = $conexion->prepare("CALL ConsultaGneralAlimentacion()");
      $consulta->execute();

      $tabla = $consulta->fetchAll(PDO::FETCH_ASSOC);
      return $tabla;
    }

    public function consultaEspecifica($id){
      $this->id_alimentacion = $id['id'];

      include "conexion.php";
      $consulta = $conexion->prepare("CALL ConsultarAlimentacionPorID(?)");
      $consulta->bindParam(1,$this->id_alimentacion);
      $consulta->execute();

      $tabla = $consulta->fetchAll(PDO::FETCH_ASSOC);
      return $tabla;
    }

  }

?>