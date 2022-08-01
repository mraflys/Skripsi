@extends('layouts.app')
@section('css')
<style type="text/css">

</style>
@endsection
@section('content')
    <h1>Absent, Tanggal {{Carbon\Carbon::parse($Absent->created_at)->format("d-M-Y")}}</h1>
    <input hidden name="latitude" id="latitude" value="{{$Absent->latitude}}">
    <input hidden name="longitude" id="longitude" value="{{$Absent->longitude}}">
    <div class="detail-absen">
        <div class="image-absen"><img src="{{asset('storage/'.$Absent->url_img)}}" style="width: 100%; height: 100%;object-fit: cover;"></div>
        <div class="location-absen">
            {!! Mapper::render() !!}
        </div>
    </div>
    <h3>Detail</h3>
    <div class="tables-main">
        <table>
            <thead>
                <tr class="head">
                    <th>
                        <div>Nama</div>
                    </th>
                    <th>
                        <div>Tanggal</div>
                    </th>
                    <th>
                        <div>Jam</div>
                    </th>
                    <th>
                        <div>Status</div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="list">
                    <td>
                        <div>{{$Absent->user->name}}</div>
                    </td>
                    <td>
                        <div>{{Carbon\Carbon::parse($Absent->created_at)->format("d-M-Y")}}</div>
                    </td>
                    <td>
                        <div>{{Carbon\Carbon::parse($Absent->created_at)->format("H:s")}}</div>
                    </td>
                    @if($Absent->status == true)
                        <td>
                            <div>Berhasil</div>
                        </td>
                    @else
                        <td>
                            <div>Tidak Berhasil</div>
                        </td>
                    @endif>
                </tr>
            </tbody>
        </table>
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
