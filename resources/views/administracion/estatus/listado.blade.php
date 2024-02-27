<table id="data-table" class="table table-hover" style="width:100%">
    <thead>
        <th style="text-align: center" width="10%">EDITAR</th>
        <th style="text-align: center" width="40%">ESTATUS </th>
		<th style="text-align: center" width="40%">SIGLAS </th>
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
                 targets: [0,1,2],
                 className: 'dt-body-center'
            }
        ],
        ajax: URL_BASE+'/api/estatus',
        columns:[
            {data:"id_estatus",render:function(data, type, row){
                return `<a href="#winEdit" data-registro='${URL_BASE}/estatus/${data}/edit'"
                            class="badge badge-primary p-2 openEditWin zebra_tooltips_td border border-success rounded-circle"
                            data-backdrop="static" data-target="#winEdit" data-toggle="modal" data-placement="bottom"
                            title="Editar"><span class="icofont-ui-edit text-white "></span></a>`
                }
            },


            {data:"descripcion"},
            {data:"siglas"},
                    ]
    });
</script>
@endsection
