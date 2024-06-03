@php
    $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
    $dt = $dt->format('d/m/y');
    $user = $prestamo->user;
    $fechaPrestamo = date('d/m/y', strtotime($prestamo->fecha_prestamo));
    $cantidad = count($prestamo->inventario);
    $aula = $prestamo->aula
@endphp
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .header h1 {
            margin: 0;
            font-size: 14px;
        }

        .content p {
            margin: 2px 0;
        }

        .content table {
            width: 100%;
            border-collapse: collapse;
        }

        .content table, .content th, .content td {
            border: 1px solid #ccc;
        }

        .content th, .content td {
            padding: 5px;
            text-align: left;
        }

        .footer {
            text-align: center;
            margin-top: 10px;
            font-size: 8px;
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
                        <td style="padding: 0; width: 25%;">
                            <img src="img/logo-transparente.png" width="125px" height="125px" alt="Logo Universidad Católica de El Salvador">
                        </td>
                        <td style="padding: 0; width: 35%;">
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
                        <td style="padding: 0;width:20%" align="left">
                            <img src="img/logo-transparente.png" width="45px" alt="Logo Universidad Católica de El Salvador">
                        </td>
                        <td style="padding: 0;width:80%" align="center">
                            <p>Universidad Católica de El Salvador &copy; 2024</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</htmlpagefooter>

<sethtmlpageheader name="myheader" value="on" show-this-page="1" />
<sethtmlpagefooter name="myfooter" value="on" />
mpdf-->

<div style="padding: 10px 40px;">
    <div class="header">
        <br>
        <br>
        <br>
        <br>
        <br>
        <hr>
    </div>
    <div class="content">
        <p><strong>Nombre:</strong> {{$user->name . ' ' . $user->lastname}} </p>
        <p><strong>Carrera:</strong> {{$user->carrera->nombre}}</p>
        <p><strong>Asignatura:</strong> {{$prestamo->asignatura->nombre}}</p>
        <p><strong>Tipo de Usuario:</strong> {{$user->type}}</p>
        <p><strong>Total de Equipos:</strong> {{$cantidad}} </p>
        <p><strong>Fecha de Solicitud:</strong> {{$fechaPrestamo}}</p>
        <p><strong>Tiempo:</strong> {{substr($prestamo->hora_inicio, 0, -3)}}
            - {{substr($prestamo->hora_fin, 0, -3)}}</p>
        <p><strong>Estado:</strong> {{$prestamo->estado}}</p>
        <h3 style="text-align:center">Dispositivos en préstamo</h3>
        <table>
            <thead>
            <tr>
                <th>Dispositivo</th>
                <th>Identificador</th>
            </tr>
            </thead>
            <tbody>';
            @if($cantidad > 0)
                @for($i = 0, $j = 1; $i < $cantidad; $i++, ++$j)
                    <tr>
                        <td>{{$prestamo->inventario[$i]->marca . ' ' . $prestamo->inventario[$i]->modelo}}</td>
                        <td>{{$prestamo->inventario[$i]->identificador}}</td>
                    </tr>
                @endfor
            @else
                <td colspan="2">No hay dispositivos en préstamo</td>
            @endif
            </tbody>
        </table>
    </div>
    <div class="footer">
        <p>Gracias por su solicitud.</p>
    </div>
</div>
</body>
</html>
