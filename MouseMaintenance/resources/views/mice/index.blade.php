@extends('layouts.app')

@section('content')
@if(!$pep)
    <div class="container">
        <h1>Mice</h1>
        <div class="panel-body">
            <div class="form-group">
                {{--{{ Form::open(['action' => ['SurgeryController@create'], 'method' => 'get']) }}--}}
                {{ Form::open(array('url' => 'mice/group')) }}
                <table class="table table-bordered table-striped" id="mice_table" data-toggle="table" >
                    <thead>
                    <tr>
                        <th></th>
                        <th data-field="tag" >Tag</th>
                        <th>Strain</th>
                        <th>Genotype</th>
                        <th>Source</th>
                        <th>Pedigree</th>
                        <th>Sex</th>
                        <th>Age</th>
                        <th>DOB</th>
                        <th>Weight</th>
                        <th>Blood Pressure</th>
                        <th>End Date</th>
                        <th>Comments</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($mice as $mouse)
                        @if(isset($mouse->tags->last()->tag_num))
                            @if($mouse->sex == "1")
                                <?php $class = "info" ?>
                            @elseif($mouse->sex == "0" and !is_null($mouse->sex))
                                <?php $class = "danger" ?>
                            @else
                                <?php $class = "" ?>
                            @endif
                            @if($mouse->sick_report)
                                <?php $id = "report" ?>
                            @else
                                <?php $id = "no_report" ?>
                            @endif
                                <tr class="{{ $class }}" id="{{ $id }}">
                                <td>
                                    <input type="checkbox" id="group_select_cb" name="group_select_cb[]" value="{{ $mouse->id }}"/>
                                </td>
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
                                <td>{{ $mouse->genoFormat($mouse->geno_type_a, $mouse->geno_type_b) }}</td>
                                <td>
                                    {{ $mouse->source }}
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
                                <td>{{$mouse->getAge($mouse->birth_date)}} weeks</td>
                                <td>{{ $mouse->showDate($mouse->birth_date) }}</td>
                                <td>
                                    @if(!empty($mouse->weights->last()->weight))
                                        {{$mouse->weights->last()->weight . 'g'}}
                                    @endif
                                </td>
                                <td>
                                    @if(!empty($mouse->blood_pressures->last()->taken_on))
                                        {{$mouse->showDate($mouse->blood_pressures->last()->taken_on)}}
                                    @endif
                                </td>
                                <td>{{$mouse->showDate($mouse->end_date)}}</td>
                                <td>{{$mouse->comments}}  </td>
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
                        @endif
                    @endforeach
                    </tbody>
                </table>
                <div>
                <button type="submit" name="submit" value="surgery" id="submit_surgery" class="btn btn-default pull-left">
                    Create Surgery
                </button>
                </div>
                <div id="submit_euthanize_div">
                <button type="submit" name="submit" value="euthanize" id="submit_euthanize" class="btn btn-default pull-left">
                    Eunthanize
                </button>
                </div>
                {{ Form::close() }}
                {{ Form::open(['action' => ['MouseController@index'], 'method' => 'get']) }}
                <button type="submit" class="btn btn-default pull-right">
                    <input type="hidden" name="pep_mice"/>
                    View Archived mice
                </button>
                {{ Form::close() }}
            </div>
        </div>
        <h3>Untagged Mice</h3>
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Strain</th>
                <th>Source</th>
                <th>Sex</th>
                <th>Pedigree</th>
                <th>DOB</th>
                <th>Give Tag</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($mice as $mouse)
                @if(!isset($mouse->tags->last()->tag_num))
                    @if($mouse->sex == "1")
                            <?php $class = "info" ?>
                        @elseif($mouse->sex == "0")
                            <?php $class = "danger" ?>
                        @else
                            <?php $class = "" ?>
                        @endif
                    @if($mouse->sick_report)
                            <?php $id = "report" ?>
                        @else
                            <?php $id = "no_report" ?>
                        @endif
                    <tr class="{{ $class }}" id="{{ $id }}">
                        <td>{{ $mouse->colony->name }}</td>
                        <td>{{ $mouse->source }}</td>
                        <td>{{ $mouse->getGender($mouse->sex) }}</td>
                        @if($mouse->source == 'In house')
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
                        @else
                            <td>N/A</td>
                        @endif

                        <td>{{$mouse->showDate($mouse->birth_date)}}</td>
                        <td>
                            {{ Form::open(['action' => ['MouseController@edit', $mouse], 'method' => 'get']) }}
                            <button type="submit" >
                                <span class="glyphicon glyphicon-tags"></span>
                            </button>
                            {{ Form::close() }}
                        </td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
@else
    <div class="container">
        <h1>Archived Mice</h1>
        <div class="form-group">
            {{ Form::open(['action' => ['MouseController@index'], 'method' => 'get']) }}
            <button type="submit" class="btn btn-default pull-right">
                <input type="hidden" name="mice"/>
                <span class="glyphicon glyphicon-skull"></span>
                View Current Mice
            </button>
            {{ Form::close() }}
        </div>
        <table class="table table-bordered table-striped" id="mice_table" data-toggle="table" >
            <thead>
            <tr>
                <th data-field="tag" >Tag</th>
                <th>Strain</th>
                <th>Source</th>
                <th>Pedigree</th>
                <th>Sex</th>
                <th>Geno Type</th>
                <th>Age</th>
                <th>DOB</th>
                <th>Weight</th>
                <th>Blood Pressure</th>
                <th>Wean Date</th>
                <th>End Date</th>
                <th>Comments</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($mice as $mouse)
                @if(isset($mouse->tags->last()->tag_num))
                    @if($mouse->sex == '1')
                        <?php $class = "info" ?>
                    @else
                        <?php $class = "danger" ?>
                    @endif
                    @if($mouse->sick_report)
                        <?php $id = "report" ?>
                    @else
                        <?php $id = "no_report" ?>
                    @endif
                    <tr class="{{ $class }}" id="{{ $id }}">
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
                            {{ $mouse->source }}
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
                        <td>{{ $mouse->genoFormat($mouse->geno_type_a, $mouse->geno_type_b) }}</td>
                        <td>{{$mouse->getAge($mouse->birth_date)}} weeks</td>
                        <td>{{ $mouse->showDate($mouse->birth_date) }}</td>
                        <td>{{$mouse->weights->last()->weight}}g</td>
                        <td>
                            {{$mouse->blood_pressures->last()->taken_on}}
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
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
@endif
<style type="text/css">
    #report{
        color: red;
    }
</style>
@endsection