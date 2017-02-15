@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Surgery ID: {{$surgery->id}}</h1>
        <p><strong>Surgeon:</strong> {{$surgery->user->getFullName()}}</p>
        <p><strong>Scheduled Date:</strong>  {{$surgery->scheduled_date}}</p>
        <p><strong>Mice: </strong>
            @foreach($surgery->mice as $mouse)
                <br>
                # {{ $mouse->tagPad($mouse->tags->last()->tag_num) }}
            @endforeach
        </p>
        <p><strong>Treatment:</strong>  {{ $surgery->treatment }}</p>
        <p><strong>Dose:</strong>  {{ $surgery->dose }} (mg/kd/day)</p>
        <p><strong>Purpose:</strong>  {{$surgery->purpose}}</p>
        <p><strong>Comments:</strong>  {{$surgery->comments}}</p>
        <a href="{{ action( 'SurgeryController@index') }}">
            Go Back
        </a>
    </div>
@endsection