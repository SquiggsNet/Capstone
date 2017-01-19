@extends('layouts.app')

@section('content')
    <div class="container">
        {!! Form::open(['action' => 'StorageController@store' ]) !!}
        <div class="form-group">
            {!! Form::label('tissue_id', 'Tissue ID') !!}
            {!! Form::text('tissue_id',null ,['class'=>'form-control'])!!}
        </div>
        <div class="form-group">
            {!! Form::label('type', 'Type') !!}
            {!! Form::text('type',null ,['class'=>'form-control'])!!}
        </div>
        <div class="form-group">
            {!! Form::label('freezer', 'Freezer') !!}
            {!! Form::text('freezer',null ,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('compartment', 'Compartment') !!}
            {!! Form::text('compartment',null ,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('shelf', 'Shelf') !!}
            {!! Form::text('shelf',null ,['class'=>'form-control']) !!}
        </div>
        {!! Form::submit('Add',['class'=>'btn btn-default']) !!}
        {!! Form::close() !!}

        <a href="{{ action( 'StorageController@index') }}">
            Go Back
        </a>
    </div>
@endsection