<?php
include_once '../modelo/ClasePremioRuleta.php';
$sorteo = new PremioRuleta();

if($_POST['funcion']=="editar_premio_ruleta"){
    $id = $_POST['id'];
    $nombre_premio =  $_POST['nombre_premio'];
    $descripcion =  $_POST['descripcion'];
    /* echo $id,$nombre_premio,$descripcion;
    exit(); */
    //var_dump($id);
   // var_dump($descripcion);
    $sorteo->editar($id, $nombre_premio,$descripcion);
}

if($_POST['funcion']=="borrar_premio"){
    $id = $_POST['id'];
   // $nombre_sorteo =  $_POST['nombre_sorteo'];

    $sorteo->eliminar($id);


}
?>