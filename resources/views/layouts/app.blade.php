<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
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
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    @yield('bcss')
    <link rel="stylesheet" href="/assets/css/styleEmil.css">
    @yield('css')
    <!-- Styles -->
</head>

<body>
    <div class="dashboard">
        @include('layouts.navbar')
        <div class="main-content">
            <header>
                <div class="logo">JKI</div>
                <div class="search-container">
                    <form action="">
                        {{-- <div class="search-column">
                            <i class="las la-search"></i>
                            <input type="search" name="" id="" placeholder="Hari Absen">
                        </div> --}}
                        @if(Auth::user()->role != 'administrator')
                            <a href="#" class="absen" onclick="form_popup()">Absen</a>
                        @endif
                    </form>
                </div>
                <div class="user-profile">
                    <p>{{Auth::user()->name}}</p>
                    <div class="user-pict"><i class="las la-user"></i></div>
                </div>
            </header>
            <main>
                @if (!is_null(session('message_error')))
                    <div class="alert danger-alert">
                        <h3>{{ session('message_error') }}</h3>
                        <a class="close">&times;</a>
                    </div>
                @endif
                @if (session('message_success'))
                    <div class="alert success-alert">
                        <h3>{{ session('message_success') }}</h3>
                        <a class="close">&times;</a>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert success-alert">
                        @foreach ($errors->all() as $error)
                            <h3>{{ $error }}</h3><br>
                        @endforeach
                        <a class="close">&times;</a>
                    </div>
                @endif

                @yield('content')
            </main>
            <div id="form-absen" class="background-absen">
                <form method="POST" action="{{ route('webcam.capture.absent') }}">
                    <input hidden name="latitude" id="latitude">
                    <input hidden name="longitude" id="longitude">
                    @csrf
                    <div class="form-login-regis">
                        <h1>Absen</h1>
                        <p class="message-status-login">Capture Foto</p>
                        <div class="group-capture">
                            <div class="camera" id="my_camera"></div>
                            <div id="results" class="camera" style="display: none"></div>
                        </div>
                        <p class="note">Note :  Pastikan data yang dimasukan adalah benar dan tidak ada keraguan, langkah selanjutnya adalah penambahan dataset wajah anda</p>
                        <div class="group-button-info">
                            <button type="button" class="submit-next-button" id="take" onClick="take_snapshot()"><i class="las la-camera"></i> Take</button>
                            <button type="button" class="retake-button" id="re-take" onClick="re_take()" style="display: none"><i class="las la-camera"></i> Retake</button>
                            <input type="hidden" name="image" class="image-tag">
                            <button id="submit" class="submit-next-button" style="display: none">Submit</button>
                            <button type="button" class="cancel-button" onclick="close_form()">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
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
    <script src="/assets/js/indexEmil.js"></script>
    <script
        src="https://cdn.polyfill.io/v2/polyfill.min.js?features=es6,Array.prototype.includes,CustomEvent,Object.entries,Object.values,URL">
    </script>
    <script src="https://unpkg.com/plyr@3"></script>
    <script>

    </script>

    <script>
        feather.replace();
        function take_snapshot() {
            Webcam.snap(function(data_uri) {
                console.log(data_uri);
                document.querySelector('.image-tag').value = data_uri;
                document.getElementById('results').innerHTML = '<img src="' + data_uri + '"/>';
            });
            document.getElementById('my_camera').style.display = "none";
            document.getElementById('take').style.display = "none";
            document.getElementById('re-take').style.display = "block";
            document.getElementById('results').style.display = "block";
            document.getElementById('submit').style.display = "block";
        }
        function re_take() {
            document.getElementById('my_camera').style.display = "";
            document.getElementById('take').style.display = "";
            document.getElementById('re-take').style.display = "none";
            document.getElementById('results').style.display = "none";
            document.getElementById('submit').style.display = "none";
        }
        function showPosition(position) {
            document.getElementById('latitude').value = position.coords.latitude
            document.getElementById('longitude').value = position.coords.longitude

        }
        $(document).ready(function() {


        });
    </script>
    @yield('js')
</body>

</html>
