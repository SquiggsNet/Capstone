@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Breeder Cages</h1>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Cage ID</th>
            <th>Location</th>
            <th>Male</th>
            <th>Female 1</th>
            <th>Female 2</th>
            <th>Female 3</th>
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
                    <td>{{$cage->male}}</td>
                    <td>{{$cage->female_one}}</td>
                    <td>{{$cage->female_two}}</td>
                    <td>{{$cage->female_three}}</td>
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