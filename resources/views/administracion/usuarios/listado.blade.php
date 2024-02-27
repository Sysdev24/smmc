<table id="data-table" class="table table-hover" style="width:200%">
    <thead>
        <th>&nbsp;</th>
        <th style="text-align: center" width="7%">ESTATUS</th>
        <th style="text-align: center" width="7%">USUARIO</th>
        <th style="text-align: center" width="6%">CÉDULA</th>
        <th style="text-align: center" width="13%">NOMBRE</th>
        <th style="text-align: center" width="13%">APELLIDO</th>
        <th style="text-align: center" width="18%">CORREO ELECTRÓNICO</th>
        <th style="text-align: center" width="18%">ROLES</th>
        <th style="text-align: center" width="18%"> GERENCIA</th>
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
    ajax: URL_BASE+'/api/usuarios',
    columns:[
        {data:"id_usuario",render:function(data, type, row){
            return `<a href="#winEdit" data-registro='${location.href}/${data}/edit'"
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
            <a href="#winEditEstatus" data-registro="${URL_BASE}/usuarios/${row.id_usuario}"
                        class="badge p-2 openEditStatusWin zebra_tooltips_td border rounded-circle ${style}"
                        data-backdrop="static" data-target="#winEditEstatus" data-toggle="modal" data-placement="bottom"
                        title="Modificar estatus">
                        <span class="text-white ${icono}">
                        </span>
                    </a>`
            }
        },

        {data:"usuario"},
        {data:"ci"},
        {data:"nombre"},
        {data:"apellido"},
        {data:"email"},
        {data:"roles.descripcion"},
        //{data:"gerencia.nombre"}
        {data:"gerencia.descripcion"}
        ]
});
</script>
@endsection
