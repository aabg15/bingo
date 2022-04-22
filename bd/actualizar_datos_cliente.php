<?php
$dni = $_POST['dni'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellidos'];
$direccion = $_POST['direccion'];
$distrito = $_POST['distrito'];
$departamento = $_POST['departamento'];
$provincia = $_POST['provincia'];
$agencia = $_POST['agencia'];
$celular = $_POST['celular'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];

require('config.php');
//var_dump($departamento);

if (is_numeric($distrito) && is_numeric($provincia) && is_numeric($departamento)) {
    $sqldepart = "SELECT departamento from ubdepartamento where idDepa='" . $departamento . "';";
    $sqlD = mysqli_query($con, $sqldepart);
    while ($fila = $sqlD->fetch_row()) {
        $departamento = $fila[0];
    }

    $sqldistr = "SELECT distrito from ubdistrito where idDist='" . $distrito . "';";
    $sqlDis = mysqli_query($con, $sqldistr);
    while ($fila = $sqlDis->fetch_row()) {
        $distrito = $fila[0];
    }

    $sqlprovi = "SELECT provincia from ubprovincia where idProv='" . $provincia . "';";
    $sqlPro = mysqli_query($con, $sqlprovi);
    while ($fila = $sqlPro->fetch_row()) {
        $provincia = $fila[0];
    }
} else {

}





/* var_dump($departamento);
var_dump($provincia);
var_dump($distrito);

exit(); */

$sqlAct = "UPDATE `cliente` SET `nombre`='$nombre',`apellidos`='$apellido',`celular`='$celular',`telefono`='$telefono',`correo`='$correo',
`id_sucursal`='$agencia',`ciudad`='$provincia',`distrito`='$distrito',`direccion`='$direccion',`departamento`='$departamento' WHERE dni='" . $dni . "';";

$sql = mysqli_query($con, $sqlAct);
