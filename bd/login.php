<?php
session_start();

include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

//recepción de datos enviados mediante POST desde ajax
//$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
//$password = (isset($_POST['password'])) ? $_POST['password'] : '';
//$dni = (isset($_POST['dni'])) ? $_POST['dni'] : '';
//$dni= $_POST['dni'];
$dni=$_POST['dni'];
/* echo gettype($dni);
exit(); */
//print_r($dni);

//$pass = md5($password); //encripto la clave enviada por el usuario para compararla con la clava encriptada y almacenada en la BD

$consulta = "SELECT * FROM cliente WHERE dni='$dni'";

$resultado = $conexion->prepare($consulta);
$resultado->execute();
//var_dump ($resultado);
//exit();
if($resultado->rowCount() >= 1){
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION["s_usuario"] = $dni;
    //var_dump($resultado);
}else{
    $_SESSION["s_usuario"] = null;
    $data=null;
}

print json_encode($data,true);
$conexion=null;

//usuarios de pruebaen la base de datos
//usuario:admin pass:12345
//usuario:demo pass:demo