<?php
include_once '../conexion.php';

class Sorteo
{


    var $sorteo;
    /*  public function __construct()
    {
        $this->acceso
    } */

    function editar($id, $nombre_sorteo, $fecha_inicio, $fecha_fin,$premio5letras,$premio6letras,$premio7letras)
    {

        $objeto = new Conexion();
        $conexion = $objeto->Conectar();

        $sql = "UPDATE sorteo SET `nombre`='$nombre_sorteo',`fecha_inicio`='$fecha_inicio',`fecha_fin`='$fecha_fin',`premio5letras`='$premio5letras',`premio6letras`='$premio6letras',`premio7letras`='$premio7letras' where `id_sorteo`='$id'";
        $resultado = $conexion->prepare($sql);
        $resultado->execute();
        // $dataJugada = $result->fetchAll(PDO::FETCH_ASSOC);
    }

    function eliminar($id)
    {

        $objeto = new Conexion();
        $conexion = $objeto->Conectar();

        $sqlDetalle = "DELETE FROM detalle_sorteo where id_sorteo=" . $id;
        $resultado1 = $conexion->prepare($sqlDetalle);
        $resultado1->execute();

        if (!empty($resultado1->execute())) {

        $sql = "DELETE from sorteo where id_sorteo='$id'";
        $resultado = $conexion->prepare($sql);
        $resultado->execute(); 
        echo 'elimino';
            // $dataJugada = $result->fetchAll(PDO::FETCH_ASSOC);
        }else{
            echo 'noeliminado';
        }

    }
}
