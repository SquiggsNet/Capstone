@extends('layouts.app')


@section('content')

    <div class="container">
        <div class="row">
            <div class="panel panel-default third-x2">
                <div class="panel-heading"><h1>Colonies</h1></div>
                <div class="panel-body">

                    <table class="table table-bordered table-striped">
                        {{--<thead>--}}
                        {{--<tr>--}}
                            {{--<th>Colony Name</th>--}}
                        {{--</tr>--}}
                        {{--</thead>--}}
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

            <div class="panel panel-default third last">
                <div class="panel-heading"><h1>Add Mice</h1></div>
                <div class="panel-body">

                        {!! Form::open(['action' => 'MouseController@create', 'method' => 'get']) !!}

                            <div class="form-group third-x2">
                                <label>Add Mice</label>
                                <select class="form-control" name="source" id="source" onchange="selectedSource();">
                                    <option value="0">Select source</option>
                                    <option value="1">In House</option>
                                    <option value="2">External</option>
                                </select>
                            </div>
                            <div style="display:none" id=selectCage class="form-group third-x2">
                                <label>Select Breeder Cage:</label>
                                <select class="form-control" name="cage_id" id="cage_id">
                                    <option value="0">Select Cage </option>
                                    @foreach($cages as $cage)
                                        <option value="{{ $cage->id }}">{{ $cage->id }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group clearfix">
                                {!! Form::submit('Add',['class'=>'btn btn-default']) !!}
                            </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
    </div>


@endsection