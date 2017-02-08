@extends('layouts.app')


@section('content')
    <style>
        option {
            text-align: center;
        }
    </style>

<div class="container">
    <h1>Colony</h1>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Colony Name</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($colonies as $colony)
        <tr>
            <td>
                <a href="{{ action( 'ColonyController@show', ['id' => $colony->id]) }}">
                    {{$colony->name}}
                </a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    {{--<div class="dropdown">--}}
        {{--<button class="btn btn-default dropdown-toggle" type="button" id="dropDownNewMice" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">--}}
            {{--Add Mice--}}
            {{--<span class="caret"></span>--}}
        {{--</button>--}}
        {{--<ul class="dropdown-menu" aria-labelledby="dropDownNewMice">--}}
            {{--<li><strong>Select Source</strong></li>--}}
            {{--<li role="separator" class="divider"></li>--}}
            {{--<li><a href="{{ action( 'MouseController@createSource', ['source' => 'internal']) }}">In House</a></li>--}}
            {{--<li><a href="{{ action( 'MouseController@createSource', ['source' => 'external']) }}">External</a></li>--}}
        {{--</ul>--}}
    {{--</div>--}}
</div>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">Add Mice</div>
        <div class="panel-body">
            <div>
                <form id="createMice" method="GET" action="mice/source">
                    {{ csrf_field() }}
                    {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-6 col-md-2">
                            <label>Add Mice</label>
                            <select class="form-control" name="source" id="source" onchange="selectedSource();">
                                <option value="0">Select source</option>
                                <option value="1">In House</option>
                                <option value="2">External</option>
                            </select>
                        </div>
                        <div style="display:none" id=selectCage class="form-group col-xs-12 col-sm-6 col-md-2">
                            <label>Select Breeder Cage:</label>
                            <select class="form-control" name="cage_id" id="cage_id">
                                <option value="0">Select Cage </option>
                                @foreach($cages as $cage)
                                    <option value="{{ $cage->id }}">{{ $cage->id }}</option>
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


<script>
    function selectedSource(){
        var dropDown = document.getElementById("source");
        var currentValue = dropDown.options[dropDown.selectedIndex].value;

        if(currentValue == "1"){
            document.getElementById("selectCage").style.display = "block";
        }else{
            document.getElementById("selectCage").style.display = "none";
        }
    }

    $('#createMice').on('submit', function() {
        var id = $('#source').val();
        var formAction = $('#createMice').attr('action');
        $('#createMice').attr('action', formAction + id);
    });

</script>
@endsection