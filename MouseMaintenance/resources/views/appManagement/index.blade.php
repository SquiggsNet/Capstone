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
                        <li><a href="{{ action( 'StorageController@create') }}">
                            Add a new Storage Facility (Freezer?)
                        </a></li>
                    </div>
                </div>
            </div>

            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">User Management</div>

                    <div class="panel-body">
                        <li><a href="{{ action( 'UserController@create') }}">
                            Add a new User
                        </a></li>
                    </div>
                </div>
            </div>

            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">User Rights Management</div>

                    <div class="panel-body">
                        <li><a href="{{ action( 'PrivilegeController@create') }}">
                            Add a new Privilege
                        </a></li>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection