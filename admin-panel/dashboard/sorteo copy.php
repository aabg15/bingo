<!doctype html>
<html lang="en">
<?php
session_start();
if (!isset($_SESSION["s_usuario"])) {
  //echo 'aqui?';
  //exit();
  header("Location: ../index.php");
}
require('../bd/config.php');


$fecha_actual = (date("Y-m-d"));
?>

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <title>Realizar Sorteo
  </title>
  <link rel="shortcut icon" type="image/x-icon" href="../logo-icon.ico" />
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!----css3---->
  <link rel="stylesheet" href="css/custom.css">
  <!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

  <!--google material icon-->
  <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

  <!--   <link src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.all.min.js"></link>
  <link src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.min.css"></link>
 -->
  <div class="container" style="display:none;">

    <img id="A" class="slimg" name="letraA" src="letras_loticaja/A.png">
    <img id="B" class="slimg" name="letraB" src="letras_loticaja/B.png">
    <img id="C" class="slimg" name="letraC" src="letras_loticaja/C.png">
    <img id="D" class="slimg" name="letraD" src="letras_loticaja/D.png">
    <img id="E" class="slimg" name="letraE" src="letras_loticaja/E.png">
    <img id="F" class="slimg" name="letraF" src="letras_loticaja/F.png">
    <img id="G" class="slimg" name="letraG" src="letras_loticaja/G.png">
    <img id="H" class="slimg" name="letraH" src="letras_loticaja/H.png">
    <img id="I" class="slimg" name="letraI" src="letras_loticaja/I.png">
    <img id="J" class="slimg" name="letraJ" src="letras_loticaja/J.png">
    <img id="k" class="slimg" name="letraK" src="letras_loticaja/k.png">
    <img id="L" class="slimg" name="letraL" src="letras_loticaja/L.png">
    <img id="M" class="slimg" name="letraM" src="letras_loticaja/M.png">
    <img id="N" class="slimg" name="letraN" src="letras_loticaja/N.png">
    <img id="O" class="slimg" name="letraO" src="letras_loticaja/O.png">
    <img id="P" class="slimg" name="letraP" src="letras_loticaja/P.png">
    <img id="Q" class="slimg" name="letraQ" src="letras_loticaja/Q.png">
    <img id="R" class="slimg" name="letraR" src="letras_loticaja/R.png">
    <img id="S" class="slimg" name="letraS" src="letras_loticaja/S.png">
    <img id="T" class="slimg" name="letraT" src="letras_loticaja/T.png">
    <img id="U" class="slimg" name="letraU" src="letras_loticaja/U.png">
    <img id="V" class="slimg" name="letraV" src="letras_loticaja/V.png">
    <img id="W" class="slimg" name="letraW" src="letras_loticaja/W.png">
    <img id="X" class="slimg" name="letraX" src="letras_loticaja/X.png">
    <img id="Y" class="slimg" name="letraY" src="letras_loticaja/Y.png">
    <img id="Z" class="slimg" name="letraZ" src="letras_loticaja/Z.png">

  </div>




  <style>
    .seleccionadas {
      margin: 15px;
      width: 100px;
      height: 100px;
      line-height: 88px;
      font-size: 39px;
      margin-right: 15px;
      font: oblique bold 356% cursive;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
      border-radius: 100%;
      float: left;
      cursor: pointer;
      border: 3px solid rgb(253, 133, 0);
      ;
    }

    .slimg {
      width: 121px;
      margin-top: -16px;
      margin-left: -14.8px;
    }


    #spinner {
      border: 4px solid rgba(0, 0, 0, 0.1);
      width: 36px;
      height: 36px;
      border-radius: 50%;
      border-left-color: #09f;

      animation: spin 1s ease infinite;
    }

    @keyframes spin {
      0% {
        transform: rotate(0deg);
      }

      100% {
        transform: rotate(360deg);
      }
    }
  </style>


</head>

<body>
  <input type="hidden" id="fecha_validar" value="<?php echo $fecha_actual; ?>">
  <div class="wrapper">
    <div class="body-overlay"></div>
    <?php
    include_once 'vistas/nav.php'
    ?>
    <!-- Page Content  -->
    <div id="content">

      <div class="top-navbar">
        <?php
        include_once 'vistas/nav_bar.php'

        ?>
      </div>
      <div class="main-content">
        <h4 id='cambio_texto' name='cambio_texto'>
          <center>Realizar sorteo de: </center>
        </h4>

        <div class="row-5">

          <form class="needs-validation" id="formRealizarSorteo">
            <div class="form-row">

              <div class="col-md-3 mb-3">
                <label for="validationCustom05">elige :</label>
                <select class="form-control" name='sorteos_disp' id='sorteos_disp' required>
                </select>
                <div class="invalid-feedback">
                  Selecciona un sorteo.
                </div>
              </div>

            </div>
            <br>
            <center id='botonSorteoCambiar'>
              <!--  -->
              <button class="btn btn-primary" type="button" id="botonSorteo" name="botonSorteo" style="font-size: 30px;border-radius: 70px;">Realizar sorteo</button>
            </center>


          </form>


          <div class="container">
            <br>
            <div class="row">
              <div class="col-md-1 col-xl-1 col-sm-12"></div>
              <div class="col-md-10 col-xl-10 col-sm-12">
                <center id="bolillas">

                  <div class="seleccionadas" id="seleccionadaLetra1"></div>
                  <div class="seleccionadas" id="seleccionadaLetra2"></div>
                  <div class="seleccionadas" id="seleccionadaLetra3"></div>
                  <div class="seleccionadas" id="seleccionadaLetra4"></div>
                  <div class="seleccionadas" id="seleccionadaLetra5"></div>
                  <div class="seleccionadas" id="seleccionadaLetra6"></div>
                  <div class="seleccionadas" id="seleccionadaLetra7"></div>

                </center>
              </div>
              <div class="col-md-1 col-xl-1 col-sm-12"></div>
            </div>




            <div class="row">
              <div class="col-md-1 col-xl-1 col-sm-12"></div>
              <div class="col-md-10 col-xl-10 col-sm-12">
                <center id="bolillasNuevas">
                </center>
              </div>
              <div class="col-md-1 col-xl-1 col-sm-12"></div>
            </div>
          </div>


          <br><br>
          <center id="spinerejem">
          </center>
          <div id="jugadaObtenida">
          </div>

          <!-- Optional JavaScript -->
          <!-- jQuery first, then Popper.js, then Bootstrap JS -->
          <script src="js/jquery-3.3.1.slim.min.js"></script>
          <script src="js/popper.min.js"></script>
          <script src="js/bootstrap.min.js"></script>
          <script src="js/jquery-3.3.1.min.js"></script>
          <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
          <script src="codigo.js"></script>




          <script>
            $(document).ready(function() {
              let button1 = document.querySelector("#botonSorteo");
              button1.disabled = true;
              $.ajax({
                  type: 'POST',
                  url: '../bd/sorteos_disponibles.php',
                  data: {
                    fecha_validar: document.getElementById('fecha_validar').value
                  }
                })
                .done(function(listas_rep) {
                  $('#sorteos_disp').html(listas_rep);
                  let button1 = document.querySelector("#botonSorteo");
                  button1.disabled = true;
                  //
                })

                .fail(function() {
                  alert('Hubo un errror al cargar')
                })
            })

            $('#sorteos_disp').on('change', function() {
              var id = $('#sorteos_disp').val()
              //alert('el id es: ' + id);
              if (id != 0) {
                let button1 = document.querySelector("#botonSorteo");
                button1.disabled = false;
                //alert('entro');
                $.ajax({
                  type: 'POST',
                  url: '../bd/asignar_sorteo.php',
                  data: {
                    'id': id
                  },
                  dataType: 'json',
                  success: function(json) {
                    $('#cambio_texto').html("<h4 id='cambio_texto' name='cambio_texto'><center>Realizar Sorteo de: '" + json + "'</center></h4>");
                  },
                  error: function(xhr, status) {
                    console.log('Disculpe, existió un problema');
                  },
                  complete: function(xhr, status) {
                    console.log('Petición realizada');
                  }
                })

              } else {
                let button1 = document.querySelector("#botonSorteo");
                button1.disabled = true;
                document.querySelector("#botonSorteo").style.cursor = "no-drop";

              }
            })

            $(document).ready(function() {

              function dameLetra() {

                let abecedario = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                var abcd = Array.from(abecedario);
                var posicion = Math.floor(Math.random() * abcd.length);
                var letra = abcd[posicion];
                return letra;

              }
              var arregloLetras = [];
              var salir = false;
              var cont = 0;
              var letraNueva = "";

              function validarLetra() {
                if (estado) {
                  while (!salir) {
                    var obtenida = dameLetra();
                    if (cont == 0) {
                      //primerla letra,no hay con quien compararla
                      arregloLetras.push(obtenida);
                      cont++;
                    } else {
                      if (cont == 7) {
                        salir = true;
                      } else {
                        //comprarar las letras
                        var i = arregloLetras.indexOf(obtenida)
                        if (i == -1) {
                          //no se esta repitiendo
                          arregloLetras.push(obtenida);
                          cont++;
                        }
                      }
                    }
                  }

                } else {
                  //cuando se debe mandar una sola letra, pero validada
                  while (!salir) {
                    var obtenida = dameLetra();
                    var i = arregloLetras.indexOf(obtenida)
                    if (i == -1) {
                      arregloLetras.push(obtenida);
                      letraNueva = obtenida;
                      salir = true;
                    }
                  }
                  console.log('nueva letra obtenida : ', letraNueva);
                  letraSaliente.push(letraNueva);
                  console.log('NUEVA CADENA A VALIDAR -> ', letraSaliente);

                }
                let button1 = document.querySelector("#botonSorteo");
                button1.disabled = true;
              }
              var ncholoate = 0;
              var empiezo = 0;

              function chocolateo(cont) {

                let abecedario = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                var abcd = Array.from(abecedario);

                //for (let index = 0; index < abcd.length; index++) {
                const element = abcd[Math.floor(Math.random() * abcd.length)];

                if (empiezo == 0) {
                  var urlImagen = '<img class="slimg" src="letras_loticaja/' + element + '.png">';

                  $("#seleccionadaLetra" + (cont + 1)).css({
                    'border': 0,
                    'box-shadow': '0 0 0 0'
                  })
                  //console.log(urlImagen);
                  $("#seleccionadaLetra" + (cont + 1)).html(urlImagen)


                  ncholoate++;
                  if (ncholoate == 20) {
                    enChocolat = false;
                  }
                  if (enChocolat) {


                    setTimeout(() => {
                      chocolateo(cont);
                      //console.log(element);
                      //
                    }, 100);
                  } else {
                    llenardatos(cont);
                  }

                  empiezo = empiezo + 1;

                } else {

                  var indice = letraSaliente.indexOf(element);
                  if (indice == -1) {
                    var urlImagen = '<img class="slimg" src="letras_loticaja/' + element + '.png">';

                    $("#seleccionadaLetra" + (cont + 1)).css({
                      'border': 0,
                      'box-shadow': '0 0 0 0'
                    })
                    //console.log(urlImagen);
                    $("#seleccionadaLetra" + (cont + 1)).html(urlImagen)


                    ncholoate++;
                    if (ncholoate == 20) {
                      enChocolat = false;
                    }
                    if (enChocolat) {

                      setTimeout(() => {
                        chocolateo(cont);
                        //console.log(element);
                        //
                      }, 100);
                    } else {
                      llenardatos(cont);
                    }

                    //empiezo = empiezo + 1;

                  } else {
                    console.log('letra repetida, no lo muetres! ', element);
                    chocolateo(cont);
                  }

                }
              }


              function chocolateoSeparado(numeroCelda) {

                let abecedario = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                var abcd = Array.from(abecedario);

                console.log('segundo estado del chocolateo : ', estado);
                const element = abcd[Math.floor(Math.random() * abcd.length)];

                if (empiezo == 0) {
                  console.log('entro al if ');
                  var urlImagen = '<img class="slimg" src="letras_loticaja/' + element + '.png">';
                  console.log('urlImagen: ', urlImagen);

                  console.log('numeroCelda : ', numeroCelda);


                  $("#seleccionadaLetra" + (numeroCelda)).css({
                    'border': 0,
                    'box-shadow': '0 0 0 0'
                  })
                  //console.log(urlImagen);
                  $("#seleccionadaLetra" + (numeroCelda)).html(urlImagen)

                  console.log($("#seleccionadaLetra" + (numeroCelda)).html(urlImagen));
                  //return  

                  console.log('ncholoate : ', ncholoate);
                  ncholoate++;
                  console.log('ncholoate2 : ', ncholoate);

                  if (ncholoate == 20) {
                    enChocolat = false;
                  }
                  if (enChocolat) {
                    setTimeout(() => {
                      chocolateo(cont);
                      console.log('cont: ', cont);
                      //
                    }, 100);
                  } else {
                    console.log('LLENAR DATOS DEL ESLSE : ');
                    llenardatos(cont);

                  }
                  empiezo = empiezo + 1;

                } else {

                  console.log('ENTRO AL ELSE DEL SEGUNDO ESTAD0 : ');
                  var indice = letraSaliente.indexOf(element);

                  if (indice == -1) {
                    //letra no existe en los que ya salieron. 
                    var urlImagen = '<img class="slimg" src="letras_loticaja/' + element + '.png">';

                    console.log('se muestra la  : ', element);

                    $("#seleccionadaLetra" + (numeroCelda)).css({
                      'border': 0,
                      'box-shadow': '0 0 0 0'
                    })
                    //console.log(urlImagen);
                    $("#seleccionadaLetra" + (numeroCelda)).html(urlImagen)

                    console.log('ncholoate : ', ncholoate);
                    ncholoate++;
                    console.log('ncholoate2 : ', ncholoate);


                    console.log('enChocolat : ', enChocolat);

                    if (ncholoate == 20) {
                      enChocolat = false;
                    }

                    if (enChocolat) {
                      setTimeout(() => {

                        chocolateoSeparado(numeroCelda);

                      }, 100);
                    } else {
                      console.log('lLAMO AL metodo llenar datos desde el nueveo chocolateo ');
                      llenardatos(cont);
                    }
                  } else {
                    console.log('letra repetida, no lo muetres! ', element);
                    chocolateoSeparado(numeroCelda);
                  }
                }

              }

              function guardarJugada() {
                var id = $('#sorteos_disp').val();

                $.ajax({
                  url: "../bd/dame_letra.php",
                  type: "POST",
                  data: {
                    sorteos_disp: id,
                    arregloLetras: arregloLetras,
                  },

                  success: function(data) {
                    //console.log('data', data);

                  }
                });

              }

              function tablaCantidadGanadores() {
                //funcion para crear la tabla y luego mostrarla
                var id = $('#sorteos_disp').val();
                //console.log('id del sorteo', id);
                $.ajax({
                  url: "../bd/armartablaganadores.php",
                  type: "POST",

                  data: {
                    sorteos_disp: id,
                    arregloLetras: arregloLetras,
                  },
                  success: function(data) {
                    console.log('data', data);
                    //return

                    $('#jugadaObtenida').html(data);
                    ganador7letras();

                  }
                });
                //return data;
              }

              var estado = true;

              function buscarGanadores() {
                //mandar a un php para evaluar ganadores, si encuentra, las guarda en la bd.
                var id = $('#sorteos_disp').val();
                $.ajax({
                  url: "../bd/ganadores.php",
                  type: "POST",

                  data: {
                    sorteos_disp: id,
                    arregloLetras: arregloLetras,
                  },

                  success: function(data) {
                    //console.log('data', data);
                    if (data == 'ok') {
                      //mostrar tabla
                      console.log('bien')
                      //valido si hubo ganador de 7 letras

                      if (ganador7letras()) {
                        //hubo ganador de 7 letras, asi que muestra todo normal
                        $('#spinerejem').html('<div id="spinner"></div><h2>Cargando Ganadores...</h2>');
                        setTimeout(() => {
                          tablaCantidadGanadores();
                          $('#spinerejem').html('');

                        }, 7000);
                      } else {
                        //no hubo ganadorde 7 letras.
                        console.log('No hay ganador, dale bolilla adicional');
                        $('#spinerejem').html('<div id="spinner"></div><h2>No reventó el premio mayor.NUEVA BOLILLA!</h2>');
                        estado = false;
                        setTimeout(() => {
                          $('#spinerejem').html('');


                        }, 5000);
                        //cambiar el nombre del botonazo a 'saca nueva bolilla'
                        $('#botonSorteo').html('Nueva Bolilla');
                        document.querySelector("#botonSorteo").disabled = false


                        console.log('estado : ', estado);

                      }

                    }
                  }
                });
              }


              var letraSaliente = [];

              function llenardatos(cont) {
                if (estado) {

                  if (cont < arregloLetras.length) {


                    var html = document.querySelector('#seleccionadaLetra');
                    var urlImagen = '<img class="animate__animated animate__heartBeat slimg" src="letras_loticaja/' + arregloLetras[cont] + '.png">';

                    letraSaliente.push(arregloLetras[cont]);

                    $("#seleccionadaLetra" + (cont + 1)).html(urlImagen)

                    cont++;
                    enChocolat = true;
                    ncholoate = 0;
                    setTimeout(() => {
                      chocolateo(cont);
                      //console.log(element);
                    }, 100);
                  } else {

                    guardarJugada();
                    buscarGanadores();

                  }
                } else {

                  console.log('segundo estado en el llenar datos: ');
                  console.log('LETRA QUE SE DEBE MOSTRAR AL FINAL : ', letraNueva);
                  var html = document.querySelector('#seleccionadaLetra');
                  console.log('snumeroCelda->  ', numeroCelda);
                  var urlImagen = '<img class="animate__animated animate__heartBeat slimg" src="letras_loticaja/' + letraNueva + '.png">';
                  $("#seleccionadaLetra" + (numeroCelda)).html(urlImagen);
                  console.log($("#seleccionadaLetra" + (numeroCelda)).html(urlImagen));
                }


              }

              function ganador7letras() {

                var id = $('#sorteos_disp').val();
                var resultado = false;
                $.ajax({
                  url: "../bd/ganador_7letras.php",
                  type: "POST",

                  data: {
                    sorteos_disp: id,
                  },

                  success: function(data) {
                    if (data == 'ok') {
                      //mostrar tabla
                      console.log('bien, no se necesita bolilla adicional');

                      resultado = true;


                    } else {
                      //agregar circulo de bolilla
                      console.log('se necesita bolilla adicional');
                      //activame el boton sorteo
                      // let button1 = document.querySelector("#botonSorteo");
                      // button1.disabled = false;
                      salir = false;
                      resultado = false;

                    }
                  }
                });
                return resultado;

              }
              let numeroCelda = 8;

              function agregarCirculo(numeroCelda) {
                var nuevoCirculo = '<div class="seleccionadas" id="seleccionadaLetra' + numeroCelda + '"></div>';
                $('#bolillasNuevas').html(nuevoCirculo);

              }



              var enChocolat = true;

              $("#botonSorteo").click(function(event) {



                if (estado) {

                  console.log('dio click');
                  document.querySelector("#botonSorteo").style.cursor = "no-drop";
                  console.log('estado : ', estado);
                  validarLetra();
                  chocolateo(0);

                } else {

                  console.log('segundo estado');
                  console.log('estado : ', estado);
                  //apagame el boton 
                  document.querySelector("#botonSorteo").disabled = true;
                  document.querySelector("#botonSorteo").style.cursor = "no-drop";
                  //agregame un circulo: 
                  agregarCirculo(numeroCelda);
                  //empiezo = 0;
                  ncholoate = 0;
                  enChocolat = true;
                  validarLetra();
                  chocolateoSeparado(numeroCelda);




                  //numeroCelda = numeroCelda + 1;




                }


                event.preventDefault();

              });




            });

            $("body").on('click', '#botonGuar', function(ev) {
              //alert('dio click');
              ev.preventDefault();


              $.ajax({
                url: "../bd/ganador_sorteo.php",
                type: "POST",
                datatype: "json",
                processData: false,
                contentType: false,
                success: function(data) {
                  if (true) {
                    Swal.fire({
                      type: 'success',
                      title: 'Sorteo realizado',
                      confirmButtonColor: '#3085d6',
                      confirmButtonText: 'Ver ganadores'
                    }).then((result) => {
                      if (result.value) {
                        //peticion
                        window.location.href = "cliente_psorteo.php";

                      }
                    })

                  }
                }
              });
            });
          </script>

          <script>
            // Example starter JavaScript for disabling form submissions if there are invalid fields
            (function() {
              'use strict';
              window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                  form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                      event.preventDefault();
                      event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                  }, false);
                });
              }, false);
            })();
          </script>

          <br><br>
          <div id="jugadaObtenida">


          </div>



        </div>
        <!-- <br>
                <br><br><br><br><br><br><br><br><br><br><br><br> -->
        <br>
        <footer class="footer">

          <?php

          include_once 'vistas/footer.php';
          ?>

        </footer>

      </div>

    </div>
  </div>






  <!--    <script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="codigo.js"></script> -->




  <script type="text/javascript">
    $(document).ready(function() {
      $('#sidebarCollapse').on('click', function() {
        $('#sidebar').toggleClass('active');
        $('#content').toggleClass('active');
      });

      $('.more-button,.body-overlay').on('click', function() {
        $('#sidebar,.body-overlay').toggleClass('show-nav');
      });

    });
  </script>

</body>

</html>