@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Colony</h1>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Colony Name</th>
            <th>Mice In Colony</th>
            <th></th>
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
                @foreach($colony->mice as $mouse)
                    @foreach($mouse->tags as $tag)
                        @if($tag->lost_tag == '0')
                            {{ $mouse->tagPad($tag->tag_num) }}
                            <br>
                        @endif
                    @endforeach
                @endforeach
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
    <a href="{{ action( 'ColonyController@create') }}">
        Create a New Colony
    </a>
</div>
@endsection