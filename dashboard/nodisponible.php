<?php

use function PHPSTORM_META\type;
session_start();
if ($_SESSION["s_usuario"] === null) {
  header("Location: ../index.php");
}

?>

<?php
include_once '../bd/conexion.php';

$dni = $_SESSION["s_usuario"];
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consultax = "SELECT * FROM cliente where dni=" . $dni;
$resultadox = $conexion->prepare($consultax);
$resultadox->execute();
$datax = $resultadox->fetchAll(PDO::FETCH_ASSOC);
foreach ($datax as $datp) {

  $nombre = $datp['nombre'];
  $apellido = $datp['apellidos'];
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../ruleta/styles/style_ruleta.css" type="text/css" media="screen" />

  <title>Realiza tus jugadas </title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

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

    #btn_gracias {
      width: 20%;
      weight: 50%;
      border-radius: 46px;
      margin-top: 15px;
      background: linear-gradient(to right, #f2cc15, #df040b);
      border: none;
      color: #fff;
      font-weight: bold;
      text-align: center;
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
    <a class="navbar-brand" href="#">
      <img src="img/logo-s-slogan.png" width="200" style="margin-left: 100px;">
    </a>
    <ul class="navbar-nav ml-auto">

 
      <div class="topbar-divider d-none d-sm-block"></div>

      <!-- Nav Item - User Information -->
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="mr-2 d-none d-lg-inline text-gray-600 small" id="nombreUsuario"><?php echo $nombre . ' ' . $apellido; ?></span>
          <!--                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">-->
          <img class="img-profile rounded-circle" src="img/user.png">
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            Cerrar Sesión
          </a>
        </div>
      </li>
    </ul>

  </nav>

  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">¿Confirma salir y cerrar Sesión?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">x</span>
          </button>
        </div>

        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <a class="btn btn-primary" href="../bd/logout.php">Salir</a>

        </div>
      </div>
    </div>
  </div>
  <div class="container">

    <div class="row justify-content-around align-items-center">

      <input type="hidden" name="nombre" id="nombre" value="<?php echo $nombre; ?>">
      <input type="hidden" name="id_sorteo" id="id_sorteo" value="<?php echo $id_sorteo; ?>">

      <input type="hidden" name="apellidos" id="apellidos" value="<?php echo $apellido; ?>">

      <input type="hidden" name="dni_jugador" id="dni_jugador" value="<?php echo $_SESSION["s_usuario"]; ?>">
      <!-- JUEGO -->
      <div class="col-auto p-5" id="juego">
        <center>
          <h5><b><?php echo $nombre . ' ' . $apellido; ?> </b></h5> <br>
        </center>

        <center>
          <h5 style="color:#ff8000;">¡Lo sentimos, por el momento no hay sorteos disponibles!</h5>
        </center>

        <br>


        <div id="formato-titulo">
       

          <center>
            <button onclick="window.location.href='../index.php'" type=submit id="btn_gracias" name="btn_gracias">Volver</button>
          </center>
        </div>
        <br>

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
  <script src="../plugins/sweetalert2/sweetalert2.all.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <?php require_once "vistas/parte_inferior.php" ?>
  <br>