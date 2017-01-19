@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Colony ID: {{$colony->id}}</h1>
        <p>Name: {{$colony->name}}</p>
        <a href="{{ action( 'ColonyController@index') }}">
            Go Back
        </a>
    </div>
@endsection