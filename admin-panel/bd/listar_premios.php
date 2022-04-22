

<?php
require_once("../bd/conexion.php");


$objeto = new Conexion();
$conexion = $objeto->Conectar();

if ($_POST['funcion'] == 'verPremiolista') {
    //lsta
    //echo "aqui cick";
    $sql = "SELECT * FROM ruleta where id_sorteo=".$sor;
    $result = $conexion->prepare($sql);
    $result->execute();
    $dataJugada = $result->fetchAll(PDO::FETCH_ASSOC);
    //    var_dump($dataJugada);


    $json = array();
   // $json['data']

    foreach ($dataJugada as $datp) {

        //var_dump($datp['id_sorteo']);
        $json[] = array(
            'cantidad_aciertos' => $datp['cantidad_aciertos'],
            'descripcion' => $datp['descripcion'],
            'nombre' => $datp['nombre'],
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring; 
    
}


