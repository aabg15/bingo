<?php

use function PHPSTORM_META\type;

session_start();
if (!isset($_SESSION["s_usuario"])) {
  //echo 'aqui?';
  //exit();
  header("Location: ../index.php");
}


//$_SESSION["s_usuario"] = $dni;
?>

<?php
include_once '../bd/conexion.php';

$dni = $_SESSION["s_usuario"];
//echo $dni;
//exit();
$objeto = new Conexion();
$conexion = $objeto->Conectar();
//echo $dni;
//$consulta = "SELECT * FROM sorteo where dni=" . $dni;

//saber cuantos sorteos hay:
$cant_sorteo = "SELECT COUNT(*) total from sorteo";
$resultadocs = $conexion->query($cant_sorteo);
$total = $resultadocs->fetchColumn();


if ($total > 0) {
  //echo 'bien;';
  if ($total == 1) {
    echo 'solo un sorteo,dejamos que juegue tranquilo';
    $consultaIdSorteo = "SELECT MIN(`id_sorteo`) as total from `sorteo` where(`estado` LIKE 'SS');";
    $resultadoid = $conexion->prepare($consultaIdSorteo);
    $resultadoid->execute();
    $dataid = $resultadoid->fetchAll(PDO::FETCH_ASSOC);

    foreach ($dataid as $datid) {
      $id_sorteo = $datid['total'];
    }
  } else {
    //quiere decir que hay mas de 2 sorteos,PERO se debe JUGAR EL PRIMERO QUE SE REGISTRO Y SIEMPRE Y CUANDO, ESTE SIN SORTEARSE.
    $consultaIdSorteo = "SELECT MIN(`id_sorteo`) as total from `sorteo` where(`estado` LIKE 'SS');";

    $resultadoid = $conexion->prepare($consultaIdSorteo);

    $resultadoid->execute();

    $dataid = $resultadoid->fetchAll(PDO::FETCH_ASSOC);
    //var_dump($dataid[0]['total']);
    //exit();
    if ($dataid[0]['total'] != NULL) {
      foreach ($dataid as $datid) {
        $id_sorteo = $datid['total'];
      }
    } else {
      //ya no hay mas sorteos disponibles

      echo 'no hay';
      //echo 'el sorteo a jugar es : ' . $id_sorteo;
      //exit();
      header("Location: nodisponible.php");
    }
  }
} else {
  echo 'mandar vista,no hay sorteos disponibles por ahora!';
  header("Location: nodisponible.php");
}

$consulta = "SELECT * FROM sorteo where id_sorteo=" . $id_sorteo;

//echo 'el id del sorteo es: ->'.$id_sorteo;

$resultado = $conexion->prepare($consulta);

$resultado->execute();

$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

foreach ($data as $datx) {
  //$id_sorteo = $datx['id_sorteo'];
  $sorteo = $datx['nombre'];
  $fecha_inicio = $datx['fecha_inicio'];
  $fecha_fin = $datx['fecha_fin'];
}



//saber el minimo y el maximo valor del sorteo

$consultax = "SELECT * FROM cliente where dni='".$dni."' and id_sorteo=" . $id_sorteo;
$resultadox = $conexion->prepare($consultax);
$resultadox->execute();


$datax = $resultadox->fetchAll(PDO::FETCH_ASSOC);

foreach ($datax as $datp) {

  $nombre = $datp['nombre'];
  $apellido = $datp['apellidos'];
  $cantidadJugadas = $datp['cant_jugada'];
}



$consultaJugada = "SELECT count(`id_cliente`) as 'cant' FROM jugada where `id_cliente`=" . $dni." and id_sorteo=" . $id_sorteo;
$resultadoJugada = $conexion->prepare($consultaJugada);
$resultadoJugada->execute();
$dataJugada = $resultadoJugada->fetchAll(PDO::FETCH_ASSOC);
foreach ($dataJugada as $datp) {

  $cant_jug = $datp['cant'];
}

$consultaJugada2 = "SELECT count(`id_cliente`) as 'cant' FROM subjugada where `id_cliente`=" . $dni;
$resultadoJugada2 = $conexion->prepare($consultaJugada2);
$resultadoJugada2->execute();

$dataJugada2 = $resultadoJugada2->fetchAll(PDO::FETCH_ASSOC);
foreach ($dataJugada2 as $datp2) {

  $cant_jug2 = $datp2['cant'];
}
//$valor = $dataJugada[0];
//echo ($cant_jug);


if ($cant_jug == $cantidadJugadas && ($cant_jug2 == $cantidadJugadas)) { //todos los juegos asignados, los jugo
  //hizo todas las jugadas, tanto de la ruleta y las letras.
  //header("Location: gracias.php");

  header("Status: 301 Moved Permanently");
  header("Location:gracias.php");
  echo "<script language='javascript'>window.location='gracias.php'</script>;";
  exit();
  $data = 'HEADER DEL INDEX-CON DOBLE CONDICION';
  echo '<script>';
  echo 'console.log(' . json_encode($data) . ')';
  echo '</script>';
} else {
  if ($cant_jug == $cantidadJugadas) {
    $data = 'Lo mandamos al sgte juego';
    echo '<script>';
    echo 'console.log(' . json_encode($data) . ')';
    echo '</script>';
    //header("Location: juego_diario.php");
    header("Status: 301 Moved Permanently");
    header("Location:juego_diario.php?id=$id_sorteo");
    echo "<script language='javascript'>window.location='juego_diario.php'</script>;";
    exit();
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Realiza tus jugadas </title>
  <link rel="shortcut icon" type="image/x-icon" href="/logo-icon.ico" />


  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <link href="../style.css" rel="stylesheet">
  <style>
    #contenedor {
      padding: 20px;
      border: 3px solid rgb(253, 133, 0);

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
    <a class="navbar-brand" href="#">
      <img src="img/logo-s-slogan.png" width="200" style="margin-left: 100px;">
    </a>
    <ul class="navbar-nav ml-auto" id="iconousuario">


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
    <input type="hidden" name="cantidadJugadas" id="cantidadJugadas" value="<?php echo $cantidadJugadas; ?>">
    <input type="hidden" name="cant_jugadas_control" id="cant_jugadas_control" value="<?php echo $cant_jug; ?>">

    

    <input type="hidden" name="dni_jugador" id="dni_jugador" value="<?php echo $_SESSION["s_usuario"]; ?>">


    <br><br><br>
    <div class="row justify-content-md-center">
      <div class="col-md-12">

        <!--  <div class="shadow m-5 bg-white rounded"> -->
        <div>
          <form class="login-form validate-form" id="formDatos" method="post">
          <input type="hidden" name="id_sorteo" id="id_sorteo" value="<?php echo $id_sorteo; ?>">
            <div class="row">
              <div class="col-md-9">
                <div class="row p-4">
                  <!-- <legend class="m-3" id="tituloprimero">SORTEO :<?php echo $sorteo; ?> </legend> -->

                  <div class="col-md-6">
                    <div class="col-auto p-1" id="juego">
                      <h5><b>Jugador : <?php echo $nombre . ' ' . $apellido; ?> </b></h5> <br>
                      <!--  <h5><b>Cantidad de jugadas Disponibles : <?php echo $cantidadJugadas; ?> </b></h5> <br>
                <h5><b>Jugada N° 0<?php echo $cant_jug + 1; ?> </b></h5> <br> -->

                      <center>
                        <h5><b>Elige 7 letras para el sorteo</b></h5>
                      </center>
                      <div id="contenedor" class="cont_caja row">
                        <div class="caja col-md-1 col-sm-2 col-xs-2">A</div>
                        <div class="caja col-md-1 col-sm-2 col-xs-2">B</div>
                        <div class="caja col-md-1 col-sm-2 col-xs-2">C</div>
                        <div class="caja col-md-1 col-sm-2 col-xs-2">D</div>
                        <div class="caja col-md-1 col-sm-2 col-xs-2">E</div>
                        <div class="caja col-md-1 col-sm-2 col-xs-2">F</div>
                        <div class="caja col-md-1 col-sm-2 col-xs-2">G</div>
                        <div class="caja col-md-1 col-sm-2 col-xs-2">H</div>
                        <div class="caja col-md-1 col-sm-2 col-xs-2">I</div>
                        <div class="caja col-md-1 col-sm-2 col-xs-2">J</div>
                        <div class="caja col-md-1 col-sm-2 col-xs-2">K</div>
                        <div class="caja col-md-1 col-sm-2 col-xs-2">L</div>
                        <div class="caja col-md-1 col-sm-2 col-xs-2">M</div>
                        <div class="caja col-md-1 col-sm-2 col-xs-2">N</div>
                        <div class="caja col-md-1 col-sm-2 col-xs-2">O</div>
                        <div class="caja col-md-1 col-sm-2 col-xs-2">P</div>
                        <div class="caja col-md-1 col-sm-2 col-xs-2">Q</div>
                        <div class="caja col-md-1 col-sm-2 col-xs-2">R</div>
                        <div class="caja col-md-1 col-sm-2 col-xs-2">S</div>
                        <div class="caja col-md-1 col-sm-2 col-xs-2">T</div>
                        <div class="caja col-md-1 col-sm-2 col-xs-2">U</div>
                        <div class="caja col-md-1 col-sm-2 col-xs-2">V</div>
                        <div class="caja col-md-1 col-sm-2 col-xs-2">W</div>
                        <div class="caja col-md-1 col-sm-2 col-xs-2">X</div>

                        <div class="caja col-md-1 col-sm-2 col-xs-2">Y</div>
                        <div class="caja col-md-1 col-sm-2 col-xs-2">Z</div>


                      </div>
                      <br>

                    </div>

                  </div>
                  <div class="col-md-6">

                    <div class="col-auto p-1" id="juego">
                      <center>

                        <h5><b>Letras seleccionadas</b></h5>
                      </center>
                      <br><br>
                      <div class="seleccionadas s1" id="seleccionadaLetra"></div>
                      <div class="seleccionadas s2" id="seleccionadaLetra"></div>
                      <div class="seleccionadas s3" id="seleccionadaLetra"></div>
                      <div class="seleccionadas s4" id="seleccionadaLetra"></div>
                      <div class="seleccionadas s5" id="seleccionadaLetra"></div>
                      <div class="seleccionadas s6" id="seleccionadaLetra"></div>
                      <div class="seleccionadas s7" id="seleccionadaLetra"></div>
                      <br><br><br><br>

                      <div class="row mt-10">
                        <div class="col-md text-center">
                          <button class="btn btns mr-4" id="botonBorrar" type="button">Borrar</button>
                          <button class="btn btns ok" type="button">Enviar</button>
                        </div>
                      </div>

                    </div>

                  </div>

                </div>

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
              <br><br>
              <div class="col-md-3 info-col">
                <!-- <div class="col-auto p-5" id="juego"> -->
                <!--  <h3 id="tituloParaFoto">foto de fondo </h3> -->
                <!--    width="200" style="margin-left: 100px;" -->
                <!--  <img src="img/imagen_persona.jpg"> -->
                <!--     </div> -->
                <br><br>
                <img src="img/senalandosinfondo.png" id="fotoPrueba">

              </div>
            </div>
          </form>
        </div>
        <!-- </div> -->
      </div>
    </div>

  </div>

  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
  </script>

  <script>
    var cont = 0;
    //var btn_letra = document.querySelectorAll('.caja');
    const cadenaLetras = [];

    $('.caja').on('click', function() {

      if ($(this).hasClass('disable') == false) {
        cont++;
        console.log('fuera de los' + cont);
        $(this).addClass('disable');
        let letra = $(this).text(); //captura texto html
        if (cont < 8) {

          $('.s' + cont + '').text(letra);
          let letrasSeleccionadas = $('.s' + cont + '').text(letra);
          //console.log(letra);
          cadenaLetras.push(letra);
          console.log(cadenaLetras);

          console.log(cont);
        } else {
          //alert('Jugada completa');
          const Toast = Swal.mixin({
            toast: true,
            position: 'center',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          })
          Toast.fire({
            icon: 'success',
            title: 'Tu jugada está completa'
          }).then(function() {
            //eliminarLS();
            //location.href = "../informativo.php";
          });
          $(this).removeClass('disable');
          cont = 7;
        }
        //console.log(cont);
      }
    })

    $('#botonBorrar').click(function() {
      console.log('se borra el lugar : ' + cont);
      let letra = $('.s' + cont + '').text(); +
      $('.caja').each(function() {
        let letraTemporal = $(this).text();
        if (letraTemporal == letra) {
          $(this).removeClass('disable');
          cadenaLetras.pop(letra);
          console.log(cadenaLetras);
        }
      })
      //alert(letra);
      $('.s' + cont + '').text("");
      cont = cont - 1;
      if (cont < 0) {
        cont = 0;
      }
    })


    $('.ok').click(function() {


      //jugadas correctas
      if (cont == 7 && cont < 8) {
        console.log('Jugada accesible, manda la data');
        const cant_jugad = document.getElementById('cantidadJugadas').value;
        var dni = document.getElementById('dni_jugador').value;
        var id_sorteo = document.getElementById('id_sorteo').value;
        var cant_control = document.getElementById('id_sorteo').value;
        console.log('cant de jugadas ' + cant_jugad);
        console.log('cant de jugadas de control' + cant_control);
        if (cant_jugad != cant_jugadas_control) {
          console.log((cant_jugad));

          var url = "guardar_jugada.php";
          $.ajax({
            type: "POST",
            url: url,
            datatype: "json",
            data: {
              dni: dni,
              cadenaLetras: cadenaLetras,
              id_sorteo: id_sorteo,
              cant_jugad: cant_jugad

            },
            success: function(data) {

              if (data == "null") {

                const Toast = Swal.mixin({
                  toast: true,
                  position: 'center',
                  showConfirmButton: false,
                  timer: 2000,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                  }
                })
                Toast.fire({
                  icon: 'error',
                  title: 'Tu jugada no fue registrada'
                }).then(function() {
                  //eliminarLS();
                  //location.href = "../informativo.php";
                });
              } else {
                const Toast = Swal.mixin({
                  toast: true,
                  position: 'center',
                  showConfirmButton: false,
                  timer: 2000,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                  }
                })
                Toast.fire({
                  icon: 'success',
                  title: 'FELICIDADES, TU JUGADA FUE GUARDADA'
                }).then(function() {
                  //eliminarLS();
                  location.href = "jugada_enviada.php?id="+id_sorteo;
                });



              }



            }
          });
        }
      } else {
        if (cont != 7) {
          //4 letras a menos, seleccionadas
          //console.log("Debe seleccionar entre 5 a 7 letras para poder jugar");

          const Toast = Swal.mixin({
            toast: true,
            position: 'center',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          })
          Toast.fire({
            icon: 'error',
            title: 'Debe seleccionar 7 letras para poder jugar'
          }).then(function() {
            //eliminarLS();
            //location.href = "index.php";
          });



        }
      }
    })
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
  <script src="../jquery/jquery-3.3.1.min.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <!-- <script src="../popper/popper.min.js"></script> -->
  <script src="../plugins/sweetalert2/sweetalert2.all.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>




  <?php require_once "vistas/parte_inferior.php" ?>