@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Cardiovascular Research</div>

                <div class="panel-body">
                    Your Application's Landing Page.
                    <li><a href="{{ url('/home') }}">Home</a></li>
                    <li><a href="{{ url('/colonies') }}">Colonies</a></li>
                    <li><a href="{{ url('/mice') }}">Mice</a></li>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
