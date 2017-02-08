@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Treatments</h1>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Dosage (mg/kg/day)</th>
            <th>Mouse ID</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($treatments as $treatment)
        <tr>
            <td>
                <a href="{{ action( 'TreatmentController@show', ['id' => $treatment->id]) }}">
                    {{$treatment->id}}
                </a>
            </td>
            <td>{{$treatment->title}}</td>
            <td>{{$treatment->drug_amount}}</td>
            <td>{{$treatment->mouse_id}}</td>
            <td>
                {{ Form::open(['action' => ['TreatmentController@edit', $treatment], 'method' => 'get']) }}
                <button type="submit" >
                    <span class="glyphicon glyphicon-pencil"></span>
                </button>
                {{ Form::close() }}
            </td>
            <td>
                {{ Form::open(['action' => ['TreatmentController@destroy', $treatment], 'method' => 'delete']) }}
                <button type="submit" >
                    <span class="glyphicon glyphicon-trash"></span>
                </button>
                {{ Form::close() }}
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <a href="{{ action( 'TreatmentController@create') }}">
        Create a New Treatment
    </a>
</div>
@endsection