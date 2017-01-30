@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Colony</h1>
    <div>
        <a href="{{ action( 'ColonyController@create') }}">
            Create a New Colony
        </a>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Colony Name</th>
            <th>Mice In Colony</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($colonies as $colony)
        <tr>
            <td>
                <a href="{{ action( 'ColonyController@show', ['id' => $colony->id]) }}">
                    {{$colony->name}}
                </a>
            </td>
            <td>
                {{ Form::open(['action' => ['ColonyController@edit', $colony], 'method' => 'get']) }}
                <button type="submit" >
                    <span class="glyphicon glyphicon-pencil"></span>
                </button>
                {{ Form::close() }}
            </td>
            <td>
                {{ Form::open(['action' => ['ColonyController@destroy', $colony], 'method' => 'delete']) }}
                <button type="submit" >
                    <span class="glyphicon glyphicon-trash"></span>
                </button>
                {{ Form::close() }}
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <div class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" id="dropDownNewMice" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            Add Mice
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropDownNewMice">
            <li><strong>Select Source</strong></li>
            <li role="separator" class="divider"></li>
            <li><a href="{{ action( 'MouseController@createSource', ['source' => 'internal']) }}">In House</a></li>
            <li><a href="{{ action( 'MouseController@createSource', ['source' => 'external']) }}">External</a></li>
        </ul>
    </div>
</div>
@endsection