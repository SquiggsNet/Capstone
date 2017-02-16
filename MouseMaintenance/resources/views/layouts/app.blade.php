<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Research Facility</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/styles.css">

</head>
<body id="app-layout">
<nav class="navbar navbar-default navbar-static-top" id="nav">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                {{--<img src="img/mmLogoSmoothXSInvert.png">--}}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li><a href="{{ url('/home') }}">Home</a></li>

                @if (!Auth::guest())

                    <li><a href="{{ url('/colonies') }}">Colonies</a></li>
                    <li><a href="{{ url('/mice') }}">Mice</a></li>
                    <li><a href="{{ url('/surgeries') }}">Surgeries</a></li>
                    {{--<li><a href="{{ url('/bloodPressures') }}">Blood Pressures</a></li>--}}
                    <li><a href="{{ url('/cages') }}">Breeders</a></li>
                    <li><a href="{{ url('/storages') }}">Storages</a></li>

                    {{--<li><a href="{{ url('/tags') }}">Tags</a></li>--}}
                    {{--<li><a href="{{ url('/tissues') }}">Tissues</a></li>--}}
                    {{--<li><a href="{{ url('/treatments') }}">Treatments</a></li>--}}
                    {{--<li><a href="{{ url('/weights') }}">Weights</a></li>--}}
                @endif
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
            <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->getFullName() }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/appManagement') }}">Manage</a></li>
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
<div>

</div>
<div>

    @if (Auth::guest())
        @yield('content')
    @else
        <div class="container">
            <div class="row">

                <div class="user quarter">
                    {{--<div class="third">--}}
                    <div class="panel panel-default">
                        <div class="panel-heading"><h4>{{ Auth::user()->getFullName() }}</h4></div>

                        <div class="panel-body">

                            <h4>User Info</h4>

                            <p>A general info for user</p>

                            <h4>Surgeries</h4>

                            <ul>
                                <li>Surgery 1</li>
                                <li>Surgery 2</li>
                                <li>Surgery 3</li>
                            </ul>

                            <p>A general info for user</p>

                            <h4>User Info</h4>

                            <p>A general info for user</p>
                        </div>
                    </div>
                </div>

                <div class="content last quarter-x3">
                    <div class="panel panel-default">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>


<!-- JavaScripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src="/js/scripts.js"></script>
{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>