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
                    <center>Lista de Clientes</center>
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

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="text-primary">
                                <tr>

                                    <th>DNI</th>
                                    <th>Nombre y Apellidos</th>
                                    <th>Cantidad de Jugadas</th>
                                    <th>Accion</th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                include_once '../bd/conexion.php';
                                $objeto = new Conexion();
                                $conexion = $objeto->Conectar();

                                //$consulta = "SELECT id, nombre, pais, edad FROM personas";
                                $consulta = "SELECT * FROM cliente";
                                $resultado = $conexion->prepare($consulta);
                                $resultado->execute();
                                $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($data as $dat) {
                                    $dnid=$dat['dni'];

                                ?>
                                    <tr>
                                        <td><?php echo $dat['dni'] ?></td>
                                        <td><?php echo $dat['nombre'] . ' ' . $dat['apellidos'] ?></td>
                                        <td><?php echo $dat['cant_jugada'] ?></td>
                                        <td><?php echo $dat['celular'] ?></td>
                                        <td><?php echo $dat['telefono'] ?></td>
                                        <td><?php echo $dat['correo'] ?></td>
                                        <td><?php echo $dat['codigo_interno_cliente'] ?></td>
                                        <td><?php echo $dat['codigo_deposito'] ?></td>
                                        <td><?php echo $dat['tipo_deposito'] ?></td>
                                        <td><?php echo $dat['fecha_apertura'] ?></td>
                                        <td><?php echo $dat['fecha_vencimiento'] ?></td>
                                        <td><?php echo $dat['plazo'] ?></td>
                                        <td><?php echo $dat['moneda'] ?></td>
                                        <td><?php echo $dat['id_sucursal'] ?></td>
                                        <td><a href="actualizar_cliente.php?id=<?php echo $dnid ?>">Actualizar</a></td>

                                    </tr>
                                <?php

                                }
                                ?>

                            </tbody>
                        </table>
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