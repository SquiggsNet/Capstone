@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Users</h1>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Student ID</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
        <tr>
            <td>
                <a href="{{ action( 'UserController@show', ['id' => $user->id]) }}">
                    {{$user->id}}
                </a>
            </td>
            <td>{{$user->first_name}}</td>
            <td>{{$user->last_name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->phone}}</td>
            <td>{{$user->student_id}}</td>
            <td>
                {{ Form::open(['action' => ['UserController@edit', $user], 'method' => 'get']) }}
                <button type="submit" >
                    <span class="glyphicon glyphicon-pencil"></span>
                </button>
                {{ Form::close() }}
            </td>
            <td>
                {{ Form::open(['action' => ['UserController@destroy', $user], 'method' => 'delete']) }}
                <button type="submit" >
                    <span class="glyphicon glyphicon-trash"></span>
                </button>
                {{ Form::close() }}
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <a href="{{ action( 'UserController@create') }}">
        Create a New User
    </a>
</div>
@endsection