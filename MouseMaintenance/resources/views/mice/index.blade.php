@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mice</h1>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Tag</th>
            <th>Colony ID</th>
            <th>Pedigree</th>
            <th>Sex</th>
            <th>Geno Type</th>
            <th>Age</th>
            <th>Weight</th>
            <th>Blood Pressure</th>
            <th>Wean Date</th>
            <th>End Date</th>
            <th>Comments</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($mice as $mouse)
            @if($mouse->end_date)
                <tr class="danger">
            @elseif($mouse->surgeries->first())
                <tr class="warning">
            @else
                <tr>
            @endif
                {{--<a href="{{ action( 'MouseController@show', ['id' => $mouse->id]) }}">--}}
                    {{--{{$mouse->tags->last()->tag_num}}--}}
                {{--</a>--}}
                    <td>
                @foreach($mouse->tags as $tag)
                    @if($tag->lost_tag == '0')
                        {{ $mouse->tagPad($tag->tag_num) }}
                    @endif
                @endforeach
                    </td>
                <td>
                    <a href="{{ action( 'ColonyController@show', ['id' => $mouse->colony->id]) }}">
                        {{$mouse->colony->name}}
                    </a>
                </td>
                <td>
                    {{$mouse->tagPad($mouse->father_record->tags->last()->tag_num)}}
                    {{$mouse->getGender($mouse->father_record->sex)}}
                    ({{$mouse->getGeno($mouse->father_record->geno_type_a)}}
                    /{{$mouse->getGeno($mouse->father_record->geno_type_b)}}
                    )x
                    {{$mouse->tagPad($mouse->mother_one_record->tags->last()->tag_num)}}
                    {{$mouse->getGender($mouse->mother_one_record->sex)}}
                    ({{$mouse->getGeno($mouse->mother_one_record->geno_type_a)}}
                    /{{$mouse->getGeno($mouse->mother_one_record->geno_type_b)}}
                    ),
                    {{$mouse->tagPad($mouse->mother_two_record->tags->last()->tag_num)}}
                    {{$mouse->getGender($mouse->mother_two_record->sex)}}
                    ({{$mouse->getGeno($mouse->mother_two_record->geno_type_a)}}
                    /{{$mouse->getGeno($mouse->mother_two_record->geno_type_b)}}
                    )
                </td>
                <td>{{$mouse->getGender($mouse->sex)}}</td>
                <td>({{$mouse->getGeno($mouse->geno_type_a)}}/{{$mouse->getGeno($mouse->geno_type_b)}})</td>
                <td>{{$mouse->getAge($mouse->birth_date)}} weeks</td>
                <td>{{$mouse->weights->last()->weight}}g</td>
                <td>
                    {{$mouse->blood_pressures->last()->systolic}}
                    /
                    {{$mouse->blood_pressures->last()->diastolic}}
                </td>
                <td>{{$mouse->wean_date}}</td>
                <td>{{$mouse->end_date}}</td>
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