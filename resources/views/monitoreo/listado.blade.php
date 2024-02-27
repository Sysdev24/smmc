<table id="data-table" class="table table-hover" style="width:100%">
    <thead>
        <th style="text-align: center" width="2%">MOD</th>
        <th style="text-align: center" width="2%">SUSP</th>
        <th style="text-align: center" width="5%">ID</th>
        <th style="text-align: center" width="2%">C.I</th>
        <th style="text-align: center" width="2%">NOMBRES</th>
        <th style="text-align: center" width="2%">APELLIDOS</th>
        <th style="text-align: center" width="2%">FECHA</th>
        <th style="text-align: center" width="2%">FECHA/EMISION</th>
        <th style="text-align: center" width="5%">TIPO DE MEDIOS DE COMUNICACION</th>
        <th style="text-align: center" width="5%">MEDIOS DE COMUNICACION</th>
        <th style="text-align: center" width="5%">DESCRIPCION</th>
        <th style="text-align: center" width="5%">LINK</th>
        <th style="text-align: center" width="5%">REPORTA</th>
        <th style="text-align: center" width="5%">REGIONES</th>
        <th style="text-align: center" width="5%">ESTADOS</th>
        <th style="text-align: center" width="5%">TENDENCIA</th>
        <th style="text-align: center" width="5%">TIPO DE MINUTA</th>
        <th style="text-align: center" width="5%">ESTATUS</th>
    </thead>
</table>

@section('js')

<script>
    const URL_BASE = window.location.protocol + '//' + window.location.host;
    let table = $('#data-table').DataTable({

        language: {
            url: 'js/librerias/es-ES.json'
        }
        , info: false
        , pageLength: 10
        , order: [
            [2, "asc"]
        ]
        , paging: true
        , lengthChange: false
        , columnDefs: [{
                orderable: false
                , targets: 0
            }
            , {
                targets: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17]
                , className: 'dt-body-center'
            }
        ]
        , ajax: URL_BASE + '/api/monitoreo'
        , columns: [{
                data: "id_monitoreo"
                , render: function(data, type, row) {
                    return `<a href="#winEdit" data-registro='${URL_BASE}/monitoreo/${data}/edit'"
                            class="badge badge-primary p-2 openEditWin zebra_tooltips_td border border-success rounded-circle"
                            data-backdrop="static" data-target="#winEdit" data-toggle="modal" data-placement="bottom"
                            title="Editar"><span class="icofont-ui-edit text-white "></span></a>`
                }
            },

            {
                data: "estatus_monitoreo"
                , render: function(data, type, row) {
                    if (data === 1) {
                        icono = 'icofont-ui-check';
                        style = 'bg-success'
                    } else {
                        icono = 'icofont-ui-close';
                        style = 'bg-danger'
                    }

                    return `<label style="visibility: hidden;">${data}</label>
            <a href="#winEditEstatus" data-registro="${URL_BASE}/monitoreo/${row.id_monitoreo}"
                        class="badge p-2 openEditStatusWin zebra_tooltips_td border rounded-circle ${style}"
                        data-backdrop="static" data-target="#winEditEstatus" data-toggle="modal" data-placement="bottom"
                        title="Desactivar">
                        <span class="text-white ${icono}">
                        </span>
                    </a>`
                }
            },

            {
                data: "id_personal"
            }
            , {
                data: "ci"
            }
            , {
                data: "nombre"
            }
            , {
                data: "apellido"
            }
            , {
                data: "fecha"
            }
            , {
                data: "fecha_emision"
            }
            , {
                data: "informacion"
            }
            , {
                data: "tipo_informacion"
            }
            , {
                data: "observacion"
            }
            , {
                data: "link"
            }
            , {
                data: "insumo"
            }
            , {
                data: "regiones"
            }
            , {
                data: "estado"
            }
            , {
                data: "tendencia"
            }
            , {
                data: "tipo_evento"
            }
            , {
                data: "estatus"
            },
         ]
    });

    $('#ci').on('change', function() {
        var ci = $(this).val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
            , type: 'GET'
            , url: "{{ route('get.person') }}"
            , data: {
                'ci': ci
            , }
            , success: function(data) {
                if (data.id_estatus === 1) {
                    $('#nombre').val(data.nombre);
                    $('#apellido').val(data.apellido);
                    $('#id_personal').val(data.id_personal);
                } else {
                    alert('El registro no existe')
                }
            }
        , });

    });

</script>
@endsection
