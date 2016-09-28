<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>MMA Berlin Dashboard</title>

    <!-- Bootstrap -->
    <!--<link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.6/flatly/bootstrap.min.css" rel="stylesheet" integrity="sha384-XYCjB+hFAjSbgf9yKUgbysEjaVLOXhCgATTEBpCqT1R3jvG5LGRAK5ZIyRbH5vpX" crossorigin="anonymous">-->
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/timepicki.css') }}">
    <script src="{{ asset('js/jquery-2.2.3.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/timepicki.js')}}"></script>
    <script src="{{ asset('js/isotope.pkgd.min-2.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <style>body {
            padding-top: 70px;
        }</style>
</head>

<body>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a href="{{url('admin/dashboard')}}" class="navbar-brand">MMA Berlin Dashboard</a>
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="stundenplan">Stundenplan<span
                                class="caret"></span></a>
                    <ul class="dropdown-menu" aria-labelledby="themes">
                        <li><a href="{{url('admin/stundenplaene')}}">Stundenpläne</a></li>
                        <li><a href="{{url('admin/trainer')}}">Trainer</a></li>
                        <li><a href="{{url('admin/kurse')}}">Kurse</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="turnier">Turniere<span
                                class="caret"></span></a>
                    <ul class="dropdown-menu" aria-labelledby="themes">
                        <li><a href="{{url('admin/turniere')}}">Turniere</a></li>
                        <li><a href="{{url('admin/gyms')}}">Gyms</a></li>
                        <li><a href="{{url('admin/fighters')}}">Kämpfer</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{url('logout')}}">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">