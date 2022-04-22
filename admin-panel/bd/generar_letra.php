<?php
session_start();
$sorteo_id = $_POST['sorteos_disp']; //SORTEO ID del cual se hara el sorteo
//var_dump($sorteos_disp);
//echo $sorteos_disp;

include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();


include_once 'config.php';


//saber la cantidad de aciertos del sorteo tal
$consultaIntentos = "SELECT cantidad_aciertos FROM premio_sorteo WHERE id_sorteo =" . $sorteo_id . ";";
//echo $consultaIntentos;
$cant_obtenida = 0;
$result = (mysqli_query($con, $consultaIntentos));
while ($row = $result->fetch_assoc()) {
    //echo $row['classtype']."<br>";
    $cant_obtenida =  $row['cantidad_aciertos'];
}


$cant_obtenida = intval($cant_obtenida);

$abecedario = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
$abecedario = str_split($abecedario);
//genero la cant de letras de la cant_obtenida para el sorteo

//debo obtener la primera combinacion de 5 letras
//recorrer todas las jugadas de los jugadores guardados, recortar las dos ultimas letras y guardarlo en un array
//ese array, comparar todas las jugadas, con la combionacion de 5letras del juego.
    //si hay ganadores, almacenarlos
    //si no, seguir recorriendo hasta acabar las jugadas 
//hacer la siguiente om


while ($cant_obtenida > 0) {
    // abecedario se convierte a un array

    $consulta = "SELECT * FROM letra WHERE id_sorteo = :sorteo_id";
    $resultado = $conexion->prepare($consulta);
    $resultado->bindParam("sorteo_id", $sorteo_id);
    $resultado->execute();

    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    $orden = 1;
    foreach ($data as $item) {
        foreach ($abecedario as $key => $value) {
            if ($item['letra'] == $value) {
                array_splice($abecedario, $key, 1);
            }
        }
        $orden = $orden + 1;
    }

    // posicion aleatorio
    $posicion = rand(0, count($abecedario) - 1);

    // letra aleatoria
    $letra = $abecedario[$posicion];


    $consulta = "INSERT INTO letra(letra, orden, id_sorteo) VALUES(:letra,:orden,:sorteo_id)";
    $resultado = $conexion->prepare($consulta);
    $resultado->bindParam(':letra', $letra);
    $resultado->bindParam(':orden', $orden);
    $resultado->bindParam(':sorteo_id', $sorteo_id);
    $resultado->execute();

    $cant_obtenida = $cant_obtenida - 1;
    //echo$cant_obtenida;
}

/* 
$consulta = "SELECT * FROM letra WHERE id_sorteo = :sorteo_id";
$resultado = $conexion->prepare($consulta);
$resultado->bindParam("sorteo_id", $sorteo_id);
$resultado->execute();

$data = $resultado->fetchAll(PDO::FETCH_ASSOC);
$orden = 1;
foreach ($data as $item) {
    foreach ($abecedario as $key => $value) {
        if ($item['letra'] == $value) {
            array_splice($abecedario, $key, 1);
        }
    }
    $orden = $orden + 1;
}

// posicion aleatorio
$posicion = rand(0, count($abecedario) - 1);

// letra aleatoria
$letra = $abecedario[$posicion];


$consulta = "INSERT INTO letra(letra, orden, id_sorteo) VALUES(:letra,:orden,:sorteo_id)";
$resultado = $conexion->prepare($consulta);
$resultado->bindParam(':letra', $letra);
$resultado->bindParam(':orden', $orden);
$resultado->bindParam(':sorteo_id', $sorteo_id);
$resultado->execute();
 */
$consulta = "SELECT * FROM letra WHERE id_sorteo = :sorteo_id ORDER BY orden ASC";

$resultado = $conexion->prepare($consulta);
$resultado->bindParam(":sorteo_id", $sorteo_id);
$resultado->execute();
$letras = $resultado->fetchAll(PDO::FETCH_ASSOC);


$cadenaJugadaGanadora = "";
foreach ($letras as $item) {
    $cadenaJugadaGanadora .= $item['letra'];
}
//insertar la jugada y cambiar el estado del sorteo a REALIZADO 
$sqlInsertar =  "UPDATE `sorteo` SET `juagada_ganadora`='$cadenaJugadaGanadora', `estado`='SR' WHERE `id_sorteo`='$sorteo_id'";
$resultadox = $conexion->prepare($sqlInsertar);
$resultadox->execute();


if ($resultadox->rowCount() > 0) {
    //$data =$cadenaJugadaGanadora;
    //$data = "ok";
    //$_SESSION["s_usuario"] = $usuario;
} else {
    //$_SESSION["s_usuario"] = null;
    $cadenaJugadaGanadora = null;
}

//comparar con las jugadas de los jugadores: 

$sql_ganador = "SELECT * FROM `jugada` WHERE `id_sorteo`='$sorteo_id'";

$resultadoG = $conexion->prepare($sql_ganador);
$resultadoG->execute();
$jugadas_jugadores = $resultadoG->fetchAll(PDO::FETCH_ASSOC);

$posbilesGanadores = [];
foreach ($jugadas_jugadores as $item) {
    if ($item['letras'] == $cadenaJugadaGanadora) {
        //ganador, almacenalo en la bd
        $dni_ganador = $item['id_cliente'];
        $sqlInsertar =  "UPDATE `ganadores` SET `letras`='$cadenaJugadaGanadora' WHERE dni =''$dni_ganador'' and`id_sorteo`='$sorteo_id'";
        $resultadom = $conexion->prepare($sqlInsertar);
        $resultadom->execute();

    }
}



//header("Content-Type: application/json");
//print json_encode($cadenaJugadaGanadora);
echo json_encode($cadenaJugadaGanadora);
$conexion = null;
