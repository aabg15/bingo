

<?php
require_once("../bd/conexion.php");


$objeto = new Conexion();
$conexion = $objeto->Conectar();

if ($_POST['funcion'] == 'listarCorreos') {

    $sql = "SELECT * from correo ";
    $result = $conexion->prepare($sql);
    $result->execute();
    $dataJugada = $result->fetchAll(PDO::FETCH_ASSOC);
    //    var_dump($dataJugada);

    $json = array();
   // $json['data']

    foreach ($dataJugada as $datp) {

        //var_dump($datp['id_sorteo']);
        $json[] = array(
            'asunto' => $datp['asunto'],
            'destinatario' => $datp['destinatario'],
            'dni' => $datp['dni'],
            'premio'=>$datp['premio'],
            'jugada'=>$datp['jugada'],
            'ruleta'=>$datp['ruleta'],
            'fecha'=>$datp['fecha'],
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring; 
    
}



