@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Cardiovascular Research</div>

                <div class="panel-body">
                    <a href="{{ url('/colonies') }}"><h3>Colonies</h3></a>

                    @foreach ($colonies as $colony)

                        <a class="btn btn-primary btn-lg btn-block" href="{{ action( 'ColonyController@show', ['id' => $colony->id]) }}" role="button">
                            <span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span> {{$colony->name}}
                        </a>

                    @endforeach

                    <a href="{{ url('/storages') }}"><h3>Storage</h3></a>

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

                    <a href="{{ url('/surgeries') }}"><h3>Surgeries</h3></a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
