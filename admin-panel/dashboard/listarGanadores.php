
<?php

session_start();
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

//recepción de datos enviados mediante POST desde ajax
$sorteos_disp = $_POST['sorteos_disp'];

$consulta = "SELECT gp.dni as dni, gp.fecha as fecha, gp.premio as premio,gp.cantidad_letras as cantidad_letras, gp.letras as letras,c.nombre as nombre,c.apellidos as apellidos from ganadores_premiom gp inner join cliente c on(gp.dni = c.dni) where id_sorteo=" . $sorteos_disp;

$resultado = $conexion->prepare($consulta);
$resultado->execute();
$cantt = $resultado->rowCount();
if ($cantt > 0) {
    $dataJugada = $resultado->fetchAll(PDO::FETCH_ASSOC);


    $json = array();
    // $json['data']

    foreach ($dataJugada as $datp) {

        //var_dump($datp['id_sorteo']);
        $json[] = array(
            'dni' => $datp['dni'],
            'fecha' => $datp['fecha'],
            'premio' => $datp['premio'],
            'cantidad_letras' => $datp['cantidad_letras'],
            'letras' => $datp['letras'],
            'nombre' => $datp['nombre'].' '.$datp['apellidos'],
            
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;

    //echo json_encode($data);
    $conexion = null;
}else{
    echo 'null';
    $conexion = null;
}

//usuarios de pruebaen la base de datos
//usuario:admin pass:12345
//usuario:demo pass:demo