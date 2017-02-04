@extends('layouts.app')

@section('content')

@if($source == "internal")
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">In House</div>
            <div class="panel-body">
                <div>
                    <form method="post" action="#">
                        {{ method_field('PATCH') }}
                        <div class="row">
                            <div class="form-group col-xs-6 col-sm-6 col-md-2">
                                <label>Male:</label>
                                <input class="form-control" type="number" id="maleMiceNumber" min="0" />
                            </div>
                            <div class="form-group col-xs-6 col-sm-6 col-md-2">
                                <label>Female:</label>
                                <input class="form-control" type="number" id="femaleMiceNumber" min="0"/>
                            </div>
                            <div class="form-group col-xs-12 col-sm-6 col-md-3">
                                <label>Date of Birth:</label>
                                <input class="form-control" type="date" id="dateOfBirth" />
                            </div>
                            <div class="form-group col-xs-12 col-sm-6 col-md-3">
                                <label>Colony:</label>
                                <select class="form-control" id="colony_id">
                                    <option value="0">Select Colony...</option>
                                    @foreach($colonies as $colony)
                                        <option value="{{ $colony->id }}">{{ $colony->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-xs-12 col-sm-6 col-md-2">
                                <label>Breeder Cage:</label>
                                <select class="form-control" id="colony_id">
                                    <option value="0">Select Cage </option>
                                    @foreach($colonies as $colony)
                                        <option value="{{ $colony->id }}">{{ $colony->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-12 col-sm-6 col-md-2">
                                <button type="submit" class="btn btn-primary">Save Mice</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@else

@endif


    {{--A nice +/- number selector, need to get JS to work in view --}}
    {{--<div class="col-lg-1">--}}
    {{--<div class="input-group">--}}
    {{--<span class="input-group-btn"><button class="btn btn-default value-control" data-action="minus" data-target="font-size"><span class="glyphicon glyphicon-minus"></span></button></span>--}}
    {{--<input type="text" value="1" class="form-control" id="font-size">--}}
    {{--<span class="input-group-btn"><button class="btn btn-default value-control" data-action="plus" data-target="font-size"><span class="glyphicon glyphicon-plus"></span></button></span>--}}
    {{--</div>--}}
    {{--</div>--}}
    <script type="text/javascript" src="{!! asset('public/js/button.js') !!}}"></script>

    {{--COMMENTED OUT BELOW TO CREATE NEW ADDITION PAGE--}}
    {{--<div class="container">--}}

        {{--<h1>New Mouse5</h1>--}}

        {{--{!! Form::open(['action' => 'MouseController@store' ]) !!}--}}

        {{--<div class="panel panel-default col-md-4">--}}
            {{--<div class="panel-heading">Identification</div>--}}

            {{--<div class="panel-body">--}}

                {{--<div class="form-group">--}}
                    {{--{!! Form::label('tag_id', 'Tag ID') !!}--}}
                    {{--{!! Form::number('tag_num') !!}--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                    {{--{!! Form::label('colony_id', 'Colony') !!}--}}
                    {{--<select name="colony_id" id="colony_id" class="form-control">--}}
                        {{--<option value="0">Select Colony...</option>--}}
                        {{--@foreach($colonies as $colony)--}}
                            {{--<option value="{{ $colony->id }}">{{ $colony->name }}</option>--}}
                        {{--@endforeach--}}
                    {{--</select>--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                    {{--{!! Form::label('reserved_for', 'Reserved For') !!}--}}
                    {{--<select name="reserved_for" id="reserved_for" class="form-control">--}}
                        {{--<option value="0">Reserve For...</option>--}}
                        {{--@foreach($users as $user)--}}
                            {{--<option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>--}}
                        {{--@endforeach--}}
                    {{--</select>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class="panel panel-default col-md-4">--}}
            {{--<div class="panel-heading">Sex and GenoType</div>--}}

            {{--<div class="panel-body">--}}

                {{--<div class="form-group">--}}
                    {{--{!! Form::label('sex', 'Sex') !!}--}}
                    {{--{!! Form::select('sex', ['True' => 'Male', 'False' => 'Female'], null) !!}--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                    {{--{!! Form::label('geno_type_a', 'Geno Type') !!}(--}}
                    {{--{!! Form::select('geno_type_a', ['True' => '+', 'False' => '-'], null) !!}/--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                    {{--{!! Form::label('geno_type_b', 'Geno Type B') !!}--}}
                    {{--{!! Form::select('geno_type_b', ['True' => '+', 'False' => '-'], null) !!})--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                    {{--{!! Form::label('father', 'Father') !!}--}}
                    {{--<select name="father" id="father" class="form-control">--}}
                        {{--<option value="0">Select Male Parent..</option>--}}
                        {{--@foreach($mice as $mouse)--}}
                            {{--@if($mouse->sex == 'True')--}}
                                {{--<option value="{{ $mouse->id }}">--}}
                                    {{--@foreach($mouse->tags as $tag)--}}
                                        {{--@if($tag->lost_tag == '0')--}}
                                                {{--{{ $mouse->tagPad($tag->tag_num) }}--}}
                                        {{--@endif--}}
                                    {{--@endforeach--}}
                                    {{--{{$mouse->getGender($mouse->sex)}}--}}
                                    {{--({{$mouse->getGeno($mouse->geno_type_a)}}--}}
                                    {{--/{{$mouse->getGeno($mouse->geno_type_b)}})</option>--}}
                            {{--@endif--}}
                        {{--@endforeach--}}
                    {{--</select>--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                    {{--{!! Form::label('mother_one', 'Mother') !!}--}}
                    {{--<select name="mother_one" id="mother_one" class="form-control">--}}
                        {{--<option value="0">Select Female Parent..</option>--}}
                        {{--@foreach($mice as $mouse)--}}
                            {{--@if($mouse->sex == 'False')--}}
                                {{--<option value="{{ $mouse->id }}">--}}
                                    {{--@foreach($mouse->tags as $tag)--}}
                                        {{--@if($tag->lost_tag == '0')--}}
                                            {{--{{ $mouse->tagPad($tag->tag_num) }}--}}
                                        {{--@endif--}}
                                    {{--@endforeach--}}
                                    {{--{{$mouse->getGender($mouse->sex)}}--}}
                                    {{--({{$mouse->getGeno($mouse->geno_type_a)}}--}}
                                    {{--/{{$mouse->getGeno($mouse->geno_type_b)}})</option>--}}
                            {{--@endif--}}
                        {{--@endforeach--}}
                    {{--</select>--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                    {{--{!! Form::label('mother_two', 'Mother') !!}--}}
                    {{--<select name="mother_two" id="mother_two" class="form-control">--}}
                        {{--<option value="0">Select Female Parent..</option>--}}
                        {{--@foreach($mice as $mouse)--}}
                            {{--@if($mouse->sex == 'False')--}}
                                {{--<option value="{{ $mouse->id }}">--}}
                                    {{--@foreach($mouse->tags as $tag)--}}
                                        {{--@if($tag->lost_tag == '0')--}}
                                            {{--{{ $mouse->tagPad($tag->tag_num) }}--}}
                                        {{--@endif--}}
                                    {{--@endforeach--}}
                                    {{--{{$mouse->getGender($mouse->sex)}}--}}
                                    {{--({{$mouse->getGeno($mouse->geno_type_a)}}--}}
                                    {{--/{{$mouse->getGeno($mouse->geno_type_b)}})</option>--}}
                            {{--@endif--}}
                        {{--@endforeach--}}
                    {{--</select>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class="panel panel-default col-md-4">--}}
            {{--<div class="panel-heading">Date Information</div>--}}

            {{--<div class="panel-body">--}}

                {{--<div class="form-group">--}}
                    {{--{!! Form::label('birth_date', 'Birth Date') !!}--}}
                    {{--{!! Form::date('birth_date', \Carbon\Carbon::now('America/Halifax')->format('Y-m-d H:i:s')) !!}--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                    {{--{!! Form::label('wean_date', 'Wean Date') !!}--}}
                    {{--{!! Form::date('wean_date', \Carbon\Carbon::now('America/Halifax')->format('Y-m-d H:i:s')) !!}--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                    {{--{!! Form::label('end_date', 'End Date') !!}--}}
                    {{--{!! Form::date('end_date', \Carbon\Carbon::now('America/Halifax')->format('Y-m-d H:i:s')) !!}--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="panel panel-default col-md-12 ">--}}
            {{--<div class="panel-heading">Additional Information</div>--}}

            {{--<div class="panel-body">--}}
                {{--<div class="form-group">--}}
                    {{--{!! Form::label('blood_pressure', 'Blood Pressure') !!}--}}
                    {{--{!! Form::number('systolic') !!} / {!! Form::number('diastolic') !!}--}}

                    {{--{!! Form::label('weight_one', 'Weight') !!}--}}

                        {{--{!! Form::number('weight_one') !!}--}}

                    {{--.--}}

                        {{--{!! Form::number('weight_two') !!} gms--}}

                {{--</div>--}}
                {{--<div class="form-group">--}}
                    {{--{!! Form::label('sick_report', 'Sick Report') !!}--}}
                    {{--{!! Form::checkbox('sick_report', 'value') !!}--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                    {{--{!! Form::label('comments', 'Comments') !!}--}}
                    {{--{!! Form::textarea('comments',null ,['class'=>'form-control', 'rows' => 3]) !!}--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class=" col-md-12 ">--}}
            {{--{!! Form::submit('Add',['class'=>'btn btn-default']) !!}--}}
            {{--{!! Form::close() !!}--}}

            {{--<a href="{{ action( 'MouseController@index') }}">--}}
                {{--Go Back--}}
            {{--</a>--}}
        {{--</div>--}}

    {{--</div>--}}

@endsection