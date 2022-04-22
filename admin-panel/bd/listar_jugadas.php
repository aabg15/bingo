<?php

session_start();
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

//recepción de datos enviados mediante POST desde ajax
$sorteos_disp= $_POST['sorteos_disp']; 

$consulta = "SELECT jugada_ganadora from detalle_sorteo where id_sorteo=".$sorteos_disp;

$resultado = $conexion->prepare($consulta);
//var_dump($resultado);
$resultado->execute();
$a=$resultado->rowCount();

/* echo $a;
exit(); */
if( $a>0){
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    //$_SESSION["s_usuario"] = $usuario;
}else{
    //$_SESSION["s_usuario"] = null;
    $data=null;
}

echo json_encode($data);
$conexion=null;

//usuarios de pruebaen la base de datos
//usuario:admin pass:12345
//usuario:demo pass:demo