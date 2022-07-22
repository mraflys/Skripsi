@extends('layouts.app')
@section('css')
    <style type="text/css">
        #results {
            width: 760;
            height: 440;
            background: rgb(255, 255, 255);
        }
        @media only screen and (max-width : 750px) {
            #results {
                width: 260;
                height: 171;
                background: rgb(255, 255, 255);
            }
        }

        @media only screen and (max-width : 900px) {
            #results {
                width: 360;
                height: 237;
                background: rgb(255, 255, 255);
            }
        }

    </style>
@endsection
@section('content')
    <div class="container">
        @if(Auth::user()->role != 'administrator')
            <div class="card">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <h6>{{ session('success') }}</h6>
                    </div>
                @endif
                @if (session('message_error'))
                    <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <h6>{{ session('message_error') }}</h6>
                    </div>
                @endif
                <div class="card-header">
                    <h3>Absent</h3><br>
                    <b>Ambil Gambar Untuk Absent</b>
                    <br>
                    <p>Paskan Wajah dengan Kamera</p>
                </div>
                
                <div class="card-body m-3">
                    <form method="POST" action="{{ route('webcam.capture.absent') }}">
                        <input hidden name="latitude" id="latitude">
                        <input hidden name="longitude" id="longitude">
                        @csrf
                        <div class="container text-center">
                            <div id="my_camera" class="container text-center">

                            </div>
                            <div class="container text-center pb-2">
                                <div id="results" class="mb-5" style="display: none"></div>
                            </div>
                            <br>
                            <br>
                            <div class="position-relative">
                                <div class="d-flex mx-auto position-absolute top-50 start-50 translate-middle gap-3">
                                    <button type=button id="take" class="btn btn-secondary" onClick="take_snapshot()"><i class="feather icon-camera"></i> Take Snapshot</button>
                                    <button type=button id="re-take" class="btn btn-secondary" style="display: none" onClick="re_take()"><i class="feather icon-camera"></i> Retake Snapshot</button>
                                    <input type="hidden" name="image" class="image-tag">
                                    <button id="submit" class="btn btn-success" style="display: none">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3>Table Absent User</h3>
            </div>
            <div class="card-body m-3">
                <table id="myTable" class="table bg-light table-bordered nowrap">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
        @if(Auth::user()->role == 'administrator')
            <div class="card">
                <div class="card-header">
                    <h3>Table Absent User Perperiode</h3>
                </div>
                <div class="card-body m-3">
                    <table id="myTablePeriod" class="table bg-light table-bordered nowrap">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Tanggal</th>
                                <th>Jumlah Keluar</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection


@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous">
    </script>
    <script>
        const x = window.matchMedia("(max-width: 750px)");
        const y = window.matchMedia("(max-width: 900px)");
        var wh = 760;
        var cwch = 500;
        if (x.matches) {
            var wh = 260;
            var cwch = 171;
        }else if (y.matches) {
            var wh = 360;
            var cwch = 237;
        }
    </script>
    @if(Auth::user()->role != 'administrator')
        <script>
            Webcam.set({
                video: true,
                facingMode: "environment",
                enable_flash: true,
                width: wh,
                height: cwch,
                crop_width: wh,
                crop_height: cwch,
                
                image_format: 'jpg',
                jpeg_quality: 600
            });

            Webcam.attach('#my_camera');
        </script>
    @endif

    @if(Auth::user()->role == 'administrator')
        <script>
            $(document).ready(function() {
                ajaxDataTable('{!! route('absent-history-period') !!}',
                    [{
                            data: 'user.name',
                            name: 'user.name'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            className: 'text-center'
                        },
                    ], 'myTablePeriod', true, false, false, false, true
                );

            });
        </script>
    @endif
    
    <script>

        function take_snapshot() {
            Webcam.snap(function(data_uri) {
                console.log(data_uri);
                $(".image-tag").val(data_uri);
                document.getElementById('results').innerHTML = '<img style="width: 100%;height: '+cwch+'px;" src="' + data_uri + '"/>';
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
            if (navigator.geolocation) {
                navigator.geolocation.watchPosition(showPosition);
            } else { 
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
            ajaxDataTable('{!! route('absent-history') !!}',
                [{
                        data: 'user.name',
                        name: 'user.name'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    },
                ], 'myTable', true, false, false, false, true
            );

        });

    </script>
@endsection
