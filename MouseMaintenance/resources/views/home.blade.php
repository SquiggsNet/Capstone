@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="user quarter">
        {{--<div class="third">--}}
            <div class="panel panel-default">
                <div class="panel-heading"><h4>{{ Auth::user()->getFullName() }}</h4></div>

                <div class="panel-body">

                    <h4>User Info</h4>

                    <p>A general info for user</p>

                    <h4>Surgeries</h4>

                    <ul>
                        <li>Surgery 1</li>
                        <li>Surgery 2</li>
                        <li>Surgery 3</li>
                    </ul>

                    <p>A general info for user</p>

                    <h4>User Info</h4>

                    <p>A general info for user</p>
                </div>
            </div>
        </div>




        {{--<div class="third-x2">--}}
        <div class="content last quarter-x3">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Cardiovascular Research - Home</h3></div>

                <div class="panel-body">
                    <div class="whole">

                        <a href="{{ url('/colonies') }}"><h4>Colonies</h4></a>

                        <?php $count = 1; ?>
                        @foreach ($colonies as $colony)

                            @if($count%4 == 0)
                                <a class="btn btn-primary btn-lg quarter last colonyBtn" href="{{ action( 'ColonyController@show', ['id' => $colony->id]) }}" role="button">
                            @else
                                <a class="btn btn-primary btn-lg quarter colonyBtn" href="{{ action( 'ColonyController@show', ['id' => $colony->id]) }}" role="button">
                            @endif

                            {{--<a class="btn btn-primary btn-lg btn-block" href="{{ action( 'ColonyController@show', ['id' => $colony->id]) }}" role="button">--}}
                                <span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span> {{$colony->name}}
                            </a>

                            <?php $count ++; ?>
                        @endforeach

                    </div>
                    <div class="whole">

                        <a href="{{ url('/storages') }}"><h3>Storage</h3></a>

                        @foreach ($storages as $storage)

                            <a class="btn btn-primary btn-lg btn-block" href="{{ action( 'StorageController@show', ['id' => $storage->id]) }}" role="button">
                                {{--<a class="btn btn-primary btn-lg quarter colonyBtn" href="{{ action( 'ColonyController@show', ['id' => $colony->id]) }}" role="button">--}}
                                <span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span> (-80&deg;C Freezer)
                            </a>

                        @endforeach

                    </div>

                    <div class="whole">
                        <a href="{{ url('/surgeries') }}"><h3>Surgeries</h3></a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
