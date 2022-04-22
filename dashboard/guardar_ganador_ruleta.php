<?php
$dni = $_POST['dni'];
$cadenaPremios = $_POST['cadenaPremios'];
$id_sorteo = $_POST['id_sorteo'];
$fecha = date("Y-m-d");
$cadenaPremios1 = implode("-", $cadenaPremios);
$cadenaPremioG = explode("-",$cadenaPremios1);
$ganador = $cadenaPremioG[0];

/* echo $ganador;
exit();
 */

require('../bd/config.php');

$sqlData= "INSERT INTO `ganadores`(`dni`,`id_sorteo`, `fecha`,`premio`) VALUES ('$dni','$id_sorteo',CURDATE(),'$ganador')";    
$sql = mysqli_query($con, $sqlData);

//var_dump($sql);


?>
