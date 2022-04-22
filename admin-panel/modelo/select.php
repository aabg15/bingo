<?php
header('Content-Type: text/html; charset=UTF-8');
?>

<?php
/*       $data = 'llego al select.php';
       echo '<script>';
       echo 'console.log(' . json_encode($data) . ')';
       echo '</script>';
    exit(); */
function obtenerDepartamentos()
{
  include '../assets/db/db.php';

  $query = "SELECT * FROM ubdepartamento";
  $result = mysqli_query($connection, $query);

  $json = array();

  while ($row = mysqli_fetch_array($result)) {
    $json[] = array(
      'codDepartamento' => $row['idDepa'],
      'nomDepartamento' => $row['departamento'],
    );
  }
  //obtenerSedes();
  $jsonstring = json_encode($json);
  echo $jsonstring;
}


function obtenerProvincias($codDepartamento)
{
  include '../assets/db/db.php';

  $query = "SELECT * FROM ubprovincia WHERE idDepa = $codDepartamento";
  $result = mysqli_query($connection, $query);

  $json = array();

  while ($row = mysqli_fetch_array($result)) {
    $json[] = array(
      'codProvincia' => $row['idProv'],
      'nomProvincia' => $row['provincia'],
    );
  }

  $jsonstring = json_encode($json);
  echo $jsonstring;
}

function obtenerDistritos($codProvincia)
{
  include '../assets/db/db.php';

  $query = "SELECT * FROM ubdistrito WHERE idProv = $codProvincia";
  $result = mysqli_query($connection, $query);

  $json = array();

  while ($row = mysqli_fetch_array($result)) {
    $json[] = array(
      'codDistrito' => $row['idDist'],
      'nomDistrito' => $row['distrito'],
    );
  }

  $jsonstring = json_encode($json);
  echo $jsonstring;
}



if (isset($_POST['codigoDepar'])) {
  $codDepartamento = $_POST['codigoDepar'];
  obtenerProvincias($codDepartamento);
  //obtenerSedes();
} else if (isset($_POST['codigoProv'])) {
  $codProvincia = $_POST['codigoProv'];
  obtenerDistritos($codProvincia);
} else {
  obtenerDepartamentos();
}
