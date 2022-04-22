<?php
session_start();

$id_sorteo = $_POST['sorteos_disp'];
$arregloLetras = $_POST['arregloLetras']; //array

//$jugadaGanadora = implode('', $arregloLetras);
//echo 'jugadaganadora : '.$jugadaGanadora;

/* $id_sorteo = 26;

$arregloLetras = array(
    'D',
    'F',
    'G',
    'H',
    'P',
    'L',
    'J',
); */
include_once 'conexion.php';

$objeto = new Conexion();
$conexion = $objeto->Conectar();

//primero, sabremos los premios que se obtendran : 

// premios de 5,6,7 letras.
//5 letras
$sentencia5letra = "SELECT * FROM `sorteo` WHERE `id_sorteo`='$id_sorteo'";
//$sentencia5letra = "SELECT * FROM sorteo where id_sorteo=" + $sorteo_id;
$resultadoPremios = $conexion->prepare($sentencia5letra);
$resultadoPremios->execute();
$premiosAregalar = $resultadoPremios->fetchAll(PDO::FETCH_ASSOC);
$premio5l = "";
$premio6l = "";
$premio7l = "";

foreach ($premiosAregalar as $itemP) {
    $premio5l = $itemP['premio5letras'];
    $premio6l = $itemP['premio6letras'];
    $premio7l = $itemP['premio7letras'];
}

$dnisGanadores7 = [];
$dnisGanadores6 = [];
$dnisGanadores5 = [];

$fecha = date('Y-m-d');
$sql_ganador = "SELECT * FROM `jugada` WHERE `id_sorteo`='$id_sorteo'";
$resultadoG = $conexion->prepare($sql_ganador);
$resultadoG->execute();
$jugadas_jugadores = $resultadoG->fetchAll(PDO::FETCH_ASSOC);

//si hay ganador de 7 letras, quitarlo y seguir con los demas
//evaluamos los ganadores de 7 letras acertadas.
//$posbilesGanadores = [];
//7 Letras
//var_dump($jugadas_jugadores);


foreach ($jugadas_jugadores as $item) {
    $contador = 0;
    $jugadaAcomparar = $item['letras'];
    $dni = $item['id_cliente'];
    //echo 'Jugada a evaluar :' . $jugadaAcomparar . ' con dni : ' . $dni . '';
   // echo '<br>';
    foreach ($arregloLetras as $letraganadora) {
        //echo $letraganadora . ' - ';
        if ((strlen(strstr($jugadaAcomparar, $letraganadora)) > 0)) {
            //si se encuentra, suma el contador
            $contador = $contador + 1;
        }
        if ($contador == 7) {
            //hubo ganador de 7 letras, guardalo y quitalo de los demas sorteos 
           // echo 'ganador con dni : ' . $dni . '';
            $sqlInsertar =  "INSERT INTO `ganadores_premiom`(`dni`, `fecha`, `premio`, `cantidad_letras`, `id_sorteo`, `letras`) VALUES ('$dni','$fecha','$premio7l','$contador','$id_sorteo','$jugadaAcomparar')";
            $resultadom = $conexion->prepare($sqlInsertar);
            $resultadom->execute();

            //agrego dni ganador para no incluirlo en los demas premios
            $dnisBloqueados[] = $dni;
           // echo '<br>';
        } else {
            //no hubo ganadores
        }
    }
}


//para 6 letras.
foreach ($jugadas_jugadores as $item) {
    $contador = 0;
    $jugadaAcomparar = $item['letras'];
    $dni = $item['id_cliente'];
    //echo '<br>';
   // echo 'Jugada a evaluar :' . $jugadaAcomparar . ' con dni : ' . $dni . '';
   // echo '<br>';
    foreach ($arregloLetras as $letraganadora) {
        //echo $letraganadora . ' - ';
        if ((strlen(strstr($jugadaAcomparar, $letraganadora)) > 0)) {
            //si se encuentra, suma el contador
            $contador = $contador + 1;
        }
        if ($contador == 6 && !(in_array($dni, $dnisBloqueados))) {
            //hubo ganador de 7 letras, guardalo y quitalo de los demas sorteos 
           // echo 'ganador con dni : ' . $dni . '';
            $sqlInsertar =  "INSERT INTO `ganadores_premiom`(`dni`, `fecha`, `premio`, `cantidad_letras`, `id_sorteo`, `letras`) VALUES ('$dni','$fecha','$premio6l','$contador','$id_sorteo','$jugadaAcomparar')";
            $resultadom = $conexion->prepare($sqlInsertar);
            $resultadom->execute();

            //agrego dni ganador para no incluirlo en los demas premios
            $dnisBloqueados[] = $dni;
          //  echo '<br>';
        } else {
            //no hubo ganadores o se bloqueo a los dni ya ganadores
            //echo '<br>';
            //echo 'dni bloqueado : ', $dni;
           // echo '<br>';
        }
    }
}


//para 6 letras.
foreach ($jugadas_jugadores as $item) {
    $contador = 0;
    $jugadaAcomparar = $item['letras'];
    $dni = $item['id_cliente'];
    //echo '<br>';
    //echo 'Jugada a evaluar :' . $jugadaAcomparar . ' con dni : ' . $dni . '';
  //  echo '<br>';
    foreach ($arregloLetras as $letraganadora) {
        //echo $letraganadora . ' - ';
        if ((strlen(strstr($jugadaAcomparar, $letraganadora)) > 0)) {
            //si se encuentra, suma el contador
            $contador = $contador + 1;
        }
        if ($contador == 5 && !(in_array($dni, $dnisBloqueados))) {
            //hubo ganador de 7 letras, guardalo y quitalo de los demas sorteos 
          //  echo 'ganador con dni : ' . $dni . '';
            $sqlInsertar =  "INSERT INTO `ganadores_premiom`(`dni`, `fecha`, `premio`, `cantidad_letras`, `id_sorteo`, `letras`) VALUES ('$dni','$fecha','$premio5l','$contador','$id_sorteo','$jugadaAcomparar')";
            $resultadom = $conexion->prepare($sqlInsertar);
            $resultadom->execute();

            //agrego dni ganador para no incluirlo en los demas premios
            $dnisBloqueados[] = $dni;
          //  echo '<br>';
        } else {
            //no hubo ganadores o se bloqueo a los dni ya ganadores
          //  echo '<br>';
          //  echo 'dni bloqueado : ', $dni;
          // echo '<br>';
        }
    }
}


$data = 'ok';
echo $data;
$conexion = null;
