<table id="data-table" class="table table-hover" style="width:60%">
    <thead>
    <th style="text-align: center" width="2%">MOD</th>
	<th style="text-align: center" width="2%">SUSP</th>
    <th style="text-align: center" width="10%">FECHA</th>
    <th style="text-align: center" width="10%">DESCRIPCION-TEND</th>
    <th style="text-align: center" width="5%">OBSERVACION</th>
    <th style="text-align: center" width="10%">RED SOCIAL</th>
    <th style="text-align: center" width="5%">TENDENCIA#</th>
    <th style="text-align: center" width="5%">TIPO</th>
    <th style="text-align: center" width="5%">POSICION</th>
    <th style="text-align: center" width="5%">LINK</th>
    <th style="text-align: center" width="5%">ESTATUS</th>
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
            targets: [0,1,2,3,4,5,6,7,8,9,10],
             className: 'dt-body-center'
        }
    ],
    ajax: URL_BASE+'/api/tendencia_ven',
    columns:[
         {data:"id",
            render:function(data, type, row){
                return `<a href="#winEdit" data-registro='${URL_BASE}/tendencia_ven/${data}/edit'"
                            class="badge badge-primary p-2 openEditWin zebra_tooltips_td border border-success rounded-circle"
                            data-backdrop="static" data-target="#winEdit" data-toggle="modal" data-placement="bottom"
                            title="Editar"><span class="icofont-ui-edit text-white "></span></a>`
            }
        },

            {
                    data: "estatus_registro",
                    render: function(data, type, row) {
                        if (data === 1) {
                            icono = 'icofont-ui-check';
                            style = 'bg-success'
                        } else {
                            icono = 'icofont-ui-close';
                            style = 'bg-danger'
                        }

                        return `<label style="visibility: hidden;">${data}</label>
                        <a href="#winEditEstatus" data-registro="${URL_BASE}/tendencia_ven/${row.id}"
                        class="badge p-2 openEditStatusWin zebra_tooltips_td border rounded-circle ${style}"
                        data-backdrop="static" data-target="#winEditEstatus" data-toggle="modal" data-placement="bottom"
                        title="Desactivar">
                        <span class="text-white ${icono}">
                        </span>
                    </a>`

            }
        },

        {data:"fecha"},
        {data:"descripcion_tend"},
        {data:"observacion"},
	    {data:"informacion"},
	    {data:"tendencia_actual"},
	    {data:"tendencia"},
	    {data:"posicion"},
        {data:"link"},
	    {data:"estatus"},
        ]
});

</script>
@endsection
