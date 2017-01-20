@extends('layouts.app')

@section('content')
    <div class="container">
        {!! Form::open(['action' => 'SurgeryController@store' ]) !!}
        <div class="form-group">
            {!! Form::label('user_id', 'User ID') !!}
            {!! Form::text('user_id',null ,['class'=>'form-control'])!!}
        </div>
        <div class="form-group">
            {!! Form::label('scheduled_date', 'Scheduled Date') !!}
            {!! Form::text('scheduled_date',null ,['class'=>'form-control'])!!}
        </div>
        <div class="form-group">
            {!! Form::label('purpose', 'Purpose') !!}
            {!! Form::text('purpose',null ,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('comments', 'Comments') !!}
            {!! Form::text('comments',null ,['class'=>'form-control']) !!}
        </div>
        {!! Form::submit('Add',['class'=>'btn btn-default']) !!}
        {!! Form::close() !!}

        <a href="{{ action( 'SurgeryController@index') }}">
            Go Back
        </a>
    </div>
@endsection