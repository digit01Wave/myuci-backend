<!doctype html>

<html>
<head>
    @section('head')
        <!--Bootstrap-->
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="/css/master.css">
    @show
</head>
<body>
    <!--Nav Bar-->
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <!--The tree bar icon thing-->
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!--Home Page Brand Corner-->
                <a class="navbar-brand" href="{{URL::route('home')}}">myUCI</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-responsive-collapse">
                <!--Left Nav Tabs-->
                <ul class="nav navbar-nav">
                    <li><a href="{{URL::route('rest')}}">REST Services</a><li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{URL::route('getEvents')}}">Events</a></li>
                    @if(!Auth::check())
                        <li><a href="{{URL::route('getCreate')}}">Register</a></li>
                        <li><a href="{{ URL::route('getLogin')}}">Login</a></li>
                    @else
                        <li><a href="{{ URL::route('getLogout') }}">Logout</a></li>
                    @endif
                </ul>
                <!--Right Nav Tabs-->
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

    <!--Error reporting-->
    @if(Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
    @elseif(Session::has('fail'))
            <div class="alert alert-danger">{{Session::get('fail')}} </div>
    @endif

    <!--Page Content-->
    <div class='container'>
        @yield('content')
    </div>

    <!--Javascript-->
    @section('javascript')
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" type="text/javascript"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    @show
</body>
</html>
