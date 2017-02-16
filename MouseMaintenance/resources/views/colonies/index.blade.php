@extends('layouts.app')


@section('content')

<div class="whole">

    <div class="panel panel-default">
        <div class="panel-heading"><h1>Colony</h1></div>
            <div class="panel-body">
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
            </div>
        </div>
    <div class="whole">
        <div class="panel panel-default">
            <div class="panel-heading">Add Mice</div>
            <div class="panel-body">
                <div>
                    {!! Form::open(['action' => 'MouseController@create', 'method' => 'get']) !!}
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
                            {!! Form::submit('Add',['class'=>'btn btn-default']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection