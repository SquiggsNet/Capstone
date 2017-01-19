@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Storage ID: {{$storage->id}}</h1>
        <p>Tissue ID: {{$storage->tissue_id}}</p>
        <p>Type: {{$storage->type}}</p>
        <p>Freezer: {{$storage->freezer}}</p>
        <p>Compartment: {{$storage->compartment}}</p>
        <p>Shelf: {{$storage->shelf}}</p>
        <a href="{{ action( 'StorageController@index') }}">
            Go Back
        </a>
    </div>
@endsection