<?php

/* include_once 'conexion.php';
 */
include 'config.php';
/* $objeto = new Conexion();
$conexion = $objeto->Conectar(); */

$premio = $_POST['premio'];
$descripcion = $_POST['descripcion'];
$sorteos_disp =  $_POST['sorteos_disp'];



if ($sorteos_disp == '0') {
   $data =null;
} else {
   //echo 'no es cero';
   if (isset($_FILES['imagen']['name'])) {

      $nombreImg = $_FILES['imagen']['name'];
      $ruta      = $_FILES['imagen']['tmp_name'];
      //$destino   = "../../../ruleta/img/" . $nombreImg;
      $destino   = "../../ruleta/img/" . $nombreImg;

      if (move_uploaded_file($ruta, $destino))
         $consulta = "INSERT INTO `ruleta`(`id_sorteo`,`descripcion`, `imagen_premio`, `nombre`) VALUES ('$sorteos_disp','$descripcion','$nombreImg','$premio')";
      $res = mysqli_query($con, $consulta);
      //echo $res;
      //exit();
      if ($res) {
         echo '<script type="text/javascript"> alert("Agregado Correctamente"); window.location="index.php";</script>';
         $data = "si";
      } else {
         $data = null;
         //die("Error" . mysqli_error($cn));
      }


      //$conexion = null;
   }
}

print json_encode($data);
