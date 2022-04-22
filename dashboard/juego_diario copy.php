<?php
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

$consultax = "SELECT * FROM cliente where dni=" . $dni;
$resultadox = $conexion->prepare($consultax);
$resultadox->execute();
$datax = $resultadox->fetchAll(PDO::FETCH_ASSOC);
foreach ($datax as $datp) {

    $nombre = $datp['nombre'];
    $apellido = $datp['apellidos'];
    $cantidadJugadas = $datp['cant_jugada'];
}
//id jugada

/* $consultax = "SELECT * FROM jugada where dni=" . $dni;
$resultadox = $conexion->prepare($consultax);
$resultadox->execute();
$datax = $resultadox->fetchAll(PDO::FETCH_ASSOC);
foreach ($datax as $datp) {
    $id_jugada = $datp['id_jugada'];
} */

//

$consultaRuleta = "SELECT * FROM ruleta";

//$resultado = $conexion->prepare($consulta);
$resultadoRuleta = $conexion->prepare($consultaRuleta);
$resultadoRuleta->execute();
$contador = 0;
$data = $resultadoRuleta->fetchAll(PDO::FETCH_ASSOC);
$lista1 = "<div id='casino1' class='slotMachine' style='margin-left: -65px;'>";
foreach ($data as $datx) {
    $id_sorteo = $datx['id_sorteo'];
    $nombre_premio = $datx['nombre'];
    $imagen = $datx['imagen_premio'];
    $contador = $contador + 1;
    $lista1 .= "<div class='slot' premio='$nombre_premio' style='color:yellow;'>'$nombre_premio'</div>";
}
$lista1 .= '</div>';



$consultaRuleta2 = "SELECT * FROM ruleta";
//$resultado = $conexion->prepare($consulta);
$resultadoRuleta2 = $conexion->prepare($consultaRuleta2);
$resultadoRuleta2->execute();
$contador = 0;
$data2 = $resultadoRuleta2->fetchAll(PDO::FETCH_ASSOC);
$lista2 = "<div id='casino2' class='slotMachine'>";
foreach ($data2 as $datx2) {
    $id_sorteo = $datx2['id_sorteo'];
    $nombre_premio = $datx2['nombre'];
    $imagen = $datx2['imagen_premio'];
    $contador = $contador + 1;
    $lista2 .= "<div class='slot slot$contador' premio='$nombre_premio'></div>";
}
$lista2 .= '</div>';


$consultaRuleta3 = "SELECT * FROM ruleta";

//$resultado = $conexion->prepare($consulta);
$resultadoRuleta3 = $conexion->prepare($consultaRuleta3);
$resultadoRuleta3->execute();
$contador = 0;
$data3 = $resultadoRuleta3->fetchAll(PDO::FETCH_ASSOC);
//crear el css

/* .slot1 {background-image: url("../ruleta/img/slot1.png");} */

$listaCss = "";

$lista3 = "<div id='casino3' class='slotMachine'>";
foreach ($data3 as $datx3) {
    $id_sorteo = $datx3['id_sorteo'];
    $nombre_premio = $datx3['nombre'];
    $imagen = $datx3['imagen_premio'];
    $contador = $contador + 1;
   // var_dump($nombre_premio);
    $lista3 .= "<div class='slot slot$contador' premio='$nombre_premio'></div>";
    $listaCss .= ".slot$contador {background-image: url('../ruleta/img/$imagen');}\n";
}
$lista3 .= '</div>';
$contador = 0;



$consultaJugada = "SELECT count(`id_cliente`) as 'cant' FROM subjugada where `id_cliente`=" . $dni;
$resultadoJugada = $conexion->prepare($consultaJugada);
$resultadoJugada->execute();
$dataJugada = $resultadoJugada->fetchAll(PDO::FETCH_ASSOC);
foreach ($dataJugada as $datp2) {

    $cant_jug = $datp2['cant'];
}
//$valor = $dataJugada[0];
//echo ($cant_jug);

if ($cant_jug == $cantidadJugadas) {
    //header("Location: gracias.php");
    header("Status: 301 Moved Permanently");
    header("Location:gracias.php");
    echo "<script language='javascript'>window.location='gracias.php'</script>;";
    exit();
    }


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=2.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../ruleta/dist/jquery.slotmachine.css" type="text/css" media="screen" />
    <title>Ruleta ganadora</title>

    <link rel="stylesheet" href="../ruleta/styles/style_ruleta.css" type="text/css" media="screen" />

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <script src="../ruleta/dist/slotmachine.js"></script>
    <script src="../ruleta/dist/jquery.slotmachine.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/languages/javascript.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous">
    </script>
 
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


    <div class="row justify-content-around align-items-center">
        <input type="hidden" name="cantidadJugadas" id="cantidadJugadas" value="<?php echo $cantidadJugadas; ?>">
        <input type="hidden" name="cant_jugadas_control" id="cant_jugadas_control" value="<?php echo $cant_jug; ?>">
        <input type="hidden" name="dni_jugador" id="dni_jugador" value="<?php echo $_SESSION["s_usuario"]; ?>">
        <input type="hidden" name="id_jugada" id="id_jugada" value="<?php echo $id_jugada; ?>">
        <input type="hidden" name="id_sorteo" id="id_sorteo" value="<?php echo $id_sorteo; ?>">


        <!-- JUEGO -->
        <div class="col-auto p-5" id="juego">
            <!--      <h5><b>Jugador : <?php echo $nombre . ' ' . $apellido; ?> </b></h5> <br>
            <h5><b>Cantidad de jugadas Disponibles : <?php echo $cantidadJugadas; ?> </b></h5> <br>
            <h5><b>Jugada N° 0<?php echo $cant_jug + 1; ?> </b></h5> <br> -->

        </div>
    </div>
    </div>

    <!-- <div class="container"> -->

    <div id="casino">
        <div class="content">
            <!-- <h1>Ruleta LOTICAJA</h1> -->

            <div>
                <?php
                echo $lista1;
                //echo $lista2;
               // echo $lista3;
                ?>


               <!--  <div id="casino1" class="slotMachine" style="margin-left: -65px;">
                    <div class="slot slot1" premio="20"></div>
                    <div class="slot slot2" premio="10"></div>
                    <div class="slot slot3" premio="22"></div>
                    <div class="slot slot4" premio="23"></div>
                    <div class="slot slot5" premio="26"></div>
                    <div class="slot slot6" premio="29"></div>

                </div>

                <div id="casino2" class="slotMachine">
                    <div class="slot slot1" premio="20"></div>
                    <div class="slot slot2" premio="10"></div>
                    <div class="slot slot3" premio="22"></div>
                    <div class="slot slot4" premio="23"></div>
                    <div class="slot slot5" premio="26"></div>
                    <div class="slot slot6" premio="29"></div>
                </div>

                <div id="casino3" class="slotMachine">
                    <div class="slot slot1" premio="20"></div>
                    <div class="slot slot2" premio="10"></div>
                    <div class="slot slot3" premio="22"></div>
                    <div class="slot slot4" premio="23"></div>
                    <div class="slot slot5" premio="26"></div>
                    <div class="slot slot6" premio="29"></div>
                </div> -->
                <br>
                <div class="btn-group btn-group-justified" role="group">
                    <button id="casinoShuffle" type="button" class="btn btn-primary btn-lg">Jugar</button>
                    <!-- <button id="casinoStop" type="button" class="btn btn-primary btn-lg">Stop!</button> -->
                </div>

            </div>
        </div>

    </div>
    <!-- </div> -->

    <script id="codeScript5">
        const btn = document.querySelector('#casinoShuffle');

        const casino1 = document.querySelector('#casino1');
        const casino2 = document.querySelector('#casino2');
        const casino3 = document.querySelector('#casino3');


        const mCasino1 = new SlotMachine(casino1, {
            active: 0,
            delay: 500
        });
        const mCasino2 = new SlotMachine(casino2, {
            active: 1,
            delay: 500
        });
        const mCasino3 = new SlotMachine(casino3, {
            active: 2,
            delay: 500
        });
    </script>

    <script id="codeScript6">
        var premio1, premio2, premio3;
        var count = 0;
        const cadenaPremios = [];
        const cadenaSalidas = [];

        function onComplete(active) {

            //results[this.element.id].innerText = `Index: ${this.active}`;
            count = count + 1;
            let tex = `Index: ${this.active}`;
            //let index = `${this.active}`
            //console.log(active,tex,active,index);
            cadenaSalidas.push(active+1);

            //cadenaPremios.push('-');
            //alert(cadenaPremios);
            if (count == 3) {
                ganadafinal();
                console.log(cadenaSalidas);
            }
        }


        btn.addEventListener('click', () => {
            btn.disabled = true;
            mCasino1.shuffle(5, onComplete);
            setTimeout(() => mCasino2.shuffle(5, onComplete), 700);
            setTimeout(() => mCasino3.shuffle(5, onComplete), 1000);
            // ganadafinal();


        });


        function ganadafinal() {
            //alert(cadenaPremios);

            idpremio1 = cadenaSalidas[0];
            idpremio2 = cadenaSalidas[1];
            idpremio3 = cadenaSalidas[2];
            //obtengo los premios del arreglo
            /* console.log(premio1);
            console.log(premio2);
            console.log(premio3); */
            premio1 = casino1.children[0].children[idpremio1];
            premio2 = casino2.children[0].children[idpremio2];
            premio3 = casino3.children[0].children[idpremio3];



            //      console.log(premio1, premio2, premio3);
            premioa = premio1.getAttribute('premio');
            premiob = premio2.getAttribute('premio');
            premioc = premio3.getAttribute('premio');

            console.log(premioa);
            console.log(premiob);
            console.log(premioc);
            if (premioa == premiob && premiob == premioc) {
                console.log('ganaste ' + premioa);
                //deshabilitar botones

                let ganador = 1;
                const button = document.getElementById('casinoShuffle');
                //const button2 = document.getElementById('casinoStop');
                button.disabled = true;
                //button2.disabled = true;
                count = 5;
                //guardar la jugada
                cadenaPremios.push(premioa);
                cadenaPremios.push(premiob);
                cadenaPremios.push(premioc);

                guardarJugadas(ganador);
                guardarGanador();
                //mostrar vista de ganador
                /* setInterval(function() {
                    count--;
                    //document.getElementById('countDown').innerHTML = count;
                    if (count == 0) {
                        //window.location = 'https://www.google.com';
                        window.location = "ganaste_ruleta.php";
                    }
                }, 1000); */

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top',
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
                    title: 'FELICIDADES, HAS GANADO'
                }).then(function() {
                    //eliminarLS();
                    location.href = "ganaste_ruleta.php?id="+premioa;
                });


            } else {
                //console.log('perdiste ' + premio1);
                console.log('perdiste');
                //deshabilitar botones
                let ganador = 0;
                const button = document.getElementById('casinoShuffle');
                //const button2 = document.getElementById('casinoStop');
                button.disabled = true;
                //button2.disabled = true;
                count = 3;

                //guardar la jugada
                cadenaPremios.push(premioa);
                cadenaPremios.push(premiob);
                cadenaPremios.push(premioc);
                guardarJugadas(ganador);

                //mostrar vista de perdedor
                /*    setInterval(function() {
                       count--;
                       //document.getElementById('countDown').innerHTML = count;
                       if (count == 0) {
                           //window.location = 'https://www.google.com';
                           window.location = "perdiste_ruleta.php";
                       }
                   }, 1000); */



                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
                Toast.fire({
                    icon: 'info',
                    title: 'Por poco ganas'
                }).then(function() {
                    //eliminarLS();
                    location.href = "perdiste_ruleta.php";
                });
            }
        }

        function guardarGanador() {

            var url = "guardar_ganador_ruleta.php";
            const cant_jugad = document.getElementById('cantidadJugadas').value;
            var dni = document.getElementById('dni_jugador').value;
            var id_sorteo = document.getElementById('id_sorteo').value;

            $.ajax({
                type: "POST",
                url: url,
                data: {
                    dni: dni,
                    cadenaPremios: cadenaPremios,
                    id_sorteo: id_sorteo,

                },
                success: function(data) {
                    //$('#resp').html(data);
                    //window.location.href = "jugada_enviada.php";
                }
            });
        }

        function guardarJugadas(opcion) {

            var url = "guardar_jugada_ruleta.php";
            const cant_jugad = document.getElementById('cantidadJugadas').value;

            var dni = document.getElementById('dni_jugador').value;
            var id_sorteo = document.getElementById('id_sorteo').value;
            //var id_jugada = document.getElementById('id_jugada').value;
            //var cant_control = document.getElementById('id_sorteo').value;


            if (cant_jugad != cant_jugadas_control) {
                //console.log((cant_jugad));
                //console.log($cadenaPremios);

                var url = "guardar_jugada_ruleta.php";
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        dni: dni,
                        cadenaPremios: cadenaPremios,
                        id_sorteo: id_sorteo,
                        opcion: opcion
                    },
                    success: function(data) {
                        //$('#resp').html(data);
                        //window.location.href = "jugada_enviada.php";
                    }
                });
            } else {
                //window.location.href = "jugada_enviada.php";

            }

        }

        /*  btnStop.addEventListener('click', () => {
             switch (count) {
                 case 3:
                     //mCasino1.shuffle(2, )
                     mCasino1.stop(function(indexganador) {
                         premio1 = casino1.children[0].children[indexganador + 1];
                         console.log();
                     });
                     break;
                 case 2:
                     mCasino2.stop(function(indexganador) {
                         premio2 = casino2.children[0].children[indexganador + 1];
                     });
                     //mCasino2.stop();
                     break;
                 case 1:
                     mCasino3.stop(function(indexganador) {
                         premio3 = casino3.children[0].children[indexganador + 1];
                         ganadafinal();
                         //console.log(casino1,indexganador);
                     });
                     //mCasino3.stop();
                     break;
             }
             count--;
         }); */
    </script>


    <!--     <script>
        // Fill code blocks
        [1, 2, 3, 4, 5, 6].forEach((index) => {
            const script = document.querySelector(`#codeScript${index}`);
            const block = document.querySelector(`#codeBlock${index}`);

            block.innerText = script.innerText.replace(/^\n|\n\s*$/g, '');
        });
        hljs.initHighlightingOnLoad();
    </script> -->



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
    </script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>



    <script src="../jquery/jquery-3.3.1.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../popper/popper.min.js"></script>
    <script src="../plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>




    <?php require_once "vistas/parte_inferior.php" ?>