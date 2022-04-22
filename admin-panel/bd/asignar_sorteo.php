<?php 

require('../../bd/config.php');
$fecha_validar = $_POST['id'];
$sqlData = "SELECT * from sorteo where id_sorteo =" .$fecha_validar;

$sql = mysqli_query($con, $sqlData);
//var_dump($sql);
//$listas = '<option value="0">Elige una opción</option>';
$nombreSorteo = "";
while ($row = mysqli_fetch_assoc($sql)) {
    //$fechas_validas = $row['fecha_fin'];
    //$nombre_sorteo = $row['nombre'];
   // $listas .= "<option value='$row[id_sorteo]'>$row[nombre]</option>";
    //echo $fechas_validas;
    //echo '<br>';
    //echo $nombre_sorteo;
    //echo '<br>';
    $nombreSorteo = $row['nombre'];

}
//exit();
//return $nombreSorteo;

header("Content-Type: application/json");

echo json_encode($nombreSorteo);


?>