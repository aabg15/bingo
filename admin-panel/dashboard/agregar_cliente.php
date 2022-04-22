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
    <title>Agregar cliente
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
                    <center>Registrar Cliente</center>
                </h4>
                <div class="row-5">

                    <form class="needs-validation" id="formAgregarCliente">
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del cliente" required>
                                <div class="invalid-feedback">
                                    Ingresa el nombre.
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Apellidos</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos" required>
                                <div class="invalid-feedback">
                                    Ingresa el apellidos.
                                </div>
                            </div>


                            <div class="col-md-6 mb-3">
                                <label for="departamento">Departamento</label>
                                <select class="custom-select form-control" id="departamento" name="departamento">

                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="provincia">Provincia</label>
                                <select class="form-control" id="provincia" name="provincia">

                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="distrito">Distrito</label>
                                <select class="form-control" id="distrito">

                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">DNI</label>
                                <input type="number" class="form-control" id="dni" name="dni" placeholder="DNI" required>
                                <div class="invalid-feedback">
                                    Ingresa el dni.
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Celular</label>
                                <input type="number" class="form-control" id="celular" name="celular" placeholder="celular" required>
                                <div class="invalid-feedback">
                                    Ingresa el celular.
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Telefono</label>
                                <input type="number" class="form-control" id="telefono" name="telefono" placeholder="Telefono" required>
                                <div class="invalid-feedback">
                                    Ingresa el telefono.
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Correo electronico</label>
                                <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo electronico" required>
                                <div class="invalid-feedback">
                                    Ingresa el correo.
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Direccion</label>
                                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Direccion" required>
                                <div class="invalid-feedback">
                                    Ingresa el correo.
                                </div>
                            </div>


                            <div class="col-md-6 mb-3">
                                <label for="sucursal">Sucursal</label>
                                <select class="custom-select form-control" id="sucursal" name="sucursal">
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Saldo a corte</label>
                                <input type="number" class="form-control" id="saldo_corte" name="saldo_corte" placeholder="Saldo a corte" required>
                                <div class="invalid-feedback">
                                    Ingresa el Saldo a corte.
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Numero de jugadas</label>
                                <input type="number" class="form-control" id="intentos" name="intentos" placeholder="Numero de jugadas" required>
                                <div class="invalid-feedback">
                                    Ingresa el Numero de jugadas.
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Moneda</label>
                                <input type="text" class="form-control" id="moneda" name="moneda" placeholder="Moneda" required>
                                <div class="invalid-feedback">
                                    Ingresa la moneda.
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Monto a deposito</label>
                                <input type="text" class="form-control" id="monto_deposito" name="monto_deposito" placeholder="Monto a deposito" required>
                                <div class="invalid-feedback">
                                    Ingresa el Monto a deposito.
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Plazo en días</label>
                                <input type="number" class="form-control" id="plazo_dias" name="plazo_dias" placeholder="Plazo en días" required>
                                <div class="invalid-feedback">
                                    Ingresa el Plazo en días.
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Tipo de deposito- según SBS </label>
                                <input type="text" class="form-control" id="tipo_deposito_sbs" name="tipo_deposito_sbs" placeholder="Tipo de deposito- según SBS " required>
                                <div class="invalid-feedback">
                                    Ingresa el Tipo de deposito- según SBS.
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Tipo de deposito</label>
                                <input type="text" class="form-control" id="tipo_deposito" name="tipo_deposito" placeholder="Tipo de deposito" required>
                                <div class="invalid-feedback">
                                    Ingresa el Tipo de deposito.
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Codigo Interno de cliente</label>
                                <input type="text" class="form-control" id="codig_interno_cliente" name="codig_interno_cliente" placeholder="Codigo Interno de cliente" required>
                                <div class="invalid-feedback">
                                    Ingresa el Codigo Interno de cliente
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Codigo de deposito</label>
                                <input type="text" class="form-control" id="codig_deposito" name="codig_deposito" placeholder="Codigo de deposito" required>
                                <div class="invalid-feedback">
                                    Ingresa el Codigo de deposito
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="validationCustom05">Fecha de Apertura</label>

                                <input type="date" id="fecha_apertura" name="fecha_apertura" class="form-control" required>

                                <div class="invalid-feedback">
                                    Coloca un Fecha.
                                </div>
                            </div>


                            <div class="col-md-3 mb-3">
                                <label for="validationCustom05">Fecha de Vencimiento</label>

                                <input type="date" id="fecha_vencimiento" name="fecha_vencimiento" class="form-control" required>
                                <div class="invalid-feedback">
                                    Coloca un Fecha.
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="validationCustom05">Sorteo </label>

                                <select class="form-control" name='sorteos_disp' id='sorteos_disp' required>
                                </select>

                            </div>






                        </div>
                        <br><br>
                        <center>

                            <button class="btn btn-primary" id="btn_enviar" type="submit">Registar Cliente</button>
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
                                console.log('el id es: ' + id);

                                if (id != 0) {
                                    let button1 = document.querySelector("#btn_enviar");
                                    button1.disabled = false;
                                    //alert('entro');

                                } else {
                                    let button1 = document.querySelector("#btn_enviar");
                                    button1.disabled = true;

                                }
                            })








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
    <script src="../controlador/select.js"></script>


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