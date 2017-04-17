@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">

            <div class="panel panel-default third-x2">
                <div class="panel-heading"><h3>Storage</h3></div>
                <div class="panel-body">
                    @foreach ($storages as $storage)
                        <a class="btn btn-lg btn-block" href="{{ action( 'StorageController@show', ['id' => $storage->id]) }}" role="button">
                            @if($storage->type == 1)
                                (-80&deg;C) Freezer {{$storage->identifier}}
                            @else
                                Histology {{$storage->identifier}}
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection