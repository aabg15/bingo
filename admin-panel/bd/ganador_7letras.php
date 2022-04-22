<?php
session_start();

$id_sorteo = $_POST['sorteos_disp'];
//$id_sorteo = 26;
$letras = 7;

include_once 'conexion.php';

$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consultaJugada = "SELECT COUNT(`dni`) as cant FROM ganadores_premiom where (id_sorteo=" . $id_sorteo . " AND cantidad_letras=" . $letras . ")";
$resultadoJugada = $conexion->prepare($consultaJugada);

$resultadoJugada->execute();
$arrDatos7 = $resultadoJugada->fetchAll(PDO::FETCH_ASSOC);
foreach ($arrDatos7 as $value) {
  $cantoidad = $value['cant'];
}

if ($cantoidad > 0) {
  //hay mas de 1 ganador, no se debe generar bolilla adicional
  $data = 'ok';
} else {
  //bolillas adicional
  $data = 'adicional';
}

echo $data;
$conexion = null;
