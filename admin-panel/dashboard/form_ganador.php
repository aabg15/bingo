<?php

use function PHPSTORM_META\type;

$dni = $_GET['id'];
//var_dump($dni);
//echo $dni;

if (empty($dni)) {
  header("Location: index.php");
  //validar si el dni existe

} else {
}

/* obtengo ya sea vacio, con un numero o con el dni valido 

lo debo dejar pasar, solo si agrego un digito
 */

?>

<?php
include_once 'bd/conexion.php';

//$dni = $_SESSION["s_usuario"];
//echo $dni;
$objeto = new Conexion();
$conexion = $objeto->Conectar();
//echo $dni;


$consultax = "SELECT * FROM cliente where dni=" . $dni;
$resultadox = $conexion->prepare($consultax);

$resultadox->execute();


if ($resultadox->rowCount() >= 1) {
  $datax = $resultadox->fetchAll(PDO::FETCH_ASSOC);
  //$_SESSION["s_usuario"] = $usuario;
} else {
  //$_SESSION["s_usuario"] = null;
  $datax = null;
  header("Location: index.php");
}



  /* $datax = $resultadox->fetchAll(PDO::FETCH_ASSOC);
var_dump($datax) */;
foreach ($datax as $datp) {

  $nombre = $datp['nombre'];
  $apellido = $datp['apellidos'];
  //$cantidadJugadas = $datp['cant_jugada'];
  $celular =  $datp['celular'];
  $telefono =  $datp['telefono'];
  $correo =  $datp['correo'];
  $direccion =  $datp['direccion'];
  $departamento = $datp['departamento'];
  $provincia = $datp['ciudad'];
  $distrito = $datp['distrito'];
  $sucursal = $datp['id_sucursal'];
}



//obtener todas las agencias-sucursales
$consultaSucursal = "SELECT * FROM sucursal";
$resultadoSucursal  = $conexion->prepare($consultaSucursal);
$resultadoSucursal->execute();
$dataS = $resultadoSucursal->fetchAll(PDO::FETCH_ASSOC);

foreach ($dataS as $datpS) {

  $nombre_sucursal = $datpS['nombre_sucursal'];
  $recuento = $datpS['recuento'];
  //$cantidadJugadas = $datp['cant_jugada'];
  $codigo_agencia =  $datpS['codigo_agencia'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Felicidades </title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <link href="style.css" rel="stylesheet">
  <style>
    #contenedor {
      padding: 20px;
      border: 3px solid rgb(253, 133, 0);
      ;
      border-radius: 10px;
      overflow: hidden;
      max-width: 350px;
    }

    .cont_caja>div {
      margin: 3px;
      width: 45px;
      height: 45px;
      line-height: 45px;
      text-align: center;
      /* box-shadow: 0 0 5px rgba(0, 0, 0, 0.3); */
      border-radius: 5px;
      float: left;
      cursor: pointer;

    }

    .cont_caja>div.disable {
      color: red;
      font-size: 1.3em;
    }

    .cont_caja>div:hover {
      color: rgb(253, 133, 0);
    }

    .btns {
      background-color: rgb(253, 133, 0);
      margin: 2px 2px 2px 2px;
      color: #fff;
    }

    .seleccionadas {
      margin: 3px;
      width: 45px;
      height: 45px;
      line-height: 45px;
      text-align: center;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
      border-radius: 100%;
      float: left;
      cursor: pointer;
      border: 3px solid rgb(253, 133, 0);
      ;
    }
  </style>
</head>

<body>

  <nav class="navbar navbar-expand-sm navbar-dark" style="padding: 0.6rem 1rem;background-color:rgb(253,133,0)">
    <!-- Brand -->
    <a class="navbar-brand" href="index.php">
      <img src="dashboard/img/logo-s-slogan.png" width="200" style="margin-left: 100px;">
    </a>
  </nav>
  <br><br>
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-md-12">
        <!--  <div class="shadow m-5 bg-white rounded"> -->
        <div>
          <form class="login-form validate-form" id="formDatos" method="post">
            <div class="row">
              <div class="col-md-9">
                <div class="row p" id="contenedor_datos">
                  <legend class="m-3" id="tituloprimero">Validación de datos</legend>

                  <div class="col-md-6">

                    <div class="form-group">
                      <!-- <label for="tipo_documento">Tipo de documento</label> -->
                      <select class="form-control" id="tipo_documento">
                        <option value="0">Tipo de documento</option>
                        <option value="1">DNI</option>
                        <option value="2">CE</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <!-- <label for="id_documento_inpt">Numero de Documento</label> -->
                      <input type="text" class="form-control" id="dni" placeholder="N° DNI o CE" readonly value="<?php echo $dni; ?>">
                    </div>

                    <div class="form-group">
                      <!-- <label for="id_nombres_inpt">Nombres</label> -->
                      <input type="text" class="form-control" id="nombre" value="<?php echo $nombre; ?>">
                    </div>

                    <div class="form-group">
                      <!-- <label for="id_apellidos_inpt">Apellidos</label> -->
                      <input type="text" class="form-control" id="apellido" value="<?php echo $apellido; ?>">
                    </div>


                    <div class="form-group">
                      <!-- <label for="id_telefono_inpt">Telefono</label> -->
                      <input type="text" class="form-control" id="telefono" value="<?php echo $telefono; ?>">
                    </div>

                    <div class="form-group">
                      <!-- <label for="id_email_inpt">Correo electrónico</label> -->
                      <input type="email" class="form-control" id="correo" value="<?php echo $correo; ?>">
                    </div>

                    <div class="form-group">
                      <!-- <label for="id_direccion_inpt">Dirección</label> -->
                      <input type="text" class="form-control" id="direccion" value="<?php echo $direccion; ?>">
                    </div>


                    <div class="form-group">
                      <label for="sucursal">Sucursal</label>
                      <?php
                      if ($sucursal == "") {
                        //echo 'no tienendatos muestra el select';
                      ?>
                        <select class="custom-select form-control" id="sucursal" name="sucursal">

                        </select>


                      <?php
                      } else { ?>
                        <input type="text" class="form-control" id="sucursal" name="sucursal" value="<?php echo $sucursal; ?>">
                      <?php
                      }

                      ?>

                    </div>



                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <!--   <label for="id_celular_inpt">Celular</label> -->
                      <input type="text" class="form-control" id="celular" value="<?php echo $celular; ?>">

                    </div>

                    <div class="form-group">
                      <label for="departamento">Departamento</label>
                      <?php
                      if ($departamento == "") {
                        //echo 'no tienendatos muestra el select';
                      ?>
                        <select class="custom-select form-control" id="departamento" name="departamento">

                        </select>


                      <?php
                      } else { ?>
                        <input type="text" class="form-control" id="departamento" name="departamento" value="<?php echo $departamento; ?>">
                      <?php
                      }

                      ?>

                    </div>

                    <div class="form-group">
                      <label for="provincia">Provincia</label>


                      <?php
                      if ($provincia == "") {
                        //echo 'no tienendatos muestra el select';
                      ?>

                        <select class="form-control" id="provincia" name="provincia">

                        </select>

                      <?php
                      } else { ?>
                        <input type="text" class="form-control" id="provincia" name="provincia" value="<?php echo $provincia; ?>">

                      <?php
                      }

                      ?>
                    </div>


                    <div class="form-group">
                      <label for="distrito">Distrito</label>

                      <?php
                      if ($distrito == "") {
                        //echo 'no tienendatos muestra el select';
                      ?>

                        <select class="form-control" id="distrito" name="distrito">

                        </select>

                      <?php
                      } else { ?>
                        <input type="text" class="form-control" id="distrito" name="distrito" value="<?php echo $distrito; ?>">

                      <?php
                      }

                      ?>

                    </div>
                    <br>
                    <div class="form-group">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" value="" id="checkPoliticas">
                          Acepta los politica de privacidad y uso de sus datos personales
                        </label>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" value="" id="checkTerminosCondiciones">
                          Acepto terminos y condiciones
                        </label>
                      </div>
                    </div>

                  </div>
                </div>
                <div class="row justify-content-center m-5">

                  <button type="button" class="btn btn-primary btn-lg mr-2 btn-bg" onclick="location.href='index.php'">Volver</button>
                  <button type="submit" class="btn btn-secondary btn-lg  btn-bg">Jugar</button>
                  <!--   <button type="button" id="btn_nav2" class="btn btn-primary btn-lg mr-2 btn-bg"  onclick="location.href='index.php'">Volver</button>
                                    <button type="submit" id="btn_nav2" class="btn btn-secondary btn-lg btn-bg">Jugar</button>
 -->
                </div>

                <style>
                  #fotoPrueba {

                    max-width: 400px;
                    max-height: 2000px;
                    /* width: 50px; */
                    height: 300px;
                    filter: brightness(1.1);
                    mix-blend-mode: multiply;
                  }
                </style>


              </div>


              <div class="col-md-3 info-col" id="fotoSenalando">
                <!-- <div class="col-auto p-5" id="juego"> -->
                <!--  <h3 id="tituloParaFoto">foto de fondo </h3> -->
                <!--    width="200" style="margin-left: 100px;" -->
                <!--  <img src="img/imagen_persona.jpg"> -->
                <!--     </div> -->
                <br><br><br><br>
                <img src="dashboard/img/senalandosinfondo.png" id="fotoPrueba">

              </div>



            </div>
          </form>
        </div>
        <!-- </div> -->
      </div>
    </div>
  </div>




  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
  </script>


  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>



  <script src="jquery/jquery-3.3.1.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="popper/popper.min.js"></script>
  <script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>
  <script src="codigo.js"></script>
  <script src="assets/js/jquery.min.js"></script>
  <script src="controlador/select.js"></script>
  <script src="controlador/select_sucursal.js"></script>

  <?php require_once "dashboard/vistas/parte_inferior.php" ?>