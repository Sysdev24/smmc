<table id="data-table" class="table table-hover" style="width:200%">
    <thead>
        <th style="text-align: center" width="6%">MODIFICAR</th>
        <th style="text-align: center" width="6%">ELIMINAR</th>
        <th style="text-align: center" width="6%">CÉDULA</th>
        <th style="text-align: center" width="15%">NOMBRES</th>
        <th style="text-align: center" width="15%">APELLIDOS</th>
        <th style="text-align: center" width="15%">CARGO</th>
        <th style="text-align: center" width="10%">NRO. EMPLEADO</th>
        <th style="text-align: center" width="15%">GERENCIA</th>
    </thead>
</table>

@section('js')

<script>
    const URL_BASE = window.location.protocol + '//' + window.location.host;
let table= $('#data-table').DataTable({

    language: {
        url: 'js/librerias/es-ES.json'
    },
    info:false,
    pageLength: 10,
    order: [[ 2, "asc" ]],
    paging: true,
    lengthChange:false,
    columnDefs: [
        { orderable: false,targets: 0 },
        {
            targets: [0,1,2,3,4,5,6,7],
             className: 'dt-body-center'
        }
    ],
    ajax: URL_BASE+'/api/personal',
    columns:[
        {data:"id_personal",
            render:function(data, type, row){
                return `<a href="#winEdit" data-registro='${location.href}/${data}/edit'"
                            class="badge badge-primary p-2 openEditWin zebra_tooltips_td border border-success rounded-circle"
                            data-backdrop="static" data-target="#winEdit" data-toggle="modal" data-placement="bottom"
                            title="Editar"><span class="icofont-ui-edit text-white "></span></a>`
            }
        },

        {data:"id_status",render:function(data, type, row){console.log(data);
            if(data===1){
                icono='icofont-ui-check';
                style='bg-success'
            }else{
                icono='icofont-ui-close';
                style='bg-danger'
            }

            return `<label style="visibility: hidden;">${data}</label>
            <a href="#winEditEstatus" data-registro="${URL_BASE}/personal/${row.id_personal}"
                        class="badge p-2 openEditStatusWin zebra_tooltips_td border rounded-circle ${style}"
                        data-backdrop="static" data-target="#winEditEstatus" data-toggle="modal" data-placement="bottom"
                        title="Eliminar">
                        <span class="text-white ${icono}">
                        </span>
                    </a>`
            }
        },

        {data:"ci"},
        {data:"nombre"},
        {data:"apellido"},
        {data:"cargo.descripcion"},
        {data:"nro_empleado"},
        {data:"gerencia.descripcion"},
      

        ]
});
$('#ci').on('change', function(){ 
        var ci =  $(this).val();

        $.ajax({
                    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                    type: 'GET',
                    url: "{{ route('get.person') }}",
                    data: {

                        'ci': ci,
                    },
                    success: function(data) {
                        if(data.id_estatus !=null){
                            $('#nombre').val(data.nombre);
                            $('#apellido').val(data.apellido);
                            $('#id_personal').val(data.id_personal);
                            alert ('Este registro ya esiste')
                        } 
                        }                        
                   
          });


    });
</script>
@endsection