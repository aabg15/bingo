<?php

use function PHPSTORM_META\type;

session_start();
if (!isset($_SESSION["s_usuario"])) {
  //echo 'aqui?';
  //exit();
  header("Location: ../index.php");
}
?>

<?php
include_once '../bd/conexion.php';

$dni = $_SESSION["s_usuario"];
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$id_sorteo = $_REQUEST['id'];
if (empty($id_sorteo)) {
  header("Location: index.php");
  //validar si el dni existe

} else {

}

//$consulta = "SELECT * FROM sorteo where dni=" . $dni;
$consulta = "SELECT * FROM sorteo where id_sorteo=" . $id_sorteo;

//$resultado = $conexion->prepare($consulta);
$resultado = $conexion->prepare($consulta);

//$resultado->execute();
$resultado->execute();

$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

foreach ($data as $datx) {
  //$id_sorteo = $datx['id_sorteo'];
  $sorteo = $datx['nombre'];
  $fecha_inicio = $datx['fecha_inicio'];
  $fecha_fin = $datx['fecha_fin'];
}

$consultax = "SELECT * FROM cliente where dni=" . $dni . " and id_sorteo=" . $id_sorteo;
$resultadox = $conexion->prepare($consultax);
$resultadox->execute();
$datax = $resultadox->fetchAll(PDO::FETCH_ASSOC);
foreach ($datax as $datp) {

  $nombre = $datp['nombre'];
  $apellido = $datp['apellidos'];
  $cantidadJugadas = $datp['cant_jugada'];
}

$consultaJugada = "SELECT count(`id_cliente`) as 'cant' FROM subjugada where `id_cliente`=" . $dni . " and id_sorteo=" . $id_sorteo;
$resultadoJugada = $conexion->prepare($consultaJugada);
$resultadoJugada->execute();
$dataJugada = $resultadoJugada->fetchAll(PDO::FETCH_ASSOC);
foreach ($dataJugada as $datpX) {

  $cant_jug = $datpX['cant'];
}
//$valor = $dataJugada[0];
//echo ($cant_jug);

/* if ($_SESSION["s_usuario"] === null) {
    header("Location: /");
} else {
        if ($cant_jug == $cantidadJugadas) {
        $data = 'Ya las jugdas estan completas, agradece y nos vamos';
        echo '<script>';
        echo 'console.log(' . json_encode($data) . ')';
        echo '</script>';
        header("Location: gracias.php");
    } 
} */

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

    #btn_jugenv {
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
      <input type="hidden" name="cantidadJugadas" id="cantidadJugadas" value="<?php echo $cantidadJugadas; ?>">
      <input type="hidden" name="cant_jugadas_control" id="cant_jugadas_control" value="<?php echo $cant_jug; ?>">

      <input type="hidden" name="id_sorteo" id="id_sorteo" value="<?php echo $id_sorteo; ?>">

      <input type="hidden" name="dni_jugador" id="dni_jugador" value="<?php echo $_SESSION["s_usuario"]; ?>">

      <!-- JUEGO -->
      <div class="col-auto p-5" id="juego">
        <center>
          <h5><b><?php echo $nombre . ' ' . $apellido; ?> </b></h5> <br>
        </center>

        <center>
          <h5 style="color:#ff8000;">¡Tus jugadas ha sido ingresadas con éxito!</h5>
        </center>

        <br>
        <div id="mis jugadas">

          <table class="table table-bordered">
            <tr>
              <th> # de Jugadas </th>
              <th> Fecha</th>
              <th> Jugadas</th>
            </tr>
            <?php

            //require '../conector/conexion.php';
            require('../bd/config.php');

            $sqlData = "SELECT * FROM `jugada` where id_cliente='" . $dni . "' and id_sorteo=" . $id_sorteo;
            $sql = mysqli_query($con, $sqlData);


            //$sql = mysql_query("SELECT * FROM usuario ORDER BY ID_usuario DESC");
            $i = 0;

            $row_cnt = mysqli_num_rows($sql);
            if ($row_cnt > 0) {

              while ($row = mysqli_fetch_assoc($sql)) {
                $i++;
                $fecha = $row['fecha'];
                $letras = $row['letras'];
            ?>
                <tr>
                  <td> <?php echo $i; ?></td>
                  <td> <?php echo $fecha; ?></td>
                  <td> <?php echo $letras; ?></td>

                </tr>
              <?php
              }
            } else {
              //No hay registros
              ?>



            <?php
              //echo 'no hay jugadas';
            }
            ?>

          </table>
        </div>

        <br>

        <div id="formato-titulo">
          <center>
            <p style="color:black;">Ahora prueba suerte y participa de uno de los sorteos diarios</p>
          </center>
        </div>
        <center>
          <div id='botonNew'>
            <div class="container-login-form-btn">
              <div class="wrap-login-form-btn">
                <div class="login-form-bgbtn"></div>
                <button onclick="window.location.href='juego_diario.php?id=<?php echo $id_sorteo;?>'" type="submit" id="btn_jugenv" name="btn_jugenv">Jugar</button>
 
              </div>
            </div>
          </div>
        </center>

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




  <?php require_once "vistas/parte_inferior.php" ?><br>