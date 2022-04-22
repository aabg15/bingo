<?php
function getSorteoDisponible()
{
    require('config.php');
    $fecha_validar = $_POST['fecha_validar'];
    $sqlData = "SELECT * from sorteo";
    $sql = mysqli_query($con, $sqlData);
    $listas = '<option value="0">Elige una opción</option>';
    while ($row = mysqli_fetch_assoc($sql)) {
        //$fechas_validas = $row['fecha_fin'];
        //$nombre_sorteo = $row['nombre'];
        $listas .= "<option value='$row[id_sorteo]'>$row[nombre]</option>";

    }
    
    return $listas;
}


//var_dump($listas);
//exit();
//return $listas;
var_dump(getSorteoDisponible());
