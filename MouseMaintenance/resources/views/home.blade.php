@extends('layouts.app')

@section('content')




        <div class="panel-body">
            <div class="whole">

                <a href="{{ url('/colonies') }}"><h4>Colonies</h4></a>

                <?php $count = 1; ?>
                @foreach ($colonies as $colony)

                    {{--@if($count%4 == 0)--}}
                        {{--<a class="btn btn-primary btn-lg quarter last colonyBtn" href="{{ action( 'ColonyController@show', ['id' => $colony->id]) }}" role="button">--}}
                    {{--@else--}}
                        {{--<a class="btn btn-primary btn-lg quarter colonyBtn" href="{{ action( 'ColonyController@show', ['id' => $colony->id]) }}" role="button">--}}
                    {{--@endif--}}

                    <a class="btn btn-primary btn-lg btn-block colonyBtn" href="{{ action( 'ColonyController@show', ['id' => $colony->id]) }}" role="button">
                        {{$colony->name}}
                    </a>

                    <?php $count ++; ?>
                @endforeach

            </div>
            <div class="whole">

                <a href="{{ url('/storages') }}"><h3>Storage</h3></a>

                @foreach ($storages as $storage)

                    <a class="btn btn-primary btn-lg btn-block storageBtn" href="{{ action( 'StorageController@show', ['id' => $storage->id]) }}" role="button">
                        {{--<a class="btn btn-primary btn-lg quarter colonyBtn" href="{{ action( 'ColonyController@show', ['id' => $colony->id]) }}" role="button">--}}
                        (-80&deg;C Freezer)
                    </a>

                @endforeach

            </div>

            <div class="whole">
                <a href="{{ url('/surgeries') }}"><h3>Surgeries</h3></a>
            </div>

        </div>

@endsection
