<?php
session_start();
//$sorteo_id = $_POST['sorteos_disp']; //SORTEO ID del cual se hara el sorteo
$id_sorteo = $_POST['sorteos_disp'];
$arregloLetras = $_POST['arregloLetras'];
$jugadaGanadora = implode('',$arregloLetras);
//echo 'jugadaganadora : '.$jugadaGanadora;
include_once 'conexion.php';

$objeto = new Conexion();

$conexion = $objeto->Conectar();
//introducir la jugada en la bd
$consulta = "INSERT INTO detalle_sorteo(jugada_ganadora,id_sorteo) VALUES(:cadenaFinal,:sorteo_id)";
$resultado = $conexion->prepare($consulta);
$resultado->bindParam(':cadenaFinal', $jugadaGanadora);
$resultado->bindParam(':sorteo_id', $id_sorteo);
$resultado->execute();

//cambiar el estado del sorteo a realizado 'SR'
$sqlInsertar =  "UPDATE `sorteo` SET `estado`='SR' WHERE `id_sorteo`='$id_sorteo'";
$resultadox = $conexion->prepare($sqlInsertar);
$resultadox->execute();

//exit();
$data='ok';
echo $data;
$conexion = null;

