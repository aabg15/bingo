<?php
session_start();

include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

//recepción de datos enviados mediante POST desde ajax
$apellidos = (isset($_POST['apellidos'])) ? $_POST['apellidos'] : '';
$ciudad1 = (isset($_POST['ciudad'])) ? $_POST['ciudad'] : '';
$distrito1 = (isset($_POST['distrito'])) ? $_POST['distrito'] : '';
$departamento1 = (isset($_POST['departamento'])) ? $_POST['departamento'] : '';
$celular = (isset($_POST['celular'])) ? $_POST['celular'] : '';
$telefono = (isset($_POST['telefono'])) ? $_POST['telefono'] : '';
$dni = (isset($_POST['dni'])) ? $_POST['dni'] : '';
$sede = (isset($_POST['sede'])) ? $_POST['sede'] : '';
$correo = (isset($_POST['email'])) ? $_POST['email'] : '';
$direccion = (isset($_POST['direccion'])) ? $_POST['direccion'] : '';
$intentos = (isset($_POST['intentos'])) ? $_POST['intentos'] : '';
$saldo_corte = (isset($_POST['saldo_corte'])) ? $_POST['saldo_corte'] : '';
$moneda = (isset($_POST['moneda'])) ? $_POST['moneda'] : '';
$monto_deposito = (isset($_POST['monto_deposito'])) ? $_POST['monto_deposito'] : '';
$plazo_dias = (isset($_POST['plazo_dias'])) ? $_POST['plazo_dias'] : '';
$fecha_apertura = (isset($_POST['fecha_apertura'])) ? $_POST['fecha_apertura'] : '';
$fecha_vencimiento = (isset($_POST['fecha_apertura'])) ? $_POST['fecha_apertura'] : '';
$tipo_deposito_sbs = (isset($_POST['tipo_deposito_sbs'])) ? $_POST['tipo_deposito_sbs'] : '';
$tipo_deposito = (isset($_POST['tipo_deposito'])) ? $_POST['tipo_deposito'] : '';
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$codig_interno_cliente = (isset($_POST['codig_interno_cliente'])) ? $_POST['codig_interno_cliente'] : '';
$codig_deposito = (isset($_POST['codig_deposito'])) ? $_POST['codig_deposito'] : '';
$id_sorteo = (isset($_POST['id_sorteo'])) ? $_POST['id_sorteo'] : '';

/* echo $codig_deposito;
echo $codig_interno_cliente;
exit(); */
require('config.php');
//var_dump($departamento);

$sqldepart = "SELECT departamento from ubdepartamento where idDepa='" . $departamento1 . "';";
$sqlD = mysqli_query($con, $sqldepart);
while ($fila = $sqlD->fetch_row()) {
    $departamento = $fila[0];
}

$sqldistr = "SELECT distrito from ubdistrito where idDist='" . $distrito1 . "';";
$sqlDis = mysqli_query($con, $sqldistr);
while ($fila = $sqlDis->fetch_row()) {
    $distrito = $fila[0];
}

$sqlprovi = "SELECT provincia from ubprovincia where idProv='" . $ciudad1 . "';";
$sqlPro = mysqli_query($con, $sqlprovi);
while ($fila = $sqlPro->fetch_row()) {
    $ciudad = $fila[0];
}


if (!empty($dni)) {
    $checkemail_duplicidad = ("SELECT dni FROM cliente WHERE dni='" . ($dni) . "' ");
    $ca_dupli = mysqli_query($con, $checkemail_duplicidad);
    $cant_duplicidad = mysqli_num_rows($ca_dupli);
    //print_r($cant_duplicidad);
}

//No existe Registros Duplicados
if ($cant_duplicidad == 0) {



    $consulta = "INSERT INTO `cliente`(`dni`, `nombre`, `apellidos`,`cant_jugada`, `celular`, `telefono`, `correo`,`ciudad`, 
`distrito`, `direccion`, `departamento`,`tipo_deposito`, `tipo_deposito_sbs`, `fecha_apertura`, 
`fecha_vencimiento`, `plazo`, `monto_deposito_apert`, `moneda`, `saldo_corte_moneda`,`codigo_interno_cliente`,`codigo_deposito`,`id_sucursal`,`id_sorteo`) VALUES ('$dni','$nombre','$apellidos',
'$intentos','$celular','$telefono','$correo','$ciudad','$distrito','$direccion','$departamento','$tipo_deposito','$tipo_deposito_sbs',
'$fecha_apertura','$fecha_vencimiento','$plazo_dias','$monto_deposito','$moneda','$saldo_corte','$codig_interno_cliente','$codig_deposito','$sede','$id_sorteo')";


    $resultado = $conexion->prepare($consulta);
    /* var_dump($resultado);
exit(); */
    $resultado->execute();

    if ($resultado->rowCount() > 0) {
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        //$_SESSION["s_usuario"] = $usuario;
    } else {
        //$_SESSION["s_usuario"] = null;
        $data = null;
    }

    print json_encode($data);
    $conexion = null;
} else {
    $data = null;
    print json_encode($data);
    $conexion = null;
}


//usuarios de pruebaen la base de datos
//usuario:admin pass:12345
//usuario:demo pass:demo