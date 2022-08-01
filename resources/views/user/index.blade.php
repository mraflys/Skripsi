@extends('layouts.app')
@section('content')
    <h1>Daftar Pengguna</h1>
    <div class="info-stats">
        <div class="info">
            <h2>{{App\User::count()}}</h2>
            <h3>Total User</h3>
        </div>
        <div class="info">
            <h2>{{App\User::where('is_active',true)->count()}}</h2>
            <h3>Jumlah User Aktif</h3>
        </div>
        <div class="info">
            <h2>{{App\User::where('is_active',false)->count()}}</h2>
            <h3>Jumlah User Tidak Aktif</h3>
        </div>
    </div>
    <div class="tables-main">
        <h2 style="padding-bottom: 1rem">Table verifikasi User</h2>
        <div style="padding-bottom: 1rem">
            <a href="{{ route('user-excel')}} " class="retake-button"><i class="las la-download"></i> Download Excel</a>
        </div>
        <div class="group-form">
            <input class="table-filter" onkeyup="searchTable()" data-table="myTable" type="text" id="search" placeholder="Pencarian Nama User">
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
                        <div>Email</div>
                    </th>
                    <th>
                        <div>Username</div>
                    </th>
                    <th>
                        <div>Role</div>
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
                url: '{!! route('user-table') !!}',
                success: function(data) {
                console.log(data);
                const dataLength = data.length;
                var html = '';
                for(let dataStart = 0; dataStart < dataLength; dataStart++){
                    console.log();
                    html += '<tr class="list"><td><div>'+(dataStart+1)+'</div></td><td><div>'+data[dataStart].name+'</div></td><td><div>'+data[dataStart].email+'</div></td><td><div>'+data[dataStart].username+'</div></td><td><div>'+data[dataStart].role+'</div></td><td><div>'+data[dataStart].action+'</div></td></tr>';
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
        $(document).ready(function() {
            person_list();
        });

    </script>
@endsection
