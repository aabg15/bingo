<?php require_once "vistas/parte_superior.php" ?>
<script type="text/javascript" src="../dashboard/nuevo_sorteo/control_sorteo.js"></script>
<?php

$sorteo_id = $_GET['id'] ?? '0';
//echo $sorteo_id;
require('../bd/config.php');

$sqlData = "SELECT * FROM `sorteo` where id_sorteo=" . $sorteo_id;
$sql = mysqli_query($con, $sqlData);

while ($row = mysqli_fetch_assoc($sql)) {
    $nombreSorteo = $row['nombre'];
}
?>
<!--INICIO del cont principal-->
<meta charset="UTF-8">
<div class="container">
    <h1>Realizar Sorteo "<?php echo $nombreSorteo; ?> "</h1>
    <button id="btnSorteoA" type="button" class="btn btn-success" onclick="btn_iniciaSorteo();" data-toggle="modal">Empezar sorteo</button>
</div>
<br>
<br>
<!--FIN del cont principal-->

<div class="container">
    <!-- lista de las jugadas de los clientes
 -->

    <div class="row" style="margin: 0px; padding: 0px;">
        <input type="hidden" id="sorteo_id" value="<?php echo $sorteo_id; ?>">

        <div class="col-lg-6 col-md-8 xs-12">
            <div id="panel_registro" style="padding: 5%; box-shadow: 1px 2px 2px #A4A4A4; border:1px solid #A4A4A4;" align="center">
                <!-- Panel de datos -->
                <!-- <table class="table table-condensed" style="width: 80%;"> -->

                <div class="row">
                    <div class="col-6" id="letras">

                    </div>
                </div>
                <!--  </table> -->

            </div>

        </div>
        <script>
            // var con =0;
            function btn_iniciaSorteo() {
                alert('click');

                //while(con!=6){
                $.ajax({
                    url: 'generar_letra.php',
                    data: {
                        sorteo_id: document.getElementById('sorteo_id').value
                    },
                    type: 'POST',
                    dataType: 'json',
                    success: function(json) {
                        let tabla = "<table class='table table-bordered'>";
                        tabla += `<tr>
                        <th>Orden</th>
                        <th>Letra</th>
                    </tr>`
                        json.map(function(item) {
                            console.log(item);
                            tabla += `<tr>
                            <td>${item.orden}</td>
                            <td>${item.letra}</td>
                        </tr>`
                        })

                        tabla += "</table>";
                        $('#letras').html(tabla);
                    },
                    error: function(xhr, status) {
                        console.log('Disculpe, existió un problema');
                    },
                    complete: function(xhr, status) {
                        console.log('Petición realizada');
                        // con=con+1;
                    }
                });

                //}
                //alert('Sorteo terminado!, ahora se daran los ganadores');

            }
        </script>

    </div>

    <?php require_once "vistas/parte_inferior.php" ?>