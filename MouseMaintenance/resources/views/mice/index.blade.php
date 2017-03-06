@extends('layouts.app')

@section('content')
@if(!$pep)
    <div class="container">
        <h1 class="row-centered">All Mice</h1>
        <div class="panel panel-default whole">
            <div class="panel-heading"><h3>Tagged Mice</h3></div>
            <div class="panel-body">
                @if(count($errors))
                    <ul>
                        @foreach($errors->all() as $error)
                            @if($error == 'The group select cb field is required.')
                                <li>Please select mice to process.</li>
                            @else
                                <li>{{ $error }}</li>
                            @endif
                        @endforeach
                    </ul>
                @endif
                <button type="submit" name="submit" value="breeders" id="submit_breeders" class="btn btn-default pull-right btn-block sixth bottom-buffer last">
                    Breeders
                </button>

                {{--{{ Form::open(['action' => ['SurgeryController@create'], 'method' => 'get']) }}--}}
                {{ Form::open(array('url' => 'mice/groupTagged')) }}
                <table class="table table-bordered table-striped" id="mice_table" data-toggle="table" >
                    <thead>
                        <tr>
                            <th></th>
                            <th data-field="tag" >Tag</th>
                            <th>Strain</th>
                            <th>Genotype</th>
                            {{--<th>Source</th>--}}
                            {{--<th>Pedigree</th>--}}
                            {{--<th>Sex</th>--}}
                            <th>DOB</th>
                            <th>Age</th>
                            <th>Weight</th>
                            {{--<th>Blood Pressure</th>--}}
                            {{--<th>End Date</th>--}}
                            <th>Reserved For</th>
                            <th>Comments</th>
                            <th></th>
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
                                    {{--<td>--}}
                                        {{--{{ $mouse->source }}--}}
                                    {{--</td>--}}
                                    {{--<td>--}}
                                        {{--{{$mouse->tagPad($mouse->father_record->tags->last()->tag_num)}}{{$mouse->getGender($mouse->father_record->sex)}}({{$mouse->getGeno($mouse->father_record->geno_type_a)}}/{{$mouse->getGeno($mouse->father_record->geno_type_b)}})x--}}
                                        {{--{{$mouse->tagPad($mouse->mother_one_record->tags->last()->tag_num)}}{{$mouse->getGender($mouse->mother_one_record->sex)}}({{$mouse->getGeno($mouse->mother_one_record->geno_type_a)}}/{{$mouse->getGeno($mouse->mother_one_record->geno_type_b)}})--}}
                                        {{--@if(isset($mouse->mother_two_record->sex))--}}
                                            {{--,{{$mouse->tagPad($mouse->mother_two_record->tags->last()->tag_num)}}--}}
                                            {{--{{$mouse->getGender($mouse->mother_two_record->sex)}}--}}
                                            {{--({{$mouse->getGeno($mouse->mother_two_record->geno_type_a)}}--}}
                                            {{--/{{$mouse->getGeno($mouse->mother_two_record->geno_type_b)}})--}}
                                        {{--@endif--}}
                                        {{--@if(isset($mouse->mother_three_record->sex))--}}
                                            {{--,{{$mouse->tagPad($mouse->mother_three_record->tags->last()->tag_num)}}--}}
                                            {{--{{$mouse->getGender($mouse->mother_three_record->sex)}}--}}
                                            {{--({{$mouse->getGeno($mouse->mother_three_record->geno_type_a)}}--}}
                                            {{--/{{$mouse->getGeno($mouse->mother_three_record->geno_type_b)}})--}}
                                        {{--@endif--}}
                                    {{--</td>--}}
                                    {{--<td>{{$mouse->getGender($mouse->sex)}}</td>--}}
                                    <td>{{ $mouse->showDate($mouse->birth_date) }}</td>
                                    <td>{{$mouse->getAge($mouse->birth_date)}}</td>
                                    <td>
                                        @if(!empty($mouse->weights->last()->weight))
                                            {{$mouse->weights->last()->weight . 'g'}}
                                        @endif
                                    </td>
                                    {{--<td>--}}
                                        {{--@if(!empty($mouse->blood_pressures->last()->taken_on))--}}
                                            {{--{{$mouse->showDate($mouse->blood_pressures->last()->taken_on)}}--}}
                                        {{--@endif--}}
                                    {{--</td>--}}
                                    {{--<td>{{$mouse->showDate($mouse->end_date)}}</td>--}}
                                    <td>{{$mouse->users}}</td>
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

                <button type="submit" name="submit" value="edit" id="submit_edit" class="btn btn-default pull-left btn-block sixth">
                    Edit
                </button>

                <button type="submit" name="submit" value="surgery" id="submit_surgery" class="btn btn-default pull-left btn-block sixth show_btn">
                    Create Surgery
                </button>
                {{ Form::close() }}
                <button id="submit_euthanize" class="btn btn-default pull-left btn-block sixth show_btn">
                    Eunthanize
                </button>


                {{ Form::open(['action' => ['MouseController@index'], 'method' => 'get']) }}
                <button type="submit" class="btn btn-default pull-right btn-block sixth last">
                    <input type="hidden" name="pep_mice"/>
                    View Archived mice
                </button>
                {{ Form::close() }}
                <div id="euthOptions" class="top-buffer">
                    <div id="euthPurpose" class="form-group quarter">
                        <label>Purpose:</label>
                        <select class="form-control" name="purpose" id="purpose">
                            <option value="0">Select Purpose</option>
                            <option value="1">Experiment</option>
                            <option value="2">Tissue Isolation</option>
                            <option value="3">N/A</option>
                        </select>
                    </div>
                    <div id="euthExperiment" class="form-group quarter">
                        <label>Experiment Type:</label>
                        <select class="form-control" name="experiment" id="experiment">
                            <option value="0">Select Experiment</option>
                            <option value="1">Optical Mapping</option>
                            <option value="2">Patch Clamp Experiment</option>
                            <option value="3">Intracardiac Experiment</option>
                        </select>
                    </div>
                    <div id="euthStorage" class="form-group quarter">
                        <label>Storage Type:</label>
                        <select class="form-control" name="storage" id="storage">
                            <option value="0">Select Storage</option>
                            <option value="1">-80 Freezer #1</option>
                            <option value="2">-80 Freezer #2</option>
                            <option value="2">Paraffin Embedding (Histology)</option>
                        </select>
                    </div>
                    <button type="submit" name="submit" value="euthNext" id="submit_Euthanization" class="btn btn-default pull-left btn-block sixth show_btn">
                        Next
                    </button>
                </div>
            </div>
        </div>

        <div class="panel panel-default whole">
            <div class="panel-heading"><h3>Untagged Mice</h3></div>
            <div class="panel-body">

                {{ Form::open(array('url' => 'mice/groupUntagged')) }}
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            {{--<th>Strain</th>--}}
                            {{--<th>Source</th>--}}
                            <th>Remove</th>
                            <th>Tag</th>
                            <th>Set Sex</th>
                            <th>Sex</th>
                            <th>Pedigree</th>
                            <th>DOB</th>
                            <th>Wean Date</th>
                            <th>Comments</th>
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
                                    <td>
                                        <input type="hidden" name="mice[]" id="mice" value="{{ $mouse->id }}"/>
                                        <input type="checkbox" class="untaggedChk" value="{{ $mouse->id }}" id="group_select_untagged_cb"
                                               name="group_select_untagged_cb[]" onchange="checkRemove()"/>

                                    </td>
                                    <td class="col-sm-2 col-md-1">
                                        <input type="text" id="new_tag_id" maxlength="3" minlength="3"
                                               class="form-control col-md-1" oninput="checkTag()" name="new_tag_id[]"/>
                                    </td>
                                    {{--<td>{{ $mouse->colony->name }}</td>--}}
                                    {{--<td>{{ $mouse->source }}</td>--}}
                                    <td>
                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-default" for="sex">
                                                <input type="radio" name="sex[{{ $mouse->id }}]" id="sex" value="1" onchange="checkSex()" />M
                                            </label>
                                            <label class="btn btn-default" for="sex">
                                                <input type="radio" name="sex[{{ $mouse->id }}]" id="sex" value="0" onchange="checkSex()" />F
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        @if(isset($mouse->sex))
                                            {{ $mouse->getGender($mouse->sex) }}
                                        @endif
                                    </td>
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
                                    <td>{{$mouse->showDate($mouse->wean_date)}}</td>
                                    <td>{{$mouse->comments}}  </td>

                                        {{--{{ Form::open(['action' => ['MouseController@edit', $mouse], 'method' => 'get']) }}--}}
                                        {{--<button type="submit" >--}}
                                            {{--<span class="glyphicon glyphicon-tags"></span>--}}
                                        {{--</button>--}}
                                        {{--{{ Form::close() }}--}}

                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                <button type="submit" name="submit" value="remove" id="submit_remove" class="btn btn-default pull-left btn-block sixth">
                    Remove
                </button>

                <button type="submit" name="submit" value="tag" id="submit_tag" class="btn btn-default pull-left btn-block sixth show_btn">
                    Tag Selected Mice
                </button>

                <button type="submit" name="submit" value="sex" id="submit_sex" class="btn btn-default pull-left btn-block sixth show_btn">
                    Assign Sex
                </button>
                {{ Form::close() }}
                <button type="button"  value="clear_sex" id="clear_sex" onclick="clearSex()" class="btn btn-default pull-left btn-block sixth show_btn">
                    Clear Sex
                </button>
            </div>
        </div>
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

<script type="text/javascript">
    var btn_submit_tag = document.getElementById('submit_tag');
    var btn_submit_sex = document.getElementById('submit_sex');
    var btn_clear_sex = document.getElementById('clear_sex');
    var btn_submit_remove = document.getElementById('submit_remove');
    var new_tag_array = document.getElementsByName('new_tag_id[]');
    var remove_cbk_array = document.getElementsByName('group_select_untagged_cb[]');

    function checkTag(){
        var tagArray = <?php echo json_encode($active_tags) ?>;
        var tag_str;
        var tag_num = [];
        var duplicate = [];

        //place each new_tag_input into one array
        for(i=0; i < new_tag_array.length; i++){
            tag_num.push(new_tag_array[i].value);
        }

        //loop array of current tags and new tags for duplicates and disable submit
        for(var i = 0; i < tagArray.length; i++) {
            for (var j = 0; j < tag_num.length; j++) {
                if (tagArray[i] == tag_num[j]) {
                    duplicate.push(j);
                    btn_submit_tag.disabled = true;
                } else {
                    new_tag_array[j].style.backgroundColor = "white";
                }
            }
        }

        //if duplicate set input to yellow
        for(var i = 0; i < duplicate.length; i++){
            new_tag_array[duplicate[i]].style.backgroundColor = "yellow";
        }

        //if no duplicates ensure button is enabled
        if(duplicate.length < 1){
            btn_submit_tag.disabled = false;
        }

        //if any inputs hold value, disable submit for sex and delete
        tag_str = parseFloat((tag_num.join()).replace(/,/g, ''));
        if(isNaN(tag_str)){
            btn_submit_sex.disabled = false;
            btn_submit_remove.disabled = false;
            btn_clear_sex.disabled = false;
            $(".btn-group label").attr("disabled", false);
            $("[name='group_select_untagged_cb[]']").attr('disabled', false);
        }else{
            $(".btn-group label").attr("disabled", true);
            btn_submit_sex.disabled = true;
            btn_submit_remove.disabled = true;
            btn_clear_sex.disabled = true;
            $("[name='group_select_untagged_cb[]']").attr('disabled', true);
        }
    }

    document.on('change', '[type=input]', function (e) {
        alert('This is the ' + $(this).index('[type=input]') + ' checkbox');
    });

    function checkRemove() {
        var total_cbks = $('.untaggedChk').length;
        var remove_array = [];

        for (var i = 0; i < total_cbks; i++) {
            if (remove_cbk_array[i].checked) {
                remove_array.push(i);
            }
        }
        //check boxes not selected enable other form elements
        if (remove_array.length < 1) {
            btn_submit_sex.disabled = false;
            btn_submit_tag.disabled = false;
            btn_clear_sex.disabled = false;
            $(".btn-group label").attr("disabled", false);
            $("[name='new_tag_id[]']").attr('readOnly', false);
        } else { //check boxes selected, disable and clear other form elements
            btn_submit_sex.disabled = true;
            btn_submit_tag.disabled = true;
            btn_clear_sex.disabled = true;
            $(".btn-group label").attr("disabled", true);
            $(".btn-group label").removeClass('active').end()
                    .find('[type="radio"]').prop('checked', false);
            $("[name='new_tag_id[]']").val('');
            $("[name='new_tag_id[]']").attr('readOnly', true);
        }
    }

    function checkSex(){
        //determine if any checkbox is checked
        if(($(".btn-group label").find('[type="radio"]')).length > 0){
            //disable other form controls
            $("[name='new_tag_id[]']").attr('readOnly', true);
            $("[name='group_select_untagged_cb[]']").attr('disabled', true);
            btn_submit_tag.disabled = true;
            btn_submit_remove.disabled = true;
        }else{//enable other form controls when no radio checked
            $("[name='new_tag_id[]']").attr('readOnly', false);
            $("[name='group_select_untagged_cb[]']").attr('disabled', false);
            $(".btn-group label").find('[type="radio"]').data('waschecked', false);
            $(".btn-group label").find('[type="radio"]').prop('checked', false);
            btn_submit_tag.disabled = false;
            btn_submit_remove.disabled = false;
        }
    }

    //clear the sex option if one or more have been clicked
    function clearSex(){
        $(".btn-group label").removeClass('active').end()
                .find('[type="radio"]').prop('checked', false);
        $("[name='new_tag_id[]']").attr('readOnly', false);
        $("[name='group_select_untagged_cb[]']").attr('disabled', false);
        btn_submit_tag.disabled = false;
        btn_submit_remove.disabled = false;
    }

</script>
<style type="text/css">
    /*Prevent disabled radios from being clicked*/
    label[disabled]{
        pointer-events:none;
    }
</style>
@endsection