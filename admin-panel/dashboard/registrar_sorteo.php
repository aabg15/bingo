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

?>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>Registrar sorteo
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
                    <center>Registrar Sorteo</center>
                </h4>
                <div class="row-5">

                    <form class="needs-validation" id="formAgregarRegistro">
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Nombre del sorteo</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="* Sorteo *" required>
                                <div class="invalid-feedback">
                                    Ingresa el nombre del sorteo!
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Premio por 5 letras</label>
                                <input type="text" class="form-control" id="premio5letra" name="premio5letra" placeholder="Premio por 5 letras" required>
                                <div class="invalid-feedback">
                                    Ingresa el premio!
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Premio por 6 letras</label>
                                <input type="text" class="form-control" id="premio6letra" name="premio6letra" placeholder="Premio por 6 letras" required>
                                <div class="invalid-feedback">
                                    Ingresa el premio!
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Premio por 7 letras</label>
                                <input type="text" class="form-control" id="premio7letra" name="premio7letra" placeholder="Premio por 7 letras" required>
                                <div class="invalid-feedback">
                                    Ingresa el premio!
                                </div>
                            </div>


                            <div class="col-md-6 mb-3">
                                <label for="validationCustom05">Fecha de Inicio</label>

                                <input type="date" id="fechainicio" name="fechainicio" class="form-control" required>

                                <div class="invalid-feedback">
                                    Coloca un Fecha.
                                </div>
                            </div>


                            <div class="col-md-6 mb-3">
                                <label for="validationCustom05">Fecha Fin</label>
                                
                                <input type="date" id="fechafin" name="fechafin" class="form-control" required value="yyyy-MM-dd">
                                <div class="invalid-feedback">
                                    Coloca un Fecha.
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <center>

                            <button class="btn btn-primary" type="submit">Registar Sorteo</button>
                        </center>

                    </form>

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