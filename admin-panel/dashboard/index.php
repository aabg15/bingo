<?php
session_start();
if (!isset($_SESSION["s_usuario"])) {
    //echo 'aqui?';
    //exit();
    header("Location: ../index.php");
}

include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT * FROM cliente";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);
//var_dump($data);

// los sorteos disponibles 
include_once '../bd/config.php';

$fecha_actual = (date("Y-m-d"));

$sqlData = "SELECT * from sorteo where fecha_fin>='" . $fecha_actual . "';";
$sql = mysqli_query($con, $sqlData);
$listas = '';
$i = 0;
while ($row = mysqli_fetch_assoc($sql)) {
    $i = $i + 1;
    $fechas_validas = $row['fecha_fin'];
    $nombre_sorteo = $row['nombre'];
    if ($i == 5) {
        break;
    } else {
        $listas .= "<div class='sl-item sl-primary'><div class='sl-content'><small class='text-muted'>$fechas_validas</small><p>$nombre_sorteo</p></div></div>";
    }
}



?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>Panel
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
                <div class="row ">
                    <div class="col-lg-7 col-md-12">
                        <div class="card" style="min-height: 485px">
                            <div class="card-header card-header-text">
                                <h4 class="card-title">Clientes</h4>
                                <!--                                 <p class="category">New employees on 15th December, 2016</p>
 -->
                            </div>
                            <div class="card-content table-responsive">
                                <table class="table table-hover">
                                    <thead class="text-primary">
                                        <tr>
                                            <th>#</th>
                                            <th>DNI</th>
                                            <th>Nombre y Apellidos</th>
                                            <th>Intentos</th>
                                            <th>Departamento</th>
                                            <th>Celular</th>
                                            <th>Direccion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        foreach ($data as $dat) {
                                            $i = $i + 1;
                                        ?>
                                            <tr>
                                                <td><?php echo $i ?></td>
                                                <td><?php echo $dat['dni'] ?></td>
                                                <td><?php echo $dat['nombre'] . ' ' . $dat['apellidos'] ?></td>
                                                <td><?php echo $dat['cant_jugada'] ?></td>
                                                <td><?php echo $dat['departamento'] ?></td>
                                                <td><?php echo $dat['celular'] ?></td>
                                                <td><?php echo $dat['direccion'] ?></td>

                                            </tr>
                                        <?php
                                        if($i==5){
                                            //dejar de recorrer
                                            break;

                                        }
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5 col-md-12">
                        <div class="card" style="min-height: 485px">
                            <div class="card-header card-header-text">
                                <h4 class="card-title">Sorteos Disponibles</h4>
                            </div>
                            <div class="card-content">
                                <div class="streamline">

                                    <!--  <div class="sl-item sl-primary">
                                        <div class="sl-content">
                                            <small class="text-muted">22/02/2022</small>
                                            <p>NOMBRE DEL SORTEO</p>
                                        </div>
                                    </div> -->

                                    <?php
                                    echo $listas;
                                    ?>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

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