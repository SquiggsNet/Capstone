@extends('layouts.app')

@section('content')
    <div class="container">
        {!! Form::model($cage, ['action' => ['CageController@update', $cage], 'method' => 'put']) !!}

        <div class="form-group">
            {!! Form::label('room_num', 'Room Number') !!}
            {!! Form::text('room_num',null ,['class'=>'form-control'])!!}
        </div>
        <div class="form-group">
            {!! Form::label('mouse_id', 'Mouse ID') !!}
            {!! Form::text('mouse_id',null ,['class'=>'form-control'])!!}
        </div>
        <div class="form-group">
            {!! Form::label('breeder', 'Breeder') !!}
            {!! Form::text('breeder',null ,['class'=>'form-control']) !!}
        </div>
        {!! Form::submit('Save Update',['class'=>'btn btn-default']) !!}
        {!! Form::close() !!}

        <a href="{{ action( 'CageController@index') }}">
            Go Back
        </a>
    </div>
@endsection