@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Colony ID: {{$colony->id}}</h1>
        <p>Name: {{$colony->name}}</p>

        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Geno Type A</th>
                <th>Geno Type B</th>
                <th>Father</th>
                <th>Mother 1</th>
                <th>Mother 2</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($colony->mice as $mouse)
                <tr>
                    <td>
                        <a href="{{ action( 'MouseController@show', ['id' => $mouse->id]) }}">
                            {{$mouse->id}}
                        </a>
                    </td>
                    <td>{{$mouse->geno_type_a}}</td>
                    <td>{{$mouse->geno_type_b}}</td>
                    <td>{{$mouse->father}}</td>
                    <td>{{$mouse->mother_one}}</td>
                    <td>{{$mouse->mother_two}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>


        <a href="{{ action( 'ColonyController@index') }}">
            Go Back
        </a>
    </div>
@endsection