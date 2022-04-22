

<?php
require_once("../bd/conexion.php");


$objeto = new Conexion();
$conexion = $objeto->Conectar();

if ($_POST['funcion'] == 'jugadaPorCliente') {
    //lsta
    //echo "aqui cick";
    $sql = "SELECT c.dni as dni,c.nombre as nombre,c.apellidos as apellidos,ju.letras as letras,ju.fecha as fecha FROM cliente c INNER join jugada ju on(c.dni=ju.id_cliente)";
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
            'nombre' => $datp['nombre'],
            'apellidos' => $datp['apellidos'],
            'letras' => $datp['letras'],
            'fecha' => $datp['fecha'],
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring; 
    
}



