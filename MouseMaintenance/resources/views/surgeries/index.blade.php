@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Surgeries</h1>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Surgeon</th>
            <th>Surgery Date</th>
            <th>Tag#</th>
            <th>Treatment</th>
            <th>Dosage (mg/kg/d)</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($surgeries as $surgery)
        <tr>
            {{--<td>--}}
                {{--<a href="{{ action( 'SurgeryController@show', ['id' => $surgery->id]) }}">--}}
                    {{--{{$surgery->id}}--}}
                {{--</a>--}}
            {{--</td>--}}
            <td>{{$surgery->user_id}}</td>
            <td>{{$surgery->scheduled_date}}</td>
            <td>tag#</td>
            <td>{{$surgery->purpose}}</td>
            <td>{{$surgery->comments}}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <a href="{{ action( 'SurgeryController@create') }}">
        Create a New Surgery
    </a>
</div>
@endsection