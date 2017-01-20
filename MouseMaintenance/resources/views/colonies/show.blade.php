@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Colony ID: {{$colony->id}}</h1>
        <p>Name: {{$colony->name}}</p>

        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Tag</th>
                <th>Geno Type</th>
                <th>Treatment</th>
                <th>DOB</th>

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
                    <td>Uncomment next line when tag relationship in place</td>
                    {{--@foreach ($mouse->tags as $tag)--}}
                        {{--<td>{{$tag->tag_num}}</td>--}}
                    {{--@endforeach--}}
                    <td>({{$mouse->geno_type_a}}/{{$mouse->geno_type_b}})</td>
                    @foreach ($mouse->treatments as $treatment)
                        <td>{{$treatment->title}}</td>
                    @endforeach
                    <td>{{$mouse->birth_date}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <p>
            <a href="{{ action( 'HomeController@index') }}">
                Go Back to Main Menu
            </a>
        </p>
        <p>
            <a href="{{ action( 'ColonyController@index') }}">
                Go Back to Colony Management
            </a>
        </p>

    </div>
@endsection