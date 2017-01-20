@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Cardiovascular Research</div>

                <div class="panel-body">
                    <h3>Colonies</h3>

                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Colony Name</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($colonies as $colony)
                            <tr>
                                <td>
                                    <a href="{{ action( 'ColonyController@show', ['id' => $colony->id]) }}">
                                        {{$colony->name}}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <a href="{{ action( 'ColonyController@index') }}">
                        Manage Colonies
                    </a>

                    <h3>Storage</h3>

                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Storage Location</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($storages as $storage)
                            <tr>
                                <td>
                                    <a href="{{ action( 'StorageController@show', ['id' => $storage->id]) }}">
                                        {{$storage->type}} (Type should be changed from boolean to string
                                        to represent freezer type(freezer 1, freezer 2, Histology)
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <a href="{{ action( 'StorageController@index') }}">
                        Manage Storage Locations
                    </a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
