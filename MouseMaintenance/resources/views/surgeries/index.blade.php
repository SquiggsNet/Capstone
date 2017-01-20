@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Surgeries</h1>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>Scheduled Date</th>
            <th>Purpose</th>
            <th>Comments</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($surgeries as $surgery)
        <tr>
            <td>
                <a href="{{ action( 'SurgeryController@show', ['id' => $surgery->id]) }}">
                    {{$surgery->id}}
                </a>
            </td>
            <td>{{$surgery->user_id}}</td>
            <td>{{$surgery->scheduled_date}}</td>
            <td>{{$surgery->purpose}}</td>
            <td>{{$surgery->comments}}</td>
            <td>
                {{ Form::open(['action' => ['SurgeryController@edit', $surgery], 'method' => 'get']) }}
                <button type="submit" >
                    <span class="glyphicon glyphicon-pencil"></span>
                </button>
                {{ Form::close() }}
            </td>
            <td>
                {{ Form::open(['action' => ['SurgeryController@destroy', $surgery], 'method' => 'delete']) }}
                <button type="submit" >
                    <span class="glyphicon glyphicon-trash"></span>
                </button>
                {{ Form::close() }}
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <a href="{{ action( 'SurgeryController@create') }}">
        Create a New Surgery
    </a>
</div>
@endsection