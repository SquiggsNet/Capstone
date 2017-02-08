@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Mouse # {{ $mouse->tagPad($mouse->tags->last()->tag_num) }}</h1>
        <a href="{{ action( 'MouseController@edit', ['id' => $mouse->id]) }}">
            Edit Mouse
            </a>
        <p><strong>Colony:</strong> {{ $colony->name }}</p>
        <p><strong>Sex:</strong> {{ $mouse->getGender($mouse->sex) }}</p>
        <p><strong>Reserved For:</strong> {{ $user->first_name . ' ' . $user->last_name }} </p>
        <p><strong>Geno Type:</strong> ({{$mouse->getGeno($mouse->geno_type_a)}}/{{$mouse->getGeno($mouse->geno_type_b)}})</p>
        <p><strong>Father:</strong>

            <a href="{{ action( 'MouseController@show', ['id' => $mouse->father]) }}">
                {{$mouse->tagPad($mouse->father_record->tags->last()->tag_num)}}
                {{$mouse->getGender($mouse->father_record->sex)}}
                ({{$mouse->getGeno($mouse->father_record->geno_type_a)}}/{{$mouse->getGeno($mouse->father_record->geno_type_b)}})
            </a>
        </p>
        <p><strong>Mother 1:</strong>
            <a href="{{ action( 'MouseController@show', ['id' => $mouse->mother_one]) }}">
                {{$mouse->tagPad($mouse->mother_one_record->tags->last()->tag_num)}}
                {{$mouse->getGender($mouse->mother_one_record->sex)}}
                ({{$mouse->getGeno($mouse->mother_one_record->geno_type_a)}}/{{$mouse->getGeno($mouse->mother_one_record->geno_type_b)}})
            </a>
        </p>
        <p><strong>Mother 2:</strong>
            @if(isset($mouse->mother_two->id))
                <a href="{{ action( 'MouseController@show', ['id' => $mouse->mother_two]) }}">
                    {{$mouse->tagPad($mouse->mother_two_record->tags->last()->tag_num)}}
                    {{$mouse->getGender($mouse->mother_two_record->sex)}}
                    ({{$mouse->getGeno($mouse->mother_two_record->geno_type_a)}}/{{$mouse->getGeno($mouse->mother_two_record->geno_type_b)}})
                </a>
            @endif
        </p>
        <p><strong>Mother 3:</strong>
            @if(isset($mouse->mother_three->id))
                <a href="{{ action( 'MouseController@show', ['id' => $mouse->mother_three]) }}">
                    {{$mouse->tagPad($mouse->mother_three_record->tags->last()->tag_num)}}
                    {{$mouse->getGender($mouse->mother_three_record->sex)}}
                    ({{$mouse->getGeno($mouse->mother_three_record->geno_type_a)}}/{{$mouse->getGeno($mouse->mother_three_record->geno_type_b)}})
                </a>
            @endif
        </p>
        <p><strong>Birth Date:</strong> {{$mouse->birth_date}}</p>
        <p><strong>Wean Date:</strong> {{$mouse->wean_date}}</p>
        <p><strong>End Date:</strong> {{$mouse->end_date}}</p>
        <p><strong>Sick Report:</strong> @if($mouse->sick_report) Yes @else No @endif</p>
        <p><strong>Comments:</strong> {{$mouse->comments}}</p>
        <a href="{{ action( 'MouseController@index') }}">
            Go Back
        </a>
    </div>
@endsection