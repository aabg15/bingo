<!doctype html>
<html lang="en">
<?php

session_start();

if (!isset($_SESSION["s_usuario"])) {
    //echo 'aqui?';
    //exit();
    header("Location: ../index.php");
}

$dni = $_GET['id'] ?? '0';

if ($dni == '0') {
    //header("Location: ver_clientes.php");
    header("Status: 301 Moved Permanently");
    header("Location:ver_clientes.php");
    echo "<script language='javascript'>window.location='ver_clientes.php'</script>;";
    exit();
} else {
}


//$idd = $_GET['id'];
//$idd = $_GET['id'] ?? '0';
//var_dump($idd);
include("../bd/config.php");


$sql = "SELECT * FROM cliente WHERE dni='$dni'";
$query = mysqli_query($con, $sql);
$row = mysqli_fetch_array($query);




?>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>Actualizar Cliente
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
                    <center>Actualizar Cliente</center>
                </h4>
                <div class="row-5">

                    <form class="needs-validation" id="formActualizarCliente">
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">DNI</label>
                                <input type="text" class="form-control" id="dni" name="dni" readonly required value="<?php echo $row['dni']  ?>">
                                <div class="invalid-feedback">
                                    Ingresa el nombre.
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required value="<?php echo $row['nombre']  ?>">
                                <div class="invalid-feedback">
                                    Ingresa el nombre.
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Apellidos</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos" required value="<?php echo $row['apellidos'] ?>">
                                <div class="invalid-feedback">
                                    Ingresa el apellidos.
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Departamento</label>
                                <input type="text" class="form-control" id="departamento" name="departamento" placeholder="Departamento" required value="<?php echo $row['departamento'] ?>">
                                <div class="invalid-feedback">
                                    Ingresa el Departamento.
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Provincia</label>
                                <input type="text" class="form-control" id="provincia" name="provincia" placeholder="Provincia" required value="<?php echo $row['ciudad'] ?>">
                                <div class="invalid-feedback">
                                    Ingresa la Provincia.
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Distrito</label>
                                <input type="text" class="form-control" id="distrito" name="distrito" placeholder="Distrito" required value="<?php echo $row['distrito'] ?>">
                                <div class="invalid-feedback">
                                    Ingresa el Distrito.
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Celular</label>
                                <input type="number" class="form-control" id="celular" name="celular" placeholder="celular" required value="<?php echo $row['celular'] ?>">
                                <div class="invalid-feedback">
                                    Ingresa el celular.
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Telefono</label>
                                <input type="number" class="form-control" id="telefono" name="telefono" placeholder="Telefono" required value="<?php echo $row['telefono'] ?>">
                                <div class="invalid-feedback">
                                    Ingresa el telefono.
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Correo electronico</label>
                                <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo electronico" required value="<?php echo $row['correo'] ?>">
                                <div class="invalid-feedback">
                                    Ingresa el correo.
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Direccion</label>
                                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Direccion" required value="<?php echo $row['direccion'] ?>">
                                <div class="invalid-feedback">
                                    Ingresa el correo.
                                </div>
                            </div>

                            <!--      <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Sede</label>
                                <input type="text" class="form-control" id="sede" name="sede" placeholder="Sede" required value="<?php echo $row['id_sucursal'] ?>">
                                <div class="invalid-feedback">
                                    Ingresa la sede.
                                </div>
                            </div> -->
                            <div class="col-md-6 mb-3">
                                <label for="sucursal">Sucursal</label>
                                <?php
                                //echo $row['id_sucursal'];
                                // echo '----';
                                if ($row['id_sucursal'] == "0" || $row['id_sucursal'] == "") {
                                    //echo 'no tienendatos muestra el select';
                                ?>
                                    <select class="custom-select form-control" id="sucursal" name="sucursal">

                                    </select>


                                <?php
                                } else { ?>
                                    <input type="text" class="form-control" id="sucursal" name="sucursal" value="<?php echo $row['id_sucursal']; ?>">
                                <?php
                                }

                                ?>

                            </div>



                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Saldo a corte</label>
                                <input type="number" class="form-control" id="saldo_corte" name="saldo_corte" placeholder="Saldo a corte" required value="<?php echo $row['saldo_corte_moneda'] ?>">
                                <div class="invalid-feedback">
                                    Ingresa el Saldo a corte.
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Numero de jugadas</label>
                                <input type="number" class="form-control" id="intentos" name="intentos" placeholder="Numero de jugadas" required value="<?php echo $row['cant_jugada'] ?>">
                                <div class="invalid-feedback">
                                    Ingresa el Numero de jugadas.
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Moneda</label>
                                <input type="text" class="form-control" id="moneda" name="moneda" placeholder="Moneda" required value="<?php echo $row['moneda'] ?>">
                                <div class="invalid-feedback">
                                    Ingresa la moneda.
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Monto a deposito</label>
                                <input type="text" class="form-control" id="monto_deposito" name="monto_deposito" placeholder="Monto a deposito" required value="<?php echo $row['monto_deposito_apert'] ?>">
                                <div class="invalid-feedback">
                                    Ingresa el Monto a deposito.
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Plazo en días</label>
                                <input type="number" class="form-control" id="plazo_dias" name="plazo_dias" placeholder="Plazo en días" required value="<?php echo $row['plazo'] ?>">
                                <div class="invalid-feedback">
                                    Ingresa el Plazo en días.
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Tipo de deposito- según SBS </label>
                                <input type="text" class="form-control" id="tipo_deposito_sbs" name="tipo_deposito_sbs" placeholder="Tipo de deposito- según SBS " required value="<?php echo $row['tipo_deposito_sbs'] ?>">
                                <div class="invalid-feedback">
                                    Ingresa el Tipo de deposito- según SBS.
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Tipo de deposito</label>
                                <input type="text" class="form-control" id="tipo_deposito" name="tipo_deposito" placeholder="Tipo de deposito" required value="<?php echo $row['tipo_deposito'] ?>">
                                <div class="invalid-feedback">
                                    Ingresa el Tipo de deposito.
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="validationCustom05">Fecha de Apertura</label>

                                <input type="date" id="fecha_apertura" name="fecha_apertura" class="form-control" required value="<?php echo $row['fecha_apertura'] ?>">

                                <div class="invalid-feedback">
                                    Coloca un Fecha.
                                </div>
                            </div>


                            <div class="col-md-3 mb-3">
                                <label for="validationCustom05">Fecha de Vencimiento</label>

                                <input type="date" id="fecha_vencimiento" name="fecha_vencimiento" class="form-control" required value="<?php echo $row['fecha_vencimiento'] ?>">
                                <div class="invalid-feedback">
                                    Coloca un Fecha.
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationCustom01">Codigo Interno de cliente</label>
                                <input type="text" class="form-control" id="codig_interno_cliente" name="codig_interno_cliente" required value="<?php echo $row['codigo_interno_cliente'] ?>">
                                <div class="invalid-feedback">
                                    Ingresa el Codigo Interno de cliente
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="validationCustom01">Codigo de deposito</label>
                                <input type="text" class="form-control" id="codig_deposito" name="codig_deposito"  required value="<?php echo $row['codigo_deposito'] ?>">
                                <div class="invalid-feedback">
                                    Ingresa el Codigo de deposito
                                </div>
                            </div>


                        </div>
                        <br><br>
                        <center>

                            <button class="btn btn-primary" type="submit">Actualizar Cliente</button>
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