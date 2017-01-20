@extends('layouts.app')

@section('content')
    <div class="container">
        {!! Form::model($mouse, ['action' => ['MouseController@update', $mouse], 'method' => 'put']) !!}

        <div class="form-group">
            {!! Form::label('colony_id', 'Colony ID') !!}
            {!! Form::text('colony_id',null ,['class'=>'form-control'])!!}
        </div>
        <div class="form-group">
            {!! Form::label('reserved_for', 'Reserved For') !!}
            {!! Form::text('reserved_for',null ,['class'=>'form-control'])!!}
        </div>
        <div class="form-group">
            {!! Form::label('geno_type_a', 'Geno Type A') !!}
            {!! Form::text('geno_type_a',null ,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('geno_type_b', 'Geno Type B') !!}
            {!! Form::text('geno_type_b',null ,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('father', 'Father') !!}
            {!! Form::text('father',null ,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('mother_one', 'Mother 1') !!}
            {!! Form::text('mother_one',null ,['class'=>'form-control'])!!}
        </div>
        <div class="form-group">
            {!! Form::label('mother_two', 'Mother 2') !!}
            {!! Form::text('mother_two',null ,['class'=>'form-control'])!!}
        </div>
        <div class="form-group">
            {!! Form::label('birth_date', 'Birth Date') !!}
            {!! Form::text('birth_date',null ,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('wean_date', 'Wean Date') !!}
            {!! Form::text('wean_date',null ,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('end_date', 'End Date') !!}
            {!! Form::text('end_date',null ,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('sick_report', 'Sick Report') !!}
            {!! Form::text('sick_report',null ,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('comments', 'Comments') !!}
            {!! Form::text('comments',null ,['class'=>'form-control']) !!}
        </div>
        {!! Form::submit('Save Update',['class'=>'btn btn-default']) !!}
        {!! Form::close() !!}

        <a href="{{ action( 'MouseController@index') }}">
            Go Back
        </a>
    </div>
@endsection