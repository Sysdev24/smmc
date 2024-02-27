<table id="data-table" class="table table-hover" style="width:100%">
    <thead>
        <th style="text-align: center" width="5%">EDITAR</th>
        <th style="text-align: center" width="5%">ELIMINAR</th>
        <th style="text-align: center" width="50%">REDES SOCIALES </th>
        <th style="text-align: center" width="40%">TIPO DE MEDIOS</th>


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
                 targets: [0,1,2,3],
                 className: 'dt-body-center'
            }
        ],
        ajax: URL_BASE+'/api/informacion',
        columns:[
            {data:"id_informacion",render:function(data, type, row){
                return `<a href="#winEdit" data-registro='${URL_BASE}/informacion/${data}/edit'"
                            class="badge badge-primary p-2 openEditWin zebra_tooltips_td border border-success rounded-circle"
                            data-backdrop="static" data-target="#winEdit" data-toggle="modal" data-placement="bottom"
                            title="Editar"><span class="icofont-ui-edit text-white "></span></a>`
                }
            },

            {data:"id_status",render:function(data, type, row){
                if(data===1){
                    icono='icofont-ui-check';
                    style='bg-success'
                }else{
                    icono='icofont-ui-close';
                    style='bg-danger'
                }

                return `<label style="visibility: hidden;">${data}</label>
                <a href="#winEditEstatus" data-registro="${URL_BASE}/informacion/${row.id_informacion}"
                            class="badge p-2 openEditStatusWin zebra_tooltips_td border rounded-circle ${style}"
                            data-backdrop="static" data-target="#winEditEstatus" data-toggle="modal" data-placement="bottom"
                            title="Eliminar">
                            <span class="text-white ${icono}">
                            </span>
                        </a>`
                }
            },

            {data:"descripcion"},
            {data:"tipo_informacion"},

                    ]
    });
</script>
@endsection
