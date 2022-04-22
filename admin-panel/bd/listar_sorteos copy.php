<?php
require_once("../bd/conexion.php");


$objeto = new Conexion();
$conexion = $objeto->Conectar();


if(!empty($_POST['palabra'])){
    $palabra =$_POST['palabra'];

    $sql = "SELECT * FROM `sorteo`WHERE nombre LIKE '%".$palabra."%'";
    $result = $conexion->prepare($sql);
    
  

}else{
    $sql = "SELECT * FROM `sorteo`";
    $result = $conexion->prepare($sql);

}

$result->execute();
$dataJugada = $result->fetchAll(PDO::FETCH_ASSOC);



// $row = $result->fetch_array(MYSQLI_ASSOC)


$json=array();

foreach ($dataJugada as $datp) {

    //var_dump($datp['id_sorteo']);
     $json[]=array(
        'id_sorteo' => $datp['id_sorteo'],
        'nombre' => $datp['nombre'],
        'fecha_inicio' => $datp['fecha_inicio'],
        'fecha_fin' => $datp['fecha_fin'],
    );

}


$jsonstring = json_encode($json);
echo $jsonstring; 
