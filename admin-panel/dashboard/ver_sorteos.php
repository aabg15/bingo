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
  <title>Ver sorteos
  </title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!----css3---->
  <link rel="stylesheet" href="css/custom.css">
  <script src="../datatable/datatables.css"></script>
  <!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

  <!--google material icon-->
  <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
</head>

<body>

  <!-- Modal -->
  <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar Sorteo</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
        </div>
        <div class="modal-body">
          <form action="" id="form_editar">
            <div class="form-group">
              <label for="">SORTEO</label>
              <input type="text" id="nombre_sorteo" class="form-control">
              <label for="">Fecha inicio</label>
              <input type="date" id="fecha_inicio" class="form-control">
              <label for="">Fecha Fin</label>
              <input type="date" id="fecha_fin" class="form-control">
              <label for="">Premio 5 letras</label>
              <input type="text" id="premio5letras" class="form-control">
              <label for="">Premio 6 letras</label>
              <input type="text" id="premio6letras" class="form-control">
              <label for="">Premio 7 letras</label>
              <input type="text" id="premio7letras" class="form-control">
              <input type="hidden" id="id_sorteo">

            </div>



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="modalBorrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Eliminar Sorteo</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="form_eliminar">
            <div class="form-group">
              <label for="sorteo">Sorteo: </label>
              <label id="sorteo_eliminar"></label>
              <input type="hidden" id="id_sorteo_eliminar">

            </div>



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Eliminar</button>
          </form>
        </div>
      </div>
    </div>
  </div>


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
        <div class="">

          <div class="col-md-12 grid-margin">
            <div class="card">
              <div class="card-body">

                <h4 class="card-title">Resultados</h4>
                <div class="col-12 grid-margin">

                  <div class="table-responsive">
                    <table class="table table-bordered" id="tablaSorteos" style="width: 100%;">
                      <thead class="text-primary thead-dark">
                        <tr>
                          <th> ID </th>
                          <th> Nombre del Sorteo </th>
                          <th> Fecha Inicio </th>
                          <th> Premio 5 letras </th>
                          <th> Premio 6 letras </th>
                          <th> Premio 7 letras </th>
                          <th> Fecha Fin </th>
                          <th> Estado </th>
                          <th> Acciones </th>
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
      let datatable_sorteo;

      function listarTablasorteo() {
        let funcion = "verSorteolista";

        $.post("../bd/listar_sorteos.php", {
          funcion
        }, (response) => {

          var datos = JSON.parse(response)

          datatable_sorteo = $('#tablaSorteos').DataTable({
            resposive: true,

            data: datos,

            columns: [

              {
                data: "id_sorteo"
              },
              {
                data: "nombre"
              },
              {
                data: "fecha_inicio"
              },
              {
                data: "premio5letras"
              },
              {
                data: "premio6letras"
              },
              {
                data: "premio7letras"
              },
              {
                data: "fecha_fin"
              },
              {
                data: "estado"
              },
              {
                "defaultContent": "<center><button type='button' class='editar btn btn-primary' data-toggle='modal' data-target='#modalEditar'>Editar</button>       <button type='button' class='eliminar btn btn-danger'>Borrar</button>   <a href='premio_ruleta.php' type='button' class='btn btn-success'>Premios</a></center>"
              },

            ],
            destroy: true,
            language: espanol,


          });
        })


      }

      $('#tablaSorteos tbody').on('click', '.editar', function() {
        let data = datatable_sorteo.row($(this).parents()).data();
        $('#nombre_sorteo').val(data.nombre);
        $('#fecha_fin').val(data.fecha_fin);
        $('#fecha_inicio').val(data.fecha_inicio);
        $('#premio5letras').val(data.premio5letras);
        $('#premio6letras').val(data.premio6letras);
        $('#premio7letras').val(data.premio7letras);
        $('#id_sorteo').val(data.id_sorteo);
        // console.log(data);

      });

      $('#form_editar').submit(e => {
        let id = $('#id_sorteo').val();
        let nombre_sorteo = $('#nombre_sorteo').val();
        let fecha_inicio = $('#fecha_inicio').val();
        let fecha_fin = $('#fecha_fin').val();
        let premio5letras= $('#premio5letras').val();
        let premio6letras= $('#premio6letras').val();
        let premio7letras= $('#premio7letras').val();
        //console.log(id+nombre_sorteo);
        funcion = 'editar_sorteo';
        $.post('../bd/controlador/Controlador_sorteo.php', {
          id,
          nombre_sorteo,
          fecha_inicio,
          fecha_fin,
          premio5letras,
          premio6letras,
          premio7letras,
          funcion
        }, (response) => {
          // console.log(response);
        });
        // e.preventDefault();
      })

      $('#tablaSorteos tbody').on('click', '.eliminar', function() {
        let data = datatable_sorteo.row($(this).parents()).data();
        /*        $('#sorteo_eliminar').html(data.nombre);
               $('#id_sorteo_eliminar').val(data.id_sorteo); */
        let id = data.id_sorteo;
        funcion = 'borrar_sorteo';
        const swalWithBootstrapButtons = Swal.mixin({
          customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger mr-2'
          },
          buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
          title: 'Eliminar',
          text: "Seguro que deseas eliminar el sorteo " + data.nombre,
          icon: 'question',
          showCancelButton: true,
          confirmButtonText: 'Si',
          cancelButtonText: 'No',
          reverseButtons: true
        }).then((result) => {
          if (result.isConfirmed) {

            $.post('../bd/controlador/Controlador_sorteo.php', {
              id,
              funcion
            }, (response) => {
              console.log(response);
              if (response == 'elimino') {
                listarTablasorteo();
                swalWithBootstrapButtons.fire({
                  position: 'top-center',
                  icon: 'success',
                  title: 'Se elimino correctamente',
                  showConfirmButton: false,
                  timer: 1500
                })

              } else {
                swalWithBootstrapButtons.fire({
                  position: 'top-center',
                  icon: 'danger',
                  title: 'Error al eliminar',
                  showConfirmButton: false,
                  timer: 1500
                })

              }
            });

          } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
          ) {
            swalWithBootstrapButtons.fire({
              position: 'top-center',
              icon: 'error',
              title: 'Error al eliminar',
              showConfirmButton: false,
              timer: 1500
            })
          }
        })


        // console.log(data);

      });

      $('#form_eliminar').submit(e => {
        let id = $('#id_sorteo_eliminar').val();
        funcion = 'borrar_sorteo';
        /* console.log(id);
        e.preventDefault();
        return */
        $.post('../bd/controlador/Controlador_sorteo.php', {
          id,
          funcion
        }, (response) => {
          console.log(response);
          if (response == 'elimino') {
            listarTablasorteo();
          } else {


          }
        });
        e.preventDefault();
      })


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