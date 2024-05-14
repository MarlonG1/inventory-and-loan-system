@php
    $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
    $dt = $dt->format('d/m/y');
    $user = $prestamo->user;
    $fechaPrestamo = date('d/m/y', strtotime($prestamo->fecha_prestamo));
    $cantidad = count($prestamo->equipos);
    $aula = $prestamo->aula
@endphp

    <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Préstamo</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        /* Estilos generales */
        body {
            font-family: 'Roboto', sans-serif;
            color: #535353;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 50px;
        }

        /* Encabezado y pie de página */
        header,
        footer {
            background-color: #9a2323;
            color: #fff;
            padding: 10px;
            display: flex;
            align-items: center;
        }

        header img,
        footer img {
            height: 50px;
            margin-right: 10px;
        }

        footer {
            font-size: 14px;
            justify-content: center;
        }

        /* Secciones */
        section {
            margin-bottom: 30px;
        }

        section h2 {
            color: #9a2323;
            font-size: 24px;
        }

        /* Tablas */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #9a2323;
            color: #fff;
            font-weight: 500;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Detalles */
        .details {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .details div {
            flex: 1;
            padding: 10px;
        }

        .details div:first-child {
            flex: 2;
        }

        .details h3 {
            color: #9a2323;
            font-size: 18px;
            margin-bottom: 5px;
        }

        /* Iconos */
        .icon {
            display: inline-block;
            width: 20px;
            height: 20px;
            margin-right: 5px;
            vertical-align: middle;
        }

        .section-title {
            color: #9a2323;
            margin-bottom: 10px;
            margin-top: 10px;
        }

        .details-table {
            width: 100%;
            border-collapse: collapse;
        }

        .details-column {
            padding: 10px;
            vertical-align: top;
        }

        .details-subtitle {
            color: #9a2323;
            font-size: 18px;
            margin-bottom: 5px;
        }

        .details-name {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .details-info {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }

        .details-icon {
            margin-right: 5px;
        }
    </style>
</head>
<body>

<!--mpdf
<htmlpageheader name="myheader">
    <table style="border-collapse: collapse; width: 100%; background-color: #9a2323; color: white;">
        <tr>
            <td style="">
                <table style="border-collapse: collapse; width: 90%;" align="center">
                    <tr style="border: 0;">
                        <td style="padding: 0; width: 10%;">
                            <img src="img/logo-transparente.png" width="55px" alt="Logo Universidad Católica de El Salvador">
                        </td>
                        <td style="padding: 0; width: 70%;">
                            <h2 style="margin: 0;">Universidad Católica de El Salvador</h2>
                        </td>
                        <td align="center" style="border: 0;width=20%" >
                            <div class="invoice" style="">
                                <h1 style="font-size: 20px;">Prestamos</h1>
                                <p style="font-size: 13px;">N° de solicitud </p>
                                <div style="font-size: 18px; text-align: center;"><strong>{{$prestamo->id}}</strong></div>
                                <hr style="margin: 4px;color:white;">
                                <div style="text-align: right">
                                    <p style="font-size: 12px;">Fecha {{ $dt }}</p>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</htmlpageheader>

<htmlpagefooter name="myfooter">
    <table style="border-collapse: collapse; width: 100%; background-color: #9a2323; color: white; padding-bottom:300px">
        <tr>
            <td style="padding: 10px;" align="center">
                <table style="border-collapse: collapse; width: 90%;" align="center">
                    <tr style="border: 0;">
                        <td style="padding: 0;width:15%" align="left">
                            <img src="img/logo-transparente.png" width="45px" alt="Logo Universidad Católica de El Salvador">
                        </td>
                        <td style="padding: 0;width:60%" align="center">
                            <p>Universidad Católica de El Salvador &copy; 2024</p>
                        </td>
                        <td  style="width:15%" align="right">Página {PAGENO} de {nb}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</htmlpagefooter>

<sethtmlpageheader name="myheader" value="on" show-this-page="1" />
<sethtmlpagefooter name="myfooter" value="on" />
mpdf-->
<div class="container">
    <section>
        <h2 class="section-title" style="text-align: center">Detalles del Préstamo</h2>
        <hr style="margin: 5px;color: #9a2323;">
        <table class="details-table">
            <tr style="border: 0;">
                <td class="details-column" width="50%">
                    <h3 class="details-subtitle">Realizado por</h3>
                    <br>
                    <p class="details-name"> {{$user->name . ' ' . $user->lastname}}</p>
                    <p class="details-info">
                        <svg width="15px" class="details-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path fill="#535353"
                                  d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/>
                        </svg>
                        {{'  ' . $user->email}}
                    </p>
                    <p class="details-info">
                        {!! $user->phone === null ? '' :  '<svg width="15px" class="details-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#535353" d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/></svg>'
. '  ' .  $user->phone !!}
                    </p>
                    <p class="details-info">
                        {!! $user->carnet === null ? '' : '<svg width="15px" class="details-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#535353" d="M0 96l576 0c0-35.3-28.7-64-64-64H64C28.7 32 0 60.7 0 96zm0 32V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V128H0zM64 405.3c0-29.5 23.9-53.3 53.3-53.3H234.7c29.5 0 53.3 23.9 53.3 53.3c0 5.9-4.8 10.7-10.7 10.7H74.7c-5.9 0-10.7-4.8-10.7-10.7zM176 192a64 64 0 1 1 0 128 64 64 0 1 1 0-128zm176 16c0-8.8 7.2-16 16-16H496c8.8 0 16 7.2 16 16s-7.2 16-16 16H368c-8.8 0-16-7.2-16-16zm0 64c0-8.8 7.2-16 16-16H496c8.8 0 16 7.2 16 16s-7.2 16-16 16H368c-8.8 0-16-7.2-16-16zm0 64c0-8.8 7.2-16 16-16H496c8.8 0 16 7.2 16 16s-7.2 16-16 16H368c-8.8 0-16-7.2-16-16z"/></svg>'
 . '  ' . $user->carnet !!}</p>
                </td>
                <td width="10%"></td>
                <td class="details-column" width="40%" style="line-height: 1.3;">
                    <h3 class="details-subtitle">Información del Préstamo</h3>
                    <br>
                    <p class="details-info">Fecha de prestamo: {{$fechaPrestamo}}</p>
                    <p class="details-info">Tiempo: {{substr($prestamo->hora_inicio, 0, -3)}}
                        - {{substr($prestamo->hora_fin, 0, -3)}}</p>
                    <p class="details-info">Estado: {{$prestamo->estado}}</p>
                    <p class="details-info">Aula asignada: {{$aula->aula}}</p>
                </td>
            </tr>
        </table>
    </section>
    <section>
        <h2 class="section-title" style="font-size: 22px">Motivo</h2>
        {!! $prestamo->motivo !!}
    </section>

    <section>
        <h2 class="section-title" style="font-size: 22px">Equipos Prestados</h2>
        <table>
            <thead>
            <tr>
                <th>#</th>
                <th>Equipo</th>
                <th>Identificador</th>
                <th>Observaciones</th>
            </tr>
            </thead>
            <tbody>
            @for($i = 0, $j = 1; $i < $cantidad; $i++, ++$j)
                <tr>
                    <td>{{$j}}</td>
                    <td>{{$prestamo->equipos[$i]->marca . ' ' . $prestamo->equipos[$i]->modelo}}</td>
                    <td>{{$prestamo->equipos[$i]->identificador}}</td>
                    <td>{{$prestamo->equipos[$i]->observaciones}}</td>
                </tr>
            @endfor
            </tbody>
        </table>
        <p>Cantidad de equipos prestados: {{$cantidad}}</p>
    </section>
</div>
</body>

</html>
