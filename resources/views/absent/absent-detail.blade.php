@extends('layouts.app')
@section('css')
<style type="text/css">

</style>
@endsection
@section('content')
    <div class="container" >

        <div class="card" style="overflow-x : scroll">
            <div class="card-header">
                <h3>Absent</h3>
            </div>
            
            <div class="card-body m-3 w-100">
                <input hidden name="latitude" id="latitude" value="{{$Absent->latitude}}">
                <input hidden name="longitude" id="longitude" value="{{$Absent->longitude}}">
                <div class="d-flex flex-row bd-highlight mb-3 w-100 container">
                    <div class="m-3">
                        <h4>Foto Absent</h4>
                        <div class="w-100">

                            <img src="{{asset('storage/'.$Absent->url_img)}}" style="width: 526px; height: 311px;">

                        </div>
                    </div>
                    <div class="m-3">
                        <h4>Detail</h4>
                        <div class="mb-3" style="width: 600px">
                            <label for="" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" disabled value="{{$Absent->user->name}}">
                        </div>
                        <div class="mb-3" style="width: 600px">
                            <label for="" class="form-label">Waktu Absen</label>
                            <input type="text" class="form-control" id="name" disabled value="{{$Absent->created_at}}">
                        </div>
                        <div class="mb-3" style="width: 600px">
                            <label for="" class="form-label">Status</label>
                            <input type="text" class="form-control" id="name" disabled 
                            @if($Absent->status == true)
                                value="Berhasil"
                            @else
                                value="Tidak Berhasil"
                            @endif>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Location</label>
                            <div style="width: 100%; height: 500px;">
                                {!! Mapper::render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@endsection


@section('js')
    <!-- Replace the value of the key parameter with your own API key. -->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous">
    </script>

    <script>

    </script>
@endsection
