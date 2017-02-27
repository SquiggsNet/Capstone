@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row row-centered">
        <div class="half col-centered">

            <div class="control-label hidden-xs">
                {!! Html::image('img/mmLogoSmooth.png', 'Laboratory Mouse Tracker') !!}
            </div>
            <div class="control-label hidden-sm hidden-md hidden-lg">
                {!! Html::image('img/mmLogoSmoothXS.png', 'Laboratory Mouse Tracker') !!}
            </div>

            <form class="form-horizontal sixth-x5 center-block" role="form" method="POST" action="{{ url('/login') }}">
            {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input id="email" type="email" class="form-control login" name="email" placeholder="username" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input id="password" type="password" class="form-control login" placeholder="password" name="password">
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group half">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember"> Remember Me
                        </label>
                    </div>
                </div>

                <div class="form-group text-right half pull-right">
                    <a href="{{ url('/password/reset') }}">Forgot Password</a>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary top-buffer">
                        <i class="fa fa-btn fa-sign-in"></i> Login
                    </button>
                </div>
            </form>

        </div>

        {{--<div class="col-md-8 col-md-offset-2">--}}
            {{--<div class="text-right">--}}
                {{--<a id="help" class="glyphicon glyphicon-question-sign" href="{{ url('/password/reset') }}"></a>--}}
            {{--</div>--}}
            {{--<div class="control-label col-md-offset-2 hidden-xs">--}}
                {{--{!! Html::image('img/mmLogoSmooth.png', 'Laboratory Mouse Tracker') !!}--}}
            {{--</div>--}}
            {{--<div class="control-label col-xs-offset-3 hidden-sm hidden-md hidden-lg">--}}
                {{--{!! Html::image('img/mmLogoSmoothXS.png', 'Laboratory Mouse Tracker') !!}--}}
            {{--</div>--}}
            {{--<div class="panel-body">--}}
                {{--<form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">--}}
                    {{--{{ csrf_field() }}--}}

                    {{--<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">--}}
                        {{--<div class="col-md-6 col-md-offset-3">--}}
                            {{--<input id="email" type="email" class="form-control" name="email" placeholder="username" value="{{ old('email') }}">--}}
                            {{--@if ($errors->has('email'))--}}
                                {{--<span class="help-block">--}}
                                    {{--<strong>{{ $errors->first('email') }}</strong>--}}
                                {{--</span>--}}
                            {{--@endif--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">--}}
                        {{--<div class="col-md-6 col-md-offset-3">--}}
                            {{--<input id="password" type="password" class="form-control" placeholder="password" name="password">--}}

                            {{--@if ($errors->has('password'))--}}
                                {{--<span class="help-block">--}}
                                    {{--<strong>{{ $errors->first('password') }}</strong>--}}
                                {{--</span>--}}
                            {{--@endif--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="form-group half">--}}
                        {{--<div class="col-md-6 col-md-offset-4">--}}
                            {{--<div class="checkbox col-md-offset-1">--}}
                                {{--<label>--}}
                                    {{--<input type="checkbox" name="remember"> Remember Me--}}
                                {{--</label>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="text-right half">--}}
                        {{--<a id="help" class="glyphicon glyphicon-question-sign" href="{{ url('/password/reset') }}"></a>--}}
                    {{--</div>--}}

                    {{--<div class="form-group">--}}
                        {{--<div class="col-md-6 col-md-offset-5">--}}
                            {{--<button id="login" type="submit" class="btn btn-primary">--}}
                                {{--<i class="fa fa-btn fa-sign-in"></i> Login--}}
                            {{--</button>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</form>--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>
</div>

<style type="text/css">
    footer{
        position: absolute;
        left: 0;
        right: 0;
        bottom: 0;
    }
</style>

@endsection
