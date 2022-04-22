<?php
session_start();

include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$recibirDatos = json_decode($_POST['obj2']);
//var_dump($recibirDatos);




//recepción de datos enviados mediante POST desde ajax
$nombre= $recibirDatos->nombre; 
$apellidos=$recibirDatos->apellidos; 
$cant_jugadas = $recibirDatos->intentos; 
$celular = $recibirDatos->celular; 
$ciudad =$recibirDatos->ciudad; 
$distrito = $recibirDatos->distrito;
$direccion=$recibirDatos->direccion;
$departamento =$recibirDatos->departamento;
$dni = $recibirDatos->dni;
$correo= $recibirDatos->email;
$telefono=$recibirDatos->telefono;
$sede =$recibirDatos->sede;
$saldo_corte =$recibirDatos->saldo_corte;
$moneda=$recibirDatos->moneda;
$monto_deposito=$recibirDatos->monto_deposito;
$plazo_dias =$recibirDatos->plazo_dias;
$fecha_apertura = $recibirDatos->fecha_apertura;
$fecha_vencimiento = $recibirDatos->fecha_vencimiento;
$tipo_deposito_sbs = $recibirDatos->tipo_deposito_sbs;
$tipo_deposito=$recibirDatos->tipo_deposito;
$codig_deposito=$recibirDatos->codig_deposito;
$codig_interno_cliente = $recibirDatos->codig_interno_cliente;

//$imagen = $_POST['imagen'];
//$descripcion = $_POST['descripcion'];
//$sorteos_disp =  $_POST['sorteos_disp'];

$consulta = "UPDATE cliente SET nombre='$nombre',apellidos='$apellidos',cant_jugada='$cant_jugadas',celular='$celular', telefono='$telefono'
,correo='$correo',ciudad='$ciudad',distrito='$distrito',direccion='$direccion', departamento='$departamento',saldo_corte_moneda='$saldo_corte'
,moneda='$moneda',monto_deposito_apert='$monto_deposito',plazo='$plazo_dias', fecha_apertura='$fecha_apertura', 
fecha_vencimiento='$fecha_vencimiento', tipo_deposito_sbs='$tipo_deposito_sbs',tipo_deposito='$tipo_deposito', id_sucursal='$sede',codigo_interno_cliente='$codig_interno_cliente', codigo_deposito='$codig_deposito'
WHERE dni='$dni'";

/* 
UPDATE cliente SET nombre='$nombre',apellidos='$apellidos',cant_jugada='$cant_jugadas',celular='$celular', telefono='$telefono',correo='$correo',ciudad='$ciudad',distrito='$distrito',direccion='$direccion', departamento='$departamento',saldo_corte_moneda='$saldo_corte',moneda='$moneda',monto_deposito_apert='$monto_deposito',plazo='$plazo_dias', fecha_apertura='".$fecha_apertura."', fecha_vencimiento='".$fecha_vencimiento."'tipo_deposito_sbs='$tipo_deposito_sbs',tipo_deposito='$tipo_deposito' id_sucursal='$sede'WHERE dni='$dni';
 */

//var_dump($consulta);
$resultado = $conexion->prepare($consulta);

//var_dump($resultado);

$resultado->execute();

if($resultado->rowCount() >0){
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    
    //$_SESSION["s_usuario"] = $usuario;
}else{
    //$_SESSION["s_usuario"] = null;
    $data = 'null';
}

print $data;
$conexion=null;
//usuarios de pruebaen la base de datos
//usuario:admin pass:12345
//usuario:demo pass:demo