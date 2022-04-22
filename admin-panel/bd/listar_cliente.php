

<?php
require_once("../bd/conexion.php");


$objeto = new Conexion();
$conexion = $objeto->Conectar();

if ($_POST['funcion'] == 'verListaCliente') {
    //lsta
    //echo "aqui cick";
    $sql = "SELECT * FROM cliente";
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
            'cant_jugada' => $datp['cant_jugada'],
            'nombre' => $datp['nombre'],
            'apellidos' => $datp['apellidos'],
            'celular' => $datp['celular'],
            'telefono' => $datp['telefono'],
            'correo' => $datp['correo'],
            'codigo_interno_cliente' => $datp['codigo_interno_cliente'],
            'codigo_deposito' => $datp['codigo_deposito'],
            'tipo_deposito' => $datp['tipo_deposito'],
            'fecha_apertura' => $datp['fecha_apertura'],
            'fecha_vencimiento' => $datp['fecha_vencimiento'],
            'plazo' => $datp['plazo'],
            'moneda' => $datp['moneda'],
            'id_sucursal' => $datp['id_sucursal'],
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring; 
    
}




