@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row">

            <div class="panel panel-default quarter">
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

            <div class="quarter-x3 last">
                <div class="panel panel-default half">
                    <div class="panel-heading"><a href="{{ url('/colonies') }}"><h3>Colonies</h3></a></div>
                    <div class="panel-body">

                        @foreach ($colonies as $colony)
                            <a class="btn btn-lg btn-block" href="{{ action( 'ColonyController@show', ['id' => $colony->id]) }}" role="button">
                                {{$colony->name}}
                            </a>
                        @endforeach

                    </div>
                </div>

                <div class="panel panel-default half last">
                    <div class="panel-heading"><a href="{{ url('/surgeries') }}"><h3>Surgeries</h3></a></div>
                    <div class="panel-body">

                        @foreach ($storages as $storage)
                            <a class="btn btn-lg btn-block" href="{{ action( 'SurgeryController@show', ['id' => $storage->id]) }}" role="button">
                                (Current Surgeries)
                            </a>
                        @endforeach

                    </div>
                </div>

                <div class="panel panel-default half">
                    <div class="panel-heading"><a href="{{ url('/storages') }}"><h3>Storage</h3></a></div>
                    <div class="panel-body">

                        @foreach ($storages as $storage)
                            <a class="btn btn-lg btn-block" href="{{ action( 'StorageController@show', ['id' => $storage->id]) }}" role="button">
                                (-80&deg;C Freezer)
                            </a>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>


    {{--<div class="container">--}}
        {{--<div class="row">--}}

            {{--<div class="panel panel-default half">--}}
                {{--<div class="panel-heading"><a href="{{ url('/colonies') }}"><h3>Colonies</h3></a></div>--}}
                {{--<div class="panel-body">--}}

                    {{--@foreach ($colonies as $colony)--}}
                        {{--<a class="btn btn-lg btn-block" href="{{ action( 'ColonyController@show', ['id' => $colony->id]) }}" role="button">--}}
                            {{--{{$colony->name}}--}}
                        {{--</a>--}}
                    {{--@endforeach--}}

                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="panel panel-default half last">--}}
                {{--<div class="panel-heading"><a href="{{ url('/surgeries') }}"><h3>Surgeries</h3></a></div>--}}
                {{--<div class="panel-body">--}}

                    {{--@foreach ($storages as $storage)--}}
                        {{--<a class="btn btn-lg btn-block" href="{{ action( 'SurgeryController@show', ['id' => $storage->id]) }}" role="button">--}}
                            {{--(Current Surgeries)--}}
                        {{--</a>--}}
                    {{--@endforeach--}}

                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="panel panel-default half">--}}
                {{--<div class="panel-heading"><a href="{{ url('/storages') }}"><h3>Storage</h3></a></div>--}}
                {{--<div class="panel-body">--}}

                    {{--@foreach ($storages as $storage)--}}
                        {{--<a class="btn btn-lg btn-block" href="{{ action( 'StorageController@show', ['id' => $storage->id]) }}" role="button">--}}
                            {{--(-80&deg;C Freezer)--}}
                        {{--</a>--}}
                    {{--@endforeach--}}

                {{--</div>--}}
            {{--</div>--}}

        {{--</div>--}}
    {{--</div>--}}
@endsection
