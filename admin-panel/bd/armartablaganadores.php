<?php
session_start();

$id_sorteo = $_POST['sorteos_disp'];
//$id_sorteo = 26;

include_once 'conexion.php';

$objeto = new Conexion();
$conexion = $objeto->Conectar();


$sqlcant7 =  "SELECT COUNT(cantidad_letras) as cantidad7letras FROM ganadores_premiom WHERE (cantidad_letras=7 AND id_sorteo=" . $id_sorteo . ")";
$resultado7 = $conexion->prepare($sqlcant7);
$resultado7->execute();
$arrDatos7 = $resultado7->fetchAll(PDO::FETCH_ASSOC);
foreach ($arrDatos7 as $value) {
  $cant7 = $value['cantidad7letras'];
}


$sqlcant6 =  "SELECT COUNT(cantidad_letras) as cantidad6letras FROM ganadores_premiom WHERE (cantidad_letras=6 AND id_sorteo=" . $id_sorteo . ")";
$resultado6 = $conexion->prepare($sqlcant6);
$resultado6->execute();
$arrDatos6 = $resultado6->fetchAll(PDO::FETCH_ASSOC);
foreach ($arrDatos6 as $value) {
  $cant6 = $value['cantidad6letras'];
}

$sqlcant5 =  "SELECT COUNT(cantidad_letras) as cantidad5letras FROM ganadores_premiom WHERE (cantidad_letras=5 AND id_sorteo=" . $id_sorteo . ")";
$resultado5 = $conexion->prepare($sqlcant5);
$resultado5->execute();
$arrDatos5 = $resultado5->fetchAll(PDO::FETCH_ASSOC);
foreach ($arrDatos5 as $value) {
  $cant5 = $value['cantidad5letras'];
}

$sentencia5letra = "SELECT * FROM `sorteo` WHERE `id_sorteo`='$id_sorteo'";
$resultadoPremios = $conexion->prepare($sentencia5letra);
$resultadoPremios->execute();
$premiosAregalar = $resultadoPremios->fetchAll(PDO::FETCH_ASSOC);
$premio5 = "";
$premio6 = "";
$premio7 = "";

foreach ($premiosAregalar as $itemP) {
  $premio5 = $itemP['premio5letras'];
  $premio6 = $itemP['premio6letras'];
  $premio7 = $itemP['premio7letras'];
}


$texto = "

<div class='card card-outline card-success'>

<div class='card-body' style='width: 100%; background-color:#f2cc15;'>
<center>
<h4>Premios <img src='../../sullana.png' style='width: 20%; filter: brightness(1.1); mix-blend-mode: multiply;'></h4>
</center>
<div class='table-responsive'><table class='table table-bordered' style='width: 100%; background-color:green;'>
<thead class='text-primary thead-dark'>
<tr>

<th><h3><center>CATEGORIAS</center></h3></th>
<th><h3><center>PREMIOS</h3></th>
<th><h3><center>CANT. GANADORES</center></h3></th>
</tr>
</thead>

<tr>

<td><h3><center>5 aciertos</center></h3>
</td><td><h3><center>$premio5</center></h3></td>
</td><td><h3><center>$cant5</center></h3></td>
</tr>

<tr>

<td><h3><center>6 aciertos</center></h3></td>
</td><td><h3><center>$premio6</center></h3></td>
<td><h3><center>$cant6</center></h3></td>
</tr>

<tr>
<td><h3><center>7 aciertos</center></h3></td>
</td><td><h3><center>$premio7</center></h3></td>
<td><h3><center>$cant7</h3></td>
</tr>

</table></div>

<center><button
 class='btn btn-primary' id ='botonGuar'type='submit' style='font-size: 30px;border-radius: 70px;'>Ver ganadores</button></center>
</div>

</div>


";

$data = 'ok';
echo $texto;
//exit();
$conexion = null;
