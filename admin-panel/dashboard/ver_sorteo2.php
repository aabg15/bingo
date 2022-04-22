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
    <title>cms dashboard
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
                    <center>Lista de Sorteos</center>
                </h4>
                <div class="row">
                    <div id="los_filtros">

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

                                            <h4 class="card-title">Filtro de búsqueda</h4>

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
                    <div class="col-12 grid-margin">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="tablaSorteos">
                                <thead class="text-primary thead-dark">
                                    <tr>
                                        <th> # </th>
                                        <th> Nombre del Sorteo </th>
                                        <th> Fecha Inicio </th>
                                        <th> Fecha Fin </th>
                                        <th>Operaciones</th>

                                    </tr>
                                </thead>
                                <tbody id="talbaversorteos">
                                    

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
    <script src="../datatable/jquery.dataTables.js"></script>
    <script src="../datatable/jquery.dataTables.min.js"></script>


    <!--    <script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="codigo.js"></script> -->




    <script type="text/javascript">
        let contador = 1;
        $(document).ready(function() {
            
          /*   $('#tablaSorteos').DataTable(){
            } */
            cargaSorteo();
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
                $('#content').toggleClass('active');
            });

            $('.more-button,.body-overlay').on('click', function() {
                $('#sidebar,.body-overlay').toggleClass('show-nav');
            });

            function cargaSorteo(palabra) {

                $.ajax({
                    url: "../bd/listar_sorteos.php",
                    type: "POST",
                    datatype: "json",
                    data: {
                        'palabra': palabra
                    },
                    success: function(response) {
                        var myObj = JSON.parse(response); //A  la variable le asigno el json decodificado
                        //$("#contenido").html(myObj.ent[0].name);
                        console.log('rpta', myObj)

                        //  return
                        var template = '';
                        myObj.forEach(obj => {
                            template += `<tr>
                        <td>${contador}</td>
                                        <td>${obj.nombre}</td>
                                        <td>${obj.fecha_inicio}</td>
                                        <td>${obj.fecha_fin}</td>
                                        <td><center><a href='#' class='btn btn-primary'>borrar</a>  <a href='#' class='btn btn-primary'>Editar</a></center></td>
                                    </tr>`
                            contador = contador + 1
                        });

                        // var o = JSON.parse(response); //A la variable le asigno el json decodificado
                        $('#talbaversorteos').html(template);

                    }
                });

            }
            $(document).on('keyup', '#buscar', function() {
                let valor = $(this).val();
                console.log('valor : ', valor);
                if (valor != "") {
                    cargaSorteo(valor);

                } else {
                    cargaSorteo();

                }
            })

        });
    </script>

</body>

</html>