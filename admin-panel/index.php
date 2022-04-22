<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>Iniciar sesión
    </title>
    <link rel="shortcut icon" type="image/x-icon" href="../logo-icon.ico"/>
    
    <!-- Bootstrap CSS -->

   <!--  <link rel="stylesheet" href="dashboard/css/bootstrap.min.css"> -->
    <!----css3---->
    <link rel="stylesheet" href="estilos_panel.css">
    <!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!--google material icon-->
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <div class="body-overlay"></div>
        <?php
        //include_once 'nav.php'
        ?>
        <!-- Page Content  -->
        <div id="content">

            <div class="top-navbar">
                <?php
                //include_once 'nav_bar.php'

                ?>
            </div>
            <div class="main-content">
                <div class="row-0">

                    <div class="container-login">
                        <div class="wrap-login">
                            <form class="login-form validate-form" id="formLogin" action="" method="post">
                                <span class="login-form-title">LOGIN</span>

                                <div class="wrap-input100" data-validate="Usuario incorrecto">
                                    <input class="input100" type="text" id="usuario" name="usuario" placeholder="Usuario">
                                    <span class="focus-efecto"></span>
                                </div>

                                <div class="wrap-input100" data-validate="Password incorrecto">
                                    <input class="input100" type="password" id="password" name="password" placeholder="Password">
                                    <span class="focus-efecto"></span>
                                </div>

                                <div class="container-login-form-btn">
                                    <div class="wrap-login-form-btn">
                                        <div class="login-form-bgbtn"></div>
                                        <button type="submit" name="submit" class="login-form-btn">INICIAR SESION</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>




                </div>

                <footer class="footer">

                    <?php

                    // include_once 'footer.php';
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
    <script src="codigo.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


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