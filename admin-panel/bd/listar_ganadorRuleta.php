

<?php
require_once("../bd/conexion.php");


$objeto = new Conexion();
$conexion = $objeto->Conectar();

if ($_POST['funcion'] == 'verGanadorRuleta') {
    //lsta
    //echo "aqui cick";
    $sql = "SELECT c.dni as dni,c.nombre as nombre,c.apellidos as apellidos,g.premio as premio, g.fecha as fecha,g.sucursal as sucursal FROM ganadores g INNER join cliente c on(g.dni=c.dni);";
    $result = $conexion->prepare($sql);
    $result->execute();
    $dataJugada = $result->fetchAll(PDO::FETCH_ASSOC);
    //    var_dump($dataJugada);


    $json = array();
   // $json['data']

    foreach ($dataJugada as $datp) {

        //var_dump($datp['id_sorteo']);
        $json[] = array(
            'dni' => $datp['dni'],
            'apellidos' => $datp['apellidos'],
            'nombre' => $datp['nombre'],
            'premio' => $datp['premio'],
            'fecha' => $datp['fecha'],
            'sucursal' => $datp['sucursal'],
            
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring; 
    
}


