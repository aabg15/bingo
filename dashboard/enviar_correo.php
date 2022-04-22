<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'correo/Exception.php';
require 'correo/PHPMailer.php';
require 'correo/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
//echo 'llego';
$tipo = $_POST['tipo'];
$fecha = date('Y-m-d H:i:s');



if ($tipo == 'general') {
  $nombre = $_POST['nombre'];
  $apellidos = $_POST['apellidos'];
  $id_sorteo = $_POST['id_sorteo'];
  $sorteo = $_POST['sorteo']; //nombre del sorteo
  $correo = $_POST['correo'];
  $dni = $_POST['dni'];
  $jugadasObtenidas = $_POST['jugadasObtenidas'];
  $jugadasObtenidasRuleta = $_POST['jugadasObtenidasRuleta'];
  date_default_timezone_set('America/Lima');
  $fecha = date('Y-m-d H:i:s');
  /*  var_dump($jugadasObtenidasRuleta);
    exit(); */

  try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                    //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp-mail.outlook.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'angel_acuario1998@hotmail.com';                     //SMTP username
    $mail->Password   = 'ayy040615';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('angel_acuario1998@hotmail.com', 'Departamento De Sistemas Caja Sullana');
    $mail->addAddress($correo, 'Jugador');     //Add a recipient
    //$mail->addAddress('ellen@example.com');               //Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    $correo_oculto1 = "ahorros@cajasullana.pe";
    $correo_oculto2 = "";
    $mail->addCC($correo_oculto1);
    //$mail->addCC('cc@example.com');
    // $mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    $mensaje = '
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Envio de cartillas-LOTICAJA</title>

  <style type="text/css">
    /* Take care of image borders and formatting */

    img {
      max-width: 600px;
      outline: none;
      text-decoration: none;
      -ms-interpolation-mode: bicubic;
    }

    a {
      border: 0;
      outline: none;
    }

    a img {
      border: none;
    }

    /* General styling */

    td,
    h1,
    h2,
    h3 {
      font-family: Helvetica, Arial, sans-serif;
      font-weight: 400;
    }

    td {
      font-size: 13px;
      line-height: 19px;
      text-align: left;
    }

    body {
      -webkit-font-smoothing: antialiased;
      -webkit-text-size-adjust: none;
      width: 100%;
      height: 100%;
      color: #37302d;
      background: #ffffff;
    }




    h1,
    h2,
    h3,
    h4 {
      padding: 0;
      margin: 0;
      color: #444444;
      font-weight: 400;
      line-height: 110%;
    }

    h1 {
      font-size: 35px;
    }

    h2 {
      font-size: 30px;
    }

    h3 {
      font-size: 24px;
    }

    h4 {
      font-size: 18px;
      font-weight: normal;
    }
  </style>
  <style type="text/css" media="screen">
    @media screen {
      @import url(http://fonts.googleapis.com/css?family=Open+Sans:400);

      /* Thanks Outlook 2013! */
      td,
      h1,
      h2,
      h3 {
        font-family: "Open Sans", "Helvetica Neue", Arial, sans-serif !important;
      }
    }
  </style>

</head>

<body>
  <br>
  <center>

    <h1>Envio de jugadas del sorteo : ' . $sorteo . '</h1>
    <br><br>
    <div class="row">
      <div class="col-md-9">
        <div class="row p-4">
          <!-- <legend class="m-3" id="tituloprimero">SORTEO :<?php echo $sorteo; ?> </legend> -->

          <div class="col-md-6">
            <div class="col-auto p-1" id="juego">
              <h3><b>Hola jugador : ' .$nombre . ' ' . $apellidos.'</b></h3> <br>

            </div>
          </div>
        </div>
      </div>
    </div>

  </center>
  <center>
    <h2 style="color:#ff8000;">Cartilla de las 7 letras </h2><br>

    <div style="background-color: #ebe7e7;margin: 25px 100px 30px 100px;">
      <table style="width: 100%;">
        <thead style="background-color: black;color: #fff;width: 100%;height: 50px;text-align: center;">
          <tr>

            <th> Fecha</th>
            <th> Jugadas</th>
          </tr>
        </thead>
        <tbody
          style="background-color: rgb(255, 255, 255);color: rgb(0, 0, 0);width: 100%;height: 50px;text-align: center;">
          ';
          $cadenaLetra ="";
          foreach ($jugadasObtenidas as $prueba) {
          $juga = $prueba["jugadas"];
          $fecha = $prueba["fechas"];
          $cadenaLetra .=$juga.'\n';
          $mensaje .= '
          <tr>
            <td><center>' . $fecha . '</center></td>
            <td><center>' . $juga . '</center></td>
           
          </tr>';

          }
          $mensaje .= '
        </tbody>
      </table>
    </div>
  </center>

  <center>
    <br>
    <h2 style="color:#ff8000;">Cartilla del Tragamonedas </h2><br>

    <div style="background-color: #ebe7e7;margin: 25px 100px 30px 100px;">
      <table style="width: 100%;">
        <thead style="background-color: black;color: #fff;width: 100%;height: 50px;text-align: center;">
          <tr>

            <th> Fecha</th>
            <th> Combinacion</th>
          </tr>
        </thead>
        <tbody
          style="background-color: rgb(255, 255, 255);color: rgb(0, 0, 0);width: 100%;height: 50px;text-align: center;">
          ';
          $cadenaRuleta = "";
          foreach ($jugadasObtenidasRuleta as $pruebax) {
          $premio = $pruebax["premios"];
          $fecha = $pruebax["fechas"];
          $cadenaRuleta .=$premio.';\n';
          $mensaje .= '
          <tr>
            <td><center>' . $fecha . '</center></td>
            <td><center>' . $premio . '</center></td>
            
          </tr>';

          }
          $mensaje .= '

        </tbody>
      </table>
    </div>
    <br>
    <h4 style="color:#ff8000;">Gracias por participar, Buena Suerte</h4><br>
          <br>
  </center>


</body>

</html>';

    //Content
    //$mail->isHTML(true);                                  //Set email format to HTML
    //$asunto = 'CONSTANCIA DE JUGADAS DE LETRAS Y RULETA -LOTICAJA';
    //$mail->Subject = $asunto;
    //$mail->Body    =  $mensaje;

    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    //$mail->SMTPDebug = false;
    //$mail->do_debug = false;
    //$mail->send();

    echo 'Mensaje fue enviado';

    //guardar en la bd

    include_once '../bd/conexion.php';

    //$dni = $_SESSION["s_usuario"];
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    //$consulta = "SELECT * FROM sorteo where dni=" . $dni;
    $consultaC = "INSERT INTO correo(`asunto`, `mensaje`, `destinatario`, `estado`, `dni`, `id_sorteo`,`tipo`,`jugada`,`ruleta`,`fecha`) 
        VALUES ('$asunto','$mensaje','$correo','E','$dni','$id_sorteo','$tipo','$cadenaLetra','$cadenaRuleta','$fecha');";

    //$resultado = $conexion->prepare($consulta);
    $resultado = $conexion->prepare($consultaC);

    //$resultado->execute();
    $resultado->execute();
  } catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
 /*  echo $cadenaLetra;
  echo '--';
  echo $cadenaRuleta;
  exit(); */
} else {
  //ruleta

  $nombre = $_POST['nombre'];
  $apellidos = $_POST['apellidos'];
  $id_sorteo = $_POST['id_sorteo'];
  $sorteo = $_POST['sorteo']; //nombre del sorteo
  $correo = $_POST['correo'];
  $dni = $_POST['dni'];
  $sucursal = $_POST['sucursal'];
  $jugadasObtenidasRuleta = $_POST['jugadasObtenidasRuleta'];
  date_default_timezone_set('America/Lima');
  $fecha = date('Y-m-d H:i:s');
  /* 
    var_dump($jugadasObtenidasRuleta);
    exit(); */

  try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                    //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp-mail.outlook.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'angel_acuario1998@hotmail.com';                     //SMTP username
    $mail->Password   = '';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $titulo_envio = "Departamento De Sistemas Caja Sullana";
    $correoRemitente = "angel_acuario1998@hotmail.com";
    $mail->setFrom($correoRemitente, $titulo_envio);
    $mail->addAddress($correo, 'Jugador ');     //Add a recipient
    //$mail->addAddress('ellen@example.com');               //Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    $correo_oculto1 = "";
    $correo_oculto2 = "";
    $mail->addCC($correo_oculto1);
    //$mail->addCC('cc@example.com');


    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    $cont = 1;
    $mensaje = '
    <!DOCTYPE html>
    <html lang="en">
    
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>FELICITACIONES</title>
    
      <style type="text/css">
        /* Take care of image borders and formatting */
    
        img {
          max-width: 600px;
          outline: none;
          text-decoration: none;
          -ms-interpolation-mode: bicubic;
        }
    
        a {
          border: 0;
          outline: none;
        }
    
        a img {
          border: none;
        }
    
        /* General styling */
    
        td,
        h1,
        h2,
        h3 {
          font-family: Helvetica, Arial, sans-serif;
          font-weight: 400;
        }
    
        td {
          font-size: 13px;
          line-height: 19px;
          text-align: left;
        }
    
        body {
          -webkit-font-smoothing: antialiased;
          -webkit-text-size-adjust: none;
          width: 100%;
          height: 100%;
          color: #37302d;
          background: #ffffff;
        }
    
    
    
    
        h1,
        h2,
        h3,
        h4 {
          padding: 0;
          margin: 0;
          color: #444444;
          font-weight: 400;
          line-height: 110%;
        }
    
        h1 {
          font-size: 35px;
        }
    
        h2 {
          font-size: 30px;
        }
    
        h3 {
          font-size: 24px;
        }
    
        h4 {
          font-size: 18px;
          font-weight: normal;
        }
      </style>
      <style type="text/css" media="screen">
        @media screen {
          @import url(http://fonts.googleapis.com/css?family=Open+Sans:400);
    
          /* Thanks Outlook 2013! */
          td,
          h1,
          h2,
          h3 {
            font-family: "Open Sans", "Helvetica Neue", Arial, sans-serif !important;
          }
        }
      </style>
    
    </head>
    
    <body>
      <br>
      <center>
    
        <h1>Felicidades, has ganado en el juego del tragamoneda del sorteo : ' . $sorteo . '</h1>
        <br><br>
        <div class="row">
          <div class="col-md-9">
            <div class="row p-4">
              <!-- <legend class="m-3" id="tituloprimero">SORTEO :<?php echo $sorteo; ?> </legend> -->
    
              <div class="col-md-6">
                <div class="col-auto p-1" id="juego">
                  <h3><b>Hola jugador :' .$nombre . ' ' . $apellidos.'</b></h3> <br>
    
                </div>
              </div>
            </div>
          </div>
        </div>
    
      </center>
      <center>
        <h2 style="color:#ff8000;">Los premios obtenidos son: </h2><br>
    
        <div style="background-color: #ebe7e7;margin: 25px 100px 30px 100px;">
          <table style="width: 100%;">
            <thead style="background-color: black;color: #fff;width: 100%;height: 50px;text-align: center;">
              <tr>
    
                <th> Fecha</th>
                <th> Premio</th>
              </tr>
            </thead>
            <tbody
              style="background-color: rgb(255, 255, 255);color: rgb(0, 0, 0);width: 100%;height: 50px;text-align: center;">
              ';
              $cadenaPremios ="";
              foreach ($jugadasObtenidasRuleta as $prueba) {
              $juga = $prueba["premios"];
              $fecha = $prueba["fechas"];
              $cadenaPremios .=$juga.'\n';
              $mensaje .= '
              <tr>
                <td><center>' . $fecha . '</center></td>
                <td><center>' . $juga . '</center></td>
    
              </tr>';
    
              }
              $mensaje .= '
            </tbody>
          </table>
        </div>
        <h4 style="color:#ff8000;">Tienes un plazo hasta de 10 dias del siguiente mes</h4><br>
        <h4 style="color:black;">Recoja su premio en la agencia: ' . $sucursal . '</h5><br>
        <br>
      </center>
    
    
    
    </body>
    
    </html>';

    //Content
    //$mail->isHTML(true);                                  //Set email format to HTML
    //$asunto = 'CONSTANCIA DE PREMIO';
    //$mail->Subject = $asunto;
    //$mail->Body    =  $mensaje;

    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    //$mail->SMTPDebug = false;
    //$mail->do_debug = false;
    //$mail->send();

    echo 'Mensaje fue enviado';

    //guardar en la bd

    include_once '../bd/conexion.php';

    //$dni = $_SESSION["s_usuario"];
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    //$consulta = "SELECT * FROM sorteo where dni=" . $dni;
    $consultaC = "INSERT INTO correo(`asunto`, `mensaje`, `destinatario`, `estado`, `dni`, `id_sorteo`,`tipo`,`premio`,`fecha`) VALUES ('$asunto','$mensaje','$correo','E','$dni','$id_sorteo','$tipo','$cadenaPremios','$fecha');";

    //$resultado = $conexion->prepare($consulta);
    $resultado = $conexion->prepare($consultaC);

    //$resultado->execute();
    $resultado->execute();
  } catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}
