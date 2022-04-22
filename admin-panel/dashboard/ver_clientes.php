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
    <title>Ver clientes
    </title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!----css3---->
    <link rel="stylesheet" href="css/custom.css">
    <!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->
    <!--  <script src="../datatable/datatables.css"></script> -->
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
                    <center>Lista de Clientes</center>
                </h4>
                <div class="">

                    <div class="col-md-12 grid-margin">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title">Resultados</h4>
                                <div class="col-12 grid-margin">

                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="tablaVerCliente" style="width: 100%;">
                                            <thead class="text-primary thead-dark">
                                                <tr>
                                                    <th>DNI</th>
                                                    <th>Nombres</th>
                                                    <th>Apellidos</th>
                                                    <th>Cantidad de Jugadas</th>
                                                    <th>Celular</th>
                                                    <th>Telefono</th>
                                                    <th>Correo</th>
                                                    <th>Codigo cliente</th>
                                                    <th>Código de depósito</th>
                                                    <th>Tipo de depósito</th>
                                                    <th>Fecha Apertura</th>
                                                    <th>Fecha Vencimiento</th>
                                                    <th>Plazo en días</th>
                                                    <th>Moneda</th>
                                                    <th>Sede</th>
                                                    <th>Accion</th>
                                                </tr>
                                            </thead>
                                            <tbody>


                                            </tbody>
                                        </table>
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
    <script src="../datatable/datatables.css"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>



    <!--    <script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="codigo.js"></script> -->




    <script type="text/javascript">
        $(document).ready(function() {

            listarTablasorteo();
            var datatable;
            function listarTablasorteo() {
                let funcion = "verListaCliente";
                
                $.post("../bd/listar_cliente.php", {
                    funcion
                }, (response) => {

                    var datos = JSON.parse(response)
                    console.log('datos : ' + datos[1]['dni']);
                    //dni = 

                    datatable = $('#tablaVerCliente').DataTable({
                        resposive: true,

                        data: datos,

                        columns: [

                            {
                                data: "dni"
                            },
                            {
                                data: "nombre"
                            },
                            {
                                data: "apellidos"
                            },
                            {
                                data: "cant_jugada"
                            },
                            {
                                data: "celular"
                            },

                            {
                                data: "telefono"
                            },

                            {
                                data: "correo"
                            },

                            {
                                data: "codigo_interno_cliente"
                            },
                            {
                                data: "codigo_deposito"
                            },

                            {
                                data: "tipo_deposito"
                            },

                            {
                                data: "fecha_apertura"
                            },

                            {
                                data: "fecha_vencimiento"
                            },
                            {
                                data: "plazo"
                            },
                            {
                                data: "moneda"
                            },
                            {
                                data: "id_sucursal"
                            },
                            {
                                "defaultContent": "<center> <button type='button' class='editarCliente btn btn-info'>Editar</button></center>"
                            },


                        ],
                        destroy: true,
                        language: espanol,




                    });
                })


            }

        

            $('#tablaVerCliente tbody').on('click', '.editarCliente', function() {
                let data = datatable.row($(this).parents()).data();
                //$('#premio_eliminar').html(data.nombre);
                //$('#id_premio_eliminar').val(data.id_ruleta);
                // console.log(data);
                console.log(data['dni']);
                window.location='actualizar_cliente.php?id='+data['dni'];

              });


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