@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="text-right">
                <a class="glyphicon glyphicon-question-sign" href="{{ url('/password/reset') }}"></a>
            </div>
            <div class="control-label col-md-offset-2 hidden-xs">
                {!! Html::image('img/mmLogoSmooth.png', 'Laboratory Mouse Tracker') !!}
            </div>
            <div class="control-label col-xs-offset-3 hidden-sm hidden-md hidden-lg">
                {!! Html::image('img/mmLogoSmoothXS.png', 'Laboratory Mouse Tracker') !!}
            </div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="col-md-6 col-md-offset-3">
                            <input id="email" type="email" class="form-control" name="email" placeholder="username" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <div class="col-md-6 col-md-offset-3">
                            <input id="password" type="password" class="form-control" placeholder="password" name="password">

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <div class="checkbox col-md-offset-1">
                                <label>
                                    <input type="checkbox" name="remember"> Remember Me
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-5">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-sign-in"></i> Login
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    .glyphicon.glyphicon-question-sign {
        font-size: 25px;
    }
</style>
@endsection
