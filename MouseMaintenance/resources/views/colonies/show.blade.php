@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{$colony->name}} Colony</h1>
        <h3>Tagged Mice</h3>
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Tag#</th>
                <th>Strain</th>
                <th>Geno Type</th>
                <th>DOB</th>
                <th>Age (in weeks)</th>
                <th>Weight</th>
                <th>End Date</th>
                <th>Comments</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($colony->mice as $mouse)
                @if(isset($mouse->tags->last()->tag_num))
                <tr>
                    <td>
                        <a href="{{ action( 'MouseController@show', ['id' => $mouse->id]) }}">
                            {{ $mouse->tagPad($mouse->tags->last()->tag_num) }}
                        </a>
                    </td>
                    <td>*strain info*</td>
                    <td>({{ $mouse->getGeno($mouse->geno_type_a) }}/{{ $mouse->getGeno($mouse->geno_type_b) }})</td>
                    {{--<td>--}}
                        {{--@foreach ($mouse->treatments as $treatment)--}}
                            {{--{{ $treatment->title }}--}}
                            {{--<br>--}}
                        {{--@endforeach--}}
                    {{--</td>--}}
                    <td>{{ $mouse->birth_date }}</td>
                    <td>{{$mouse->getAge($mouse->birth_date)}} weeks</td>
                    <td>{{$mouse->weights->last()->weight}}g</td>
                    <td>{{$mouse->end_date}}</td>
                    <td>{{$mouse->comments}}</td>
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