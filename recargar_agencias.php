
<?php
require_once("bd/conexion.php");

function getRubricas()
{
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
    $sql = "SELECT * FROM sucursal";
    $result = $conexion->prepare($sql);
    
    $result->execute();
    $listas = '<option value="0">Agencias</option>';
    $dataJugada = $result->fetchAll(PDO::FETCH_ASSOC);
   // $row = $result->fetch_array(MYSQLI_ASSOC)

    foreach ($dataJugada as $datp) {
        $nombre = $datp['nombre_sucursal'];
        $listas .= "<option value='$nombre'>$nombre</option>";
        //echo $nombre;
    }
    return $listas;
}

echo(getRubricas());
//var_dump($listas);

?>

