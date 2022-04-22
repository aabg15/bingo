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
$id_sorteo = $_REQUEST['ids'];

if (empty($id_sorteo)) {
  header("Location: index.php");
  //validar si el dni existe

} else {
}

$dni = $_SESSION["s_usuario"];
$objeto = new Conexion();
$conexion = $objeto->Conectar();

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
  $correo =  $datp['correo'];
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


include_once '../bd/config.php';
//$consultaJugadad = "SELECT * FROM jugada where `id_cliente`=" . $dni;
$consultaPremio = "SELECT * FROM ganadores where dni=" . $dni . " and id_sorteo=" . $id_sorteo;
$premioObtenidos = array();
$result = (mysqli_query($con, $consultaPremio));
$row = $result->fetch_all();

foreach ($row as $obj) {
  $premioObtenidos[] = array(
    "dni" => $obj[1],
    "premios" => $obj[3],
    "fechas" => $obj[2],
    "sorteo_id" => $obj[4]
  );
}
$json_premios = json_encode($premioObtenidos, true);


//$valor = $dataJugada[0];
//echo ($cant_jug);

/* if ($_SESSION["s_usuario"] === null) {
    header("Location: ../index.php");
} else {
    if ($cant_jug == $cantidadJugadas) {
        $data = 'Ya las jugdas estan completas, agradece y nos vamos';
        echo '<script>';
        echo 'console.log(' . json_encode($data) . ')';
        echo '</script>';
        header("Location: gracias.php");
    }
} */


/* if ($cant_jug == $cantidadJugadas) {
  //header("Location: gracias.php");
  header("Status: 301 Moved Permanently");
  header("Location:gracias.php");
  echo "<script language='javascript'>window.location='gracias.php'</script>;";
  exit();
} */

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../ruleta/styles/style_ruleta.css" type="text/css" media="screen" />
  <title>Felicidades!</title>

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

    #btn_ganaste {
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

      <!-- Nav Item - Search Dropdown (Visible Only XS) -->
      <li class="nav-item dropdown no-arrow d-sm-none">
        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-search fa-fw"></i>
        </a>
        <!-- Dropdown - Messages -->
        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
          <form class="form-inline mr-auto w-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>


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

      <input type="hidden" name="nombre" id="nombre" value="<?php echo $nombre; ?>">
      <input type="hidden" name="id_sorteo" id="id_sorteo" value="<?php echo $id_sorteo; ?>">
      <input type="hidden" name="sorteo" id="sorteo" value="<?php echo $sorteo; ?>">
      <input type="hidden" name="apellidos" id="apellidos" value="<?php echo $apellido; ?>">
      <input type="hidden" name="correo" id="correo" value="<?php echo $correo; ?>">
      <input type="hidden" name="json_jugadas" id="json_jugadas" value="<?php echo $json_jugadas; ?>">
      <input type="hidden" name="dni_jugador" id="dni_jugador" value="<?php echo $_SESSION["s_usuario"]; ?>">


      <!-- JUEGO -->
      <div class="col-auto p-5" id="juego">
        <!--         <center>
          <h5><b><?php echo $nombre . ' ' . $apellido; ?> </b></h5> <br>
        </center>
 -->
        <center>
          <h5 style="color:#ff8000;">¡GANASTE!</h5>
        </center>
        <br>
        <div id="formato-titulo">
          <center>
            <h5 style="color:black;">!Recoge tu premio! Tienes un plazo hasta de 10 dias del siguiente mes</h5>
          </center>
        </div>
        <br>

        <div id="formato-titulo">
          <center>
            <table class="table table-bordered" style="width: 100%;">
              <thead class="text-primary thead-dark">
                <tr>
                  <th> # </th>
                  <th> Premio ganado </th>
                  <th> Fecha</th>

                </tr>
              </thead>
              <tbody>

                <?php
                $i = 0;
                foreach ($premioObtenidos as $premiosO) {
                  $i = $i + 1;
                  $premio = $premiosO["premios"];
                  $fecha = $premiosO["fechas"];
                ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $premio; ?></td>
                    <td><?php echo $fecha; ?></td>
                  </tr>
                <?php
                }

                ?>

              </tbody>
            </table>
            <form id="formEnviarSucursal">
              <label for="recogo">Sucusal a recoger</label>
              <div class="form-group">
                <select class="custom-select form-control" id="sucursal" name="sucursal">
                </select>
              </div>
          </center>
        </div>
        <br><br><br>
        <div class="container-login-form-btn">
          <div class="wrap-login-form-btn">
            <div class="login-form-bgbtn"></div>

            <center>
              <button type=submit id="btn_ganaste" name="btn_ganaste">Continuar</button>

              <!-- onclick="window.location.href='index.php'" -->
            </center>
          </div>
        </div>

        </form>


      </div>
      <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
      <script>
        //enviar_correo('');


        function enviar_correo() {
          /*    var jsonres = '<?php echo $json_jugadas; ?>';
             var jsonresRu = '<?php echo $json_jugadas1; ?>';
             let x = JSON.parse(jsonres)
             let y = JSON.parse(jsonresRu) */
          enviar_loder('validando_info');
          var sucursal = $("#sucursal").val();
          var premios = '<?php echo $json_premios; ?>';
          let x = JSON.parse(premios)
          //console.log($("#json_jugadas").val());

          $.ajax({
            type: 'POST',
            url: 'enviar_correo.php',

            data: {
              nombre: document.getElementById('nombre').value,
              apellidos: document.getElementById('apellidos').value,
              id_sorteo: document.getElementById('id_sorteo').value,
              correo: document.getElementById('correo').value,
              sorteo: document.getElementById('sorteo').value,
              jugadasObtenidasRuleta: x,
              dni: document.getElementById('dni_jugador').value,
              tipo: 'ruleta',
              sucursal: sucursal,

            },
            success: function(data) {
              cerrar_loader('exito_envio');

            }
          });




        }

        function enviar_loder(mensaje) {
          var texto = null;
          var mostrar = false;
          switch (mensaje) {
            case 'validando_info':
              mostrar = true;
              break;
          }
          if (mostrar) {

            Swal.fire({
              title: 'Enviando Correo',
              html: 'Enviando Correo, por favor espere...',
              timerProgressBar: true,
              didOpen: () => {
                Swal.showLoading()
                const content = Swal.getContent()
                if (content) {
                  const b = content.querySelector('b')
                  b.textContent = Swal.getTimerLeft()
                }
              },
            })

          }
        }

        function cerrar_loader(mensaje) {
          var texto = null;
          var mostrar = false;
          var tipo = null;
          switch (mensaje) {
            case 'exito_envio':
              tipo = 'success';
              texto = 'Correo enviado exitosamente';
              mostrar = true;
              break;
          }
          if (mostrar) {
            Swal.fire({
              position: 'top-center',
              icon: tipo,
              title: texto,
              showConfirmButton: false,
              timer: 1500
            }).then((result) => {


              location.href = "index.php";


            })
          }








        }








        $(document).ready(function() {
          $.ajax({
              type: 'POST',
              url: '../recargar_agencias.php'
            })
            .done(function(listas_rep) {
              $('#sucursal').html(listas_rep)
              //alert('el id es: ')
            })
            .fail(function() {
              alert('Hubo un errror al cargar las listas_rep')
            })



        });
        $('#formEnviarSucursal').submit(function(e) {
          e.preventDefault();
          var sucursal = $("#sucursal").val();
          var premios = '<?php echo $json_premios; ?>';
          let x = JSON.parse(premios)

          if (sucursal == 0) {
            //alert(sucursal)
            Swal.fire({
              type: 'error',
              title: 'Debe seleccionar una agencia',
            });
          } else {

            $.ajax({
              url: "premioSucursal.php",
              type: "POST",
              datatype: "json",
              data: {
                premios: x,
                sucursal: sucursal,

              },
              success: function(data) {
                if (data == "null") {
                  Swal.fire({
                    type: 'error',
                    title: 'Registro no realizado',
                  });
                } else {
                  Swal.fire({
                    type: 'success',
                    title: '¡Registro de sucursal exitosa!',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Confirmar'
                  }).then((result) => {
                    if (result.value) {
                      //window.location.href = "vistas/pag_inicio.php";
                      //window.location.href = "ver_sorteos.php";
                      enviar_correo();
                      //enviar el correo de que gano




                    }
                  })

                }
              }
            });
          }



        });
      </script>
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

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <?php require_once "vistas/parte_inferior.php" ?><br>