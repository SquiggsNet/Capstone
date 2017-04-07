@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Application</h1>

        <div class="row">

            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Cage Management</div>

                    <div class="panel-body">
                        <li><a href="{{ action( 'CageController@create') }}">
                            Add a new Cage
                        </a></li>
                    </div>
                </div>
            </div>

            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Colony Management</div>

                    <div class="panel-body">
                        <li><a href="{{ action( 'ColonyController@create') }}">
                            Add a new Colony
                        </a></li>
                    </div>
                </div>
            </div>

            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Storage Facility Management</div>

                    <div class="panel-body">
                        <a href="{{ action( 'StorageController@create') }}">
                            Add a new Storage Facility (Freezer?)
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">User Management</div>
                    <div class="panel-body">
                        <table class="table table-bordered table-striped" id="mice_table" data-toggle="table" >
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>ID No.</th>
                                    <th>Phone No.</th>
                                    <th>E-Mail</th>
                                    <th>Administrator</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->getFullName() }}</td>
                                        <td>{{ $user->student_id }}</td>
                                        <td>{{ $user->formatPhone() }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if($user->admin)
                                                Yes
                                            @else
                                                No
                                            @endif
                                        </td>
                                        <td>
                                            {{ Form::open(['action' => ['UserController@edit', $user], 'method' => 'get']) }}
                                            <button type="submit" >
                                                <span class="glyphicon glyphicon-pencil"></span>
                                            </button>
                                            {{ Form::close() }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <a class="btn btn-default" href="{{ action( 'UserController@create') }}">
                            Add a new User
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection