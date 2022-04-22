<?php
include_once '../bd/conexion.php';
$dni = $_POST['dni'];
$cadenaLetras = $_POST['cadenaLetras'];
$id_sorteo = $_POST['id_sorteo'];
$fecha = date("Y-m-d");
$cant_jugad = $_POST['cant_jugad'];
$cadenaLetras = implode("", $cadenaLetras);

$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "INSERT INTO `jugada`(`letras`, `id_sorteo`, `id_cliente`,`fecha`) VALUES ('$cadenaLetras','$id_sorteo','$dni',CURDATE())";

$resultado = $conexion->prepare($consulta);
/* var_dump($resultado);
exit(); */
$resultado->execute();

if($resultado->rowCount() >= 1){
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    //$_SESSION["s_usuario"] = $usuario;
}else{
    //$_SESSION["s_usuario"] = null;
    $data=null;
}
print json_encode($data);
$conexion=null;

//usuarios de pruebaen la base de datos
//usuario:admin pass:12345
//usuario:demo pass:demo


