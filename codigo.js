$('#formLogin').submit(function (e) {
    e.preventDefault();
    var dni = $.trim($("#dni").val());
    console.log('DNI :    :  : .',dni);
    //alert(dni);
    if (dni.length == 0) {



        const Toast = Swal.mixin({
            toast: true,
            position: 'center',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        Toast.fire({
            icon: 'warning',
            title: 'Debe ingresar un DNI!'
        });
        return false;


        //alert('Debe ingresar un DNI!');
    } else {
        $.ajax({
            url: "bd/login.php",
            type: "POST",
            datatype: "json",
            data: { dni: dni },
            success: function (data) {
                if (data == "null") {
                    /* Swal.fire({
                        type: 'error',
                        title: 'DNI no encontrado',
                    }); */

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 1000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
                    Toast.fire({
                        icon: 'error',
                        title: 'DNI no encontrado'
                    }).then(function () {
                        //eliminarLS();
                        location.href = "informativo.php";
                    });


                } else {
       

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'bottom',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
                    Toast.fire({
                        icon: 'success',
                        title: 'Ingresó sesión con éxito!'
                    }).then(function () {
                        //eliminarLS();
                        location.href = "datos.php?id=" + dni;
                    });

                }
            }
        });
    }
});

$('#formDatos').submit(function (e) {
    //alert('lleg');
    e.preventDefault();
    var dni = $.trim($("#dni").val());
    var nombre = $.trim($("#nombre").val());
    var apellidos = $.trim($("#apellido").val());
    var direccion = $.trim($("#direccion").val());
    var distrito = $.trim($("#distrito").val());
    var departamento = $.trim($("#departamento").val());
    var provincia = $.trim($("#provincia").val());
    var agencia = $.trim($("#sucursal").val());
    var celular = $.trim($("#celular").val());
    var telefono = $.trim($("#telefono").val());
    var correo = $.trim($("#correo").val());
    var isChecked = document.getElementById('checkPoliticas').checked;
    var isChecked2 = document.getElementById('checkTerminosCondiciones').checked;

    /*  if (isChecked) {
         alert('checkbox esta seleccionado');
     }else{
         alert('checkbox no esta seleccionado');
     } */

    /*      alert(provincia);
         alert(departamento);
    
         alert(distrito); */


    if ((agencia == '0') || (nombre.length == 0) || (isChecked == false) || (isChecked2 == false) || (apellidos.length == 0) || (direccion.length == 0) || (distrito == "0") || (departamento == "0") || (provincia == "0") || (celular.length == 0) || (telefono.length == 0) || (correo.length == 0)) {
        Swal.fire({
            type: 'warning',
            title: 'Debe llenar todos los campos!',
        });
        return false;

    } else {
        $.ajax({
            url: "bd/actualizar_datos_cliente.php",
            type: "POST",
            datatype: "json",
            data: {
                dni: dni, nombre: nombre, apellidos: apellidos, direccion: direccion, distrito: distrito, departamento: departamento,
                provincia: provincia, agencia: agencia, celular: celular, telefono: telefono, correo: correo
            },
            success: function (data) {
                if (data == null) {
                    Swal.fire({
                        type: 'error',
                        title: 'Datos No actualizados',
                    });
                } else {

                    Swal.fire({
                        type: 'success',
                        title: '¡Datos Actualizados!',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ingresar'
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = "dashboard/index.php";

                        }
                    })
                }
            }

        });
    }
});

$("body").on('click', '#botonNuevo', function (ev) {
    ev.preventDefault();
    /*  Swal.fire({
         type: 'success',
         title: '¡Ingreso exitoso!',
         confirmButtonColor: '#3085d6',
         confirmButtonText: 'Ingresar'
     }).then((result) => {
         if (result.value) {
             window.location.href = "dashboard/elegir_jugadas.php";
 
         }
     }) */

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })
    Toast.fire({
        icon: 'success',
        title: 'Ingreso!'
    })
});


