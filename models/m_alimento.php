<?php
  class alimento{
    private $id_alimento;
    private $descripcion;
    private $cantidad;
    private $especie;

    public function registrar($datos){
      $this->descripcion = $datos['descripcion'];
      $this->cantidad = $datos['cantidad'];
      $this->especie = $datos['especie'];

      include "conexion.php";
      $registro = $conexion->prepare("CALL InsertarAlimento(?,?,?)");
      $registro->bindParam(1,$this->descripcion);
      $registro->bindParam(2,$this->cantidad);
      $registro->bindParam(3,$this->especie);
      $registro->execute();

      return 1;
    }

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

    public function buscarPorId($id){
      include "conexion.php";
      $consulta = $conexion->prepare("SELECT*FROM Alimento WHERE id_alimento = ?");
      $consulta->bindParam(1,$id);
      $consulta->execute();

      $tabla = $consulta->fetchAll(PDO::FETCH_ASSOC);
      return $tabla;
    }

    public function modificar($datos){
      $this->id_alimento = $datos['id_alimento'];
      $this->descripcion = $datos['descripcion'];
      $this->cantidad = $datos['cantidad'];
      $this->especie = $datos['especie'];

      include "conexion.php";
      $modificar = $conexion->prepare("CALL ActualizarAlimento(?,?,?,?)");
      $modificar->bindParam(1,$this->id_alimento);
      $modificar->bindParam(2,$this->descripcion);
      $modificar->bindParam(3,$this->cantidad);
      $modificar->bindParam(4,$this->especie);
      $modificar->execute();

      return 1;
    }

    public function eliminar($id){
      $this->id_alimento = $id;

      include "conexion.php";
      $eliminar = $conexion->prepare("CALL EliminarAlimento(?)");
      $eliminar->bindParam(1,$this->id_alimento);
      $eliminar->execute();

      return 1;
    }
  }

?>