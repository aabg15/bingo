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

if (!isset($_POST['buscar'])) {
    $_POST['buscar'] = '';
}

if (!isset($_POST['buscafechadesde'])) {
    $_POST['buscafechadesde'] = '';
}
if (!isset($_POST['buscafechahasta'])) {
    $_POST['buscafechahasta'] = '';
}

if (!isset($_POST['nombre'])) {
    $_POST['nombre'] = '';
}


$fecha_actual = (date("Y-m-d"));
?>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>Premios Sorteo
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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>




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
                <h4>
                    <center>Registrar Premio de Sorteo Loticaja</center>
                </h4>
                <div class="row-5">

                    <form class="needs-validation" id="formAgregPremioSorteo" method="post">
                        <div class="form-row">

                            <div class="col-md-5 mb-3">
                                <label for="validationCustom05">Descripcion del premio</label>

                                <input type="text" id="descripcion" name="descripcion" class="form-control" required>

                                <div class="invalid-feedback">
                                    Coloca una Descripcion.
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="validationCustom05">Cantidad de aciertos</label>

                                <input type="number" id="cant_aciertos" name="cant_aciertos" class="form-control" required>

                                <div class="invalid-feedback">
                                    Coloca una cantidad.
                                </div>
                            </div>

                            <!--  <div class="col-md-3 mb-3">
                                <label for="validationCustom05">Seleccione archivo:</label>

                                <input type="file" id="imagen" name="imagen" class="form-control" required>

                                <div class="invalid-feedback">
                                    Coloca una imagen.
                                </div>
                            </div>
 -->
                            <div class="col-md-3 mb-4">
                                <label for="validationCustom05">Sorteos a elegir :</label>
                                <div class='caja_select'>
                                    <select name='sorteos_disp' id='sorteos_disp' class='conestilo'>

                                    </select>
                                </div>

                                <div class="invalid-feedback">
                                    Selecciona un sorteo.
                                </div>
                            </div>

                        </div>
                        <br><br>
                        <center>

                            <button class="btn btn-primary" type="submit">Registar Premio</button>
                        </center>



                    </form>

                    <script>
                        $(document).ready(function() {
                            $("#formAgregPremioSorteo").submit(function(event) {

                                console.log('no igreso');
                                //alert('id : '+premio);
                                event.preventDefault();
                                let fromData = new FormData(document.getElementById('formAgregPremioSorteo'));

                                $.ajax({
                                    url: "../bd/guardar_psorteo.php",
                                    type: "POST",
                                    /* datatype: "json", */
                                    data: fromData,
                                    processData: false,
                                    contentType: false,
                                    success: function(data) {
                                        if (data == "null") {
                                            Swal.fire({
                                                type: 'error',
                                                title: 'Registro incorrecto',
                                            });
                                        } else {
                                            Swal.fire({
                                                type: 'success',
                                                title: 'Registro de premio exitoso!',
                                                confirmButtonColor: '#3085d6',
                                                confirmButtonText: 'Confirmar'
                                            }).then((result) => {
                                                if (result.value) {
                                                    //window.location.href = "vistas/pag_inicio.php";
                                                    //window.location.href = "ver_premios.php";
                                                }
                                            })

                                        }
                                    }
                                });


                            });
                            return true;

                        });

                        $(document).ready(function() {
                            $.ajax({
                                    type: 'POST',
                                    url: '../bd/sorteos_disponibles.php',
                                    data: {
                                        fecha_validar: document.getElementById('fecha_validar').value
                                    }
                                })
                                .done(function(listas_rep) {
                                    $('#sorteos_disp').html(listas_rep);
                                })

                                .fail(function() {
                                    alert('Hubo un errror al cargar las fechas')
                                })
                        })
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