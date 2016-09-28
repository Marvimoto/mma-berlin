<?php
use Illuminate\Support\Facades\Auth;
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>MMA Berlin</title>

    <!-- Bootstrap -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <style>body { padding-top: 70px; }</style>
</head>

<body>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a href="{{url('/')}}" class="navbar-brand">MMA Berlin</a>
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="infos">Infos <span class="caret"></span></a>
                    <ul class="dropdown-menu" aria-labelledby="themes">
                        <li><a href="{{url('infos')}}">MMA</a></li>
                        <li><a href="{{url('preise')}}">Preise</a></li>
                        <li><a href="{{url('training')}}">Training</a></li>
                        <li><a href="{{url('team')}}">Team</a></li>
                        <li><a href="{{route('probetraining.create') }}">Probetraining</a></li>
                    </ul>
                </li>
                <li><a href="{{url('stundenplan')}}">Stundenplan</a></li>
                <li><a href="{{url('kontakt')}}">Kontakt</a></li>
                <li><a href="{{url('kontakt')}}">Turniere</a></li>
                <li><a href="/">Blog</a></li>
                <li><a href="{{url('impressum')}}">Impressum</a></li>
            </ul>
            @if (Auth::check())
            <ul class="navbar-nav nav navbar-right"><li><a href="{{url('admin/stundenplan')}}">Admin Dashboard</a></li></ul>
            @endif
        </div>
    </div>
</nav>

<div class="container">