<!doctype html>
<html lang="en">
<?php

session_start();

if (!isset($_SESSION["s_usuario"])) {
  //echo 'aqui?';
  //exit();
  header("Location: ../index.php");
}


//$idd = $_GET['id'];
//$idd = $_GET['id'] ?? '0';
//var_dump($idd);
/* include("../bd/config.php");


$sql = "SELECT * FROM cliente WHERE dni='$dni'";
$query = mysqli_query($con, $sql);
$row = mysqli_fetch_array($query); */

?>

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <title>Configuracion del correo
  </title>
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
          <center>Configuración Dinamica</center>
        </h4>
        <div class="row-5">

          <form class="needs-validation" id="formAgregarCorreo">
            <div class="form-row">
              <div class="col-md-6 mb-3">
                <label for="validationCustom01">Asunto del ganador de ruleta</label>
                <input type="text" class="form-control" id="asuntoGr" name="asuntoGr" placeholder="Asunto del ganador de ruleta" required ">
                                <div class=" invalid-feedback">
                Ingresa el Asunto.
              </div>
            </div>

            <div class="col-md-6 mb-3">
              <label for="validationCustom01">Asunto de envio de jugadas</label>
              <input type="email" class="form-control" id="asuntoEj" name="asuntoEj" placeholder="Asunto de envio de jugadas" required>
              <div class="invalid-feedback">
                Ingresa el Correo.
              </div>
            </div>

            <div class="col-md-6 mb-3">
              <label for="validationCustom01">Correo oculto 1</label>
              <input type="email" class="form-control" id="correoOcultoU" name="correoOcultoU" placeholder="Correo oculto 1" required>
              <div class="invalid-feedback">
                Ingresa el Correo.
              </div>
            </div>

            <div class="col-md-6 mb-3">
              <label for="validationCustom01">Correo oculto 2</label>
              <input type="email" class="form-control" id="correoOcultoD" name="correoOcultoD" placeholder="Correo oculto 2" required>
              <div class="invalid-feedback">
                Ingresa el Correo.
              </div>
            </div>

            <div class="col-md-6 mb-3">
              <label for="validationCustom01">Correo oculto 3</label>
              <input type="email" class="form-control" id="correoOcultoT" name="correoOcultoT" placeholder="Correo oculto 3" required>
              <div class="invalid-feedback">
                Ingresa el Correo.
              </div>
            </div>

            <div class="col-md-6 mb-3">
              <label for="validationCustom01">Titulo </label>
              <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Titulo" required>
              <div class="invalid-feedback">
                Ingresa el Titulo.
              </div>
            </div>

            <div class="col-md-6 mb-3">
              <label for="validationCustom01">Remitente </label>
              <input type="text" class="form-control" id="remitente" name="remitente" placeholder="Remitente" required>
              <div class="invalid-feedback">
                Ingresa el Remitente.
              </div>
            </div>

            <div class="col-md-6 mb-3">
              <label for="validationCustom01">Contraseña </label>
              <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Contraseña" required>
              <div class="invalid-feedback">
                Ingresa la Contraseña.
              </div>
            </div>
        </div>
        <br><br>
        <center>
          <button class="btn btn-primary" type="submit">Agregar Informacion</button>
        </center>
        
        </form>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

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


          $(document).ready(function() {
            $.ajax({
                type: 'POST',
                url: '../../recargar_agencias.php'
              })
              .done(function(listas_rep) {
                $('#sucursal').html(listas_rep)
                //alert('el id es: ')
              })
              .fail(function() {
                alert('Hubo un errror al cargar las listas_rep')
              })

          });
        </script>

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
  <script src="../assets/js/jquery.min.js"></script>



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