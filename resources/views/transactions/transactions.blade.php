@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card p-3">
            <div>
                <a href='{{ route('transactions.new') }}' class='btn btn-outline-primary text-primary' title='Add Data'><i
                        data-feather="plus-circle"></i>

                    Add Data</a>
            </div>
            <table id="myTable" class="table bg-light table-bordered nowrap">
                <thead>
                    <tr>
                        <th>Id Transactions</th>
                        <th>City</th>
                        <th>Code Area</th>
                        <th>Nominal</th>
                        <th>Description</th>
                        <th>Action</th>
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
            $.ajax({
                url: '{!! route('transactions.datatable') !!}',
                type: 'get',
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                },
                error: function(data) {

                }
            });
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
