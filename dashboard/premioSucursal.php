<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$sucursal = $_POST['sucursal'];
$x = $_POST['premios'];

//var_dump($x);


//foreach ($x as $prueba) {
/* $juga = $x["premios"];
$fecha = $x["fechas"]; */
$dni = $x[0]["dni"];
$sorteo_id = $x[0]["sorteo_id"];

$consulta = "UPDATE `ganadores` SET `sucursal`='$sucursal' WHERE dni = " . $dni . " AND id_sorteo=" . $sorteo_id;
$resultado = $conexion->prepare($consulta);
$resultado->execute();
/* echo $resultado->rowCount();
echo '--'; */

if ($resultado->rowCount() > 0) {
  $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
  $data = 'Ok';
} else {
  //$_SESSION["s_usuario"] = null;
  $data = null;
}
echo json_encode($data);
$conexion = null;
