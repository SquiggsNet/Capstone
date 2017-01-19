@extends('layouts.app')

@section('content')
    <div class="container">
        {!! Form::open(['action' => 'TreatmentController@store' ]) !!}
        <div class="form-group">
            {!! Form::label('title', 'Title') !!}
            {!! Form::text('title',null ,['class'=>'form-control'])!!}
        </div>
        <div class="form-group">
            {!! Form::label('drug_amount', 'Drug Amount') !!}
            {!! Form::text('drug_amount',null ,['class'=>'form-control'])!!}
        </div>
        <div class="form-group">
            {!! Form::label('mouse_id', 'Mouse ID') !!}
            {!! Form::text('mouse_id',null ,['class'=>'form-control']) !!}
        </div>
        {!! Form::submit('Add',['class'=>'btn btn-default']) !!}
        {!! Form::close() !!}

        <a href="{{ action( 'TreatmentController@index') }}">
            Go Back
        </a>
    </div>
@endsection