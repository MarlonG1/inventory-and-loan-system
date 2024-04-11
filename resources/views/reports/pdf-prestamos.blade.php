<html>
<head>
    <style>
        .invoice-content {
            font-family: 'Poppins', sans-serif;
            color: #535353;
            font-size: 14px;
        }

        .invoice-content a {
            text-decoration: none;
        }
        .invoice-content h1,
        h2,
        h3,
        h4,
        h5,
        h6
        {
            font-family: 'Poppins', sans-serif;
            color: #535353;
        }

        .mb-30 {
            margin-bottom: 30px;
        }

        .container-fluid {
            width: 100%;
            margin-right: auto;
            margin-left: auto;
        }

        .invoice-content .invoice-table th:first-child,
        .invoice-content .invoice-table td:first-child {
            text-align: left;
        }

        .invoice-content .invo-addr-1 {
            font-size: 14px;
            margin-bottom: 20px;
            line-height: 23px;
        }

        .invoice-content .item-desc-1 span {
            display: block;
        }

        .invoice-content .item-desc-1 small {
            display: block;
        }

        .invoice-content .important-notes-list-1 li {
            margin-bottom: 5px;
        }

        table th {
            font-weight: 400;
        }

        .invoice-7 h1,
        h2,
        h3,
        h4,
        h5,
        h6
        {
            color: #535353;
        }

        .invoice-7 .mb-30 {
            margin-bottom: 30px;
        }

        .invoice-7 .invoice-inner {
            background: #fff;
            position: relative;
            z-index: 0;
        }

        .invoice-7 .invoice-inner:before {
            content: "";
            width: 25px;
            height: 50px;
            position: absolute;
            bottom: 50px;
            left: 0;
            z-index: 1;
            /*background: url(../img/img-11.png) top left repeat;*/
            background-size: cover;
        }

        .invoice-7 .invoice-inner:after {
            content: "";
            width: 25px;
            height: 50px;
            position: absolute;
            top: 50px;
            right: 0;
            z-index: 1;
            /*background: url(../img/img-10.png) top left repeat;*/
            background-size: cover;
        }

        .invoice-7 .item-desc-1 span {
            font-size: 14px;
            font-weight: 500;
            color: #535353;
        }

        .invoice-7 .bank-transfer-list-1 li strong {
            font-weight: 500;
        }

        .invoice-7 .fw-bold {
            font-weight: bold !important;
        }

        .invoice-7 .item-desc-1 small {
            font-size: 13px;
            color: #535353;
        }

        .invoice-7 .invoice-top {
            padding-bottom: 30px;
        }

        .invoice-7 .invoice-top .invoice h1 {
            font-weight: 600;
            margin-bottom: 5px;
            text-transform: uppercase;
            font-size: 28px;
            color: #336ff6;
        }

        .invoice-7 table .invoice-info {
            padding: 20px;

        }

        .invoice-info {
            background: #f7f7f7;
            padding: 20px 40px;
        }

        .invoice-7 .invoice-info p {
            margin-bottom: 0;
        }

        .invoice-7 .order-summary {
            padding: 50px 0;
        }

        .invoice-7 .order-summary tbody,
        td,
        tfoot,
        th,
        thead,
        tr {
            border: solid 1px #f3f2f2;
        }

        .invoice-7 .table td,
        .invoice-7 .table th {
            padding: 10px 20px;
            vertical-align: top;
            border-top: 1px solid #e9ecef;
            border-right: 1px solid #e9ecef;
            text-align: center;
        }

        .invoice-7 .table > :not(caption) > * > * {
            box-shadow: none;
        }

        .invoice-7 .table tr,
        .invoice-7 .table tr strong {
            font-size: 14px;
        }

        .invoice-7 .table > thead {
            vertical-align: bottom;
            font-weight: 500;
        }

        .invoice-7 .invoice-informeshon p {
            font-size: 14px;
        }

        .invoice-7 .inv-title-1 {
            margin-bottom: 7px;
            color: #336ff6;
            text-transform: uppercase;
        }

        .invoice-7 thead th {
            font-weight: 500;
        }

        .invoice-7 .invoice-contact a {
            margin-right: 20px;
            color: #535353;
            font-size: 14px;
        }

        .invoice-7 .invoice-contact a i {
            color: #336ff6;
        }

        .d-flex {
            display: flex;
        }

        h2 {
            font-size: 2rem;
        }

        table.items {
            border: 0.1mm solid #000000;
        }

        .motivo {
            padding: 10px 0;
        }
    </style>

</head>
<body>
@php
    $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
    $dt = $dt->format('d/m/y');
    $user = $prestamo->user;
    $fechaPrestamo = date('d/m/y', strtotime($prestamo->fecha_prestamo));
    $cantidad = count($prestamo->equipos);
@endphp

<htmlpagefooter name="myfooter">
    <div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; ">
        Página {PAGENO} de {nb}
    </div>
</htmlpagefooter>

<sethtmlpagefooter name="myfooter" value="on"/>

<div class="invoice-7 invoice-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="invoice-inner" id="invoice_wrapper">
                    <div class="invoice-top">
                        <div class="row d-flex">
                            <table width="100%" cellpadding="10">
                                <tr>
                                    <td width="10%" style="border: 0">
                                        <img src="img/logo-transparente.png" width="55px" alt="">
                                    </td>
                                    <td width="50%" style="border: 0;">
                                        <div class="logo">
                                            <h3 style="font-size: 1.5rem;">Universidad Católica de El Salvador</h3>
                                        </div>
                                    </td>
                                    <td width="30%" style="border: 0;"></td>
                                    <td width="20%" align="center" style="border: 0;">
                                        <div class="invoice" style="">
                                            <h1 class="" style="color: #9a2323; font-size: 26px;">Registro</h1>
                                            <p style="font-size: 13px;">N° de solicitud </p>
                                            <div style="font-size: 18px; text-align: center"><strong>{{$prestamo->id}}</strong>
                                            </div>
                                            <hr style="margin: 4px;">
                                            <div style="text-align: right">
                                                <p style="font-size: 12px;">Fecha {{ $dt }}</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="invoice-info">
                        <div class="row d-flex">
                            <table width="100%" cellpadding="10">
                                <tr>
                                    <td width="40%" style="border: 0">
                                        <div class="invoice-info">
                                            <h2 class="inv-title-1" style="font-size: 18px; color: #9a2323;">Realizado
                                                por</h2>
                                            <br>
                                            <p class="invo-addr-1" style="color:#535353;">
                                                {{$user->name . ' ' . $user->lastname}} <br/>
                                                {{$user->email}} <br/>
                                                {{$user->phone}}<br/>
                                                {{$user->carnet ?? ''}}<br/>
                                            </p>
                                        </div>
                                    </td>
                                    <td width="15%" style="border: 0;"></td>
                                    <td width="35%" align="right" style="border: 0;">
                                        <div class="invoice-number">
                                            <h4 class="inv-title-1" style="color: #9a2323;">Fecha de prestamo</h4>
                                            <div style="text-align: right;color:#535353;">{{$fechaPrestamo}}</div>
                                        </div>
                                        <br>
                                        <div class="invoice-number text-end pt-4">
                                            <h4 class="inv-title-1" style="color: #9a2323;">Estado del prestamo</h4>
                                            <p class="inv-from-1" style="color:#535353;">{{$prestamo->estado}}</p>
                                        </div>
                                        <br>
                                        <div class="invoice-number text-end pt-4">
                                            <h4 class="inv-title-1" style="color: #9a2323;">Tiempo de prestacion</h4>
                                            <p class="inv-from-1" style="color:#535353;">
                                                De {{substr($prestamo->hora_inicio, 0, -3)}}
                                                hasta {{substr($prestamo->hora_fin, 0, -3)}}</p>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <div class="motivo mb-30">
                                <table width="100%" cellpadding="10">
                                    <tr>
                                        <td width="100%" align="center" style="border: 0">
                                            <div class="invoice" style="">
                                                <h4 class="" style="color: #9a2323; font-size: 20px">Motivo</h4>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse;">
                                    <thead style="background-color: #ccc;">
                                    <tr>
                                        <td width="100%" align="center" style="background-color: #ddd;font-size: 18px">
                                            Contenido
                                        </td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td style="background: white; padding: 20px;">{!! $prestamo->motivo !!}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="order-summary">
                        <table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse;">
                            <thead style="background-color: #ccc;">
                            <tr>
                                <td width="5%" align="center" style="background-color: #ddd;font-size: 14px; padding: 8px 0;">
                                    N°
                                </td>
                                <td width="25%" align="center" style="background-color: #ddd;font-size: 14px;">
                                    Equipo
                                </td>
                                <td width="30%" align="center" style="background-color: #ddd;font-size: 14px">
                                    Identificador
                                </td>
                                <td width="40%" align="center" style="background-color: #ddd;font-size: 14px">
                                    Observaciones
                                </td>
                            </tr>
                            </thead>
                            <tbody>
                            @for($i = 0, $j = 1; $i < $cantidad; $i++, ++$j)
                                <tr>
                                    <td align="center">{{$j}}</td>
                                    <td style="padding-left: 10px;">{{$prestamo->equipos[$i]->marca . ' ' . $prestamo->equipos[$i]->modelo}}</td>
                                    <td align="center">{{$prestamo->equipos[$i]->identificador}}</td>
                                    <td style="padding-left: 10px;">{{$prestamo->equipos[$i]->observaciones}}</td>
                                </tr>
                            @endfor
                            </tbody>
                        </table>
                        <table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse;">
                            <thead style="background-color: #ccc;">
                            <tr>
                                <td width="100%" align="center" style="background-color: #ddd;font-size: 14px; padding: 8px 0;">
                                    Cantidad de equipos prestados
                                </td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td align="center" class="fw-bold" style="padding: 6px 0;">{{$cantidad}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>


