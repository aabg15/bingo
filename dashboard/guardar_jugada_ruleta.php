<?php

$dni = $_POST['dni'];
$cadenaPremios = $_POST['cadenaPremios'];
$id_sorteo = $_POST['id_sorteo'];
$fecha = date("Y-m-d");
$cadenaPremios1 = implode("-", $cadenaPremios);
$cadenaPremioG = explode("-",$cadenaPremios1);
$ganador = $cadenaPremioG[0];
$opcion = $_POST['opcion'];
//var_dump($ganador);


require('../bd/config.php');

$sqlData = "INSERT INTO `subjugada`(`fecha`, `premio`, `id_cliente`,`id_sorteo`) VALUES (CURDATE(),'$cadenaPremios1','$dni','$id_sorteo')";
$sql = mysqli_query($con, $sqlData);
var_dump($sql);




?>
