<?php
/* echo 'hola;';
  exit(); */
$id_sorteo = $_GET['id'];

header('Content-Type: text/html; charset=UTF-8');
require_once('../bd/config.php');

$tipo       = $_FILES['dataCliente']['type'];
$tamanio    = $_FILES['dataCliente']['size'];
$archivotmp = $_FILES['dataCliente']['tmp_name'];


if (!empty($archivotmp)) {

  $lineas     = file($archivotmp);
  $i = 0;
  foreach ($lineas as $linea) { //para no leer la primera fila

    $cantidad_registros = count($lineas);
    $cantidad_regist_agregados =  ($cantidad_registros - 1);

    if ($i != 0) {

      $datos = explode(";", $linea);
      //print_r($datos);

      $codigo_interno_cliente = !empty($datos[0])  ? ($datos[0]) : '';
      $codigo_deposito       = !empty($datos[1])  ? ($datos[1]) : '';
      $departamento          = utf8_encode(!empty($datos[2])  ? ($datos[2]) : '');
      $ciudad                = utf8_encode(!empty($datos[3])  ? ($datos[3]) : '');
      $tipo_deposito         = !empty($datos[4])  ? ($datos[4]) : '';
      $tipo_deposito_sbs     = !empty($datos[5])  ? ($datos[5]) : '';
      $fecha_apertura        = !empty($datos[6])  ? ($datos[6]) : '';
      $fecha_vencimiento     = !empty($datos[7])  ? ($datos[7]) : '';
      //$fecha_apertura = date('d-m-Y', $fecha_apertura);
      //$fecha_vencimiento = date('d-m-Y', $fecha_vencimiento);
      $plazo                 = !empty($datos[8])  ? ($datos[8]) : '';
      $monto_deposito_apert  = !empty($datos[9])  ? ($datos[9]) : '';
      $moneda                = !empty($datos[10])  ? ($datos[10]) : '';
      $saldo_corte_monedaL   = !empty($datos[11])  ? ($datos[11]) : '';
      $dni                   = !empty($datos[12])  ? ($datos[12]) : '';
      $celular               = !empty($datos[13])  ? ($datos[13]) : '';
      $correo                = !empty($datos[14])  ? ($datos[14]) : '';
      $cant_jugadas          = !empty($datos[15])  ? ($datos[15]) : '';
      $direccion             = utf8_encode(!empty($datos[16])  ? ($datos[16]) : '');
      $distrito              = utf8_encode(!empty($datos[17])  ? ($datos[17]) : '');
      $sede                  = utf8_encode(!empty($datos[18])  ? ($datos[18]) : '');
      $telefono              = !empty($datos[19])  ? ($datos[19]) : '';
      $nombre                = utf8_encode(!empty($datos[20])  ? ($datos[20]) : '');
      $apellidos             = utf8_encode(!empty($datos[21])  ? ($datos[21]) : '');

      if (!empty($dni)) {
        $checkemail_duplicidad = ("SELECT dni FROM cliente WHERE dni='" . ($dni) . "' AND id_sorteo=".$id_sorteo);
        $ca_dupli = mysqli_query($con, $checkemail_duplicidad);
        $cant_duplicidad = mysqli_num_rows($ca_dupli);
        //print_r($cant_duplicidad);

        //si hay un dni que ya fue ingresado, entonces se aumenta el numero de sus intentos
        //         $cant_jugadas 
        //obtengo la cant de la bd
        //("SELECT dni FROM cliente WHERE dni='" . ($dni) . "' ");

        $SqlCanJugada = ("SELECT cant_jugada from cliente where dni='" . $dni . "' AND id_sorteo=".$id_sorteo);
        $result = (mysqli_query($con, $SqlCanJugada));

        while ($row = $result->fetch_assoc()) {
          //echo $row['classtype']."<br>";
          $cant_obtenida =  $row['cant_jugada'];
        }

        $cant_obtenida = intval($cant_obtenida);
        $cant_jugadas = intval($cant_jugadas);
        $masoportunidades = $cant_obtenida + $cant_jugadas;

        $Sqlaumentar = "UPDATE `cliente` SET `cant_jugada`='$masoportunidades' where `dni`='$dni' AND id_sorteo=".$id_sorteo;
        $x = (mysqli_query($con, $Sqlaumentar));
      }
      if ($cant_duplicidad == 0) {

        $insertData = "INSERT INTO `cliente`(`dni`, `nombre`, `apellidos`,`cant_jugada`, `celular`, `telefono`, `correo`, `ciudad`, `distrito`, `direccion`, `departamento`, 
                `codigo_interno_cliente`, `codigo_deposito`, `tipo_deposito`, `tipo_deposito_sbs`, `fecha_apertura`, `fecha_vencimiento`, `plazo`, `monto_deposito_apert`, `moneda`, 
                `saldo_corte_moneda`,`id_sorteo`) VALUES ('$dni','$nombre','$apellidos','$cant_jugadas','$celular','$telefono','$correo','$ciudad','$distrito','$direccion','$departamento',
                '$codigo_interno_cliente','$codigo_deposito','$tipo_deposito','$tipo_deposito_sbs','$fecha_apertura','$fecha_vencimiento','$plazo',
                '$monto_deposito_apert','$moneda','$saldo_corte_monedaL','$id_sorteo')";

        $resul = mysqli_query($con, $insertData);
        /* var_dump($resul);
                echo 'HOLA';
                exit(); */
        //var_dump($resul);
        $data = 'ok';
      }

      /**Caso Contrario actualizo el o los Registros ya existentes*/
      else {
      }
    }

    $i++;
  }
  $data = 'Ok';
} else {
  //no hay documento seleccionado
  $data = 'null';
}

print $data;
$con = null;
exit();
