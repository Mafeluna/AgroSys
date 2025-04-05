<?php
  class finanza{
    private $id_transaccion;

    public function consultaGeneral(){
      include "conexion.php";
      $consulta = $conexion->prepare("CALL ConsultaGeneralFinanzas()");
      $consulta->execute();

      $tabla = $consulta->fetchAll(PDO::FETCH_ASSOC);
      return $tabla;
    }

    public function consultaEspecifica($id){
      $this->id_transaccion = $id['id'];

      include "conexion.php";
      $consulta = $conexion->prepare("CALL ConsultarfinanzasPorID(?)");
      $consulta->bindParam(1,$this->id_transaccion);
      $consulta->execute();

      $tabla = $consulta->fetchAll(PDO::FETCH_ASSOC);
      return $tabla;
    }
  }

?>