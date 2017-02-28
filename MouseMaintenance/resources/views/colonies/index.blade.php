@extends('layouts.app')


@section('content')

    <div class="container">
        <div class="row">

            <div class="panel panel-default third-x2">
                <div class="panel-heading"><h3>Colonies</h3></div>
                <div class="panel-body">
                    @foreach ($colonies as $colony)
                        <a class="btn btn-lg btn-block" href="{{ action( 'ColonyController@show', ['id' => $colony->id]) }}" role="button">
                            {{$colony->name}}
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="panel panel-default third last">
                <div class="panel-heading"><h3>Add Mice</h3></div>
                <div class="panel-body">

                        {!! Form::open(['action' => 'MouseController@create', 'method' => 'get']) !!}

                            <div class="form-group">
                                <label>Add Mice</label>
                                <select class="form-control" name="source" id="source" onchange="selectedSource();">
                                    <option value="0">Select source</option>
                                    <option value="1">In House</option>
                                    <option value="2">External</option>
                                </select>
                            </div>
                            <div style="display:none" id=selectCage class="form-group">
                                <label>Select Breeder Cage:</label>
                                <select class="form-control" name="cage_id" id="cage_id">
                                    <option value="0">Select Cage </option>
                                    @foreach($cages as $cage)
                                        <option value="{{ $cage->id }}">{{ $cage->id }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group clearfix">
                                {!! Form::submit('Add',['class'=>'btn btn-block']) !!}
                            </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
    </div>


@endsection