<?php
  class animal{
    private $id_animal;
    private $nombre;
    private $especie;
    private $peso;
    private $registrado_por;
    private $foto;
    //
    public function registrar($datos,$user,$image){
      $this->nombre = $datos['nombre'];
      $this->especie = $datos['especie'];
      $this->peso = $datos['peso'];
      $this->registrado_por = $user;
      $this->foto = $image; 

      // registro
      include "conexion.php";
      $registro = $conexion->prepare("CALL RegistrarAnimal(?,?,?,?,?)");
      $registro->bindParam(1,$this->nombre);
      $registro->bindParam(2,$this->especie);
      $registro->bindParam(3,$this->peso);
      $registro->bindParam(4,$this->registrado_por);
      $registro->bindParam(5,$this->foto);
      $registro->execute();

      return 1;
    }

    public function consultaGeneral(){
        include "conexion.php";
        $consulta = $conexion->prepare("CALL ConsultaGeneralAnimal()");
        $consulta->execute();
        $tabla = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return $tabla;
      }
  
      public function ConsultaEspecifica($dato){
        $this->id_animal = $dato['id_animal'];
  
        include "conexion.php";
        $consulta = $conexion->prepare("CALL ConsultaEspecificaAnimal(?)");
        $consulta->bindParam(1, $this->id_animal);
        $consulta->execute();
        $tabla = $consulta->fetchAll(PDO::FETCH_ASSOC);
  
        return $tabla;
      }
  
      public function modificarDatos($datos){ 
          $this->id_animal = $datos['id_animal'];
          $this->nombre = $datos['nombre'];
          $this->especie = $datos['especie'];
          $this->peso = $datos['peso'];
        
        include "conexion.php";
        $actualizar = $conexion->prepare("CALL ModificarAnimal(?,?,?,?)");
        $actualizar->bindParam(1, $this->id_animal);
        $actualizar->bindParam(2, $this->nombre);
        $actualizar->bindParam(3,$this->especie);
        $actualizar->bindParam(4,$this->peso);
        $actualizar->execute();
        return 1;
      }
  
      public function eliminar($id){
        $this->id_animal = $id;
  
        include "conexion.php";
        $eliminar = $conexion->prepare("CALL EliminarAnimal(?)");
        $eliminar->bindParam(1,$this->id_animal);
        $eliminar->execute();
  
        return 1;
      }
    }
  
  ?>
  