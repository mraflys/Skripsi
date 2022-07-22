<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="icon" href="/assets/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/assets/css/plugins/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/assets/css/plugins/sweetalert.css">
    <link rel="stylesheet" href="/assets/css/plugins/magnific-popup.css">
    <link rel="stylesheet" href="/assets/css/plugins/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="https://unpkg.com/plyr@3/dist/plyr.css">
    <link rel="stylesheet" href="/assets/css/plugins/select2.min.css">
    <link rel="stylesheet" href="/assets/css/plugins/trumbowyg.min.css">
    <link rel="stylesheet" href="/assets/css/plugins/trumbowyg.table.min.css">
    <link rel="stylesheet" href="/assets/css/plugins/trumbowyg.colors.min.css">
    <link rel="stylesheet" href="/assets/css/plugins/dropzone.min.css">
    <link rel="stylesheet" href="/assets/css/plugins/bootstrap-editable.css">
    @yield('bcss')
    <link rel="stylesheet" href="/assets/css/style.css">
    @yield('css')
    <!-- Styles -->
</head>

<body>
    <div id="app">
        @include('layouts.navbar')

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <script src="https://code.iconify.design/2/2.1.1/iconify.min.js"></script>
    <script src="/assets/js/vendor-all.min.js"></script>
    <script src="/assets/js/plugins/bootstrap.min.js"></script>
    <script src="/assets/js/pcoded.min.js"></script>
    <script src="/assets/js/ajax.js"></script>
    <script src="/assets/js/webcam.js"></script>
    <script src="/assets/js/qrcode.js"></script>
    <script src="/assets/js/plugins/jquery.blockUI.js"></script>
    <script src="/assets/js/plugins/jquery.dataTables.min.js"></script>
    <script src="/assets/js/plugins/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/js/plugins/bootstrap-notify.min.js"></script>
    <script src="/assets/js/plugins/sweetalert.min.js"></script>
    <script src="/assets/js/plugins/moment.js"></script>
    <script src="/assets/js/plugins/bootstrap-datetimepicker.js"></script>
    <script src="/assets/js/plugins/jquery.magnific-popup.min.js"></script>
    <script src="/assets/js/plugins/select2.full.min.js"></script>
    <script src="/assets/js/plugins/lazyload/lazyload.min.js"></script>
    <script
        src="https://cdn.polyfill.io/v2/polyfill.min.js?features=es6,Array.prototype.includes,CustomEvent,Object.entries,Object.values,URL">
    </script>
    <script src="https://unpkg.com/plyr@3"></script>

    <script>
        feather.replace();
    </script>
    @yield('js')
</body>

</html>
