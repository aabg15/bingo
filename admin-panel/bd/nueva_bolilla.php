<?php
session_start();

//$id_sorteo = $_POST['sorteos_disp'];
$id_sorteo = 26;

include_once 'conexion.php';

$objeto = new Conexion();
$conexion = $objeto->Conectar();

//primero traer los DNI que ya ganaron, para no incluirlo en la jugada de 7 letras + boliyapa.
$arregloGanadores = array();
$consultaYaGanadores = "SELECT dni as dni_ganador FROM ganadores_premiom where (id_sorteo=" . $id_sorteo . ")";
$resultadoGana = $conexion->prepare($consultaYaGanadores);
$resultadoGana->execute();
//$arrDatos7 = $resultadoGana->fetchAll(PDO::FETCH_ASSOC);

while ($arr = $resultadoGana->fetch(PDO::FETCH_ASSOC)) {
    $dni = $arr['dni_ganador'];
    array_push($arregloGanadores,$dni);
 }

print_r($arregloGanadores);

exit();


//luego, traerme a todos las jugadas de los jugadores, excepto de los que ya ganaron en 5 y 6 letras.





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
