<?php
session_start();

include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

//recepción de datos enviados mediante POST desde ajax
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$fechainicio = (isset($_POST['fechainicio'])) ? $_POST['fechainicio'] : '';
$fechafin = (isset($_POST['fechafin'])) ? $_POST['fechafin'] : '';
$premio5letra = (isset($_POST['premio5letra'])) ? $_POST['premio5letra'] : '';
$premio6letra = (isset($_POST['premio6letra'])) ? $_POST['premio6letra'] : '';
$premio7letra = (isset($_POST['premio7letra'])) ? $_POST['premio7letra'] : '';

$consulta = "INSERT INTO `sorteo`(`nombre`, `fecha_inicio`, `fecha_fin`,`estado`,`premio5letras`,`premio6letras`,`premio7letras`) VALUES ('$nombre','$fechainicio','$fechafin','SS','$premio5letra','$premio6letra','$premio7letra')";

$resultado = $conexion->prepare($consulta);
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

//print json_encode($data);
$conexion=null;

//usuarios de pruebaen la base de datos
//usuario:admin pass:12345
//usuario:demo pass:demo