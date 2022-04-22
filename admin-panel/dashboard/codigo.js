$('#formLogin').submit(function (e) {
    e.preventDefault();
    var usuario = $.trim($("#usuario").val());
    var password = $.trim($("#password").val());
    //alert('llego');
    if (usuario.length == "" || password == "") {
        Swal.fire({
            type: 'warning',
            title: 'Debe ingresar un usuario y/o password',
        });
        return false;
    } else {
        $.ajax({
            url: "login.php",
            type: "POST",
            datatype: "json",
            data: { usuario: usuario, password: password },
            success: function (data) {
                if (data == "null") {
                    Swal.fire({
                        type: 'error',
                        title: 'Usuario y/o password incorrecta',
                    });
                } else {
                    Swal.fire({
                        type: 'success',
                        title: '¡Conexión exitosa!',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ingresar'
                    }).then((result) => {
                        if (result.value) {
                            //window.location.href = "vistas/pag_inicio.php";
                            window.location.href = "dashboard/";
                        }
                    })

                }
            }
        });
    }
});


$('#formAgregarCorreo').submit(function (e) {
    e.preventDefault();
    var asuntoGr = $("#asuntoGr").val();
    var asuntoEj = $("#asuntoEj").val();
    var correoOcultoU = $("#correoOcultoU").val();
    var correoOcultoD = $("#correoOcultoD").val();
    var correoOcultoT = $("#correoOcultoT").val();
    var titulo = $("#titulo").val();
    var remitente = $("#remitente").val();
    var contrasena = $("#contrasena").val();
    
    $.ajax({
        url: "../bd/guardar_configuracion.php",
        type: "POST",
        datatype: "json",
        data: { asuntoGr: asuntoGr, asuntoEj: asuntoEj, correoOcultoU: correoOcultoU,correoOcultoD:correoOcultoD,correoOcultoT:correoOcultoT,titulo:titulo,remitente:remitente,contrasena:contrasena},
        success: function (data) {
            if (data == "null") {
                Swal.fire({
                    type: 'error',
                    title: 'Registro no realizado',
                });
            } else {
                Swal.fire({
                    type: 'success',
                    title: '¡Registro de sorteo exitoso!',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Confirmar'
                }).then((result) => {
                    if (result.value) {
                        //window.location.href = "vistas/pag_inicio.php";
                        //window.location.href = "ver_configuracion.php";
                    }
                })

            }
        }
    });

});



$('#formAgregarRegistro').submit(function (e) {
    e.preventDefault();
    var nombre = $("#nombre").val();
    var fechainicio = $("#fechainicio").val();
    var fechafin = $("#fechafin").val();
    var premio5letra = $("#premio5letra").val();
    var premio6letra = $("#premio6letra").val();
    var premio7letra = $("#premio7letra").val();
    
    

    //alert('llego');

    $.ajax({
        url: "../bd/guardar_sorteo.php",
        type: "POST",
        datatype: "json",
        data: { nombre: nombre, fechainicio: fechainicio, fechafin: fechafin,premio5letra:premio5letra,premio6letra:premio6letra,premio7letra:premio7letra },
        success: function (data) {
            if (data == "null") {
                Swal.fire({
                    type: 'error',
                    title: 'Registro no realizado',
                });
            } else {
                Swal.fire({
                    type: 'success',
                    title: '¡Registro de sorteo exitoso!',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Confirmar'
                }).then((result) => {
                    if (result.value) {
                        //window.location.href = "vistas/pag_inicio.php";
                        window.location.href = "ver_sorteos.php";
                    }
                })

            }
        }
    });

});

$('#formAgregarCliente').submit(function (e) {
    e.preventDefault();

    //alert('llego');
    var nombre = $("#nombre").val();
    var id_sorteo = $("#sorteos_disp").val();
    var apellidos = $("#apellidos").val();
    var ciudad = $("#provincia").val();
    var distrito = $("#distrito").val();
    var departamento = $("#departamento").val();
    var celular = $("#celular").val();
    var telefono = $("#telefono").val();
    var dni = $("#dni").val();
    var sede = $("#sucursal").val();
    var email = $("#correo").val();
    var direccion = $("#direccion").val();
    var intentos = $("#intentos").val();
    var saldo_corte = $("#saldo_corte").val();
    var moneda = $("#moneda").val();
    var monto_deposito = $("#monto_deposito").val();
    var plazo_dias = $("#plazo_dias").val();
    var fecha_apertura = $("#fecha_apertura").val();
    var fecha_vencimiento = $("#fecha_vencimiento").val();
    var tipo_deposito_sbs = $("#tipo_deposito_sbs").val();
    var tipo_deposito = $("#tipo_deposito").val();
    var codig_interno_cliente = $("#codig_interno_cliente").val();
    var codig_deposito = $("#codig_deposito").val();
   /*  alert('codig_interno_cliente : ', codig_interno_cliente);
    alert('codig_deposito : ', codig_deposito); */
    console.log('el id es: ' + id_sorteo);
    
    return;
    var ob = {
        nombre: nombre,
        apellidos: apellidos,
        ciudad: ciudad,
        distrito: distrito,
        departamento: departamento,
        celular: celular,
        telefono: telefono,
        dni: dni,
        sede: sede,
        email: email,
        direccion: direccion,
        intentos: intentos,
        saldo_corte: saldo_corte,
        moneda: moneda,
        monto_deposito: monto_deposito,
        plazo_dias: plazo_dias,
        fecha_apertura: fecha_apertura,
        fecha_vencimiento: fecha_vencimiento,
        tipo_deposito_sbs: tipo_deposito_sbs,
        tipo_deposito: tipo_deposito,
        codig_deposito: codig_deposito,
        codig_interno_cliente: codig_interno_cliente,
        id_sorteo:id_sorteo
    };

    $.ajax({
        url: "../bd/guardar_cliente.php",
        type: "POST",
        datatype: "json",
        data: ob,
        success: function (data) {
            if (data == "null") {
                Swal.fire({
                    type: 'error',
                    title: 'Registro no realizado',
                });
            } else {
                Swal.fire({
                    type: 'success',
                    title: '¡Registro de Cliente exitoso!',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Confirmar'
                }).then((result) => {
                    if (result.value) {
                        //window.location.href = "vistas/pag_inicio.php";
                        window.location.href = "ver_clientes.php";
                    }
                })

            }
        }
    });

});



$('#formActualizarCliente').submit(function (e) {
    e.preventDefault();

    //alert('llego');
    var nombre = $("#nombre").val();
    var apellidos = $("#apellidos").val();
    var ciudad = $("#provincia").val();
    var distrito = $("#distrito").val();
    var departamento = $("#departamento").val();
    var celular = $("#celular").val();
    var telefono = $("#telefono").val();
    var dni = $("#dni").val();
    var sede = $("#sucursal").val();
    var email = $("#correo").val();
    var direccion = $("#direccion").val();
    var intentos = $("#intentos").val();
    var saldo_corte = $("#saldo_corte").val();
    var moneda = $("#moneda").val();
    var monto_deposito = $("#monto_deposito").val();
    var plazo_dias = $("#plazo_dias").val();
    var fecha_apertura = $("#fecha_apertura").val();
    var fecha_vencimiento = $("#fecha_vencimiento").val();
    var tipo_deposito_sbs = $("#tipo_deposito_sbs").val();
    var tipo_deposito = $("#tipo_deposito").val();
    var codig_interno_cliente= $("#codig_interno_cliente").val();
    var codig_deposito= $("#codig_deposito").val();
    var ob = {
        nombre: nombre,
        apellidos: apellidos,
        ciudad: ciudad,
        distrito: distrito,
        departamento: departamento,
        celular: celular,
        telefono: telefono,
        dni: dni,
        sede: sede,
        email: email,
        direccion: direccion,
        intentos: intentos,
        saldo_corte: saldo_corte,
        moneda: moneda,
        monto_deposito: monto_deposito,
        plazo_dias: plazo_dias,
        fecha_apertura: fecha_apertura,
        fecha_vencimiento: fecha_vencimiento,
        tipo_deposito_sbs: tipo_deposito_sbs,
        tipo_deposito: tipo_deposito,
        codig_deposito:codig_deposito,
        codig_interno_cliente:codig_interno_cliente
    };

    var obj2 = JSON.stringify(ob)

    $.ajax({
        url: "../bd/update_cliente.php",
        type: "POST",
        datatype: "json",
        data: {
            'obj2': obj2,
        },

        success: function (data) {

            //var myObj = JSON.parse(data); //A  la variable le asigno el json decodificado
            //console.log(data)
           // alert('data'+data);

            if (data == "null") {

                Swal.fire({
                    type: 'error',
                    title: 'No hubo actualización de datos del cliente',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.value) {
                        //peticion
                        //window.location.href = "cliente_psorteo.php";

                    }
                })

            } else {

                Swal.fire({
                    type: 'success',
                    title: 'Actualizacion de Cliente exitoso!',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Confirmar'
                }).then((result) => {
                    if (result.value) {
                        //window.location.href = "vistas/pag_inicio.php";
                        window.location.href = "ver_clientes.php";
                    }
                })

            }

        }
    });

});




