@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Mouse ID: {{$mouse->id}}</h1>
        <p>Colony ID: {{$mouse->colony_id}}</p>
        <p>Sex: {{$mouse->sex}}</p>
        <p>Reserved For: {{$mouse->reserved_for}}</p>
        <p>Geno Type A: {{$mouse->geno_type_a}}</p>
        <p>Geno Type B: {{$mouse->geno_type_b}}</p>
        <p>Father: {{$mouse->father}}</p>
        <p>Mother 1: {{$mouse->mother_one}}</p>
        <p>Mother 2: {{$mouse->mother_two}}</p>
        <p>Birth Date: {{$mouse->birth_date}}</p>
        <p>Wean Date: {{$mouse->wean_date}}</p>
        <p>End Date: {{$mouse->end_date}}</p>
        <p>Sick Report: {{$mouse->sick_report}}</p>
        <p>Comments: {{$mouse->comments}}</p>
        <a href="{{ action( 'MouseController@index') }}">
            Go Back
        </a>
    </div>
@endsection