@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Surgeries</h1>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Batch</th>
            <th>Surgery Date</th>
            <th>Tag#</th>
            <th>Treatment</th>
            <th>Dosage (mg/kg/d)</th>
            <th>Surgeon</th>
            <th>Purpose</th>
            <th>Comments</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($surgeries as $surgery)
        <tr>
            <td>
                <a href="{{ action( 'SurgeryController@show', ['id' => $surgery->id]) }}">
                    # {{$surgery->id}}
                </a>
            </td>
            <td>{{$surgery->scheduled_date}}</td>
            <td>
                @foreach($surgery->mice as $mouse)
                    <a href="{{ action( 'MouseController@show', ['id' => $mouse->id]) }}">
                        {{ $mouse->tagPad($mouse->tags->last()->tag_num) }}
                    </a>
                    <br>
                @endforeach
            </td>
            <td>{{$surgery->treatment}}</td>
            <td>@if($surgery->dose != 'null')
                    {{$surgery->dose}}
                @endif
            </td>
            <td>{{$surgery->user->getFullName()}}</td>
            <td>@if($surgery->purpose != 'null')
                    {{$surgery->purpose}}
                @endif
            </td>
            <td>{{$surgery->comments}}</td>
            <td>
                {{ Form::open(['action' => ['SurgeryController@edit', $surgery], 'method' => 'get']) }}
                <button type="submit" >
                    <span class="glyphicon glyphicon-pencil"></span>
                </button>
                {{ Form::close() }}
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <a href="{{ action( 'MouseController@index') }}">
        Create a New Surgery
    </a>
</div>
@endsection