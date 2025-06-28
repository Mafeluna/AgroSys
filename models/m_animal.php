<?php
  class animal{
    private $id_animal;
    private $nombre;
    private $especie;
    private $peso;
    private $registrado_por;
    //
    public function registrar($datos,$codigo,$user){
      $this->nombre = $codigo;
      $this->especie = $datos['especie'];
      $this->peso = $datos['peso'];
      $this->registrado_por = $user;

      // registro
      include "conexion.php";
      $registro = $conexion->prepare("CALL RegistrarAnimal(?,?,?,?)");
      $registro->bindParam(1,$this->nombre);
      $registro->bindParam(2,$this->especie);
      $registro->bindParam(3,$this->peso);
      $registro->bindParam(4,$this->registrado_por);
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

      public function consultaPorEspecie($especie){
        $this->especie = $especie;

        include "conexion.php";
        $consulta = $conexion->prepare("CALL ConsultaPorEspecie(?)");
        $consulta->bindParam(1,$this->especie);
        $consulta->execute();

        $tabla = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return $tabla;
      }

      public function consultaPorEspecieEspecifica($especie,$codigo){
        $this->especie = $especie;
        $this->nombre = $codigo;

        include "conexion.php";
        $consulta = $conexion->prepare("CALL ConsultaPorEspecieEspecifica(?,?)");
        $consulta->bindParam(1,$this->especie);
        $consulta->bindParam(2,$this->nombre);
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
  
      public function eliminar($data){
        $this->id_animal = $data['id'];
        $this->especie = $data['especie'];
  
        include "conexion.php";
        $eliminar = $conexion->prepare("CALL EliminarAnimal(?,?)");
        $eliminar->bindParam(1,$this->id_animal);
        $eliminar->bindParam(2,$this->especie);
        $eliminar->execute();
  
        return 1;
      }

      public function contarPorEspecie($especie){

        include "conexion.php";
        $consulta = $conexion->prepare("CALL ContarPorEspecie(?);");
        $consulta->bindParam(1,$especie);
        $consulta->execute();

        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        var_dump($datos);
        
        $cantidad = $datos[0]['cantidad_animales'];
        return $cantidad;
      }
    }
  
  ?>
  