<?php
include_once '../modelo/Clasesorteo.php';
$sorteo = new Sorteo();

if($_POST['funcion']=="editar_sorteo"){
    $id = $_POST['id'];
    $nombre_sorteo =  $_POST['nombre_sorteo'];
    $fecha_inicio =  $_POST['fecha_inicio'];
    $fecha_fin=  $_POST['fecha_fin'];
    $premio5letras=  $_POST['premio5letras'];
    $premio6letras=  $_POST['premio6letras'];
    $premio7letras=  $_POST['premio7letras'];
    $sorteo->editar($id, $nombre_sorteo,$fecha_inicio,$fecha_fin,$premio5letras,$premio6letras,$premio7letras);
}

if($_POST['funcion']=="borrar_sorteo"){
    $id = $_POST['id'];
   // $nombre_sorteo =  $_POST['nombre_sorteo'];
 /*   echo $id;
   exit(); */
    $sorteo->eliminar($id);

}
?>