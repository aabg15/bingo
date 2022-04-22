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


        <div class="row-5">

          <form class="needs-validation" id="formRealizarSorteo">
            <div class="form-row">
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

                </center>
              </div>
              <div class="col-md-1 col-xl-1 col-sm-12"></div>
            </div>


          </div>


          <script>
            $(document).ready(function() {


              var ncholoate = 0;
              var empiezo = 0;

              function chocolateo() {
                let abecedario = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                var abcd = Array.from(abecedario); //convierte a la cadena a un array.
                var cont = 0;
                for (let index = 0; index < abcd.length; index++) {
                  const element = abcd[index];
                  var urlImagen = '<img class="slimg" src="letras_loticaja/' + element + '.png">';
                  console.log(element);
                /*   $("#seleccionadaLetra" + (cont + 1)).css({
                    'border': 0,
                    'box-shadow': '0 0 0 0'
                  }) */
                  
                  setTimeout(() => {
                    chocolateo();
                    //$("#seleccionadaLetra" + (cont + 1)).html(urlImagen)
                  }, 500);

                }
              }

              var estado = true;

              var letraSaliente = [];

              let numeroCelda = 8;

              var enChocolat = true;

              $("#botonSorteo").click(function(event) {
                chocolateo(0);
                event.preventDefault();
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




  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="js/jquery-3.3.1.slim.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="codigo.js"></script>



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