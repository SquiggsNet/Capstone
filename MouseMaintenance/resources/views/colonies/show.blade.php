@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{$colony->name}} Colony</h1>
        <h3>Tagged Mice</h3>
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>id</th>
                <th>Tag</th>
                <th>Geno Type</th>
                <th>Treatment</th>
                <th>DOB</th>

            </tr>
            </thead>
            <tbody>
            @foreach ($colony->mice as $mouse)
                @if(isset($mouse->tags->last()->tag_num))
                <tr>
                    <td>{{ $mouse->id }}</td>
                    <td>
                        <a href="{{ action( 'MouseController@show', ['id' => $mouse->id]) }}">
                            {{ $mouse->tagPad($mouse->tags->last()->tag_num) }}
                        </a>
                    </td>
                    <td>({{ $mouse->getGeno($mouse->geno_type_a) }}/{{ $mouse->getGeno($mouse->geno_type_b) }})</td>
                    <td>
                        @foreach ($mouse->treatments as $treatment)
                            {{ $treatment->title }}
                            <br>
                        @endforeach
                    </td>
                    <td>{{ $mouse->birth_date }}</td>
                </tr>
                @endif
            @endforeach
            </tbody>
        </table>
        <h3>Untagged Mice</h3>
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Quantity</th>
                <th>Sex</th>
                <th>Pedigree</th>
                <th>DOB</th>
                <th>Give Tag</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($colony->mice as $mouse)
                @if(!isset($mouse->tags->last()->tag_num))
                <tr>
                    <td>{{ $mouse->id }}</td>
                    <td>({{ $mouse->getGeno($mouse->geno_type_a) }}/{{ $mouse->getGeno($mouse->geno_type_b) }})</td>
                    <td>
                        @foreach ($mouse->treatments as $treatment)
                            {{ $treatment->title }}
                            <br>
                        @endforeach
                    </td>
                    <td>{{ $mouse->birth_date }}</td>
                    <td>
                        {{--{{ Form::open(['action' => ['#'], 'method' => 'get']) }}--}}
                            <button type="submit" >
                                <span class="glyphicon glyphicon-tags"></span>
                            </button>
{{--                        {{ Form::close() }}--}}
                    </td>
                </tr>
                @endif
            @endforeach
            </tbody>
        </table>
.................
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