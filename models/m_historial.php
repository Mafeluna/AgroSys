<?php
  class historial{
    private $id_historial;
    private $animal;
    private $fecha;
    private $descripcion;
    private $tratamiento;

    public function consultaGeneral(){
      include "conexion.php";
      $consulta = $conexion->prepare("CALL ConsultaGeneralHistorial()");
      $consulta->execute();

      $tabla = $consulta->fetchAll(PDO::FETCH_ASSOC);
      return $tabla;
    }

    public function consultaEspecifica($id){
      $this->id_historial = $id['id'];

      include "conexion.php";
      $consulta = $conexion->prepare("CALL ConsultarhistorialPorID(?)");
      $consulta->bindParam(1,$this->id_historial);
      $consulta->execute();

      $tabla = $consulta->fetchAll(PDO::FETCH_ASSOC);
      return $tabla;
    }
  } 

?>