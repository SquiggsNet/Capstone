@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tissues</h1>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($tissues as $tissue)
        <tr>
            <td>
                <a href="{{ action( 'TissueController@show', ['id' => $tissue->id]) }}">
                    {{$tissue->id}}
                </a>
            </td>
            <td>{{$tissue->name}}</td>
            <td>
                {{ Form::open(['action' => ['TissueController@edit', $tissue], 'method' => 'get']) }}
                <button type="submit" >
                    <span class="glyphicon glyphicon-pencil"></span>
                </button>
                {{ Form::close() }}
            </td>
            <td>
                {{ Form::open(['action' => ['TissueController@destroy', $tissue], 'method' => 'delete']) }}
                <button type="submit" >
                    <span class="glyphicon glyphicon-trash"></span>
                </button>
                {{ Form::close() }}
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <a href="{{ action( 'TissueController@create') }}">
        Create a New Tissue
    </a>
</div>
@endsection