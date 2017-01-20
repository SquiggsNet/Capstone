@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Surgery ID: {{$surgery->id}}</h1>
        <p>User ID: {{$surgery->user_id}}</p>
        <p>Scheduled Date: {{$surgery->scheduled_date}}</p>
        <p>Purpose: {{$surgery->purpose}}</p>
        <p>Comments: {{$surgery->comments}}</p>
        <a href="{{ action( 'SurgeryController@index') }}">
            Go Back
        </a>
    </div>
@endsection