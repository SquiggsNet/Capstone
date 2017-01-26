@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Mouse ID: {{$mouse->id}}</h1>
        <p><strong>Colony ID:</strong> {{$mouse->colony_id}}</p>
        <p><strong>Sex:</strong> {{$mouse->sex}}</p>
        <p><strong>Reserved For:</strong> {{ $user->first_name . ' ' . $user->last_name }} </p>

        <p><strong>Geno Type:</strong> ({{$mouse->getGeno($mouse->geno_type_a)}}/{{$mouse->getGeno($mouse->geno_type_b)}})</p>
        <p><strong>Father:</strong>
            <a href="{{ action( 'MouseController@show', ['id' => $mouse->father]) }}">
                {{$mouse->father}}
            </a>
        </p>
        <p><strong>Mother 1:</strong>
            <a href="{{ action( 'MouseController@show', ['id' => $mouse->mother_one]) }}">
                {{$mouse->mother_one}}
            </a>
        </p>
        <p><strong>Mother 2:</strong>
            <a href="{{ action( 'MouseController@show', ['id' => $mouse->mother_two]) }}">
                {{$mouse->mother_two}}
            </a>
        </p>
        <p><strong>Birth Date:</strong> {{$mouse->birth_date}}</p>
        <p><strong>Wean Date:</strong> {{$mouse->wean_date}}</p>
        <p><strong>End Date:</strong> {{$mouse->end_date}}</p>
        <p><strong>Sick Report:</strong> {{$mouse->sick_report}}</p>
        <p><strong>Comments:</strong> {{$mouse->comments}}</p>
        <a href="{{ action( 'MouseController@index') }}">
            Go Back
        </a>
    </div>
@endsection