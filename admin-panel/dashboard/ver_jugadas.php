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
$fecha_actual = (date("Y-m-d"));
?>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>Premios por ruleta
    </title>
    <link rel="shortcut icon" type="image/x-icon" href="../logo-icon.ico" />
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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>




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
                <h4 id='cambio_texto' name='cambio_texto'>
                    <center>Jugadas Ganadoras Del Sorteo : </center>
                </h4>

                <!--   <div id="cambio_texto">
                    <h1>Realizar Sorteo de: </h1>
                </div>
 -->


                <div class="row-5">

                    <form class="needs-validation" id="formRealizarSorteo">
                        <div class="form-row">

                            <div class="col-md-3 mb-3">
                                <label for="validationCustom05">elige :</label>
                                <select name='sorteos_disp' id='sorteos_disp' required>
                                </select>
                                <div class="invalid-feedback">
                                    Selecciona un sorteo.
                                </div>
                            </div>

                        </div>
                        <br>
                        <center>
                            <!--  -->
                            <button class="btn btn-primary" type="button" onclick="fn_capturarid();" id="botonSorteo">Ver jugadas</button>
                        </center>
                    </form>

                    <div class="">

                        <div class="col-md-12 grid-margin">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Resultados</h4>
                                    <div class="col-12 grid-margin">
                                        <center>
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="tablaPremiosRuleta" style="width: 80%;">
                                                    <thead class="text-primary thead-dark">
                                                        <tr>

                                                            <th>
                                                                <h3>
                                                                    <center>Jugada ganadora</center>
                                                                </h3>
                                                            </th>
                                                            <!--  <th> Imagen</th>
                            <th> Acciones</th> -->
                                                        </tr>
                                                    </thead>

                                                    <tbody style="text-align: center;">
                                                    
                                                    </tbody>


                                                </table>
                                            </div>
                                        </center>
                                    </div>

                                </div>
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
                    <script src="../datatable/datatables.js"></script>

                    <script>
                        $(document).ready(function() {


                            let button1 = document.querySelector("#botonSorteo");
                            button1.disabled = true;

                            $.ajax({
                                    type: 'POST',
                                    url: '../bd/todos_sorteos.php',
                                    data: {
                                        fecha_validar: document.getElementById('fecha_validar').value
                                    }
                                })
                                .done(function(listas_rep) {
                                    $('#sorteos_disp').html(listas_rep);
                                    let button1 = document.querySelector("#botonSorteo");
                                    button1.disabled = true;
                                })

                                .fail(function() {
                                    alert('Hubo un errror al cargar las fechas')
                                })

                            //



                            //


                        })

                        function fn_capturarid() {


                            var sorteos_disp = $('#sorteos_disp').val();
                            console.log('mensaje', sorteos_disp);

                            var template = '';
                            $.ajax({
                                url: "../bd/listar_jugadas.php",
                                method: 'post',
                                data: {
                                    'sorteos_disp': sorteos_disp
                                },

                                success: function(response) {
                                    var myObj = JSON.parse(response); //A  la variable le asigno el json decodificado
                                    console.log(myObj)
                                    //alert(response);

                                    if (myObj == null) {
                                        Swal.fire({
                                            type: 'error',
                                            title: 'No hay jugada ganadora',
                                            confirmButtonColor: '#3085d6',
                                            confirmButtonText: 'Ok'
                                        }).then((result) => {
                                            if (result.value) {
                                                //peticion
                                                //window.location.href = "cliente_psorteo.php";

                                            }
                                        })


                                    } else {
                                        // alert(myObj[0].nombre);
                                        let button1 = document.querySelector("#botonSorteo");
                                        button1.disabled = true;
                                        datatable_sorteo = $('#tablaPremiosRuleta').DataTable({
                                            resposive: true,

                                            data: myObj,
                                            columns: [

                                                {
                                                    data: "jugada_ganadora"
                                                },


                                            ],
                                            destroy: true,
                                            language: espanol,

                                        });




                                    }
                                }
                            });

                        }

                        $('#sorteos_disp').on('change', function() {
                            var id = $('#sorteos_disp').val()
                            //alert('el id es: ' + id);
                            if (id != 0) {
                                let button1 = document.querySelector("#botonSorteo");
                                button1.disabled = false;
                                //alert('entro');
                                $.ajax({
                                    type: 'POST',
                                    url: '../bd/asignar_sorteoR.php',
                                    data: {
                                        'id': id
                                    },
                                    dataType: 'json',
                                    success: function(json) {
                                        console.log(json);

                                        $('#cambio_texto').html("<h4 id='cambio_texto' name='cambio_texto'><center>Jugadas ganadoras del sorteo : '" + json + "'</center></h4>");

                                    },
                                    error: function(xhr, status) {
                                        console.log('Disculpe, existi贸 un problema');
                                    },
                                    complete: function(xhr, status) {
                                        console.log('Peticion realizada');
                                    }
                                })

                            } else {
                                let button1 = document.querySelector("#botonSorteo");
                                button1.disabled = true;

                            }
                        })

                        /*  $(document).ready(function() {

                           $("#formRealizarSorteo").submit(function(event) {

                             console.log('no igreso');
                             //alert('id : '+premio);
                             event.preventDefault();
                             let fromData = new FormData(document.getElementById('formRealizarSorteo'));
                             console.log(fromData);

                           });
                           return true;

                         }) */
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
                                sLast: "Ultimo",
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

                    <br><br>









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