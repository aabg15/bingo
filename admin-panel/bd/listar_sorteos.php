<?php
require_once("../bd/conexion.php");


$objeto = new Conexion();
$conexion = $objeto->Conectar();

if ($_POST['funcion'] == 'verSorteolista') {
    //lsta
    //echo "aqui cick";
    $sql = "SELECT * FROM `sorteo`";
    $result = $conexion->prepare($sql);
    $result->execute();
    $dataJugada = $result->fetchAll(PDO::FETCH_ASSOC);
    //    var_dump($dataJugada);


    $json = array();
   // $json['data']

    foreach ($dataJugada as $datp) {

        //var_dump($datp['id_sorteo']);
        $json[] = array(
            'id_sorteo' => $datp['id_sorteo'],
            'nombre' => $datp['nombre'],
            'fecha_inicio' => $datp['fecha_inicio'],
            'premio5letras' => $datp['premio5letras'],
            'premio6letras' => $datp['premio6letras'],
            'premio7letras' => $datp['premio7letras'],
            'estado' => $datp['estado'],
            'fecha_fin' => $datp['fecha_fin'],
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring; 
    
}


