@extends('layouts.app')
@section('content')
    <h1>Daftar Absen Pengguna</h1>
    <div class="info-stats">
        <div class="info">
            <h2>{{App\User::count()}}</h2>
            <h3>Total Pengguna</h3>
        </div>
        <div class="info">
            <h2>{{App\User::where('role','user')->count()}}</h2>
            <h3>Jumlah User</h3>
        </div>
        <div class="info">
            <h2>{{App\User::where('role','administrator')->count()}}</h2>
            <h3>Jumlah Admin</h3>
        </div>
    </div>
    <div class="tables-main">
        <h2 style="padding-bottom: 1rem">Table Absensi Semua Karyawan</h2>
        <div style="padding-bottom: 1rem">
            <a href="{{ route('absent-history-excel')}} " class="retake-button"><i class="las la-download"></i> Download Excel</a>
        </div>
        <div class="group-form">
            <input class="table-filter" onkeyup="searchTable()" data-table="myTable" type="text" id="search" placeholder="Pencarian Nama Karyawan">
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
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous">
    </script>
    
    <script>

        function person_list(){
            $.ajax({
                type: 'GET',
                url: '{!! route('absent-history') !!}',
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
            person_list();

        } );
    </script>
@endsection
