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
                        {{--<a class="btn btn-primary btn-lg quarter colonyBtn" href="{{ action( 'ColonyController@show', ['id' => $colony->id]) }}" role="button">--}}
                            <span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span> {{$colony->name}}
                        </a>

                    @endforeach

                    <a href="{{ url('/storages') }}"><h3>Storage</h3></a>

                    @foreach ($storages as $storage)

                        <a class="btn btn-primary btn-lg btn-block" href="{{ action( 'StorageController@show', ['id' => $storage->id]) }}" role="button">
                            {{--<a class="btn btn-primary btn-lg quarter colonyBtn" href="{{ action( 'ColonyController@show', ['id' => $colony->id]) }}" role="button">--}}
                            <span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span> (Type should be changed from boolean to string
                            to represent freezer type(freezer 1, freezer 2, Histology)
                        </a>

                    @endforeach

                    <a href="{{ url('/surgeries') }}"><h3>Surgeries</h3></a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
