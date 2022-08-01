@extends('layouts.app')

@section('content')
    <h1>Hi, <span>{{Auth::user()->name}}</span> Welcome to JKI</h1>
    @if(Auth::user()->role == 'administrator')
        <div class="info-stats">
            <div class="info">
                <h2>{{App\Model\Absent::count()}}</h2>
                <h3>Jumlah Absen</h3>
            </div>
            <div class="info">
                <h2>{{round((App\Model\Absent::count()/2)-0.5)}}</h2>
                <h3>Jumlah Kehadiran</h3>
            </div>
            <div class="info">
                <h2>{{App\User::count()}}</h2>
                <h3>Jumlah Karyawan</h3>
            </div>
        </div>
        <div class="chart-container">
            <div id="columnchart_values"></div>
        </div>
        <div class="tables-main">
            <h2 style="padding-bottom: 1rem">Table User Periode Lapangan</h2>
            <div style="padding-bottom: 1rem">
                <a href="{{ route('absent.periode.excels')}} " class="retake-button"><i class="feather icon-camera"></i> Download Excel</a>
            </div>
            <div class="group-form">
                <input class="table-filter" onkeyup="searchTable()" data-table="myTable" type="text" id="search" placeholder="Pencarian Tanggal">
            </div>
            <table id="myTable">
                <thead>
                    <tr class="head">
                        <th>
                            <div>No</div>
                        </th>
                        <th>
                            <div>Tanggal Absen</div>
                        </th>
                        <th>
                            <div>Periode</div>
                        </th>
                    </tr>
                </thead>
                <tbody id="bodytable">

                </tbody>
            </table>
        </div>
    @else
        <div class="info-stats">
            <div class="info">
                <h2>{{App\Model\Absent::where('id_user',Auth::user()->id)->count()}}</h2>
                <h3>Jumlah Absen</h3>
            </div>
            <div class="info">
                <h2>@if(round((App\Model\Absent::where('id_user',Auth::user()->id)->count()/2)-0.5)<=0)
                        0
                     @else
                        {{round((App\Model\Absent::where('id_user',Auth::user()->id)->count()/2)-0.5)}}
                    @endif
                </h2>
                <h3>Jumlah Kehadiran</h3>
            </div>
        </div>
        <div class="tables-main">
            <h2 style="padding-bottom: 1rem">Table Absensi Saya</h2>
            <div style="padding-bottom: 1rem">
                <a href="{{ route('absent.periode.excels')}} " class="retake-button"><i class="las la-download"></i> Download Excel</a>
            </div>
            <div class="group-form">
                <input class="table-filter" onkeyup="searchTable()" data-table="myTable" type="text" id="search" placeholder="Pencarian Tanggal">
            </div>
            <table id="myTable">
                <thead>
                    <tr class="head">
                        <th>
                            <div>No</div>
                        </th>
                        <th>
                            <div>Nama</div>
                        </th>
                        <th>
                            <div>Status</div>
                        </th>
                        <th>
                            <div>Tanggal</div>
                        </th>
                        <th>
                            <div>Jam</div>
                        </th>
                        <th>
                            <div>Action</div>
                        </th>
                    </tr>
                </thead>
                <tbody id="bodytable">

                </tbody>
            </table>
        </div>
    @endif
@endsection
@section('js')
@if(Auth::user()->role == 'administrator')
    <script>
        const arraydata = [];
        google.charts.load("current", {packages:['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            $.ajax({
                method: "GET",
                url: '{!! route('absent.periode') !!}',
                success: function(value) {
                    // console.log(value.data);
                    var data = google.visualization.arrayToDataTable(value.data);   
                    var view = new google.visualization.DataView(data);
                    view.setColumns([0, 1,
                                    { calc: "stringify",
                                        sourceColumn: 1,
                                        type: "string",
                                        role: "annotation" },
                                    2]);
                    var options = {
                    title: "User Absen Periode ",
                    width: 1500,
                    height: 800,
                    position: "50%",
                    bar: {groupWidth: "60%"},
                    legend: { position: "none" },
                    };
                    var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
                    chart.draw(view, options);
                    // arraydata.push(["tanggal", "Periode", { role: "style" } ]);
                    // console.log(arraydata);
                },
                error: function(value) {
                    if (value.status == 419) {
                        window.location.reload()
                    } else {
                        alert('error');
                    }
                },
            });
            // let arraycoba;
            // arraycoba = arraydata[0];
            // console.log(arraydata);
            // console.log(arraydata);
        }
        function person_list(){
        $.ajax({
            type: 'GET',
            url: '{!! route('absent.periode.table') !!}',
            success: function(data) {
                
            const dataLength = data.length;
            var html = '';
            for(let dataStart = 0; dataStart < dataLength; dataStart++){
                console.log();
                html += '<tr class="list"><td><div>'+(dataStart+1)+'</div></td><td><div>'+data[dataStart].date+'</div></td><td><div>'+data[dataStart].date+'</div></td></tr>';
            }
            $('#bodytable').html(html);
            },
            error: function(data) {

            }
        });
        
        }
        
        function showTable(){
            person_list();
        }
        function searchTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("search");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
                }       
            }
        }
        
        $(document).ready( function () {
            showTable();

        } );

    </script>
@else
    <script>
        function person_list(){
            $.ajax({
                type: 'GET',
                url: '{!! route('absent.periode.table') !!}',
                success: function(data) {
                console.log(data);
                const dataLength = data.length;
                var html = '';
                for(let dataStart = 0; dataStart < dataLength; dataStart++){
                    console.log();
                    html += '<tr class="list"><td><div>'+(dataStart+1)+'</div></td><td><div>'+data[dataStart].name+'</div></td><td><div>'+data[dataStart].status+'</div></td><td><div>'+data[dataStart].tanggal+'</div></td><td><div>'+data[dataStart].jam+'</div></td><td><div><a href="'+data[dataStart].url+'" class="detail-active">Detail</a></div></td></tr>';
                }
                $('#bodytable').html(html);
                },
                error: function(data) {

                }
            });
        }
        function showTable(){
            person_list();
        }
        function searchTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("search");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[3];
                if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
                }       
            }
        }
        $(document).ready( function () {
            showTable();

        } );
    </script>
@endif
@endsection
