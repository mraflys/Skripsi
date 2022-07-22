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

        <div class="card">
            <div class="card-header">
                <h3>Dataset Absent</h3><br>
                @if(count($faceDataset) == 0)
                    <b>Ambil Gambar Tanpa Ekspresi</b>
                @elseif(count($faceDataset) == 1)
                    <b>Ambil Gambar Senyum</b>
                @elseif(count($faceDataset) == 2)
                    <b>Ambil Gambar mangap</b>
                @elseif(count($faceDataset) == 3)
                    <b>Ambil Gambar Tutup Mata</b>
                @elseif(count($faceDataset) == 4)
                    <b>Ambil Gambar kerutkan jidat</b>
                @endif
                <br>
                <p>Paskan Wajah dengan Kamera</p>
            </div>
            <div class="pl-4">
                
            </div>
            
            <div class="card-body m-3">
                <form method="POST" action="{{ route('webcam.capture') }}">
                    @csrf
                    <input type="text" hidden value="{{$id}}" name="id">
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

        function take_snapshot() {
            Webcam.snap(function(data_uri) {
                console.log(data_uri);
                $(".image-tag").val(data_uri);
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
    </script>
@endsection
