@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mice</h1>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Colony ID</th>
            <th>Reserved For</th>
            <th>Geno Type A</th>
            <th>Geno Type B</th>
            <th>Father</th>
            <th>Mother 1</th>
            <th>Mother 2</th>
            <th>Birth Date</th>
            <th>Wean Date</th>
            <th>End Date</th>
            <th>Sick Report</th>
            <th>Comments</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($mice as $mouse)
        <tr>
            <td>
                <a href="{{ action( 'MouseController@show', ['id' => $mouse->id]) }}">
                    {{$mouse->id}}
                </a>
            </td>
            <td>{{$mouse->colony_id}}</td>
            <td>{{$mouse->reserved_for}}</td>
            <td>{{$mouse->geno_type_a}}</td>
            <td>{{$mouse->geno_type_b}}</td>
            <td>{{$mouse->father}}</td>
            <td>{{$mouse->mother_one}}</td>
            <td>{{$mouse->mother_two}}</td>
            <td>{{$mouse->birth_date}}</td>
            <td>{{$mouse->wean_date}}</td>
            <td>{{$mouse->end_date}}</td>
            <td>{{$mouse->sick_report}}</td>
            <td>{{$mouse->comments}}</td>
            <td>
                {{ Form::open(['action' => ['MouseController@edit', $mouse], 'method' => 'get']) }}
                <button type="submit" >
                    <span class="glyphicon glyphicon-pencil"></span>
                </button>
                {{ Form::close() }}
            </td>
            <td>
                {{ Form::open(['action' => ['MouseController@destroy', $mouse], 'method' => 'delete']) }}
                <button type="submit" >
                    <span class="glyphicon glyphicon-trash"></span>
                </button>
                {{ Form::close() }}
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <a href="{{ action( 'MouseController@create') }}">
        Create a New Mouse
    </a>
</div>
@endsection