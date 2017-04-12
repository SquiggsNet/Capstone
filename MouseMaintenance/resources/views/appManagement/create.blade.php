@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Data Export</h1>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><h4>Mouse Table</h4></div>
                    <div class="panel-body">
                        <h5>Click to download data from mouse table</h5>
                        {{ Form::open(array('url' => 'mice/export')) }}
                        <button type="submit" name="submit" value="export_mice" id="export_mice" class="btn btn-default pull-left btn-block sixth show_btn">
                        Export Mice <span class="glyphicon glyphicon-download-alt"></span>
                        </button>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection