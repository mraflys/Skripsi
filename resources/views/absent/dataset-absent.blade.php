{{--  --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/styleEmil.css">
    <title>Capture Dataset</title>
</head>
<body>
    <div class="login-regis">
        <div class="logo-login-regis">
            <h1>JKI</h1>
        </div>

        <form method="POST" action="{{ route('webcam.capture') }}">
            @csrf
            <input type="text" hidden value="{{$id}}" name="id">
            <div class="form-login-regis">
                <h1>Capture Dataset</h1>
                <div class="caution">
                    <p>Capture Dataset <span>{{(count($faceDataset)+1)}}</span>/5</p>
                    <p>Perhatikan 
                        @if(count($faceDataset) == 0)
                            <span>Ambil Gambar Tanpa Ekspresi</span>
                        @elseif(count($faceDataset) == 1)
                            <span>Ambil Gambar Senyum</span>
                        @elseif(count($faceDataset) == 2)
                            <span>Ambil Gambar mangap</span>
                        @elseif(count($faceDataset) == 3)
                            <span>Ambil Gambar Tutup Mata</span>
                        @elseif(count($faceDataset) == 4)
                            <span>Ambil Gambar kerutkan jidat</span>
                        @endif
                    </p>
                </div>
                <div class="group-capture">
                    <div class="camera" id="my_camera"></div>
                    <div id="results" class="camera" style="display: none"></div>
                    <div class="group-button-info">
                        <button type="button" class="submit-next-button" id="take" onClick="take_snapshot()"><i class="las la-camera"></i> Take</button>
                        <button type="button" class="retake-button" id="re-take" onClick="re_take()" style="display: none"><i class="las la-camera"></i> Retake</button>
                        <input type="hidden" name="image" class="image-tag">
                        <button id="submit" class="submit-next-button" style="display: none">Submit</button>
                    </div>
                </div>
                <div class="group-button-info">
                    <p class="note">Note :  Pastikan data yang dimasukan adalah benar dan tidak ada keraguan, langkah selanjutnya adalah penambahan dataset wajah anda</p>
                </div>
                <div class="step">
                    <h2>Step</h2>
                    <a href="#" class="steps">1</a>
                    <a href="#" class="steps active">2</a>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous">
        <script src="/assets/js/ajax.js"></script>
    </script>
    <script src="/assets/js/webcam.js"></script>
    <script>
        // const x = window.matchMedia("(max-width: 750px)");
        // const y = window.matchMedia("(max-width: 900px)");
        // var wh = 760;
        // var cwch = 500;
        // if (x.matches) {
        //     var wh = 260;
        //     var cwch = 171;
        // }else if (y.matches) {
        //     var wh = 360;
        //     var cwch = 237;
        // }
        const x = window.matchMedia("(max-width: 750px)");
        let box = document.querySelector('.camera');
        let width = box.offsetWidth;
        let height = box.offsetHeight;
        let pluswid = 200;
        let plushei = 200;
        if(wid == null){
        wid = width;
        hei = height;
        if (x.matches) {
            pluswid = 220;
            plushei = 10;
            }
        }
        Webcam.set({
            video: true,
            facingMode: "environment",
            enable_flash: true,
            width: wid+pluswid,
            height: hei+plushei,
            crop_width: wid,
            crop_height: hei,
            
            image_format: 'jpg',
            jpeg_quality: 600
        });

        Webcam.attach('#my_camera');

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
    </script>
</body>
</html>
