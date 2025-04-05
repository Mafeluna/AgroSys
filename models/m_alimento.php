<?php
  class alimento{
    private $id_alimento;
    private $descripcion;
    private $cantidad;

    public function consultaGeneral(){
      include "conexion.php";
      $consulta = $conexion->prepare("CALL ConsultaGeneralAlimento()");
      $consulta->execute();

      $tabla = $consulta->fetchAll(PDO::FETCH_ASSOC);
      return $tabla;
    }

    public function consultaEspecifica($id){
      $this->id_alimento = $id['id'];

      include "conexion.php";
      $consulta = $conexion->prepare("CALL ConsultarAlimentoPorID(?)");
      $consulta->bindParam(1,$this->id_alimento);
      $consulta->execute();

      $tabla = $consulta->fetchAll(PDO::FETCH_ASSOC);
      return $tabla;
    }
  }

?>