<?php

session_start();
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

//recepción de datos enviados mediante POST desde ajax
$sorteos_disp= $_POST['sorteos_disp']; 
//echo $sorteos_disp;
//echo $sorteos_disp;
//exit();

//$imagen = $_POST['imagen'];
//$descripcion = $_POST['descripcion'];
//$sorteos_disp =  $_POST['sorteos_disp'];

$consulta = "SELECT r.id_ruleta as id_ruleta,r.nombre as nombre,r.descripcion as descripcion,r.imagen_premio as imagen_premio from ruleta r where r.id_sorteo=".$sorteos_disp;

$resultado = $conexion->prepare($consulta);
//var_dump($resultado);
//var_dump($consulta);

//exit(); 

/* var_dump($resultado);
exit(); */
$resultado->execute();

if($resultado->rowCount() >0){
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