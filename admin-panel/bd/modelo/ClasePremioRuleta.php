<?php
include_once '../conexion.php';

class PremioRuleta{


    var $sorteo;
   /*  public function __construct()
    {
        $this->acceso
    } */

    function editar($id,$nombre_premio,$descripcion){
        
        $objeto = new Conexion();
        $conexion = $objeto->Conectar();

        $sql = "UPDATE ruleta SET `nombre`='$nombre_premio',`descripcion`='$descripcion' where `id_ruleta`='$id'";
        $resultado = $conexion->prepare($sql);
        $resultado->execute();
       // $dataJugada = $result->fetchAll(PDO::FETCH_ASSOC);
    }

    function eliminar($id){
        
        $objeto = new Conexion();
        $conexion = $objeto->Conectar();

        $sql = "DELETE from ruleta where id_ruleta='$id'";
        $resultado = $conexion->prepare($sql);
        $resultado->execute();
       // $dataJugada = $result->fetchAll(PDO::FETCH_ASSOC);
    }


}
