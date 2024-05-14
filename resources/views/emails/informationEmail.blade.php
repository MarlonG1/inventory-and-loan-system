@php
    $user = $emailData->user;
    $fechaPrestamo = date('d/m/y', strtotime($emailData->fecha_prestamo));
    $cantidad = count($emailData->equipos);
    $aula = $emailData->aula
@endphp
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Solicitud de prestamos</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- CSS Reset : BEGIN -->
    <style>

        html,
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
            background: #f1f1f1;
        }

        /* What it does: Stops email clients resizing small text. */
        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        /* What it does: Centers email on Android 4.4 */
        div[style*="margin: 16px 0"] {
            margin: 0 !important;
        }

        /* What it does: Stops Outlook from adding extra spacing to tables. */
        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }

        /* What it does: Fixes webkit padding issue. */
        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            /*table-layout: fixed !important;*/
            margin: 0 auto !important;
        }

        /* What it does: Uses a better rendering method when resizing images in IE. */
        img {
            -ms-interpolation-mode: bicubic;
        }

        /* What it does: Prevents Windows 10 Mail from underlining links despite inline CSS. Styles for underlined links should be inline. */
        a {
            text-decoration: none;
        }

        /* What it does: A work-around for email clients meddling in triggered links. */
        *[x-apple-data-detectors], /* iOS */
        .unstyle-auto-detected-links *,
        .aBn {
            border-bottom: 0 !important;
            cursor: default !important;
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* What it does: Prevents Gmail from displaying a download button on large, non-linked images. */
        .a6S {
            display: none !important;
            opacity: 0.01 !important;
        }

        /* What it does: Prevents Gmail from changing the text color in conversation threads. */
        .im {
            color: inherit !important;
        }

        /* If the above doesn't work, add a .g-img class to any image in question. */
        img.g-img + div {
            display: none !important;
        }


        /*!* iPhone 4, 4S, 5, 5S, 5C, and 5SE *!*/
        /*@media only screen and (min-device-width: 320px) and (max-device-width: 374px) {*/
        /*    u ~ div .email-container {*/
        /*        min-width: 320px !important;*/
        /*    }*/
        /*}*/

        /*!* iPhone 6, 6S, 7, 8, and X *!*/
        /*@media only screen and (min-device-width: 375px) and (max-device-width: 413px) {*/
        /*    u ~ div .email-container {*/
        /*        min-width: 375px !important;*/
        /*    }*/
        /*}*/

        /*!* iPhone 6+, 7+, and 8+ *!*/
        /*@media only screen and (min-device-width: 414px) {*/
        /*    u ~ div .email-container {*/
        /*        min-width: 414px !important;*/
        /*    }*/
        /*}*/

    </style>

    <!-- CSS Reset : END -->

    <!-- Progressive Enhancements : BEGIN -->
    <style>

        .primary {
            background: #f3a333;
        }

        .bg_white {
            background: #ffffff;
        }

        .bg_light {
            background: #fafafa;
        }

        .bg_black {
            background: #000000;
        }

        .bg_dark {
            background: rgba(0, 0, 0, .8);
        }

        .email-section {
            padding: 2.5em;
        }

        /*BUTTON*/
        .btn {
            padding: 10px 15px;
        }

        .btn.btn-primary {
            border-radius: 30px;
            background: #f3a333;
            color: #ffffff;
        }


        h1, h2, h3, h4, h5, h6 {
            color: #000000;
            margin-top: 0;
        }

        body {
            /*font-family: 'Montserrat', sans-serif;*/
            font-weight: 400;
            font-size: 15px;
            line-height: 1.8;
            color: rgba(0, 0, 0, .4);
        }

        a {
            color: #f3a333;
        }

        table {
        }

        /*LOGO*/

        .logo h1 {
            margin: 0;
        }

        .logo h1 a {
            color: #000;
            font-size: 20px;
            font-weight: 700;
            text-transform: uppercase;
            /*font-family: 'Montserrat', sans-serif;*/
        }

        /*HERO*/
        .hero {
            position: relative;
        }

        .hero img {

        }

        .hero .text {
            color: rgba(255, 255, 255, .8);
        }

        .hero .text h2 {
            color: #ffffff;
            font-size: 30px;
            margin-bottom: 0;
        }


        /*HEADING SECTION*/
        .heading-section {
        }

        .heading-section h2 {
            color: #000000;
            font-size: 28px;
            margin-top: 0;
            line-height: 1.4;
        }

        .heading-section .subheading {
            margin-bottom: 20px !important;
            display: inline-block;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: rgba(0, 0, 0, .4);
            position: relative;
        }

        .heading-section .subheading::after {
            position: absolute;
            left: 0;
            right: 0;
            bottom: -10px;
            content: '';
            width: 100%;
            height: 2px;
            background: #f3a333;
            margin: 0 auto;
        }

        .heading-section-white {
            color: rgba(255, 255, 255, .8);
        }

        .heading-section-white h2 {
            font-size: 28px;
            padding-bottom: 0;
        }

        .heading-section-white h2 {
            color: #ffffff;
        }

        .heading-section-white .subheading {
            margin-bottom: 0;
            display: inline-block;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: rgba(255, 255, 255, .4);
        }


        .icon {
            text-align: center;
        }

        .icon img {
        }


        /*SERVICES*/
        .text-services {
            padding: 10px 10px 0;
            text-align: center;
        }

        .text-services h3 {
            font-size: 20px;
        }

        /*BLOG*/
        .text-services .meta {
            text-transform: uppercase;
            font-size: 14px;
        }

        /*TESTIMONY*/
        .text-testimony .name {
            margin: 0;
        }

        .text-testimony .position {
            color: rgba(0, 0, 0, .3);

        }


        /*VIDEO*/
        .img {
            width: 100%;
            height: auto;
            position: relative;
        }

        .img .icon {
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            bottom: 0;
            margin-top: -25px;
        }

        .img .icon a {
            display: block;
            width: 60px;
            position: absolute;
            top: 0;
            left: 50%;
            margin-left: -25px;
        }


        /*COUNTER*/
        .counter-text {
            text-align: center;
        }

        .counter-text .num {
            display: block;
            color: #ffffff;
            font-size: 34px;
            font-weight: 700;
        }

        .counter-text .name {
            display: block;
            color: rgba(255, 255, 255, .9);
            font-size: 13px;
        }


        /*FOOTER*/

        .footer {
            color: rgba(255, 255, 255, .5);

        }

        .footer .heading {
            color: #ffffff;
            font-size: 20px;
        }

        .footer ul {
            margin: 0;
            padding: 0;
        }

        .footer ul li {
            list-style: none;
            margin-bottom: 10px;
        }

        .footer ul li a {
            color: rgba(255, 255, 255, 1);
        }


        @media screen and (max-width: 500px) {

            .icon {
                text-align: center;
            }

            .text-services {
                padding-right: 20px;
                text-align: center;
            }

        }


        /* Tablas */
        .customTable table {
            width: 100%;
            border-collapse: collapse;
        }

        .customTable th,
        .customTable td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .customTable th {
            background-color: #9a2323;
            color: #fff;
            font-weight: 500;
        }

        .customTable tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #222222;">
<center style="width: 100%; background-color: #f1f1f1;">
    <div
        style="display: none; font-size: 1px;max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
        &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
    </div>
    <div style="max-width: 600px; margin: 0 auto;" class="email-container">
        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%"
               style="margin: auto;">
            <tr>
                <td class="logo" style="padding: 1em 2.5em; text-align: center;background: #700e0e">
                    <h1 style="color:white;">Universidad Católica de El Salvador</h1>
                </td>
            </tr>
            <tr>
                <td valign="middle" class="hero" style="border: 0;">
                    <table>
                        <tr>
                            <td style="border: 0; padding: 0;">
                                <img src="https://i.imgur.com/4ASFStT.png" width="100%" alt="">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="bg_white">
                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%"
                           style="background: #700e0e">
                        <tr>
                            <td class="email-section" style="text-align:center;">
                                <div class="heading-section heading-section-white">
                                    <span class="subheading text-white" style="color:white !important;">Solicitud de prestamo</span>
                                    <p>Se le notifica por el presente medio que su solicitud de prestamo se ha
                                        registrado correctamente y se encuentra {{strtolower($emailData->estado)}}</p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="bg_white email-section">
                                <div class="heading-section" style="text-align: center; padding: 0 30px;">
                                    <span class="subheading" style="font-weight: 700;">Detalles de su solicitud</span>
                                    <p>Los detalles de su solicitud son los siguientes:</p>
                                </div>
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td valign="top" width="50%" style="padding-top: 20px;">
                                            <table role="presentation" cellspacing="0" cellpadding="0" border="0"
                                                   width="100%">
                                                <tr>
                                                    <td class="text-services">
                                                        <h3>Información personal</h3>
                                                        <p>{{$user->name . ' ' . $user->lastname}}
                                                            <br>{{$user->email}}
                                                        </p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table role="presentation" cellspacing="0" cellpadding="0" border="0"
                                                   width="100%">
                                                <tr>
                                                    <td class="text-services">
                                                        <h3>Detalles de solicitud</h3>
                                                        <p>Fecha de prestamo: {{$fechaPrestamo}}
                                                            <br>Tiempo:{{substr($emailData->hora_inicio, 0, -3)}}
                                                            - {{substr($emailData->hora_fin, 0, -3)}}
                                                            <br>Estado: {{$emailData->estado}}
                                                            <br>Aula asignada: {{$aula->aula}}</p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <section style="padding-bottom: 40px; padding-top: 20px">
                        <h3 class="section-title" style="font-size: 22px;text-align: center">Equipos solicitados</h3>
                        <table class="customTable" width="80%" style="border: 0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Equipo</th>
                            </tr>
                            </thead>
                            <tbody>
                            @for($i = 0, $j = 1; $i < $cantidad; $i++, ++$j)
                                <tr>
                                    <td>{{$j}}</td>
                                    <td>{{$emailData->equipos[$i]->marca . ' ' . $emailData->equipos[$i]->modelo}}</td>
                                </tr>
                            @endfor
                            </tbody>
                        </table>
                        <table width="80%">
                            <tr>
                                <td>
                                    <p>Cantidad de equipos prestados: {{$cantidad}}</p>
                                </td>
                            </tr>
                        </table>
                    </section>
                </td>
            </tr>
        </table>
        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%"
               style="margin: auto;background: #700e0e">
            <tr>
                <td valign="middle" class="footer email-section" style="background: #700e0e" width="90%">
                    <table>
                        <tr>
                            <td valign="top" width="60%" style="padding-top: 20px;">
                                <table role="presentation" cellspacing="0" cellpadding="0" border="0"
                                       width="100%">
                                    <tr>
                                        <td style="text-align: left; padding-left: 5px; padding-right: 5px;">
                                            <h3 class="heading">Contáctanos</h3>
                                            <ul class="footer-links pt-2">
                                                <li> Carretera a Ilobasco, Km. 51 y medio Cantón Agua Zarca,
                                                    Cabañas,
                                                    El Salvador, C.A.
                                                </li>
                                                <li>PBX: (503) 2378-1500</li>
                                                <li>ilobasco@catolica.edu.sv</li>
                                            </ul>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td valign="top" width="40%" style="padding-top: 20px;">
                                <table role="presentation" cellspacing="0" cellpadding="0" border="0"
                                       width="100%">
                                    <tr>
                                        <td style="text-align: left; padding-left: 10px;">
                                            <h3 class="heading">Links usuales</h3>
                                            <ul>
                                                <li><a href="https://cri.catolica.edu.sv/inicio/"
                                                       target="_blank">Sitio oficial</a></li>
                                                <li><a href="https://cri.catolica.edu.sv/plataformas/"
                                                       target="_blank">Plataformas</a></li>
                                                <li><a href="#" target="_blank">Portal de préstamos</a></li>
                                                <li><a href="https://regcri.catolica.edu.sv/"
                                                       target="_blank">Registro académico</a></li>
                                            </ul>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td valign="middle" class="footer email-section" align="center"
                    style="padding: 1rem !important; background: #3b3a3a">
                    <table style="width: 100%">
                        <tr>
                            <td valign="top" width="100%">
                                <table role="presentation" cellspacing="0" cellpadding="0" border="0"
                                       width="100%">
                                    <tr>
                                        <td style="text-align: left; padding-right: 10px;" align="center">
                                            <p style="text-align: center">Universidad Católica de El
                                                Salvador &copy; 2024</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</center>
</body>
</html>
