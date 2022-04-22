$(document).ready(function () {
    let $sede = document.getElementById('sucursal')
    $.ajax({
        url: 'modelo/select.php',
        type: 'GET',
        success: function (response) {
            //const departamentos = JSON.parse(response);
            //alert((response));
            let template = '<option class="form-control" value="0">-- Seleccione --</option>'
            response.forEach(x => {
                template += `<option class="form-control" value="${departamento.id_sucursal}">${departamento.nombre_sucursal}</option>`;
            })
            console.log(template);
           /*  let template = '<option class="form-control" value="0">-- Seleccione --</option>'

            departamentos.forEach(departamento => {
                template += `<option class="form-control" value="${departamento.id_sucursal}">${departamento.nombre_sucursal}</option>`;
            })

            $sede.innerHTML = template; */
            //alert(template);
        }

    })


})