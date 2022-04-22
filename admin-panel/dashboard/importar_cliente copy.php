<?php
session_start();
if (!isset($_SESSION["s_usuario"])) {
    //echo 'aqui?';
    //exit();
    header("Location: ../index.php");
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>Importar clientes
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
                    <center>Importar Clientes</center>
                </h4>
                <div class="row-0">

                    <form method="POST" enctype="multipart/form-data" id="formuploadajax">

                        <div class="input-group">
                            <input type="file" name="dataCliente" class="form-control" id="dataCliente">
                            <!-- <input type="file" name="dataCliente" id="file-input" class="file-input__input" /> -->
                            <!-- <button class="btn btn-outline-secondary" type="button" id="btn_cargar">Cargar</button> -->
                            <input type="submit" class="btn_enviar" id="btn_enviar" value="Subir Excel" />
                        </div>


                    </form>
                    <!--     <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>  -->
                    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


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
    <!--     <script src="js/jquery-3.3.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-3.3.1.min.js"></script> -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    <!--    <script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="codigo.js"></script> -->




    <script type="text/javascript">
        $(document).ready(() => {
            function addExcel(e) {
                if (e.type == "submit") {
                    e.preventDefault();
                }
                //var fd = new FormData('formuploadajax');
                var fromData = new FormData(document.getElementById('formuploadajax'));
                console.log(fromData);

                $.ajax({
                    url: 'subir_excel copy.php',
                    type: "POST",
                    data: fromData,
                    processData: false, // tell jQuery not to process the data
                    contentType: false, // tell jQuery not to set contentType,
                    success: function(response) {
                        //$('#output').html(response.responseText);
                        /* console.log('response :'+response);
                        return */

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