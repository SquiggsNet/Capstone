@extends('layouts.app')

@section('content')
    <div class="container">
        {!! Form::open(['action' => 'MouseController@store' ]) !!}
        <div class="form-group">
            {!! Form::label('colony_id', 'Colony') !!}
            <select name="colony_id" id="colony_id" class="form-control">
                <option value="0">Select Colony...</option>
                @foreach($colonies as $colony)
                    <option value="{{ $colony->id }}">{{ $colony->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            {!! Form::label('reserved_for', 'Reserved For') !!}
            <select name="reserved_for" id="reserved_for" class="form-control">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                @endforeach
            </select>

            {!! Form::label('reserved_for', 'Reserved For') !!}
            {{--{!! Form::text('reserved_for',null ,['class'=>'form-control'])!!}--}}
        </div>
        <div class="form-group">
            {!! Form::label('sex', 'Sex') !!}
            {!! Form::select('sex', ['True' => 'Male', 'False' => 'Female'], null) !!}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {!! Form::label('geno_type_a', 'Geno Type') !!}(
            {!! Form::select('geno_type_a', ['True' => '+', 'False' => '-'], null) !!}/
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {{--{!! Form::label('geno_type_b', 'Geno Type B') !!}--}}
            {!! Form::select('geno_type_b', ['True' => '+', 'False' => '-'], null) !!})
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
            {!! Form::date('birth_date', \Carbon\Carbon::now('America/Halifax')->format('Y-m-d H:i:s')) !!}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {!! Form::label('wean_date', 'Wean Date') !!}
            {!! Form::date('wean_date', \Carbon\Carbon::now('America/Halifax')->format('Y-m-d H:i:s')) !!}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {!! Form::label('end_date', 'End Date') !!}
            {!! Form::date('end_date', \Carbon\Carbon::now('America/Halifax')->format('Y-m-d H:i:s')) !!}
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
            {!! Form::checkbox('sick_report', 'value') !!}
        </div>
        <div class="form-group">
            {!! Form::label('comments', 'Comments') !!}
            {!! Form::textarea('comments',null ,['class'=>'form-control', 'rows' => 3]) !!}
        </div>
        {!! Form::submit('Add',['class'=>'btn btn-default']) !!}
        {!! Form::close() !!}

        <a href="{{ action( 'MouseController@index') }}">
            Go Back
        </a>
    </div>
@endsection