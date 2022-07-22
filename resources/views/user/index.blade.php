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
            @if (!is_null(session('message_error')))
                <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <h6>{{ session('message_error') }}</h6>
                </div>
            @endif
            @if (session('message_success'))
                <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <h6>{{ session('message_success') }}</h6>

                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card-header">
                <h3>Table User</h3>
            </div>
            <div class="card-body m-3">
                <table id="myTable" class="table bg-light table-bordered nowrap">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous">
    </script>
    
    <script>

        $(document).ready(function() {
            ajaxDataTable('{!! route('user-table') !!}',
                [{
                        data: 'name',
                        name: 'Name'
                    },
                    {
                        data: 'email',
                        name: 'Email'
                    },
                    {
                        data: 'username',
                        name: 'Username'
                    },
                    {
                        data: 'role',
                        name: 'Role'
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
