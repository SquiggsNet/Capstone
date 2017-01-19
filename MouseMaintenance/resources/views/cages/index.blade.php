@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Cages</h1>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Room Number</th>
            <th>Mouse ID</th>
            <th>Breeder</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($cages as $cage)
        <tr>
            <td>
                <a href="{{ action( 'CageController@show', ['id' => $cage->id]) }}">
                    {{$cage->id}}
                </a>
            </td>
            <td>{{$cage->room_num}}</td>
            <td>{{$cage->mouse_id}}</td>
            <td>{{$cage->breeder}}</td>
            <td>
                {{ Form::open(['action' => ['CageController@edit', $cage], 'method' => 'get']) }}
                <button type="submit" >
                    <span class="glyphicon glyphicon-pencil"></span>
                </button>
                {{ Form::close() }}
            </td>
            <td>
                {{ Form::open(['action' => ['CageController@destroy', $cage], 'method' => 'delete']) }}
                <button type="submit" >
                    <span class="glyphicon glyphicon-trash"></span>
                </button>
                {{ Form::close() }}
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <a href="{{ action( 'CageController@create') }}">
        Create a New Cage
    </a>
</div>
@endsection