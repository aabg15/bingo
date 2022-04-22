
<?php 

require('../../bd/config.php');
$fecha_validar ='SR';
$sqlData = "SELECT * from sorteo where estado like 'SR'";

$sql = mysqli_query($con, $sqlData);
//var_dump($sql);
//$listas = '<option value="0">Elige una opción</option>';
$nombreSorteo = "";
while ($row = mysqli_fetch_assoc($sql)) {

    $nombreSorteo = $row['nombre'];

}


//return $nombreSorteo;

header("Content-Type: application/json");

echo json_encode($nombreSorteo);


?>