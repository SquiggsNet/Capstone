@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>
            <label class="control-label">Selected For Surgery</label>
        </h1>
        <table class="table table-bordered table-striped" id="mice_table" data-toggle="table" >
            <thead>
            <tr>
                <th data-field="tag" >Tag</th>
                <th>Strain</th>
                <th>Geno Type</th>
                <th>Age</th>
                <th>Weight</th>
                <th>Treatment</th>
                <th>Dosage(mg/kg/day)</th>
                <th>Experimental Use</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php $m_num = 0;?>
            @foreach ($mice as $mouse)
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
                        {{--Mouse Tags--}}
                        <td>
                            <a href="{{ action( 'MouseController@show', ['id' => $mouse->id]) }}">
                                {{ $mouse->tagPad($mouse->tags->last()->tag_num) }}
                            </a>
                        </td>
                        {{--Strain--}}
                        <td>
                            <a href="{{ action( 'ColonyController@show', ['id' => $mouse->colony->id]) }}">
                                {{$mouse->colony->name}}
                            </a>
                        </td>
                        {{--GenoType--}}
                        <td>
                            @if(isset($mouse->geno_type_a))
                                {{ $mouse->genoFormat($mouse->geno_type_a, $mouse->geno_type_b) }}
                            @else
                                N/A
                            @endif
                        </td>
                        {{--Age--}}
                        <td>
                            {{$mouse->getAge($mouse->birth_date)}}
                        </td>
                        {{--Current Weight--}}
                        <td>
                            @if(isset($mouse->weights->last()->weight))
                                {{$mouse->weights->last()->weight}}g
                            @endif
                        </td>
                        {{--Treatment--}}
                        <td class="col-lg-2">
                            @for($i = 0; $i < count($treatments); $i++)
                                <select name="{{ $m_num }}_treatment[]" id="treatment" class="form-control">
                                    <option value="0">Treatment Type</option>
                                    @foreach($treatments as $treatment)
                                            <option value="{{ $treatment->id }}">
                                                {{ $treatment->title }}
                                            </option>
                                    @endforeach
                                </select>
                            @endfor
                           <button value="{{ $m_num }}" type="button" onclick="addTreatment({{ $m_num }})" class="pull-left" >
                                <span class="glyphicon glyphicon-plus"></span>
                           </button>
                            <?php $m_num++; ?>
                        </td>
                        {{--Dosage--}}
                        <td class="col-lg-1">
                            <input class="form-control" name="dosage" id="dosage" type="number" step="any"/>
                        </td>
                        {{--Experimental Use--}}
                        <td></td>
                        {{--Edit--}}
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
        @foreach ($mice as $mouse)
            <input type="hidden" name="surgery_mice[]" value="{{$mouse->id}}"/>
        @endforeach
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-sm-10 col-xs-12 col-md-offset-3 col-sm-offset-1">
                        <form method="post">
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-6">
                                    <div class="form-group col-md-12">
                                        <input class="form-control" id="treatment" name="treatment" placeholder="Treatment" type="text"/>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <input class="form-control" placeholder="Surgery Date" id="date" name="scheduled_date" type="date"/>
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
                                                <option value="{{ $surgeon->id }}">
                                                    {{$surgeon->first_name . ' ' . $surgeon->last_name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <textarea class="form-control" cols="40" id="comments" name="comments" placeholder="Comments" rows="6"></textarea>
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

    <script type="text/javascript">
        //get the total amount of mice rows
        var rows = "{{ count($mice)}}"
        //total amount of treatments available
        var treatments = "{{ count($treatments) }}"
        //empty array to load data too=
        var ddl_treatment = [];

        //populate the nested array with all the treatments per mouse
        for(var i = 0; i < rows; i++){
            for(var j = 0; j < treatments; j++) {
                ddl_treatment[i] = document.getElementsByName(i + '_treatment[]');
            }
        }

        //hide all treatments that are beyond the first one.
        for(var x = 0; x < ddl_treatment.length; x++){
            var ddl = ddl_treatment[x];
            for(var y = 0; y < ddl.length; y++) {
                if(y != 0){
                    ddl[y].style.display = 'none';
                }
            }
        }

        function addTreatment(btn_pressed){
            var ddl_treatment = [];

            //populate the nested array with all the treatments per mouse
            for(var i = 0; i < rows; i++){
                for(var j = 0; j < treatments; j++) {
                    ddl_treatment[i] = document.getElementsByName(i + '_treatment[]');
                }
            }

            //hide all treatments that are beyond the first one.
            for(var x = 0; x < ddl_treatment.length; x++) {
                if (btn_pressed == x) {
                    var ddl = ddl_treatment[x];
                    for (var y = 1; y < ddl.length + 1; y++) {
                        if (ddl[y - 1].offsetParent != null) {
                            ddl[y].style.display = 'block';
                            break;
                        }
                    }
                }
            }
        }
    </script>
@endsection