@extends('layouts.app')

@section('content')
    <div class="container">
        {!! Form::open(['action' => 'MouseController@store' ]) !!}
        <div class="form-group">
            {{--{!! Form::label('colony_id', 'Colony ID') !!}--}}
            {{--{!! Form::text('colony_id',null ,['class'=>'form-control'])!!}--}}
            <select name="colony_id" id="colony_id" class="form-control">
                @foreach($colonies as $colony)
                    <option value="{{ $colony->id }}">{{ $colony->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            {!! Form::label('reserved_for', 'Reserved For') !!}
            {!! Form::text('reserved_for',null ,['class'=>'form-control'])!!}
        </div>
        <div class="form-group">
            {!! Form::label('sex', 'Sex') !!}
            {!! Form::select('sex', ['True' => 'Male', 'False' => 'Female'], null) !!}
        </div>
        <div class="form-group">
            {!! Form::label('geno_type_a', 'Geno Type A') !!}
            {!! Form::select('geno_type_a', ['True' => '+', 'False' => '-'], null) !!}
        </div>
        <div class="form-group">
            {!! Form::label('geno_type_b', 'Geno Type B') !!}
            {!! Form::select('geno_type_b', ['True' => '+', 'False' => '-'], null) !!}
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
            {!! Form::label('blood_pressure', 'Blood Pressure') !!}
            {!! Form::number('systolic') !!} / {!! Form::number('diastolic') !!}
        </div>
        <div class="form-group">
            {!! Form::label('weight', 'weight') !!}
            {!! Form::number('weight_one') !!} . {!! Form::number('weight_two') !!} gms
        </div>
        <div class="form-group">
            {!! Form::label('sick_report', 'Sick Report') !!}
            {!! Form::text('sick_report',null ,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('comments', 'Comments') !!}
            {!! Form::text('comments',null ,['class'=>'form-control']) !!}
        </div>
        {!! Form::submit('Add',['class'=>'btn btn-default']) !!}
        {!! Form::close() !!}

        <a href="{{ action( 'MouseController@index') }}">
            Go Back
        </a>
    </div>
@endsection