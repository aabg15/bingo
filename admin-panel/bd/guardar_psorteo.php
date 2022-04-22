<?php

/* include_once 'conexion.php';
 */
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$cant_aciertos = $_POST['cant_aciertos'];
$descripcion = $_POST['descripcion'];
$sorteos_disp =  $_POST['sorteos_disp'];

$consulta = "INSERT INTO `premio_sorteo`(`id_sorteo`,`descripcion`, `cantidad_aciertos`) VALUES ('$sorteos_disp','$descripcion','$cant_aciertos')";
//$res = mysqli_query($con, $consulta);

$resultado = $conexion->prepare($consulta);
$resultado->execute();
$canti = $resultado->rowCount();

//echo $canti;
//exit();
if($resultado->rowCount() > 0){
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
/*     var_dump($data);
    print_r($data);
    echo 'jola';
    exit(); */
    //$_SESSION["s_usuario"] = $usuario;
}else{
    //$_SESSION["s_usuario"] = null;
    $data=null;
 /*    echo 'jola2';
    exit(); */
}

print json_encode($data);
$conexion=null;
