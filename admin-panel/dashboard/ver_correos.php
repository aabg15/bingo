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

?>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>Correos
    </title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!----css3---->
    <link rel="stylesheet" href="css/custom.css">
    <!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->
    <script src="../datatable/datatables.css"></script>
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
                    <center>Correos enviados</center>
                </h4>
                <div class="">

                    <div class="col-12 grid-margin">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="tablaJugadasCliente" style="width: 100%;">
                                <thead class="text-primary thead-dark">
                                    <tr>
                                        <!-- <th> # </th> -->
                                        <th> Asunto </th>
                                        <th> Destinatario</th>
                                        <th> DNI </th>
                                        <th> Premio Ruleta </th>
                                        <th> Jugadas de letras </th>
                                        <th> Jugadas de Ruleta </th>
                                        <th> Fecha de envio </th>
                                        <!--  <th> Acciones </th> -->

                                    </tr>
                                </thead>
                                <tbody>



                                </tbody>
                            </table>
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
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


    <!--    <script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="codigo.js"></script> -->




    <script type="text/javascript">
        $(document).ready(function() {
            listarTablasorteo();

            function listarTablasorteo() {
                let funcion = "listarCorreos";

                $.post("../bd/listar_correos.php", {
                    funcion
                }, (response) => {

                    var datos = JSON.parse(response)

                    $('#tablaJugadasCliente').DataTable({
                        resposive: true,

                        data: datos,

                        columns: [
                            {
                                data: "asunto"
                            },
                            {
                                data: "destinatario"
                            },
                            {
                                data: "dni"
                            },
                            {
                                data: "premio"
                            },
                            {
                                data: "jugada"
                            },
                            {
                                data: "ruleta"
                            },
                            {
                                data: "fecha"
                            },
                        ],
                        destroy: true,
                        language: espanol,


                    });
                })
            }
        });

        let espanol = {
            sProcessing: "Procesando...",
            sLengthMenu: "Mostrar _MENU_ registros",
            sZeroRecords: "No se encontraron resultados",
            sEmptyTable: "Ningún dato disponible en esta tabla",
            sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
            sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
            sInfoPostFix: "",
            sSearch: "Buscar:",
            sUrl: "",
            sInfoThousands: ",",
            sLoadingRecords: "Cargando...",
            oPaginate: {
                sFirst: "Primero",
                sLast: "Último",
                sNext: "Siguiente",
                sPrevious: "Anterior",
            },
            oAria: {
                sSortAscending: ": Activar para ordenar la columna de manera ascendente",
                sSortDescending: ": Activar para ordenar la columna de manera descendente",
            },
            buttons: {
                copy: "Copiar",
                colvis: "Visibilidad",
            },
        };
    </script>

</body>

</html>