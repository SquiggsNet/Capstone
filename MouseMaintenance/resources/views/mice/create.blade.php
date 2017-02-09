@extends('layouts.app')

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


@section('content')

@if($source == "1")
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">In House</div>
            <div class="panel-body">
                <div>
                    {!! Form::open((array('route' => 'mice.store'))) !!}
                        <div class="row">
                            <div class="form-group col-xs-6 col-sm-6 col-md-2">
                                <label># Of Male(s):</label>
                                <input class="form-control" type="number" name="male_mice_number" min="0" />
                            </div>
                            <div class="form-group col-xs-6 col-sm-6 col-md-2">
                                <label># Of Female(s):</label>
                                <input class="form-control" type="number" name="female_mice_number" min="0"/>
                            </div>
                            <div class="form-group col-xs-12 col-sm-6 col-md-3">
                                <label>Date of Birth:</label>
                                <input class="form-control" type="date" name="date_of_birth" />
                            </div>
                            <div class="form-group col-xs-12 col-sm-6 col-md-3">
                                <label>Colony:</label>
                                <select class="form-control" name="colony_id">
                                    <option value="0">Select Colony...</option>
                                    @foreach($colonies as $colony)
                                        <option value="{{ $colony->id }}">{{ $colony->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-12 col-sm-6 col-md-2">
                                <label>Male Parent:</label>
                                <label>
                                    @foreach($mice as $mouse)
                                        @if($mouse->id == $cage->male)
                                            <input class="form-control" type="text" name="male_parent" readonly="readonly"
                                                   value=" #{{ $mouse->tagPad($mouse->tags->last()->tag_num) . ' ' .
                                                            $mouse->getGender($mouse->sex) . ' (' .
                                                            $mouse->getGeno($mouse->geno_type_a) . '/' .
                                                            $mouse->getGeno($mouse->geno_type_b) . ')' }} "/>
                                        @endif
                                    @endforeach
                                </label>
                            </div>
                            <div class="form-group col-xs-12 col-sm-6 col-md-2">
                                <label>Select Female Parent:</label>
                                <input type="hidden" name="cage_id" value="{{ $cage->id }}"/>
                                <select class="form-control" name="female_parent">
                                    <option value="0">Select All (Unknown)</option>
                                    @foreach($mice as $mouse)
                                        @if($mouse->id == $cage->female_one)
                                            <option value="{{ $mouse->id }}">
                                                {{ $mouse->tagPad($mouse->tags->last()->tag_num) . ' ' .
                                                    $mouse->getGender($mouse->sex) . ' (' .
                                                    $mouse->getGeno($mouse->geno_type_a) . '/' .
                                                    $mouse->getGeno($mouse->geno_type_b) . ')' }}
                                            </option>
                                        @endif
                                        @if($mouse->id == $cage->female_two)
                                            <option value="{{ $mouse->id }}">
                                                {{ $mouse->tagPad($mouse->tags->last()->tag_num) . ' ' .
                                                    $mouse->getGender($mouse->sex) . ' (' .
                                                    $mouse->getGeno($mouse->geno_type_a) . '/' .
                                                    $mouse->getGeno($mouse->geno_type_b) . ')' }}
                                            </option>
                                        @endif
                                        @if($mouse->id == $cage->female_three)
                                            <option value="{{ $mouse->id }}">
                                                {{ $mouse->tagPad($mouse->tags->last()->tag_num) . ' ' .
                                                    $mouse->getGender($mouse->sex) . ' (' .
                                                    $mouse->getGeno($mouse->geno_type_a) . '/' .
                                                    $mouse->getGeno($mouse->geno_type_b) . ')' }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-6 col-md-2">
                            {!! Form::submit('Add',['class'=>'btn btn-default']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@else

    You've Reached external
@endif

{{--A nice +/- number selector, need to get JS to work in view --}}
{{--<div class="col-lg-1">--}}
{{--<div class="input-group">--}}
{{--<span class="input-group-btn"><button class="btn btn-default value-control" data-action="minus" data-target="font-size"><span class="glyphicon glyphicon-minus"></span></button></span>--}}
{{--<input type="text" value="1" class="form-control" id="font-size">--}}
{{--<span class="input-group-btn"><button class="btn btn-default value-control" data-action="plus" data-target="font-size"><span class="glyphicon glyphicon-plus"></span></button></span>--}}
{{--</div>--}}
{{--</div>--}}
{{--<script type="text/javascript" src="{!! asset('public/js/button.js') !!}}"></script>--}}

@endsection