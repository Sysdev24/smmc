<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>REPORTE DE CORRESPONDENCIA</title>

    <style>
        * {
            font-family: Arial, Helvetica, sans-serif
        }

        header h2 {
            color: #fff;
            text-align: end;
            position: absolute;
            top: -5;
            right: 5;
        }

        img {
            width: 100%;
            filter: grayscale(100%);
        }

        #title {
            text-transform: uppercase;
            text-align: center;
            background: #e6e6e6;
            padding: 0.5em;
            font-size: 20px;
        }

        #body-report {
            font-size: 11px;
        }

        #body-report table thead th {
            background: #e6e6e6;

        }

        table {
            border-collapse: collapse;
            border: rgb(163, 163, 163) 1px solid;
        }

        th{
            border: rgb(163, 163, 163) 1px solid;
        }
        td {
            border: rgb(163, 163, 163) 1px solid;
        }
    </style>

</head>

<body>

    <header>
        <img src="{{ $logo }}" alt="">
        <h2 class="text-white">SISTEMA DE CONTROL Y CORRESPONDENCIA (SCC)</h2>
    </header>

    <div>
        <h3 id="title"> {{ mb_strtoupper($titulo) }}</h3>
    </div>
    <div id="body-report">
        <table style="width:100%;">
            <thead>
                {{-- - <th style="text-align: center">&nbsp;</th> --}}
                @foreach ($columnas as $columna)
                    @switch($columna->columna)

                        @case('personal')
                            <th style="text-align: center">
                                {{ mb_strtoupper($columna->alias) . ' (CÉDULA)' }}
                            </th>
                            <th style="text-align: center">
                                {{ mb_strtoupper($columna->alias) . ' (NOMBRE Y APELLIDO)' }}
                            </th>
                        @break

                        @default
                            <th style="text-align: center">{{ mb_strtoupper($columna->alias) }}
                            </th>
                    @endswitch
                @endforeach
            </thead>

            <tbody>
                @foreach ($registro as $registro)
                    <tr>
                        @foreach ($registro as $valor)
                            @if ($valor === true)
                                <td>SÍ</td>
                            @elseif($valor === false)
                                <td>NO</td>
                            @else
                                @if (DateTime::createFromFormat('Y-m-d H:i:s', $valor) !== false)
                                    <td>{{ date('d/m/Y h:i a', strtotime($valor)) }}</td>
                                @else
                                    <td>{{ $valor }}</td>
                                @endif
                            @endif
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
