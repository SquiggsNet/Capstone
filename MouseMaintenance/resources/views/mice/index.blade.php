@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mice</h1>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Tag</th>
            <th>Colony</th>
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
            {{--<th></th>--}}
        </tr>
        </thead>
        <tbody>
        @foreach ($mice as $mouse)
            @if(isset($mouse->tags->last()->tag_num))
                @if($mouse->end_date)
                    <tr class="danger">
                @elseif($mouse->surgeries->first())
                    <tr class="info">
                @elseif($mouse->sick_report)
                    <tr class="warning">
                @else
                    <tr>
                @endif
                        <td>
                            <a href="{{ action( 'MouseController@show', ['id' => $mouse->id]) }}">
                                {{ $mouse->tagPad($mouse->tags->last()->tag_num) }}
                            </a>
                        </td>
                    <td>
                        <a href="{{ action( 'ColonyController@show', ['id' => $mouse->colony->id]) }}">
                            {{$mouse->colony->name}}
                        </a>
                    </td>
                    <td>
                        {{$mouse->tagPad($mouse->father_record->tags->last()->tag_num)}}{{$mouse->getGender($mouse->father_record->sex)}}({{$mouse->getGeno($mouse->father_record->geno_type_a)}}/{{$mouse->getGeno($mouse->father_record->geno_type_b)}})x
                        {{$mouse->tagPad($mouse->mother_one_record->tags->last()->tag_num)}}{{$mouse->getGender($mouse->mother_one_record->sex)}}({{$mouse->getGeno($mouse->mother_one_record->geno_type_a)}}/{{$mouse->getGeno($mouse->mother_one_record->geno_type_b)}})
                        @if(isset($mouse->mother_two_record->sex))
                            ,{{$mouse->tagPad($mouse->mother_two_record->tags->last()->tag_num)}}
                            {{$mouse->getGender($mouse->mother_two_record->sex)}}
                            ({{$mouse->getGeno($mouse->mother_two_record->geno_type_a)}}
                            /{{$mouse->getGeno($mouse->mother_two_record->geno_type_b)}})
                        @endif
                        @if(isset($mouse->mother_three_record->sex))
                            ,{{$mouse->tagPad($mouse->mother_three_record->tags->last()->tag_num)}}
                            {{$mouse->getGender($mouse->mother_three_record->sex)}}
                            ({{$mouse->getGeno($mouse->mother_three_record->geno_type_a)}}
                            /{{$mouse->getGeno($mouse->mother_three_record->geno_type_b)}})
                        @endif
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
                    {{--<td>--}}
                        {{--{{ Form::open(['action' => ['MouseController@destroy', $mouse], 'method' => 'delete']) }}--}}
                        {{--<button type="submit" >--}}
                            {{--<span class="glyphicon glyphicon-trash"></span>--}}
                        {{--</button>--}}
                        {{--{{ Form::close() }}--}}
                    {{--</td>--}}
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>
    <h3>Untagged Mice</h3>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>DB ID</th>
            <th>Colony</th>
            <th>Sex</th>
            <th>Pedigree</th>
            <th>DOB</th>
            <th>Give Tag</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($mice as $mouse)
            @if(!isset($mouse->tags->last()->tag_num))
                <tr>
                    <td>{{ $mouse->id }}</td>
                    <td>{{ $mouse->colony->name }}</td>
                    <td>{{ $mouse->getGender($mouse->sex) }}</td>
                    <td>{{$mouse->tagPad($mouse->father_record->tags->last()->tag_num)}}
                        {{$mouse->getGender($mouse->father_record->sex)}}
                        ({{$mouse->getGeno($mouse->father_record->geno_type_a)}}/
                        {{$mouse->getGeno($mouse->father_record->geno_type_b)}}) x
                        {{$mouse->tagPad($mouse->mother_one_record->tags->last()->tag_num)}}
                        {{$mouse->getGender($mouse->mother_one_record->sex)}}
                        ({{$mouse->getGeno($mouse->mother_one_record->geno_type_a)}}/
                        {{$mouse->getGeno($mouse->mother_one_record->geno_type_b)}})
                        @if(isset($mouse->mother_two_record->sex))
                            ,{{$mouse->tagPad($mouse->mother_two_record->tags->last()->tag_num)}}
                            {{$mouse->getGender($mouse->mother_two_record->sex)}}
                            ({{$mouse->getGeno($mouse->mother_two_record->geno_type_a)}}
                            /{{$mouse->getGeno($mouse->mother_two_record->geno_type_b)}})
                        @endif
                        @if(isset($mouse->mother_three_record->sex))
                            ,{{$mouse->tagPad($mouse->mother_three_record->tags->last()->tag_num)}}
                            {{$mouse->getGender($mouse->mother_three_record->sex)}}
                            ({{$mouse->getGeno($mouse->mother_three_record->geno_type_a)}}
                            /{{$mouse->getGeno($mouse->mother_three_record->geno_type_b)}})
                        @endif</td>
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
    <a href="{{ action( 'MouseController@create') }}">
        Create a New Mouse
    </a>
</div>
@endsection