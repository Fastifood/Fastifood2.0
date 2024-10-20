<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="SpeedFood - Sistema de Delivery" />
    <meta property="og:title" content="SpeedFood - Sistema de Delivery" />
    <meta property="og:description" content="SpeedFood - Sistema de Delivery" />
    <meta property="og:image" content="https://fooddesk.dexignlab.com/xhtml/social-image.png" />
    <meta name="format-detection" content="telephone=no">
    <title>@yield('titulo-pagina')</title>
    <link href="vendor/jquery-nice-select/css/nice-select.css" rel="stylesheet">
    <link href="vendor/swiper/css/swiper-bundle.min.css" rel="stylesheet">
    <link href="vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="vendor/swiper/css/swiper-bundle.min.css" rel="stylesheet">
    @yield('head-scripts')
    <link href="css/mediaqueries-toastify.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body class="@yield('body-class')">
    <div id="preloader">
        <div class="lds-ripple">
            <div></div>
            <div></div>
        </div>
    </div>
    @yield('conteudo-principal')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.css">
    <script src="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.js"></script>
    <script src="vendor/global/global.min.js"></script>
    <script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="vendor/chart.js/chart.bundle.min.js"></script>
    <script src="vendor/swiper/js/swiper-bundle.min.js"></script>
    <script src="vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script>
    <script src="js/dlabnav-init.js"></script>
    <script src="js/custom.js"></script>
    @yield('outros-scripts')
</body>
</html>
