@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>
            <label class="control-label">Surgery Batch # {{$surgery->id}}</label>
        </h1>
        <h3>
            Mice in Batch:
        </h3>
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
                <th>Weight</th>
                <th>Blood Pressure</th>
                <th>Wean Date</th>
                <th>End Date</th>
                <th>Comments</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($surgery->mice as $mouse)
                @if(isset($mouse->tags->last()->tag_num))
                    @if($mouse->sex == 'True')
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
                        <td>({{$mouse->getGeno($mouse->geno_type_a)}}/{{$mouse->getGeno($mouse->geno_type_b)}})</td>
                        <td>{{$mouse->getAge($mouse->birth_date)}} weeks</td>
                        <td>{{$mouse->weights->last()->weight}}g</td>
                        <td>
                            {{$mouse->showDate($mouse->blood_pressures->last()->taken_on)}}
                        </td>
                        <td>{{$mouse->showDate($mouse->wean_date)}}</td>
                        <td>{{$mouse->showDate($mouse->end_date)}}</td>
                        <td>{{$mouse->comments}}  </td>
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
        {!! Form::open(['action' => 'SurgeryController@store' ]) !!}
        @foreach ($surgery->mice as $mouse)
            <input type="hidden" name="surgery_mice[]" value="{{$mouse->id}}"/>
        @endforeach
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-sm-10 col-xs-12 col-md-offset-3 col-sm-offset-1">
                    <form method="post">
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-6">
                                <div class="form-group col-md-12">
                                    <input class="form-control" id="treatment" value="{{ $surgery->treatment }}"
                                           name="treatment" placeholder="Treatment" type="text"/>
                                </div>
                                <div class="form-group col-md-12">
                                    <input class="form-control" value="{{$surgery->scheduled_date}}"
                                           placeholder="Surgery Date" id="date" name="scheduled_date" type="date"/>
                                </div>
                                <div class="col-md-12" style="height:50px;"></div>
                                <div class="form-group col-md-12 hidden-xs">
                                    {!! Form::submit('Add',['class'=>'btn btn-default pull-right']) !!}
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-sm-6">
                                <div class="form-group col-md-12">
                                    <select name="surgeon" id="surgeon" class="form-control">
                                        <option value="0">Select Surgeon...</option>
                                        @foreach($surgeons as $surgeon)
                                            <option value="{{ $surgeon->id }}"
                                                @if($surgery->user_id == $surgeon->id) selected="selected" @endif>
                                                {{$surgeon->first_name . ' ' . $surgeon->last_name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <textarea class="form-control" cols="40" id="comments" name="comments"
                                              placeholder="Comments" rows="6">{{$surgery->comments}}</textarea>
                                </div>
                                <div class="form-group col-md-12 hidden-sm hidden-md hidden-lg">
                                    {!! Form::submit('Add',['class'=>'btn btn-default pull-right']) !!}
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </form>
                    <a class="pull-right" href="{{ action( 'SurgeryController@index') }}">
                        Go Back
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection