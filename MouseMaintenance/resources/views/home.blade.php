@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">

            <h1 class="row-centered"> Laboratory Mouse Tracker</h1>

            <div class="half">
                <div class="panel panel-default whole">
                    <div class="panel-heading"><a href="{{ url('/colonies') }}"><h3>Colonies</h3></a></div>
                    <div class="panel-body">

                        @foreach ($colonies as $colony)
                            @if($colony->active)
                                <a class="btn btn-lg btn-block"
                                   href="{{ action( 'ColonyController@show', ['id' => $colony->id]) }}" role="button">
                                    {{$colony->name}}
                                </a>
                            @endif
                        @endforeach

                    </div>
                </div>

                <div class="panel panel-default whole">
                    <div class="panel-heading"><a href="{{ url('/surgeries') }}"><h3>Surgeries</h3></a></div>
                    <div class="panel-body">

                        @foreach ($surgeries as $surgery)
                            <a class="btn btn-lg btn-block" href="{{ action( 'SurgeryController@show', ['id' => $surgery->id]) }}" role="button">
                                {{ $surgery->title }}
                            </a>
                        @endforeach

                    </div>
                </div>
            </div>

            <div class="panel panel-default half last">
                <div class="panel-heading"><a href="{{ url('/storages') }}"><h3>Storage</h3></a></div>
                <div class="panel-body">

                    @foreach ($storages as $storage)
                        <a class="btn btn-lg btn-block" href="{{ action( 'StorageController@show', ['id' => $storage->id]) }}" role="button">
                            @if($storage->type == 1)
                                (-80&deg;C) Freezer #{{$storage->freezer}}
                                Comp. #{{$storage->compartment}}
                                Shelf #{{$storage->shelf}}
                            @endif
                        </a>
                    @endforeach

                </div>
            </div>


        </div>
    </div>
@endsection
