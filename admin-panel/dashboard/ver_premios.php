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
    <title>Ver premios
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
                    <center>Lista de Premios</center>
                </h4>
                <div class="">
                    <!-- <div id="los_filtros">

                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Buscador</h4>


                                    <form id="form2" name="form2" method="POST" action="index.php">
                                        <div class="col-12 row">

                                            <div class="mb-3">
                                                <label class="form-label">Nombre a buscar</label>
                                                <input type="text" class="form-control" id="buscar" name="buscar" value="<?php echo $_POST["buscar"] ?>">
                                            </div>

                                            <div class="col-11">

                                                <table class="table">
                                                    <thead>
                                                        <tr class="filters">

                                                            <th>
                                                                Fecha desde:
                                                                <input type="date" id="buscafechadesde" name="buscafechadesde" class="form-control mt-2" value="<?php echo $_POST["buscafechadesde"]; ?>" style="border: #bababa 1px solid; color:#000000;">
                                                            </th>
                                                            <th>
                                                                Fecha hasta:
                                                                <input type="date" id="buscafechahasta" name="buscafechahasta" class="form-control mt-2" value="<?php echo $_POST["buscafechahasta"]; ?>" style="border: #bababa 1px solid; color:#000000;">
                                                            </th>

                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>


                                            <div class="col-1">
                                                <input type="submit" class="btn " value="Ver" style="margin-top: 38px; background-color: purple; color: white;">
                                            </div>
                                        </div>


                                        <?php
                                        /*FILTRO de busqueda////////////////////////////////////////////*/
                                        if ($_POST['buscar'] == '') {
                                            $_POST['buscar'] = ' ';
                                        }
                                        $aKeyword = explode(" ", $_POST['buscar']);


                                        if ($_POST["buscar"] == '' and $_POST['buscadepartamento'] == '' and $_POST['color'] == '' and $_POST['buscafechadesde'] == '' and $_POST['buscafechahasta'] == '' and $_POST['buscapreciodesde'] == '' and $_POST['buscapreciohasta'] == '') {
                                            $query = "SELECT * FROM datos_usuario ";
                                        } else {


                                            $query = "SELECT * FROM datos_usuario ";

                                            if ($_POST["buscar"] != '') {
                                                $query .= "WHERE (nombre LIKE LOWER('%" . $aKeyword[0] . "%') OR apellidos LIKE LOWER('%" . $aKeyword[0] . "%')) ";

                                                for ($i = 1; $i < count($aKeyword); $i++) {
                                                    if (!empty($aKeyword[$i])) {
                                                        $query .= " OR nombre LIKE '%" . $aKeyword[$i] . "%' OR apellidos LIKE '%" . $aKeyword[$i] . "%'";
                                                    }
                                                }
                                            }



                                            if ($_POST["buscafechadesde"] != '') {
                                                $query .= " AND fecha BETWEEN '" . $_POST["buscafechadesde"] . "' AND '" . $_POST["buscafechahasta"] . "' ";
                                            }
                                        }


                                        $sql = $con->query($query);

                                        //$numeroSql = mysqli_num_rows($sql);

                                        ?>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                
               
 -->

                    <div class="col-md-12 grid-margin">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title">Resultados</h4>
                                <div class="col-12 grid-margin">

                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="tablaVerPremios" style="width: 100%;">
                                            <thead class="text-primary thead-dark">
                                                <tr>
                                                    <th> Nombre del Sorteo </th>
                                                    <th> Descripcion del Sorteo </th>
                                                    <th> Cantidad de letras </th>
                                                    <!-- <th>Operaciones</th> -->
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




                    <!-- 
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="text-primary thead-dark">
                                <tr>
                                    <th> # </th>
                                    <th> Nombre del Sorteo </th>
                                    <th> Descripcion del Sorteo </th>
                                    <th> Cantidad de letras </th>
                                    <th>Operaciones</th>

                                </tr>
                            </thead>
                            <tbody id="tablaVerPremios">


                            </tbody>
                        </table>
                    </div>
 -->



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
                let funcion = "verPremiolista";

                $.post("../bd/listar_premios.php", {
                    funcion
                }, (response) => {

                    var datos = JSON.parse(response)

                    $('#tablaVerPremios').DataTable({
                        resposive: true,

                        data: datos,

                        columns: [

                            {
                                data: "nombre"
                            },
                            {
                                data: "descripcion"
                            },
                            {
                                data: "cantidad_aciertos"
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