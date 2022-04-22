$(document).ready(function(){

    /* --variables para llamar a los select por el id */
    let $departamento = document.getElementById('departamento')
    let $provincia = document.getElementById('provincia')
    let $distrito = document.getElementById('distrito')
   // let $sede = document.getElementById('sede')
    //alert($distrito);
  
    //cargarSedes();

    function cargarDepartamentos() {
        $.ajax({
            url: 'modelo/select.php',
            type: 'GET',
            success: function(response) {
                const departamentos = JSON.parse(response);
                //alert(departamentos);

                let template = '<option class="form-control" value="0">-- Seleccione --</option>'
    
                departamentos.forEach(departamento => {
                    template += `<option class="form-control" value="${departamento.codDepartamento}">${departamento.nomDepartamento}</option>`;
                })

                $departamento.innerHTML = template;
            }
        })
    }
    cargarDepartamentos();

    function cargarProvincias(sendDatos) {
        $.ajax({
            url: 'modelo/select.php',
            type: 'POST',
            data: sendDatos,
            success: function(response) {
                const respuestas = JSON.parse(response);
                let template = '<option class="form-control" value="0">-- Seleccione --</option>'
    
                respuestas.forEach(respuesta => {
                    template += `<option class="form-control" value="${respuesta.codProvincia}">${respuesta.nomProvincia}</option>`;
                })

                $provincia.innerHTML = template;
            }
        })
    }

    $departamento.addEventListener('change', () => {
        const codDepartamento = $departamento.value

        const sendDatos = {
            'codigoDepar': codDepartamento
        }
        
        cargarProvincias(sendDatos)

        $distrito.innerHTML = ''
    })


    function cargarDistritos(sendDatos) {
        $.ajax({
            url: 'modelo/select.php',
            type: 'POST',
            data: sendDatos,
            success: function(response) {
                const respuestas = JSON.parse(response);
                let template = '<option class="form-control" value="0">-- Seleccione --</option>'
    
                respuestas.forEach(respuesta => {
                    template += `<option class="form-control" value="${respuesta.codDistrito}">${respuesta.nomDistrito}</option>`;
                })

                $distrito.innerHTML = template;
            }
        })
    }
    $provincia.addEventListener('change', () => {
        const codProvincia = $provincia.value

        const sendDatos = {
            'codigoProv': codProvincia
        }
        
        cargarDistritos(sendDatos)
    })
})