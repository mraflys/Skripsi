@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card p-3">
            @if ($massage = Session::get('message_reject'))
                <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <h6>{{$massage}}</h6>
                </div>
            @endif
            @if ($massage = Session::get('message_aprove'))
                <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <h6>{{$massage}}</h6>
                </div>
            @endif
            {{-- <div>
                <a href='{{ route('transactions.new') }}' class='btn btn-outline-primary text-primary' title='Add Data'><i
                        data-feather="plus-circle"></i>

                    Add Data</a>
            </div> --}}
            <h3>Table Transaction</h3>
            <table id="myTable" class="table bg-light table-bordered nowrap">
                <thead>
                    <tr>
                        <th>Id Transactions</th>
                        <th>City</th>
                        <th>Code Area</th>
                        <th>Nominal</th>
                        <th>Request By</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        <div class="card p-3">
            <h3>Table Transaction History</h3>
            <table id="myTableHistory" class="table bg-light table-bordered nowrap">
                <thead>
                    <tr>
                        <th>Id Transactions</th>
                        <th>City</th>
                        <th>Code Area</th>
                        <th>Nominal</th>
                        <th>Request By</th>
                        <th>Description</th>
                        <th>Aprove By</th>
                        <th>Aprove At</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            // $.ajax({
            //     url: '{!! route('transactions.datatable') !!}',
            //     type: 'get',
            //     dataType: 'json',
            //     success: function(data) {
            //         console.log(data);
            //     },
            //     error: function(data) {

            //     }
            // });
            ajaxDataTable('{!! route('transactions.datatable.history') !!}',
                [{
                        data: 'id_transactions',
                        name: 'id_transactions'
                    },
                    {
                        data: 'city',
                        name: 'city'
                    },
                    {
                        data: 'code_area',
                        name: 'code_area'
                    },
                    {
                        data: 'nominal',
                        name: 'nominal'
                    },
                    {
                        data: 'request_By',
                        name: 'request_By'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'reviewed_by',
                        name: 'reviewed_by'
                    },
                    {
                        data: 'reviewed_at',
                        name: 'reviewed_at'
                    },
                    
                ], 'myTableHistory', true, false, false, false, true
            );
            ajaxDataTable('{!! route('transactions.datatable') !!}',
                [{
                        data: 'id_transactions',
                        name: 'id_transactions'
                    },
                    {
                        data: 'city',
                        name: 'city'
                    },
                    {
                        data: 'code_area',
                        name: 'code_area'
                    },
                    {
                        data: 'nominal',
                        name: 'nominal'
                    },
                    {
                        data: 'request_By',
                        name: 'request_By'
                    },
                    {
                        data: 'description',
                        name: 'description'
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
