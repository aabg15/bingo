<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <title>LOTICAJA</title>
    <link rel="shortcut icon" type="image/x-icon" href="logo-icon.ico" />
    <link href="style.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="canonical" href="https://getbootstrap.com/docs/4.6/examples/blog/">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900" rel="stylesheet">
    <!-- Custom styles for this template -->
    <!-- <link href="blog.css" rel="stylesheet"> -->

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="index.php">
            <img src="sullana.png" width="200" id="img_nav">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto"></ul>
            <button class="btn my-2 my-sm-0" onclick="location.href='admin-panel/'" type="button" id="btn_nav">Iniciar Sesión</button>
        </div>
    </nav>
    <div id="div2">

        <div class="container">
            <div class="row" id="rocnt">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" id="colls">
                    <img class="img-responsive" src="loticaja 3_Mesa de trabajo 1.png" alt="" style="display: block;max-width: 100%;height: auto;">
                </div>
                <div class="animate__animated animate__heartBeat col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <h1 class="animate__animated animate__heartBeat" id="titutloPrin">LOTICAJA</h1>
                    <h2><b>Gana</b> con tus <br> <b>cuentas de Ahorro</b> y Crece+</h2>
                    <h3><b>PRIMER SORTEO: 11/07/2022</b></h3>
                    <form class="form-group" id="formLogin" method="post">
                        <div class="form-group">
                            <input type="number" class="form-control" id="dni" name="dni" placeholder="Ingresa con tu DNI">
                        </div>
                        <button class="btn my-2 my-sm-1" type="submit" id="btn_nav2">JUEGA AQUI</button>

                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!--  <script src="popper/popper.min.js"></script> -->
    <script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="codigo.js"></script>


</body>

</html>