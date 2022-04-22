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
  <title>Importar clientes
  </title>
  <link rel="shortcut icon" type="image/x-icon" href="../logo-icon.ico" />
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!----css3---->
  <link rel="stylesheet" href="css/custom.css">
  <!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

  <!--google material icon-->
  <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
</head>

<body>

  <!-- Modal -->
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
        <h4>
          <center>Importar Clientes</center>
        </h4>
        <div class="">

          <div class="col-md-12 grid-margin">
            <div class="card">
              <div class="card-body">

                <h4 class="card-title">Importar</h4>


                <div class="col-12 grid-margin">
                  <div class="row-0">

                    <form method="POST" enctype="multipart/form-data" id="formuploadajax">

                      <center>
                        <div class="col-md-6 mb-3">
                          <label for="validationCustom01">Sorteo </label>
                          <select class="form-control" name='sorteos_disp' id='sorteos_disp' required>
                          </select>
                          <div class="invalid-feedback">
                            Selecciona un sorteo.
                          </div>
                        </div>
                      </center>

                      <div class="input-group">
                        <input type="file" name="dataCliente" class="form-control" id="dataCliente">
                        <!-- <input type="file" name="dataCliente" id="file-input" class="file-input__input" /> -->
                        <!-- <button class="btn btn-outline-secondary" type="button" id="btn_cargar">Cargar</button> -->
                        <input type="submit" class="btn_enviar" id="btn_enviar" value="Subir Excel" />
                      </div>

                    </form>

                  </div>

                </div>


              </div>
            </div>
          </div>
        </div>
        <br>
        <br><br><br><br><br><br><br><br><br><br><br><br>
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
  <script src="../datatable/datatables.js"></script>

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


  <!--    <script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="codigo.js"></script> -->
  <script type="text/javascript">
    $(document).ready(() => {
      let button1 = document.querySelector("#btn_enviar");
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
          //let button1 = document.querySelector("#botonSorteo");
          //button1.disabled = true;
        })

        .fail(function() {
          alert('Hubo un errror al cargar')
        })

      $('#sorteos_disp').on('change', function() {
        var id = $('#sorteos_disp').val()
        //alert('el id es: ' + id);
        if (id != 0) {
          let button1 = document.querySelector("#btn_enviar");
          button1.disabled = false;
          //alert('entro');

        } else {
          let button1 = document.querySelector("#btn_enviar");
          button1.disabled = true;

        }
      })

      function addExcel(e) {
        if (e.type == "submit") {
          e.preventDefault();
        }
        //var fd = new FormData('formuploadajax');
        var fromData = new FormData(document.getElementById('formuploadajax'));
        //console.log('fromData::::->',fromData);
        //return;
        var id = $('#sorteos_disp').val()

        $.ajax({
          url: 'subir_excel copy.php?id=' + id,
          type: "POST",
          data: fromData,

          processData: false, // tell jQuery not to process the data
          contentType: false, // tell jQuery not to set contentType,

          success: function(response) {


            if (response == 'null') {
              //carge el archivo
              const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
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
                title: 'Error al importar clientes'
              }).then(function() {
                //eliminarLS();
                //location.href = "ver_clientes.php";
              });

            } else {
              //el archivo fue importado
              const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
              })
              Toast.fire({
                icon: 'success',
                title: 'Importó clientes con éxito!'
              }).then(function() {
                //eliminarLS();
                location.href = "ver_clientes.php";
              });

            }
          },
          error: function() {
            //$('#output').html('Bummer: there was an error!');
          },
        });

        return false;
      }


      document.getElementById("formuploadajax").addEventListener("submit", addExcel, false);
    });
  </script>


</body>

</html>